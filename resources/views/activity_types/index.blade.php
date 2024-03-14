@extends('layouts.app')

@section('template_title')
    Типы мероприятий
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Типы мероприятий
                            </span>
                            @role('admin')
                            <div class="float-right">
                                <a
                                    href="{{ route('activity_types.create') }}"
                                    class="btn btn-primary btn-sm float-right"
                                    data-placement="left"
                                >
                                    <i class="bi bi-plus"></i>
                                    Создать
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('activity_types.index') }}" class="p-2">
                                <div class="row">
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="search"
                                            placeholder="Поиск"
                                            name="search"
                                            value="{{ request('search') }}"
                                        >
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <a href="{{ route('activity_types.index') }}" class="btn btn-outline-danger">
                                            <i class="bi bi-x"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($activityTypes as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->title }}</td>
                                        <td>
                                            <form
                                                action="{{ route('activity_types.destroy',$type->id) }}"
                                                method="POST"
                                            >
                                                <a
                                                    class="btn btn-sm btn-info"
                                                    href="{{ route('activity_types.show',$type->id) }}"
                                                >
                                                    <i class="bi-eye"></i>
                                                </a>
                                                @role('admin')
                                                <a
                                                    class="btn btn-sm btn-success"
                                                    href="{{ route('activity_types.edit',$type->id) }}"
                                                >
                                                    <i class="bi-pencil"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi-trash"></i>
                                                </button>
                                                @endrole
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
                        $activityTypes->links()->getData()
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
