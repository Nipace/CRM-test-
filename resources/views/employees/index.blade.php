@extends('layouts.app')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Employees</h1>
@stop
@section('content')
@include('layouts.components.alert')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employees</h3>
            <div class="card-tools">
                <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add Employee
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @if ($employees->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->company->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center p-4">
                <h4>No Employees Found</h4>
            </div>
            @endif
        </div>
        <div class="card-footer">
            {{ $employees->links() }}
        </div>
    </div>

@endsection