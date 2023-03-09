@php
    $kindPrinted = 0;
    $benchmarkPrinted = 0;
@endphp
<table style="text-align: center">
    <thead>
    <tr>
        <th colspan="10">
            <b>
                Критерии и показатели эффективности деятельности кураторов академической группы ФИСТа на
                {{ $date->endOfMonth()->format('d.m.Y г.') }}
            </b>
        </th>
    </tr>
    <tr></tr>
    <tr>
        <th colspan="6"></th>
        <th style="text-align: center; vertical-align: middle;"><b>ФИО куратора</b></th>
        @foreach($curators_with_groups as $item)
            <th style="text-align: center; vertical-align: middle;"><b>{{ data_get($item, 'curator') }}</b></th>
        @endforeach
    </tr>
    <tr>
        <th colspan="6"></th>
        <th style="text-align: center; vertical-align: middle;"><b>Группа</b></th>
        @foreach($curators_with_groups as $item)
            <th style="text-align: center; vertical-align: middle;"><b>{{ data_get($item, 'group') }}</b></th>
        @endforeach
    </tr>
    <tr>
        <th colspan="6"></th>
        <th style="text-align: center; vertical-align: middle;"><b>Итого баллов</b></th>
        @foreach($curators_with_groups as $item)
            <th style="text-align: center; vertical-align: middle;"><b>{{ data_get($item, 'score') }}</b></th>
        @endforeach
    </tr>
    <tr>
        <th style="text-align: center; vertical-align: middle;"><b>№ п/п</b></th>
        <th style="text-align: center; vertical-align: middle;"><b>Направление деятельности</b></th>
        <th style="text-align: center; vertical-align: middle;"><b>Критерий</b></th>
        <th style="text-align: center; vertical-align: middle;"><b>Показатель</b></th>
        <th style="text-align: center; vertical-align: middle;"><b>Пороговое значение</b></th>
        <th style="text-align: center; vertical-align: middle;"><b>Периодичность оценивания</b></th>
        <th style="text-align: center; vertical-align: middle;"><b>Оценка в баллах</b></th>
        @foreach($curators_with_groups as $item)
            <th></th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($activities as $kindKey => $activitiesForKind)
        @foreach(data_get($activitiesForKind, 'items') as $benchmarkKey => $activitiesForBenchmark)
            @foreach(data_get($activitiesForBenchmark, 'items') as $activitiesForIndicator)
                <tr>
                    @if ($kindPrinted == 0)
                        @php($kindPrinted = data_get($activitiesForKind, 'rowspan'))
                        <th rowspan="{{ data_get($activitiesForKind, 'rowspan') }}" style="text-align: center; vertical-align: middle;">
                            <b>{{ data_get($activitiesForKind, 'number') }}</b>
                        </th>
                        <th rowspan="{{ data_get($activitiesForKind, 'rowspan') }}" style="text-align: center; vertical-align: middle;">
                            <b>{{ data_get($activitiesForKind, 'name') }}</b>
                        </th>
                    @endif
                    @if ($benchmarkPrinted == 0)
                        @php($benchmarkPrinted = data_get($activitiesForBenchmark, 'rowspan'))
                        <th rowspan="{{ data_get($activitiesForBenchmark, 'rowspan') }}" style="text-align: center; vertical-align: middle;">
                            {{ data_get($activitiesForBenchmark, 'name') }}
                        </th>
                    @endif
                    <th>{{ data_get($activitiesForIndicator, 'name') }}</th>
                    <th style="text-align: center; vertical-align: middle;">{{ data_get($activitiesForIndicator, 'threshold') }}</th>
                    <th style="text-align: center; vertical-align: middle;">{{ data_get($activitiesForIndicator, 'assessment_frequency') }}</th>
                    <th style="text-align: center; vertical-align: middle;">{{ data_get($activitiesForIndicator, 'possible_score') }}</th>
                    @foreach(data_get($activitiesForIndicator, 'scores') as $score)
                        <th style="text-align: center; vertical-align: middle;">{{ $score }}</th>
                    @endforeach

                    @php($kindPrinted--)
                    @php($benchmarkPrinted--)
                </tr>
            @endforeach
        @endforeach
    @endforeach
    <tr></tr>
    <tr>
        <th colspan="5" style="text-align: center"><b><i>Дополнительные мероприятия факультета, кафедры, вуза</i></b></th>
    </tr>
    @foreach($additional_events as $key => $additionalEvent)
        <tr>
            <th style="text-align: center; vertical-align: middle;"><b>{{ $key++ }}</b></th>
            <th colspan="10" style="vertical-align: middle;"><b>{{ data_get($additionalEvent, 'title') }}</b></th>
        </tr>
    @endforeach
    </tbody>
</table>
