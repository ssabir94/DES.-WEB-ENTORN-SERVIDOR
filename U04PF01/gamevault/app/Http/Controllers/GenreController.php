<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    // mostra només els gèneres de l'usuari autenticat
    public function index()
    {
        $genres = Genre::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('genres.index', compact('genres'));
    }

    // formulari per crear un gènere
    public function create()
    {
        return view('genres.create');
    }

    // guarda un gènere nou
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Genre::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre created');
    }

    // mostrar un gènere (no el fem servir, però el deixem per coherència)
    public function show(Genre $genre)
    {
        //
    }

    // formulari per editar un gènere
    public function edit(Genre $genre)
    {
        $this->checkOwner($genre);

        return view('genres.edit', compact('genre'));
    }

    // actualitza un gènere existent
    public function update(Request $request, Genre $genre)
    {
        $this->checkOwner($genre);

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre updated');
    }

    // elimina un gènere
    public function destroy(Genre $genre)
    {
        $this->checkOwner($genre);

        $genre->delete();

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre deleted');
    }

    // comprova que el gènere pertanyi a l'usuari autenticat
    private function checkOwner(Genre $genre)
    {
        if ($genre->user_id != Auth::id()) {
            abort(403);
        }
    }
}