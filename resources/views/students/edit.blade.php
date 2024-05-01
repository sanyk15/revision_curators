@extends('layouts.app')

@section('scripts')
    <script src="https://unpkg.com/imask"></script>

    <script>
        const title = document.getElementById('phone');
        const maskOptions = {
            mask: '+{7}(000)000-00-00'
        };
        const mask = IMask(title, maskOptions);
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
                                <h3>Редактирование студента группы <b>{{ $group->title }}</b></h3>
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
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ route('students.update', [$group->id, $student->id]) }}">
                            @csrf
                            @method('PUT')
                            <input id="group_id" type="hidden" value="{{ $group->id }}" name="group_id">

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">Фамилия</label>

                                <div class="col-md-6">
                                    <input
                                        id="last_name"
                                        type="text"
                                        class="form-control
                                        @error('last_name') is-invalid @enderror"
                                        name="last_name"
                                        value="{{ $student->last_name ?? old('last_name') }}"
                                        required
                                        autocomplete="last_name"
                                        autofocus
                                    >

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="first_name" class="col-md-4 col-form-label text-md-end">Имя</label>

                                <div class="col-md-6">
                                    <input
                                        id="first_name"
                                        type="text"
                                        class="form-control
                                        @error('first_name') is-invalid @enderror"
                                        name="first_name"
                                        value="{{ $student->first_name ?? old('first_name') }}"
                                        required
                                        autocomplete="first_name"
                                    >

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-end">Отчество</label>

                                <div class="col-md-6">
                                    <input
                                        id="surname"
                                        type="text"
                                        class="form-control
                                        @error('surname') is-invalid @enderror"
                                        name="surname"
                                        value="{{ $student->surname ?? old('surname') }}"
                                        autocomplete="surname"
                                    >

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-end">Дата рождения</label>

                                <div class="col-md-6">
                                    <input
                                        id="birth_date"
                                        type="date"
                                        class="form-control
                                        @error('birth_date') is-invalid @enderror"
                                        name="birth_date"
                                        value="{{ $student->birth_date->toDateString() ?? old('birth_date') }}"
                                        autocomplete="birth_date"
                                        required
                                    >

                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">Телефон</label>

                                <div class="col-md-6">
                                    <input
                                        id="phone"
                                        type="text"
                                        class="form-control
                                        @error('phone') is-invalid @enderror"
                                        name="phone"
                                        value="{{ $student->phone ?? old('phone') }}"
                                        autocomplete="phone"
                                    >

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control
                                        @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ $student->email ?? old('email') }}"
                                        autocomplete="email"
                                    >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="citizenship" class="col-md-4 col-form-label text-md-end">Гражданство</label>

                                <div class="col-md-6">
                                    <input
                                        id="citizenship"
                                        type="text"
                                        class="form-control
                                        @error('citizenship') is-invalid @enderror"
                                        name="citizenship"
                                        value="{{ $student->citizenship ?? old('citizenship') }}"
                                        autocomplete="citizenship"
                                    >

                                    @error('citizenship')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="is_head"
                                        name="is_head"
                                        value="1"
                                        @if($student->is_head) checked @endif
                                    >
                                    <label class="form-check-label" for="is_head">Староста</label>
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
