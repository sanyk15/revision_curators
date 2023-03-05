@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Редактирование куратора</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('curators.index') }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('curators.update', $curator->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">Фамилия</label>

                                <div class="col-md-6">
                                    <input
                                        id="last_name"
                                        type="text"
                                        class="form-control
                                        @error('last_name') is-invalid @enderror"
                                        name="last_name"
                                        value="{{ old('last_name') ?? $curator->last_name }}"
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
                                        class="form-control
                                        @error('first_name') is-invalid @enderror"
                                        name="first_name"
                                        value="{{ old('first_name') ?? $curator->first_name }}"
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
                                        class="form-control
                                        @error('surname') is-invalid @enderror"
                                        name="surname"
                                        value="{{ old('surname') ?? $curator->surname }}"
                                        required
                                        autocomplete="surname"
                                    >

                                    @error('last_name')
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
