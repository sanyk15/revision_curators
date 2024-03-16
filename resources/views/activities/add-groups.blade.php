@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Запись групп с мероприятия</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ url()->previous() }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <span class="alert alert-primary m-1">Запись своих групп на мероприятия</span>

                    <div class="card-body">
                        <form method="POST" action="{{ route('activities.add-groups', $activity->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">
                                    Группа
                                </label>
                                <label class="col-md-6 col-form-label">
                                    Количество студентов, которое придет на мероприятие
                                </label>
                            </div>

                            @foreach($groups as $group)
                                <div class="row mb-3">
                                    <label for="group_ids[{{ $group->id }}]" class="col-md-4 col-form-label text-md-end">
                                        {{ $group->title }}
                                    </label>

                                    <div class="col-md-6">
                                        <input
                                            id="group_ids[{{ $group->id }}]"
                                            type="number"
                                            class="form-control"
                                            name="group_ids[{{ $group->id }}]"
                                            value="{{ data_get($activityGroups, $group->id) ? $activityGroups[$group->id]->pivot->students_count : 0 }}"
                                        >
                                    </div>
                                </div>
                            @endforeach

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
