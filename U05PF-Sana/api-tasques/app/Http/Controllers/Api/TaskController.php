<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // GET /api/tasks
    // Llistar les tasques de l’usuari autenticat amb filtre i ordenació opcional
    public function index(Request $request)
    {
        // Obtenim l’usuari autenticat a partir del token
        $user = $request->user();

        // Preparem la consulta base: només tasques de l’usuari autenticat
        $query = Task::with('category')
            ->where('user_id', $user->id);

        // Si arriba ?categoria=ID, filtrem per categoria
        if ($request->has('categoria')) {
            $query->where('category_id', $request->categoria);
        }

        // Ordenació opcional
        // Per defecte: desc (més noves primer)
        $order = $request->query('order', 'desc');

        // Només permetem asc o desc
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'desc';
        }

        // Ordenem per data de creació
        $query->orderBy('created_at', $order);

        // Executem la consulta i obtenim les tasques paginades (2 per pàgina)
        $tasks = $query->paginate(2);

        return response()->json([
            'success' => true,
            'data' => $tasks
        ], 200);
    }

    // POST /api/tasks
    // Crear una nova tasca associada a l’usuari autenticat
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'comentari' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $user = $request->user();

        $task = Task::create([
            'user_id' => $user->id,
            'nom' => $request->nom,
            'comentari' => $request->comentari,
            'category_id' => $request->category_id
        ]);

        $task->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Tasca creada correctament',
            'data' => $task
        ], 201);
    }

    // GET /api/tasks/{id}
    // Mostrar una tasca concreta de l’usuari autenticat
    public function show(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::with('category')
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Tasca no trobada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
    }

    // PUT /api/tasks/{id}
    // Actualitzar una tasca de l’usuari autenticat
    public function update(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'No tens permisos'
            ], 403);
        }

        $request->validate([
            'nom' => 'required',
            'comentari' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $task->update([
            'nom' => $request->nom,
            'comentari' => $request->comentari,
            'category_id' => $request->category_id
        ]);

        $task->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Tasca actualitzada',
            'data' => $task
        ], 200);
    }

    // DELETE /api/tasks/{id}
    // Eliminar una tasca de l’usuari autenticat
    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'No tens permisos'
            ], 403);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tasca eliminada'
        ], 200);
    }
}