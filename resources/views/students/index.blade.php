@extends('layouts.app')

@section('template_title')
    Студенты
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Студенты группы <h4>{{ $group->title }}</h4>
                            </span>
                            <div class="float-right">
                                <a
                                    href="{{ route('students.create', $group->id) }}"
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
                            <form action="{{ route('students.index', $group->id) }}" class="p-2">
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
                                        <a href="{{ route('students.index', $group->id) }}" class="btn btn-outline-danger">
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
                                    <th>ФИО</th>
                                    <th>Дата рождения</th>
                                    <th>Телефон</th>
                                    <th>Email</th>
                                    <th>Гражданство</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            {{ $student->id }}
                                            @if ($student->is_head)
                                                <span class="badge rounded-pill text-bg-success">Староста</span>
                                            @endif
                                        </td>
                                        <td>{{ $student->full_name }}</td>
                                        <td>{{ $student->birth_date->format('d.m.Yг.') }}</td>
                                        <td>
                                            <a href="tel:{{ $student->phone }}">{{ $student->phone }}</a>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $student->email }}">{{ $student->email }}</a>
                                        </td>
                                        <td>{{ $student->citizenship }}</td>
                                        <td>
                                            <form
                                                action="{{ route('students.destroy', [$group->id, $student->id]) }}"
                                                method="POST"
                                            >
                                                @role('admin')
                                                <a
                                                    class="btn btn-sm btn-success"
                                                    href="{{ route('students.edit', [$group->id, $student->id]) }}"
                                                >
                                                    <i class="bi-pencil"></i>
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi-trash"></i>
                                                </button>
                                                @endrole
                                                @role('curator')
                                                @if ($group->user_id == auth()->id())
                                                    <a
                                                        class="btn btn-sm btn-success"
                                                        href="{{ route('students.edit', [$group->id, $student->id]) }}"
                                                    >
                                                        <i class="bi-pencil"></i>
                                                    </a>
                                                @endif
                                                @endrole
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include(
                        'vendor.pagination.default',
                        $students->links()->getData()
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
