<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employeePages.employeeListing', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employeePages.createEmployee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    dd($request->all());
       $validator = Validator::make($request->all(), [
        'emp_id'   => 'required|numeric', // Employee ID required & must be a number
        'name'     => 'required|string|max:255', // Name required & max 255 characters
        'email'    => 'required|email|unique:employees,email', // Unique email required
        'password' => 'required|min:5', // Password must be min 8 characters
        'phone' => 'required|max:10', // End date should be a valid date
    ]);

    // ✅ Check if Validation Fails
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator) // Send errors back to view
            ->withInput(); // Retain old input values in form
    }

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
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
        $employee = Employee::findOrFail($id);
        return view('employeePages.editEmployee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'emp_id'   => 'required|numeric', // Employee ID required & must be a number
            'name'     => 'required|string|max:255', // Name required & max 255 characters
            'email'    => 'required|email|unique:employees,email,' . $id, // Ignore current record
            'password' => 'required|min:5', // Password must be min 8 characters
            'phone' => 'required|max:10', // End date should be a valid date
        ]);
    
        // ✅ Check if Validation Fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Send errors back to view
                ->withInput(); // Retain old input values in form
        }
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
