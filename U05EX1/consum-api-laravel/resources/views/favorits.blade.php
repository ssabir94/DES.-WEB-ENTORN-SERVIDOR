<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Posts Favorits</title>
</head>

<body>

    <h1>Posts Favorits</h1>

    <!-- Enllaç per tornar als posts -->
    <a href="/posts">Tornar als posts</a>

    <hr>

    @foreach($postsFavorits as $post)

        <!-- Contenidor visual -->
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <!-- Títol -->
            <h2>{{ $post['title'] }}</h2>

            <!-- Contingut -->
            <p>{{ $post['body'] }}</p>

            <!-- Indicador visual -->
            <p style="color: green;"><strong>Favorit</strong></p>

        </div>

    @endforeach

</body>

</html>