@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Редактирование пользователя</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('users.index') }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">Фамилия</label>

                                <div class="col-md-6">
                                    <input
                                        id="last_name"
                                        type="text"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name"
                                        value="{{ old('last_name') ?? $user->last_name }}"
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
                                        value="{{ old('first_name') ?? $user->first_name }}"
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
                                <label for="surname" class="col-md-4 col-form-label text-md-end">Отчество</label>

                                <div class="col-md-6">
                                    <input
                                        id="surname"
                                        type="text"
                                        class="form-control @error('surname') is-invalid @enderror"
                                        name="surname"
                                        value="{{ old('surname') ?? $user->surname }}"
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
                                        value="{{ old('email') ?? $user->email }}"
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
                                <label for="role_id" class="col-md-4 col-form-label text-md-end">Роль</label>

                                <div class="col-md-6">
                                    <select
                                        id="role_id"
                                        class="form-control js-example-basic-multiple"
                                        aria-label="Роль"
                                        required
                                        name="role_id"
                                    >
                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role->id }}"
                                                @if($user->hasRole($role->name)) selected @endif
                                            >
                                                {{ \App\Models\User::ROLE_NAMES[$role->name] ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi-save"></i>
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
