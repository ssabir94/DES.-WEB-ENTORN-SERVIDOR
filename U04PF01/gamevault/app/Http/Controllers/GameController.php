<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    // mostra només els videojocs de l'usuari autenticat
    public function index()
    {
        // carreguem també el gènere per evitar consultes innecessàries
        $games = Game::with('genre')
            ->where('user_id', Auth::id())
            ->get();

        return view('games.index', compact('games'));
    }

    // mostra el formulari per crear un videojoc
    public function create()
    {
        // obtenim tots els gèneres de l'usuari autenticat ordenats alfabèticament
        $genres = Genre::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('games.create', compact('genres'));
    }

    // guarda un videojoc nou a la base de dades
    public function store(Request $request)
    {
        // validem les dades del formulari
        $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|max:255',
            'release_year' => 'required|integer',
            'description' => 'nullable',
            // permeto que el joc no tingui categoria, però si se n'envia una ha d'existir
            'genre_id' => 'nullable|exists:genres,id',
            'status' => 'required|in:pending,playing,completed',
            'rating' => 'nullable|integer|min:1|max:10',
            'notes' => 'nullable|string',
        ]);

        // creo el videojoc associant-lo a l'usuari autenticat
        Game::create([
            'title' => $request->title,
            'platform' => $request->platform,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'genre_id' => $request->genre_id,
            'status' => $request->status,
            'rating' => $request->rating,
            'notes' => $request->notes,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('games.index')
            ->with('success', 'Game created');
    }

    // mostra un videojoc concret
    // no el fem servir en aquest projecte, però el deixem per coherència
    public function show(Game $game)
    {
        // $this->checkOwner($game);
        // return view('games.show', compact('game'));
    }

    // mostra el formulari per editar un videojoc
    public function edit(Game $game)
    {
        // comprovem que el joc sigui del propietari correcte
        $this->checkOwner($game);

        // obtenim els gèneres per omplir el select del formulari
        $genres = Genre::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('games.edit', compact('game', 'genres'));
    }

    // actualitza un videojoc existent
    public function update(Request $request, Game $game)
    {
        // comprovem que el joc sigui del propietari correcte
        $this->checkOwner($game);

        // validem les dades rebudes
        $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|max:255',
            'release_year' => 'required|integer',
            'description' => 'nullable',
            // permeto que el joc no tingui categoria, però si se n'envia una ha d'existir
            'genre_id' => 'nullable|exists:genres,id',
            'status' => 'required|in:pending,playing,completed',
            'rating' => 'nullable|integer|min:1|max:10',
            'notes' => 'nullable|string',
        ]);

        // actualitzem només els camps necessaris
        $game->update([
            'title' => $request->title,
            'platform' => $request->platform,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'genre_id' => $request->genre_id,
            'status' => $request->status,
            'rating' => $request->rating,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('games.index')
            ->with('success', 'Game updated');
    }

    // elimina un videojoc
    public function destroy(Game $game)
    {
        // comprovem que el joc sigui del propietari correcte
        $this->checkOwner($game);

        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('success', 'Game deleted');
    }

    // comprova que el videojoc pertanyi a l'usuari autenticat
    private function checkOwner(Game $game)
    {
        if ($game->user_id != Auth::id()) {
            abort(403);
        }
    }
}