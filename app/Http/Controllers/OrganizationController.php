<?php

namespace App\Http\Controllers;

use App\Models\Organizational;
use App\Models\Headquarter;
use App\Models\OrganizationalUnitTypes;
use App\Models\OrganizationalUnit;
use App\Models\OrganizationalUnitMember;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{

public function index()
{
    // Consulta optimizada para sedes activas con sus relaciones
    $headquartersWithUnitTypes = Headquarter::with([
        'organization:id,name,status', // Solo campos necesarios de organización
        'unitTypes.units' => function($query) {
            $query->where('status', 'active')
                  ->with([
                      'leaders' => function($q) {
                          $q->with('person:id,name') // Solo ID y nombre de persona
                            ->wherePivot('is_leader', true)
                            ->where(function($query) {
                                $query->whereNull('end_date')
                                      ->orWhere('end_date', '>', now());
                            })
                            ->orderBy('start_date', 'desc');
                      }
                  ]);
        }
    ])
    ->where('status', 'active')
    ->get(['id', 'name', 'organizational_id']); // Solo campos necesarios

    // Consulta separada para organizaciones (mejor rendimiento)
   $organizations = Organizational::active()->with(['headquarters' => function($query) {
        $query->where('status', 'active'); // Solo sedes activas
    }])->get(['id', 'name', 'status']);

    // Obtener sedes activas para el modal create-unit
    $headquarters = Headquarter::where('status', 'active')->get(['id', 'name']);

    // Obtener tipos de unidad activos para el modal create-unit
    $unitTypes = OrganizationalUnitTypes::where('status', 'active')->get(['id', 'name']);

    return view('service.organization.index', compact('organizations', 'headquartersWithUnitTypes', 'headquarters', 'unitTypes'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tax_id' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
        ]);

        $organization = Organizational::create($validated);

        return redirect()->route('organization')->with('success', 'Organization created successfully.');
    }

    public function update(Request $request, $id)
    {
        $organization = Organizational::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tax_id' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
        ]);

        $organization->update($validated);

        return redirect()->route('organization')->with('success', 'Organization updated successfully.');
    }

    public function show($id)
    {
        $organization = Organizational::with([
            'headquarters',
            'unitTypes.members'
        ])->findOrFail($id);
        return view('service.organization.show', compact('organization'));
    }

    // New method to return JSON data for edit modal
    public function getOrganizationData($id)
    {
        $organization = Organizational::with([
            'headquarters',
            'unitTypes.members'
        ])->findOrFail($id);
        return response()->json($organization);
    }

    public function destroy($id)
    {
        $organization = Organizational::findOrFail($id);
        $organization->delete();

        return response()->json(['success' => 'Organization deleted successfully']);
    }

}