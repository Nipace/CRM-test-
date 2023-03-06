@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
                <div class="card-tools">
                    <a href="{{ route('employees.index') }}" class="btn btn-tool">
                        <i class="fas fa-list"></i> Employee List
                    </a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-tool">
                        <i class="fas fa-edit"></i> Edit Employee
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>First Name:</td>
                                    <td>{{ $employee->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td>{{ $employee->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Company:</td>
                                    <td>
                                        @if($employee->company)
                                            <a href="{{ route('companies.show', $employee->company->id) }}">
                                                {{ $employee->company->name }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $employee->email ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>{{ $employee->phone ?: 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        @if($employee->company && $employee->company->logo)
                            <img src="{{ $employee->company->logo }}" alt="{{ $employee->company->name }} Logo" class="img-fluid" width="400">
                        @endif
                    </div>
                </div>
            </div>
        </div>
       </div>
  </div>
@endsection