<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    @foreach ($item as $key => $value)
        <p>{{$value}}</p>
    @endforeach

@endforeach

{{-- @foreach($apts as $apt)
<p>{{$apt}}</p>
@endforeach --}}
</body>
</html>

