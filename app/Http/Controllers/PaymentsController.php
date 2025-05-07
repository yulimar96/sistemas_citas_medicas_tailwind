<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Payment,
    Patient,
    Employee,
    Persons
};

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['patient.person', 'employee.person', 'employee.speciality'])->get();
        $patients = Patient::with('person')->get();
        $doctors = Employee::where('employee_type', 'Doctor')
                          ->with('person')
                          ->get();
        
        return view('service.payments.index', compact('payments', 'patients', 'doctors'));
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
    try {
        // Validación de datos
        $validatedData = $request->validate([
            'monto' => 'required|numeric',
            'pay_date' => 'required|date',
            'pacient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:employees,id',
            'description' => 'nullable|string|max:100'
        ]);

        // Crear el pago (no un Event)
        $payment = new Payment();
        $payment->monto = $validatedData['monto'];
        $payment->pay_date = $validatedData['pay_date'];
        $payment->pacient_id = $validatedData['pacient_id'];
        $payment->doctor_id = $validatedData['doctor_id'];
        $payment->description = $validatedData['description'];
        $payment->save();

        return redirect()->route('payment')
               ->with('success', 'Pago creado exitosamente.');

    } catch (\Exception $e) {
        return redirect()->back()
               ->withInput()
               ->with('error', 'Error al crear el pago: ' . $e->getMessage());
    }
}
    
    

    /**
     * Display the specified resource.
     */
  // En PaymentController.php
  public function show($id)
    {
        try {
            $payment = Payment::with([
                'patient.person', 
                'employee.person',
                'employee.speciality'
            ])->findOrFail($id);

            // Rename 'employee' to 'doctor' in the response for frontend consistency
            $paymentData = $payment->toArray();
            $paymentData['doctor'] = $paymentData['employee'];
            unset($paymentData['employee']);

            return response()->json([
                'success' => true,
                'data' => $paymentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar el pago'
            ], 500);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        try {
            // Validar datos
        $validatedData = $request->validate([
            'monto' => 'required|numeric',
            'pay_date' => 'required|date',
            'pacient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:employees,id',
            'description' => 'nullable|string|max:100'
        ]);

        // Actualizar el pago
        $payment->monto = $validatedData['monto'];
        $payment->pay_date = $validatedData['pay_date'];
        $payment->pacient_id = $validatedData['pacient_id'];
        $payment->doctor_id = $validatedData['doctor_id'];
        $payment->description = $validatedData['description'];
        $payment->save();

            return redirect()->route('payment')
                ->with('success', 'Pago actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el pago: ' . $e->getMessage());
        }
    }

    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            return redirect()->route('payment')
                ->with('success', 'Pago eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el pago: ' . $e->getMessage());
        }
    }
}
