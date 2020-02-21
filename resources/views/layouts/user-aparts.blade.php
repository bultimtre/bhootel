<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <title>BoolBnb</title>
</head>
<body>

    <div class="container">
      <div class="row">
        <div class="col-6">
          @auth
            <h2>{{ Auth::user() -> email }}</h2>  
          @else 
            <h2>GUEST</h2>
          @endauth         
        </div>
        <div class="col-6">
          @auth
            <form action="{{ route('logout') }}" method="post">
              @csrf
              @method('POST')
              <button type="submit" class="btn btn-light">Logout</button>
              
            </form>
          @else
            <a href="{{ route('login') }}" type="submit" class="btn btn-light">Login</a>         
          @endauth          
        </div>
      </div>
    </div>

    @yield('content')



</body>
</html>