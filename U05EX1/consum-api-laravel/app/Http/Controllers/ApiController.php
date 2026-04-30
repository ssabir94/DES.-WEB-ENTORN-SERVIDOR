<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // Aquesta funció obté els posts de l'API
    public function getPosts()
    {
        // Faig la petició GET a l'API externa
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        // Converteixo la resposta JSON a array
        $posts = $response->json();

        // Retorno les dades
        return view('posts', compact('posts'));
    }

    // Aquesta funció crea un nou post amb POST
    public function createPost()
    {
        // Envio dades a l'API
        $response = Http::post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'Post Laravel',
            'body' => 'Creat amb Http::post()',
            'userId' => 1
        ]);

        // Retorno la resposta en JSON
        return $response->json();
    }

    // Aquesta funció actualitza un post amb PUT
    public function updatePost()
    {
        // Envio dades per modificar el post amb ID = 1
        $response = Http::put('https://jsonplaceholder.typicode.com/posts/1', [
            'title' => 'Post actualitzat Laravel',
            'body' => 'Modificat amb Http::put()',
            'userId' => 1
        ]);

        // Retorno la resposta
        return $response->json();
    }


    // Aquesta funció elimina un post amb DELETE
    public function deletePost()
    {
        // Faig la petició DELETE al post amb ID = 1
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/1');

        // Retorno el codi d'estat HTTP
        return $response->status();
    }

}

