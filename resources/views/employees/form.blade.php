@extends('layouts.app')

@section('title', 'Add Employee')
@inject('company_helper', 'App\Helpers\CompanyHelper')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 card-secondary">
                <div class="card-header">
                    <h4>{{ isset($employee) ? 'Edit' : 'Create' }} Employee</h4>
                </div>
                <div class="card-body">
                    @if (isset($employee))
                        {!! Form::model($employee, [
                            'route' => ['employees.update', $employee->id],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @else
                        {!! Form::open(['route' => 'employees.store', 'enctype' => 'multipart/form-data']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('first_name', 'First Name') !!}
                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name', 'Last Name') !!}
                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('company_id', 'Company') !!}
                        {!! Form::select('company_id', $company_helper->dropdown(), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Select a company',
                        ]) !!}
                         @error('company_id')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone', 'Phone') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
