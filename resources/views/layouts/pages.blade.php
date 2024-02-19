<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('partials/_head')
    <link rel="stylesheet" href="styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome icons cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @if(\Route::currentRouteName() != "intialPage")
    <header id="header" class="page-content">
        <nav class="navbar container fixed-top py-3">
            <div class="container-fluid">
                <div class="col-md-9">
                    <img src="{{asset("assets/biomag-logo.png")}}" alt="logo" width="130px">
                </div>
                <div class="row" id="rightNav">
                    <div class="col" style="border-radius:50%;background-color:white;" id="person">
                        <i class="fa-solid fa-user" style="font-size:30px;cursor:pointer;color:slategray"></i>
                    </div>
                    <button class="navbar-toggler col" id="btn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <div class="text-container mt-5 mx-5">
                <h1>
                    <?php echo str_replace('_', ' ', \Request::route()->getName()); ?>
                </h1>
                <h6><a href="{{ route('intialPage') }}" class="color-white">HOME </a>/ <a class="color-white">
                        <?php echo str_replace('_', ' ', \Request::route()->getName()); ?>
                    </a> </h6>
            </div>
        </nav>

    </header>
    @endif


    @yield('content')
</body>