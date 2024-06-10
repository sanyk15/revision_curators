@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Импорт групп и студентов</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('groups.import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="alert alert-info" role="alert">
                                Для импорта студентов и групп необходимо загрузить CSV файл с обязательными столбцами.<br>
                                <a href="/students.csv">Пример файла</a>
                            </div>

                            @if(!empty($result))
                                <div class="alert alert-success" role="alert">
                                    Список студентов и групп будет импортирован в ближайшее время!
                                </div>
                            @endif

                            <div class="row mb-1">
                                <div class="mb-1">
                                    <input class="form-control" type="file" accept="text/csv" name="students">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Импортировать
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
