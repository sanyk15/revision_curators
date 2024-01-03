@extends('layouts.app')

@section('scripts')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <ul class="nav nav-pills mb-2" id="profile" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="main-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#main"
                            type="button"
                            role="tab"
                            aria-controls="main"
                            aria-selected="true"
                        >Данные профиля
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="profile-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#groups"
                            type="button"
                            role="tab"
                            aria-controls="groups"
                            aria-selected="false"
                        >Мои группы
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="contact-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#activities"
                            type="button"
                            role="tab"
                            aria-controls="activities"
                            aria-selected="false"
                        >Мои мероприятия
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div
                        class="tab-pane fade show active"
                        id="main"
                        role="tabpanel"
                        aria-labelledby="main-tab"
                    >
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="POST" action="{{ route('update-profile') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="last_name"
                                               class="col-md-4 col-form-label text-md-end">Фамилия</label>

                                        <div class="col-md-6">
                                            <input
                                                id="last_name"
                                                type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name"
                                                value="{{ $user->last_name }}"
                                                required
                                                autocomplete="last_name"
                                                autofocus
                                            >

                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-form-label text-md-end">Имя</label>

                                        <div class="col-md-6">
                                            <input
                                                id="first_name"
                                                type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name"
                                                value="{{ $user->first_name }}"
                                                required
                                                autocomplete="first_name"
                                            >

                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="surname"
                                               class="col-md-4 col-form-label text-md-end">Отчество</label>

                                        <div class="col-md-6">
                                            <input
                                                id="surname"
                                                type="text"
                                                class="form-control @error('surname') is-invalid @enderror"
                                                name="surname"
                                                value="{{ $user->surname }}"
                                                autocomplete="surname"
                                            >

                                            @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                        <div class="col-md-6">
                                            <input
                                                id="email"
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ $user->email }}"
                                                required
                                                autocomplete="email"
                                            >

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Новый
                                            пароль</label>

                                        <div class="col-md-6">
                                            <input
                                                id="password"
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                autocomplete="new-password"
                                            >

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтверждение
                                            пароля</label>

                                        <div class="col-md-6">
                                            <input
                                                id="password-confirm"
                                                type="password"
                                                class="form-control"
                                                name="password_confirmation"
                                                autocomplete="new-password"
                                            >
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="groups"
                        role="tabpanel"
                        aria-labelledby="groups-tab"
                    >
                        <div class="card mb-4">
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
                                            target="_blank"
                                        >
                                            <i class="bi bi-plus"></i>
                                            Создать
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 60vh">
                                    <table class="table table-striped table-hover overflow-auto">
                                        <thead class="thead">
                                        <tr>
                                            <th>Название</th>
                                            <th>Кол-во студентов</th>
                                            <th>Email старосты</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($groups as $group)
                                            <tr>
                                                <td>{{ $group->title }}</td>
                                                <td>{{ $group->students_count }}</td>
                                                <td>
                                                    <a href="mailto:{{ $group->headman_email }}">{{ $group->headman_email }}</a>
                                                </td>
                                                <td>
                                                    @role('curator')
                                                    <a
                                                        class="btn btn-sm btn-success"
                                                        href="{{ route('groups.edit', $group->id) }}"
                                                        target="_blank"
                                                    >
                                                        <i class="bi-pencil"></i>
                                                    </a>
                                                    @endrole
                                                    @role('admin')
                                                    <form
                                                        action="{{ route('groups.destroy', $group->id) }}"
                                                        method="POST"
                                                    >
                                                        <a
                                                            class="btn btn-sm btn-success"
                                                            href="{{ route('groups.edit', $group->id) }}"
                                                            target="_blank"
                                                        >
                                                            <i class="bi-pencil"></i>
                                                        </a>
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
                        </div>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="activities"
                        role="tabpanel"
                        aria-labelledby="activities-tab"
                    >
                        <div class="card mb-4">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span id="card_title">
                                            Мероприятия
                                        </span>
                                    <div class="float-right">
                                        <a
                                            href="{{ route('activities.create') }}"
                                            class="btn btn-primary btn-sm float-right"
                                            data-placement="left"
                                            target="_blank"
                                        >
                                            <i class="bi bi-plus"></i>
                                            Создать
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 60vh">
                                    <table class="table table-striped table-hover overflow-auto">
                                        <thead class="thead">
                                        <tr>
                                            <th>Название</th>
                                            <th>Дата</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($activities as $activity)
                                            <tr>
                                                <td>{{ $activity->title }}</td>
                                                <td>{{ $activity->date->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    @role('curator')
                                                    <a
                                                        class="btn btn-sm btn-success"
                                                        href="{{ route('activities.edit', $activity->id) }}"
                                                        target="_blank"
                                                    >
                                                        <i class="bi-pencil"></i>
                                                    </a>
                                                    @endrole
                                                    @role('admin')
                                                    <form
                                                        action="{{ route('activities.destroy', $activity->id) }}"
                                                        method="POST"
                                                    >
                                                        <a
                                                            class="btn btn-sm btn-success"
                                                            href="{{ route('activities.edit', $activity->id) }}"
                                                            target="_blank"
                                                        >
                                                            <i class="bi-pencil"></i>
                                                        </a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
