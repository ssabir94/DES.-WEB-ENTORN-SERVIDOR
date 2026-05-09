<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // GET /api/categories
    // Llistar categories
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    // POST /api/categories
    // Crear categoria
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required'
        ]);

        $category = Category::create([
            'nom' => $request->nom
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Categoria creada correctament',
            'data' => $category
        ], 201);
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria no trobada'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoria eliminada'
        ], 200);
    }
}