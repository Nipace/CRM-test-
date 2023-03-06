@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">{{ $model->name }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($model->logo) }}" alt="{{ $model->name }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Name:</th>
                                            <td>{{ $model->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ $model->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Website:</th>
                                            <td><a href="{{ $model->website }}" target="_blank">{{ $model->website }}</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection