<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    
    /**
     * Display list of employees
     *
     * @return void
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }
    
    /**
     * Returns form for storing a employee
     *
     * @return void
     */
    public function create()
    {
        return view('employees.form');
    }
    
    /**
     * Stores new employee
     *
     * @param  mixed $request
     * @return void
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->fill($request->all());
        $employee->save();

        return redirect()->route('employees.index')->with('message', 'Record added successfully');
    }
    
    /**
     * Return view for showing a employee data 
     *
     * @param  mixed $employee
     * @return void
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }
    
    /**
     * Reutrns view for edit form for a employee
     *
     * @param  mixed $employee
     * @return void
     */
    public function edit(Employee $employee)
    {
        return view('employees.form', compact('employee'));
    }
    
    /**
     * Updates a specfic employee
     *
     * @param  mixed $request
     * @param  mixed $employee
     * @return void
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {

        $employee->fill($request->all());
        $employee->save();

        return redirect()->route('employees.index')->with('message', 'Record updated successfully');
    }
    
    /**
     * Deletes a specific employee
     *
     * @param  mixed $employee
     * @return void
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('message', 'Record deleted successfully');
    }
}
