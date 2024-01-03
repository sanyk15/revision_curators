@extends('layouts.app')

@section('template_title')
    Группы
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Группы
                            </span>
                            <div class="float-right">
                                <a
                                    href="{{ route('groups.create') }}"
                                    class="btn btn-primary btn-sm float-right"
                                    data-placement="left"
                                >
                                    <i class="bi bi-plus"></i>
                                    Создать
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('groups.index') }}" class="p-2">
                                <div class="row">
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="search"
                                            placeholder="Поиск"
                                            name="search"
                                            value="{{ request('search') }}"
                                        >
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <a href="{{ route('groups.index') }}" class="btn btn-outline-danger">
                                            <i class="bi bi-x"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Куратор группы</th>
                                    <th>Кол-во студентов</th>
                                    <th>Email старосты</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->title }}</td>
                                        <td>
                                            @if($group->user_id)
                                                {{ $group->user->short_name }}
                                            @endif
                                        </td>
                                        <td>{{ $group->students_count }}</td>
                                        <td><a href="mailto:{{ $group->headman_email }}">{{ $group->headman_email }}</a></td>
                                        <td>
                                            @role('curator')
                                            <a
                                                class="btn btn-sm btn-success"
                                                href="{{ route('groups.edit', $group->id) }}"
                                            >
                                                <i class="bi-pencil"></i>
                                            </a>
                                            @endrole
                                            @role('admin')
                                            <form
                                                action="{{ route('groups.destroy', $group->id) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi-trash"></i>
                                                </button>
                                            </form>
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include(
                        'vendor.pagination.default',
                        $groups->links()->getData()
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
