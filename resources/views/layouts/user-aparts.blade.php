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
             <form action="{{route('mail.create' , $apartment->id)}}" id="mailform" method="post">
             @csrf
             @method("POST")
             
            <button type="submit">invia</button>

            
            </form>

            <textarea form= "mailform" name="message" id="msg" cols="30" rows="10">Pippo e paperino</textarea>
           
        </div>
      </div>
    </div>

    



</body>
</html>