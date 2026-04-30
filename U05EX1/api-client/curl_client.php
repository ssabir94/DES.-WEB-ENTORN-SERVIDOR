<?php

// Aquesta funció fa una petició GET a l'API.
// Rep una URL i retorna les dades convertides de JSON a array de PHP.
function getData($url) {

    // Inicio cURL amb la URL que vull consultar.
    $ch = curl_init($url);

    // Indico que la resposta no es mostri directament per pantalla,
    // sinó que es guardi dins d'una variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executo la petició HTTP.
    $resposta = curl_exec($ch);

    // Comprovo si hi ha hagut algun error amb cURL.
    if (curl_errno($ch)) {
        echo "Error cURL: " . curl_error($ch);
    }

    // Tanco la connexió cURL.
    curl_close($ch);

    // Converteixo la resposta JSON a array associatiu de PHP.
    return json_decode($resposta, true);
}

// Aquesta funció obté un únic post a partir del seu ID.
function getDataById($url, $id) {

    // Creo la URL amb l'ID (ex: /posts/1)
    $ch = curl_init($url . "/" . $id);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resposta = curl_exec($ch);

    // Comprovo errors
    if (curl_errno($ch)) {
        echo "Error cURL: " . curl_error($ch);
    }

    curl_close($ch); //Aixo surt ratllat perque es considera antic, pero es la forma correcta de tancar la connexió cURL.

    return json_decode($resposta, true);
}

// Aquesta funció envia dades a l'API amb el mètode POST.
// Serveix per crear un nou registre.
function postData($url, $data) {

    // Inicio cURL amb la URL de l'API.
    $ch = curl_init($url);

    // Converteixo l'array de PHP a JSON.
    $jsonData = json_encode($data);

    // Faig que la resposta es guardi en una variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Indico que la petició serà de tipus POST.
    curl_setopt($ch, CURLOPT_POST, true);

    // Envio les dades en format JSON.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Indico a l'API que estic enviant dades en format JSON.
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Executo la petició.
    $resposta = curl_exec($ch);

    // Comprovo si hi ha errors de cURL.
    if (curl_errno($ch)) {
        echo "Error cURL: " . curl_error($ch);
    }

    // Tanco la connexió.
    curl_close($ch);

    // Retorno la resposta convertida de JSON a array PHP.
    return json_decode($resposta, true);
}


// Aquesta funció modifica un registre existent amb el mètode PUT.
function putData($url, $id, $data) {

    // Creo la URL amb l'ID del post que vull modificar
    $ch = curl_init($url . "/" . $id);

    // Converteixo les dades a JSON
    $jsonData = json_encode($data);

    // Indico que vull rebre la resposta en una variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Indico que la petició serà de tipus PUT
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    // Envio les dades JSON
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Headers per indicar JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Executo la petició
    $resposta = curl_exec($ch);

    // Comprovo errors
    if (curl_errno($ch)) {
        echo "Error cURL: " . curl_error($ch);
    }

    // Tanco connexió
    curl_close($ch);

    // Retorno la resposta com array
    return json_decode($resposta, true);
}

// Aquesta funció elimina un registre amb el mètode DELETE.
function deleteData($url, $id) {

    // Creo la URL amb l'ID del post que vull eliminar.
    $ch = curl_init($url . "/" . $id);

    // Faig que la resposta es guardi en una variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Indico que la petició serà DELETE.
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    // Executo la petició.
    $resposta = curl_exec($ch);

    // Comprovo errors.
    if (curl_errno($ch)) {
        echo "Error cURL: " . curl_error($ch);
    }

    // Tanco la connexió.
    curl_close($ch);

    // Retorno la resposta.
    return $resposta;
}