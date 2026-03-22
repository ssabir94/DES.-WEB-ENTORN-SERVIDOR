<?php
namespace App\Http\Controllers;
use App\Models\Tasca;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TascaController extends Controller
{
    public function index()
    {
        $tasques = Tasca::orderBy('created_at', 'desc')->get();
        return view('tasques.index', compact('tasques'));
    }
    public function create()
    {
        $categories = Categoria::orderBy('nom')->get();
        return view('tasques.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:150',
            'categoria_id' => 'nullable|exists:categorias,id'
        ]);
        Tasca::create($request->only('title', 'description', 'categoria_id'));
        return redirect()->route('tasques.index');
    }
    public function edit(Tasca $tasque)
    {
        $categories = Categoria::orderBy('nom')->get();
        return view(
            'tasques.edit',
            [
                'tasca' => $tasque,
                'categories' => $categories
            ]
        );
    }
    public function update(Request $request, Tasca $tasque)
    {
        $request->validate([
            'title' => 'required|max:150',
            'categoria_id' => 'nullable|exists:categorias,id'
        ]);

        $tasque->update($request->only(
            'title',
            'description',
            'categoria_id'
        ));

        return redirect()->route('tasques.index');
    }
    public function destroy(Tasca $tasque)
    {
        $tasque->delete();
        return redirect()->route('tasques.index');
    }

}
