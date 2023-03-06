@extends('layouts.app')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Companies</h1>
@stop
@section('content')
    <div class="row">
        @include('layouts.components.alert')
        <div class="col-12">
            <a class="btn btn-success" href="{{ route('companies.create') }}"><i class="fas fa-fw fa-plus"></i> Add New</a>
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 20%">
                                    Company Name
                                </th>
                                <th style="width: 30%">
                                    Logo
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Website
                                </th>
                                <th style="width: 20%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if($item->logo)
                                                <img alt="Avatar" class="table-avatar" src="{{ $item->logo }}">
                                                @else
                                                -
                                                @endif

                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->website }}
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('companies.show', $item->id) }}">
                                            <i class="fas fa-eye">
                                            </i>
                                            View
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('companies.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>

                                        <form action="{{ route('companies.destroy', $item->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this company?')">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
