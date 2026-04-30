<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Posts API</title>
</head>

<body>

    <h1>Llistat de posts</h1>

    <!-- Enllaç per veure només els posts favorits -->
    <a href="/favorits">Veure només favorits</a>

    <hr>

    @foreach($posts as $post)

        <!-- Contenidor visual per separar millor cada post -->
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <!-- Mostro el títol del post -->
            <h2>{{ $post['title'] }}</h2>

            <!-- Mostro el contingut -->
            <p>{{ $post['body'] }}</p>

            <!-- Comprovo si aquest post ja està guardat com a favorit -->
            @if(in_array($post['id'], $favorits))

                <!-- Si és favorit -->
                <p style="color: green;"><strong>Ja és favorit</strong></p>

                <!-- Formulari per eliminar favorit -->
                <form method="POST" action="/eliminar-favorit">

                    <!-- Protecció CSRF -->
                    @csrf

                    <!-- Envio l'ID del post -->
                    <input type="hidden" name="post_id" value="{{ $post['id'] }}">

                    <!-- Botó eliminar amb color -->
                    <button style="background-color: lightcoral;">Eliminar favorit</button>

                </form>

            @else

                <!-- Si NO és favorit -->
                <form method="POST" action="/favorit">

                    <!-- Protecció CSRF -->
                    @csrf

                    <!-- Envio ID i títol -->
                    <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                    <input type="hidden" name="title" value="{{ $post['title'] }}">

                    <!-- Botó guardar amb color -->
                    <button style="background-color: lightgreen;">Afegir a favorits</button>

                </form>

            @endif

        </div>

    @endforeach

</body>

</html>