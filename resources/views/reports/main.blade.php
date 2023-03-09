@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Отчеты</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('reports.report.download') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="report" class="col-md-4 col-form-label text-md-end">Отчет</label>

                                <div class="col-md-6">
                                    <select
                                        id="report"
                                        class="form-control"
                                        aria-label="Отчет"
                                        name="report"
                                    >
                                        <option value="curators_report" selected>Отчет по кураторам</option>
                                        <option value="service_report">Служебная по кураторам</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Месяц, год</label>

                                <div class="col-auto">
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="month"
                                        value="{{ now()->month }}"
                                        required
                                        min="1"
                                        max="12"
                                    >
                                </div>
                                <div class="col-auto">
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="year"
                                        value="{{ now()->year }}"
                                        min="2000"
                                        max="3000"
                                    >
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сформировать и скачать
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
