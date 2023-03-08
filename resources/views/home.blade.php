@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Меню</h3>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a
                                class="btn btn-primary btn-block col-12"
                                href="{{ route('curators.index') }}"
                            >
                                <i class="bi-person-square"></i>
                                Кураторы
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a
                                class="btn btn-primary btn-block col-12"
                                href="{{ route('groups.index') }}"
                            >
                                <i class="bi-people"></i>
                                Группы
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a
                                class="btn btn-primary btn-block col-12"
                                href="{{ route('activity_kinds.index') }}"
                            >
                                <i class="bi-activity"></i>
                                Виды деятельности
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a
                                class="btn btn-primary btn-block col-12"
                                href="{{ route('benchmarks.index') }}"
                            >
                                <i class="bi bi-bar-chart-steps"></i>
                                Критерии
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a
                                class="btn btn-primary btn-block col-12"
                                href="{{ route('indicators.index') }}"
                            >
                                <i class="bi bi-bar-chart"></i>
                                Показатели
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
