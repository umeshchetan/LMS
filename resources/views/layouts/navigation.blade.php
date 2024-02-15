<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="{{route('intialPage')}}">
            <img class="navbar-brand" src="{{url('assets/logo.png')}}" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @if (Route::has('login'))
                <div class="d-flex sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                    <div class="navLeft">
                        <a href="{{ route('intialPage') }}"
                            class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        <a href="{{ url('/main') }}"
                            class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">My
                            Course</a>
                        <a href="{{ url('/logout') }}"
                            class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Logout</a>

                    </div>
                    <div class='navRight'>
                        <i class="fa-solid fa-user"></i>
                        <h3 class="" style="text-align:end">
                            <a href="" style="text-decoration: none;">{{Auth::user()->name}}</a>
                        </h3>
                    </div>
                    @else
                    <a href="{{ route('login') }}"
                        class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="nav-link  ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>
</nav>