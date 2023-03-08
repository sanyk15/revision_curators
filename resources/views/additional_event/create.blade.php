@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Создание дополнительного мероприятия</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('additional_events.index') }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('additional_events.store') }}">
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
                                <label for="date" class="col-md-4 col-form-label text-md-end">Дата и время</label>

                                <div class="col-md-6">
                                    <input
                                        id="date"
                                        type="datetime-local"
                                        class="form-control
                                        @error('date') is-invalid @enderror"
                                        name="date"
                                        value="{{ old('date') }}"
                                        required
                                        autocomplete="date"
                                        autofocus
                                    >

                                    @error('date')
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
