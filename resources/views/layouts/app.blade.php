<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Деятельность кураторов</title>
    <link rel="icon" href="/img.png" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark position-sticky">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    @guest
                        <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Деятельность кураторов</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li>
                                <a href="{{ route('login') }}" class="nav-link px-0 align-middle">
                                    <i class="bi-box-arrow-in-right"></i>
                                    <span class="ms-1 d-none d-sm-inline">Вход</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="nav-link px-0 align-middle">
                                    <i class="bi-person-plus"></i>
                                    <span class="ms-1 d-none d-sm-inline">Регистрация</span>
                                </a>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('activities.index') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Деятельность кураторов</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            @role('admin')
                            <li>
                                <a href="{{ route('users.index') }}" class="nav-link px-0 align-middle">
                                    <i class="bi-person-square"></i>
                                    <span class="ms-1 d-none d-sm-inline">Пользователи</span>
                                </a>
                            </li>
                            @endrole
                            <li>
                                <a href="{{ route('groups.index') }}" class="nav-link px-0 align-middle">
                                    <i class="bi-people"></i>
                                    <span class="ms-1 d-none d-sm-inline">Группы</span>
                                </a>
                            </li>
                            <li>
                                <a href="#dropdown" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="bi-list-nested"></i>
                                    <span class="ms-1 d-none d-sm-inline">Справочники</span>
                                </a>
                                <ul class="collapse nav flex-column ms-3" id="dropdown" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="{{ route('activity_types.index') }}" class="nav-link px-0">
                                            <i class="bi-border-width"></i>
                                            <span class="d-none d-sm-inline">Типы мероприятий</span>
                                        </a>
                                    </li>
                                    <li class="w-100">
                                        <a href="{{ route('activity_kinds.index') }}" class="nav-link px-0">
                                            <i class="bi-activity"></i>
                                            <span class="d-none d-sm-inline">Виды деятельности</span>
                                        </a>
                                    </li>
                                    <li class="w-100">
                                        <a href="{{ route('benchmarks.index') }}" class="nav-link px-0">
                                            <i class="bi-bar-chart-steps"></i>
                                            <span class="d-none d-sm-inline">Критерии</span>
                                        </a>
                                    </li>
                                    <li class="w-100">
                                        <a href="{{ route('indicators.index') }}" class="nav-link px-0">
                                            <i class="bi-bar-chart"></i>
                                            <span class="d-none d-sm-inline">Показатели</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('reports.main') }}" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-table"></i>
                                    <span class="ms-1 d-none d-sm-inline">Отчеты</span>
                                </a>
                            </li>
                            @role('admin')
                            <li>
                                <a href="{{ route('groups.import.form') }}" class="nav-link px-0 align-middle">
                                    <i class="bi-arrow-repeat"></i>
                                    <i class="bi-people"></i>
                                    <span class="ms-1 d-none d-sm-inline">Импорт групп</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="badge rounded-pill text-bg-primary">{{ auth()->user()->roles()->first()->name }}</span>
                                <span class="d-none d-sm-inline mx-1">{{ Auth::user()->shortName }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        Профиль
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                        Выход
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-auto col-md-9 col-xl-10 py-3">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>

@yield('scripts')
