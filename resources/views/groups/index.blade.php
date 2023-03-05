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
                                    Группы
                                </h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('groups.create') }}">
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
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->title }}</td>
                                    <td>
                                        <form action="{{ route('groups.destroy', $group->id) }}" method="Post">
                                            <a class="btn btn-primary"
                                               href="{{ route('groups.edit', $group->id) }}">
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
                            $groups->links()->getData()
                        )
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
