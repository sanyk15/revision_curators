@extends('layouts.app')

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#group_ids').select2();
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Создание мероприятия</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('activities.index') }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('activities.store') }}">
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
                                        value="{{ old('date') ?? (request()->get('date') ? \Carbon\Carbon::parse(request()->get('date')) : '') }}"
                                        required
                                        autocomplete="date"
                                    >

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">Куратор</label>

                                <div class="col-md-6">
                                    <select
                                        id="user_id"
                                        class="form-control"
                                        aria-label="Куратор"
                                        required
                                        name="user_id"
                                    >
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->short_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type_id" class="col-md-4 col-form-label text-md-end">Тип</label>

                                <div class="col-md-6">
                                    <select
                                        id="type_id"
                                        class="form-control"
                                        aria-label="Тип"
                                        required
                                        name="type_id"
                                    >
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">
                                                {{ $type->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('type_id')
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
