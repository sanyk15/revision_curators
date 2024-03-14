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
                                <h3>Редактирование мероприятия</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('activities.show', $activity->id) }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('activities.update', $activity->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Название</label>

                                <div class="col-md-6">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control
                                        @error('title') is-invalid @enderror"
                                        name="title"
                                        value="{{ old('title') ?? $activity->title }}"
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
                                        value="{{ old('date') ?? $activity->date->toDateTimeLocalString() }}"
                                        autocomplete="date"
                                    >

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @role('admin')
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
                            @endrole
                            @role('curator')
                            <input type="hidden" name="user_id" value="{{ $activity->user_id }}">
                            @endrole

                            <div class="row mb-3">
                                <label for="activity_kind_id" class="col-md-4 col-form-label text-md-end">Направление</label>

                                <div class="col-md-6">
                                    <select
                                        id="activity_kind_id"
                                        class="form-control"
                                        aria-label="Направление"
                                        name="activity_kind_id"
                                    >
                                        <option></option>
                                        @foreach($kinds as $kind)
                                            <option
                                                value="{{ $kind->id }}"
                                                @if ($activity->activity_kind_id == $kind->id) selected @endif
                                            >
                                                {{ $kind->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('activity_kind_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="benchmark_id" class="col-md-4 col-form-label text-md-end">Критерий</label>

                                <div class="col-md-6">
                                    <select
                                        id="benchmark_id"
                                        class="form-control"
                                        aria-label="Критерий"
                                        name="benchmark_id"
                                    >
                                        <option></option>
                                        @foreach($benchmarks as $benchmark)
                                            <option
                                                value="{{ $benchmark->id }}"
                                                @if ($activity->benchmark_id == $benchmark->id) selected @endif
                                            >
                                                {{ $benchmark->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('benchmark_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="indicator_id" class="col-md-4 col-form-label text-md-end">Показатель</label>

                                <div class="col-md-6">
                                    <select
                                        id="indicator_id"
                                        class="form-control"
                                        aria-label="Показатель"
                                        name="indicator_id"
                                    >
                                        <option></option>
                                        @foreach($indicators as $indicator)
                                            <option
                                                value="{{ $indicator->id }}"
                                                @if ($activity->indicator_id == $indicator->id) selected @endif
                                            >
                                                {{ $indicator->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('indicator_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="threshold" class="col-md-4 col-form-label text-md-end">Пороговое значение</label>

                                <div class="col-md-6">
                                    <input
                                        id="threshold"
                                        type="text"
                                        class="form-control
                                        @error('threshold') is-invalid @enderror"
                                        name="threshold"
                                        value="{{ old('threshold') ?? $activity->threshold }}"
                                        autocomplete="threshold"
                                    >

                                    @error('threshold')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="assessment_frequency" class="col-md-4 col-form-label text-md-end">Периодичность оценивания</label>

                                <div class="col-md-6">
                                    <input
                                        id="assessment_frequency"
                                        type="text"
                                        class="form-control
                                        @error('assessment_frequency') is-invalid @enderror"
                                        name="assessment_frequency"
                                        value="{{ old('assessment_frequency') ?? $activity->assessment_frequency }}"
                                        autocomplete="assessment_frequency"
                                    >

                                    @error('assessment_frequency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="possible_score" class="col-md-4 col-form-label text-md-end">Оценка в баллах</label>

                                <div class="col-md-6">
                                    <input
                                        id="possible_score"
                                        type="text"
                                        class="form-control
                                        @error('possible_score') is-invalid @enderror"
                                        name="possible_score"
                                        value="{{ old('possible_score') ?? $activity->possible_score }}"
                                        autocomplete="possible_score"
                                    >

                                    @error('possible_score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="curator_score" class="col-md-4 col-form-label text-md-end">Оценка куратора</label>

                                <div class="col-md-6">
                                    <input
                                        id="curator_score"
                                        type="number"
                                        class="form-control
                                        @error('curator_score') is-invalid @enderror"
                                        name="curator_score"
                                        value="{{ old('curator_score') ?? $activity->curator_score }}"
                                        autocomplete="curator_score"
                                    >

                                    @error('curator_score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
        </div>
    </div>
@endsection
