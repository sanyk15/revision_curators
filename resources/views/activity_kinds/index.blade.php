@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>
                                    <a
                                        class="btn btn-primary"
                                        href="{{ route('home') }}"
                                    >
                                        <i class="bi-arrow-left"></i>
                                    </a>
                                    Виды деятельности
                                </h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('activity_kinds.create') }}">
                                    <i class="bi-plus"></i>
                                    Создать
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($activityKinds as $activityKind)
                                <tr>
                                    <td>{{ $activityKind->id }}</td>
                                    <td>{{ $activityKind->title }}</td>
                                    <td>
                                        <form action="{{ route('activity_kinds.destroy', $activityKind->id) }}" method="Post">
                                            <a class="btn btn-primary"
                                               href="{{ route('activity_kinds.edit', $activityKind->id) }}">
                                                <i class="bi-pencil"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include(
                            'vendor.pagination.default',
                            $activityKinds->links()->getData()
                        )
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
