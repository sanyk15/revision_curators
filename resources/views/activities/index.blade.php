@extends('layouts.app')

@section('template_title')
    Деятельность кураторов
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Деятельность кураторов
                            </span>

                            <div class="float-right">
                                <a href="{{ route('activities.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    <i class="bi bi-plus"></i>
                                    Создать
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('activities.index') }}" class="p-2">
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
                                        <a href="{{ route('activities.index') }}" class="btn btn-outline-danger">
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
                                    <th>Направление деятельности</th>
                                    <th>Куратор</th>
                                    <th>Группа</th>
                                    <th>Дата и время</th>
                                    <th>Оценка куратора</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->activityKind->title }}</td>
                                        <td>{{ $activity->curator->surname_and_initials }}</td>
                                        <td>{{ $activity->group->title }}</td>
                                        <td>{{ $activity->date->format('d.m.Y H:i') }}</td>
                                        <td>{{ $activity->curator_score }}</td>
                                        <td>
                                            <form action="{{ route('activities.destroy', $activity->id) }}"
                                                  method="POST">
                                                <a class="btn btn-sm btn-primary "
                                                   href="{{ route('activities.show', $activity->id) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-success"
                                                   href="{{ route('activities.edit', $activity->id) }}">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
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
                        $activities->links()->getData()
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
