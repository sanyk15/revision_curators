@extends('layouts.app')

@section('template_title')
    Дополнительные мероприятия
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Дополнительные мероприятия
                            </span>

                            <div class="float-right">
                                <a
                                    href="{{ route('additional_events.create') }}"
                                    class="btn btn-primary btn-sm float-right"
                                    data-placement="left"
                                >
                                    <i class="bi bi-plus"></i>
                                    Создать
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Дата и время</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($additionalEvents as $additionalEvent)
                                    <tr>
                                        <td>{{ $additionalEvent->id }}</td>
                                        <td>{{ $additionalEvent->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($additionalEvent->date)->format('d.m.Y H:i') }}</td>

                                        <td>
                                            <form
                                                action="{{ route('additional_events.destroy', $additionalEvent->id) }}"
                                                method="POST"
                                            >
                                                <a
                                                    class="btn btn-sm btn-success"
                                                    href="{{ route('additional_events.edit',$additionalEvent->id) }}"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include(
                        'vendor.pagination.default',
                        $additionalEvents->links()->getData()
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
