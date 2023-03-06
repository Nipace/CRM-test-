<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.form');
    }

    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->fill($request->all());
        $employee->save();

        return redirect()->route('employees.index')->with('message','Record added successfully');
    }

    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.form', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {

        $employee->fill($request->all());
        $employee->save();

        return redirect()->route('employees.index')->with('message','Record updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('message','Record deleted successfully');
    }
}