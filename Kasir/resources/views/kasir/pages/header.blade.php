  <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center me-auto me-xl-0" style="text-decoration: none">
                <h1 class="sitename">Coffee Shop</h1>
            </a>
            <div class="d-none d-sm-block ">
                @if (Route::has('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-getstarted border-0">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>
    </header>