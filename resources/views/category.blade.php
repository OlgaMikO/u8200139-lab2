<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>{{ $name }}</title>
</head>

<body>
    <p>{{$count}}</p>
    @for($i = 0; $i < $count; $i++)
        <p><img src=$banners[$i]></p>
    @endfor
</body>

</html>
