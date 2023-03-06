@extends('layouts.app')

@section('title', 'Companies')
@section('content_header')
    <h1>Companies</h1>
@stop
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-10 mx-auto">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h4>{{ isset($model) ? 'Edit' : 'Create' }} Company</h4>
                    </div>
                    <div class="card-body">
                        @if (isset($model))
                            {{ Form::model($model, ['route' => ['companies.update', $model->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                            {{ Form::open(['route' => 'companies.store', 'files' => true]) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) }}
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('website', 'Website') }}
                            {{ Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Enter Website']) }}
                            @error('website')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('file', 'Logo') }}
                            {{ Form::file('file', ['class' => 'custom-file']) }}
                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (isset($model) && $model->logo)
                            <div class="mt-3">
                                <img src="{{ asset($model->logo) }}" alt="{{ $model->name }}" class="img-fluid">
                            </div>
                        @endif
                        <div class="form-group">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
