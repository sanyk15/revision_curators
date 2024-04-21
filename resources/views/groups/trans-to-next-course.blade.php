@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3>Перевод групп на следующий курс</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ url()->previous() }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('groups.trans-to-next-course') }}">
                    @csrf
                    @foreach($groups as $group)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5><b>{{ $group->title }}</b>, {{ $group->user->short_name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label
                                            for="group[{{ $group->id }}][title]"
                                            class="form-label"
                                        >
                                            Будущее название
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="group[{{ $group->id }}][title]"
                                            name="group[{{ $group->id }}][title]"
                                            value="{{ $group->getNextCourseTitle() }}"
                                            required
                                        >
                                    </div>
                                    <div class="col">
                                        <label
                                            for="group[{{ $group->id }}][user_id]"
                                            class="form-label"
                                        >
                                            Будущий куратор
                                        </label>
                                        <select
                                            id="group[{{ $group->id }}][user_id]"
                                            class="form-control"
                                            aria-label="Куратор группы"
                                            required
                                            name="group[{{ $group->id }}][user_id]"
                                        >
                                            @foreach($users as $user)
                                                <option
                                                    value="{{ $user->id }}"
                                                    @if($group->user_id == $user->id) selected @endif
                                                >
                                                    {{ $user->short_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi-save"></i>
                                        Перевести
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
