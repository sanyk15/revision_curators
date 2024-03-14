@extends('layouts.app')

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#group_ids').select2();
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>Запись групп с мероприятия</h3>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('activities.show', $activity->id) }}">
                                    <i class="bi-arrow-left"></i>
                                    Назад
                                </a>
                            </div>
                        </div>
                    </div>

                    <span class="alert alert-primary m-1">Запись своих групп на мероприятия</span>

                    <div class="card-body">
                        <form method="POST" action="{{ route('activities.add-groups', $activity->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="group_ids" class="col-md-4 col-form-label text-md-end">Группы</label>

                                <div class="col-md-6">
                                    <select
                                        id="group_ids"
                                        class="form-control"
                                        aria-label="Группы"
                                        name="group_ids[]"
                                        multiple
                                    >
                                        @foreach($groups as $group)
                                            <option
                                                value="{{ $group->id }}"
                                                @if (in_array($group->id, $activityGroups)) selected @endif
                                            >
                                                {{ $group->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('group_ids')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
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
