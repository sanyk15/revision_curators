@extends('layouts.app')

@php($date = request()->get('date') ?? \Carbon\Carbon::now()->toDateString())

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ru',
                initialView: 'dayGridMonth',
                buttonText: {
                    today: 'Сегодня',
                },
                initialDate: '{{ $date }}',
                events: '{{ route('activities.for-month') }}',
                dateClick: function (info) {
                    if ({{ (int)auth()->user()->hasRole('admin|curator') }}) {
                        window.location.replace('{{ route('activities.create') . '?date=' }}' + info.dateStr)
                    }
                }
            });
            calendar.render();
        });
    </script>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
@endsection
