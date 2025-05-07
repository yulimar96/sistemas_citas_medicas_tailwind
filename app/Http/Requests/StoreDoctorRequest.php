<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_1' => 'required|string|max:255',
            'name_2' => 'nullable|string|max:255',
            'surname_1' => 'required|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'sex' => 'required|boolean',
            'birthdate' => 'required|date',
            'blood_type' => 'required|string|max:20',
            'nacionality' => 'required|string|max:50',
            'identification_number' => 'required|string|max:20|unique:peoples,identification_number',
            'email' => 'required|email|unique:users,email',
            'code_area' => 'required|string|max:7',
            'phone' => 'required|string|max:15',
            'cell_phone_area_codes' => 'required|string|max:7',
            'cellphone_number' => 'required|string|max:7',
            'federal_state_id' => 'required|exists:federal_states,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'parish_id' => 'required|exists:parishes,id',
            'room_type' => 'required|string|max:100',
            'level_of_education' => 'required|string|max:100',
            'employee_contract_type_id' => 'nullable|exists:employee_contract_types,id',
            'employee_position_id' => 'nullable|exists:employee_positions,id',
            'organizational_unit_type_id' => 'nullable|exists:organizational_unit_types,id',
            'medical_license' => 'required|string|max:20|unique:employees',
            'speciality_id' => 'required|exists:medical_specialities,id',
            'hire_date' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}