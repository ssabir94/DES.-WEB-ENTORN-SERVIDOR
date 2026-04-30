<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Favorit;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Obtenir posts de l'API externa
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();

        // Obtenir els IDs dels favorits guardats a la BD
        $favorits = Favorit::pluck('post_id')->toArray();

        // Enviar les dades a la vista
        return view('posts', compact('posts', 'favorits'));
    }


    // Aquesta funció guarda un post com a favorit
    public function store(Request $request)
    {
        // Comprovo si ja existeix aquest favorit
        $existeix = Favorit::where('post_id', $request->post_id)->exists();

        // Si NO existeix, el guardo
        if (!$existeix) {
            Favorit::create([
                'post_id' => $request->post_id,
                'title' => $request->title
            ]);
        }

        // Redirigeixo a la llista de posts
        return redirect('/posts');
    }

    // Aquesta funció elimina un favorit
    public function destroy(Request $request)
    {
        // Busco el favorit pel seu post_id i l'elimino
        Favorit::where('post_id', $request->post_id)->delete();

        // Torno a la llista
        return redirect('/posts');
    }

    // Aquesta funció mostra només els posts que són favorits
    public function favorits()
    {
        // Obtenim tots els favorits de la BD
        $favoritsBD = Favorit::pluck('post_id')->toArray();

        // Obtenim tots els posts de l'API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();

        // Filtrarem només els que estan a favorits
        $postsFavorits = [];

        foreach ($posts as $post) {
            if (in_array($post['id'], $favoritsBD)) {
                $postsFavorits[] = $post;
            }
        }

        // Enviem només els favorits a la vista
        return view('favorits', compact('postsFavorits'));
    }
}