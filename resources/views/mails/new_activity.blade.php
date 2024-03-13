@extends('mails.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Создано новое мероприятие</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Название:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->title }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Дата и время:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->date->format('d.m.Y H:i') }}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Куратор:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->user->full_name }}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Направление:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->activityKind->title }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Критерий:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->benchmark->title }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Показатель:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->indicator->title }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Пороговое значение:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->threshold }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Периодичность оценивания:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->assessment_frequency }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Оценка в баллах:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->possible_score }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Оценка куратора:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activity->curator_score }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-md-center">
                                <a href="{{ $activity->calendar_link }}" class="btn btn-primary">
                                    Добавить в календарь
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
