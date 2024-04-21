@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Тип мероприятия</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ url()->previous() }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Название:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->title }}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Направление:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->activityKind ? $activityType->activityKind->title : '' }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Критерий:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->benchmark ? $activityType->benchmark->title : '' }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Показатель:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->indicator ? $activityType->indicator->title : '' }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Пороговое значение:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->threshold }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Периодичность оценивания:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->assessment_frequency }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Оценка в баллах:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->possible_score }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h5 class="col-md-4 text-md-end">Оценка куратора:</h5>

                            <div class="col-md-6">
                                <h5>{{ $activityType->curator_score }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
