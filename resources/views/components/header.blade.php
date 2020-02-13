<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    {{-- modifica qui aggiunta la rotta su web user.home --}}
    <a class="navbar-brand" href="{{route('guest.home')}}">BHOOTEL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse" >

        <ul class="navbar-nav mr-auto flex-grow-1 justify-content-end pr-5">
        {{-- modifica verifica la rotta e mostra i link --}}
        @if(Auth::guest() && !Route::is('login') && !Route::is('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @elseif(Auth::user() && !Route::is('login') && !Route::is('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    @method('post')
                </form>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route ('index.create') }}">Inserisci appartamento</a>
            </li>
        @endif
        </ul>
        {{-- if per la ricerca --}}
        @if(!Route::is('login') && !Route::is('register'))
            <form class="form-inline mt-2 mt-md-0" action="{{route(Auth::user()?'user.search':'guest.search')}}" method="post">
                @csrf
                @method('POST')

                <label for="search_field"></label>
                <input class="form-control mr-sm-2" name='search_field' type="text">

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Cerca </button>
            </form>
        @endif
        {{-- <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> --}}


    </div>
</nav>
