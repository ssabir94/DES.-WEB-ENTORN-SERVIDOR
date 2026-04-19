<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MVC CRUD Laravel</title>
</head>
<body>

    <nav>
        <a href="{{ route('tasques.index') }}">Llistat</a> |
        <a href="{{ route('categories.index') }}">Categories</a> |
        <a href="{{ route('tasques.create') }}">Nova tasca</a>
    </nav>

    <hr>

    @yield('content')

</body>
</html>