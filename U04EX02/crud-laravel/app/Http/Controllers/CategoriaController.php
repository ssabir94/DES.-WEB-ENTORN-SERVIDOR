<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categories = Categoria::orderBy('nom')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:150'
        ]);

        Categoria::create($request->only('nom'));

        return redirect()->route('categories.index');
    }

    public function edit(Categoria $category)
    {
        return view('categories.edit', ['categoria' => $category]);
    }

    public function update(Request $request, Categoria $category)
    {
        $request->validate([
            'nom' => 'required|max:150'
        ]);

        $category->update($request->only('nom'));

        return redirect()->route('categories.index');
    }

    public function destroy(Categoria $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}