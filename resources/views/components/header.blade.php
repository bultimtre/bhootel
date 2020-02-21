<div class="container">
    <nav class="navbar navbar-expand-md fixed-top {{!Route::is('all.index') ? 'dark' : ''}}">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse" >
            <ul class="navbar-nav mr-auto flex-grow-1 justify-content-between pr-5">
                <li>
                    <a class="navbar-brand" href="{{route('all.index') }}">
                        <img src="{{ url('/') }}/images/BhootelLogo.png" alt="">
                    </a>
                </li>
            @if(!Route::is('bhootel.login') && !Route::is('register'))
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
                        <a class="nav-link user-name" href="{{ route('user.user-panel') }}"><i class="fas fa-user    "></i>{{Auth::user()->name}}</a>
                    </li>
                    <li class="d-flex">
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route ('user-apt.create') }}">Inserisci appartamento</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                @method('post')
                            </form>
                            </a>
                        </div>
                    </li>
                @endif
                {{-- ADD APT GUEST/UPR/UPRA --}}
            </ul>
            @endif
        </div>
    </nav>
</div>
