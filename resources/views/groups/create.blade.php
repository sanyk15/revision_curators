@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Создание группы</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('groups.index') }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('groups.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Название</label>

                                <div class="col-md-6">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control
                                        @error('title') is-invalid @enderror"
                                        name="title"
                                        value="{{ old('title') }}"
                                        required
                                        autocomplete="title"
                                        autofocus
                                    >

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="students_count" class="col-md-4 col-form-label text-md-end">Количество студентов</label>

                                <div class="col-md-6">
                                    <input
                                        id="students_count"
                                        type="number"
                                        class="form-control
                                        @error('students_count') is-invalid @enderror"
                                        name="students_count"
                                        value="{{ old('students_count') }}"
                                        required
                                        autocomplete="students_count"
                                    >

                                    @error('students_count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="headman_email" class="col-md-4 col-form-label text-md-end">Email старосты</label>

                                <div class="col-md-6">
                                    <input
                                        id="headman_email"
                                        type="email"
                                        class="form-control
                                        @error('headman_email') is-invalid @enderror"
                                        name="headman_email"
                                        value="{{ old('headman_email') }}"
                                        required
                                        autocomplete="headman_email"
                                    >

                                    @error('headman_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Создать
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
