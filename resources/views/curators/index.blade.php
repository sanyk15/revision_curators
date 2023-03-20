@extends('layouts.app')

@section('template_title')
    Кураторы
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Кураторы
                            </span>
                            <div class="float-right">
                                <a
                                    href="{{ route('curators.create') }}"
                                    class="btn btn-primary btn-sm float-right"
                                    data-placement="left"
                                >
                                    <i class="bi bi-plus"></i>
                                    Создать
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('curators.index') }}" class="p-2">
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
                                        <a href="{{ route('curators.index') }}" class="btn btn-outline-danger">
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
                                    <th>ФИО</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($curators as $curator)
                                    <tr>
                                        <td>{{ $curator->id }}</td>
                                        <td>{{ $curator->full_name }}</td>
                                        <td>
                                            <form
                                                action="{{ route('curators.destroy', $curator->id) }}"
                                                method="POST"
                                            >
                                                <a
                                                    class="btn btn-sm btn-success"
                                                    href="{{ route('curators.edit', $curator->id) }}"
                                                >
                                                    <i class="bi-pencil"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi-trash"></i>
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
                        $curators->links()->getData()
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
