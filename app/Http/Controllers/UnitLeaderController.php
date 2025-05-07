<?php

namespace App\Http\Controllers;

use App\Models\OrganizationalUnit;
use App\Models\Employee;
use Illuminate\Http\Request;

class UnitLeaderController extends Controller
{
    public function update(Request $request, OrganizationalUnit $unit)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $employee = Employee::findOrFail($validated['employee_id']);
        
        $unit->assignLeader(
            $employee,
            $validated['start_date'],
            $validated['end_date']
        );

        return back()->with('success', 'Encargado actualizado correctamente');
    }
}