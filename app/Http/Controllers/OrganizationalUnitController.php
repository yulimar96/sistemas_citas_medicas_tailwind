<?php

namespace App\Http\Controllers;
use App\Models\Organizational;
use App\Models\OrganizationalUnitTypes;
use App\Models\OrganizationalUnit;
use Illuminate\Http\Request;


class OrganizationalUnitController extends Controller
{

 public function index()
{
    // 1. Tipos de Unidades con Conteo (Optimizado)
    $organizationalUnitTypes = OrganizationalUnitTypes::query()
        ->withCount([
            'units' => fn($query) => $query->where('status', 'active')
        ])
        ->where('status', 'active')
        ->orderBy('name')
        ->get(['id', 'name', 'description']); // ✅ Solo campos necesarios

    // 2. Unidades Organizativas Paginadas (Más Rápido)
    $organizationalUnits = OrganizationalUnit::query()
        ->select(['id', 'name', 'location', 'phone_number', 'organizational_unit_types_id'])
        ->with(['unitType:id,name']) // ✅ Solo carga estos campos de la relación
        ->where('status', 'active')
        ->orderBy('name')
        ->paginate(10); // ✅ 10 items por página

    // 3. Organizaciones (Solo si la vista lo requiere)
    $organizations = Organizational::query()
        ->select('id', 'name')
        ->where('status', 'active')
        ->get(); // ✅ No paginado porque son pocos registros

    return view('service.organization_units.index', compact(
        'organizationalUnitTypes',
        'organizationalUnits',
        'organizations'
    ));
}

    public function show($id)
    {
        // Obtener una unidad organizativa específica con sus miembros
        $unit = OrganizationalUnit::with('members')->findOrFail($id);

        return view('service.organization.units.show', compact('unit'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
