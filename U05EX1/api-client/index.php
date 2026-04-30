<?php

// Carrego la configuració (URL de l'API)
require_once 'config.php';

// Carrego les funcions cURL
require_once 'curl_client.php';

// Crido la funció getData per obtenir tots els posts
$posts = getData(API_URL);

// Mostro només els 5 primers posts
for ($i = 0; $i < 5; $i++) {

    // Mostro el títol del post
    echo "Títol: " . $posts[$i]['title'] . "<br>";

    // Mostro el contingut del post
    echo "Contingut: " . $posts[$i]['body'] . "<br>";

    // Separador visual entre posts
    echo "--------------------------<br>";
}

echo "<br><br>GET per ID<br>";

$post = getDataById(API_URL, 1);

// Mostro el post concret
echo "Títol: " . $post['title'] . "<br>";
echo "Contingut: " . $post['body'] . "<br>";

echo "<br><br>POST - Crear post<br>";

// Creo les dades que enviaré a l'API
$nouPost = [
    "title" => "Post de prova",
    "body" => "Aquest és un post creat amb cURL",
    "userId" => 1
];

// Crido la funció POST
$respostaPost = postData(API_URL, $nouPost);

// Mostro la resposta de l'API
print_r($respostaPost);


echo "<br><br>PUT - Actualitzar post<br>";

// Dades noves per modificar el post
$postActualitzat = [
    "title" => "Post modificat",
    "body" => "Aquest contingut ha estat actualitzat amb PUT",
    "userId" => 1
];

// Crido la funció PUT (modifico el post amb ID = 1)
$respostaPut = putData(API_URL, 1, $postActualitzat);

// Mostro la resposta
print_r($respostaPut);


echo "<br><br>DELETE - Eliminar post<br>";

// Crido la funció DELETE (elimino el post amb ID = 1)
$respostaDelete = deleteData(API_URL, 1);

// Mostro la resposta
print_r($respostaDelete);