<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{route('all.index') }}">BHOOTEL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse" >
        @if(!Route::is('bhootel.login') && !Route::is('register'))
        <ul class="navbar-nav mr-auto flex-grow-1 justify-content-end pr-5">
            {{-- GUEST login + register--}}
            @if(Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bhootel.login','upr') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route ('bhootel.login','apt') }}">Inserisci appartamento</a>
                </li>
            {{-- GUEST logout + name user--}}
            @elseif(Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.user-panel') }}">{{Auth::user()->name}}</a>
                </li>
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
                    <a class="nav-link" href="{{ route ('user-apt.create') }}">Inserisci appartamento</a>
                </li>
            @endif
            {{-- ADD APT GUEST/UPR/UPRA --}}

        </ul>
        {{-- GUEST/UPR/UPRA --}}
        <form class="form-inline mt-2 mt-md-0" action="{{route(Auth::user()?'user.search':'guest.search')}}" method="post">
            @csrf
            @method('POST')
            <label for="search_field"></label>
            <input class="form-control mr-sm-2" name='search_field' type="text">

            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Cerca </button>
        </form>
        @endif
    </div>
</nav>

