<?php

namespace App\Http\Controllers;
use App\Models\Headquarter;
use App\Models\Organizational;
use App\Models\OrganizationalUnitTypes;
use App\Models\OrganizationalUnit;
use Illuminate\Http\Request;

class OrganizationalUnitTypeController extends Controller
{

 public function index()
{
    $headquartersWithUnitTypes = Headquarter::with(['unitTypes' => function($query) {
            $query->where('status', 'active')
                  ->orderBy('name');
        }])
        ->where('status', 'active')
        ->get(['id', 'name', 'address', 'organizational_id']); // Asegúrate de incluir organizational_id

    $organizations = Organizational::select('id', 'name')
                                  ->where('status', 'active')
                                  ->get();

    // Preparar datos para el filtro
    $headquartersByOrganization = $headquartersWithUnitTypes->groupBy('organizational_id')
        ->map(function($hqs) {
            return $hqs->pluck('name', 'id');
        });

    return view('service.organization_type.index', compact(
        'headquartersWithUnitTypes', 
        'organizations',
        'headquartersByOrganization'
    ));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
