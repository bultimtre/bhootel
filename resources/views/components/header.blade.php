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

                @endif
            </ul>
        </div>
       {{-- GUEST/UPR/UPRA --}}
        {{-- SOSTITUITA DA CANC <form class="form-inline mt-2 mt-md-0" action="{{route(Auth::user()?'user.search':'guest.search')}}" method="post"> --}}
        <form class="form-inline mt-2 mt-md-0" action="{{route('search.show')}}" method="post">
            @csrf
            @method('POST')
            <label for="search_field"></label>
            <input class="form-control mr-sm-2" name='search_field' type="text">
        </form>
    </nav>


<script>
    // script scroll navbar
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll < 200){
            $('.fixed-top').css('background', 'transparent');
        } else{
            $('.fixed-top').css('background', 'rgb(37, 47, 50)');
        }
    });
</script>
