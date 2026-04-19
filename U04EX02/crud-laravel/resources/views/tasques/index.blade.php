<a href="{{ route('tasques.index') }}">Tasques</a> |
<a href="{{ route('categories.index') }}">Categories</a>

<hr>

<h1>Llista de tasques</h1>

<p>
    <a href="{{ route('tasques.create') }}">+ Nova tasca</a>
</p>

<ul>
    @foreach ($tasques as $t)
        <li>
            <strong>{{ $t->title }}</strong><br>
            Categoria: {{ $t->categoria->nom ?? 'Sense categoria' }}<br>

            <a href="{{ route('tasques.edit', $t) }}">Editar</a>

            <form action="{{ route('tasques.destroy', $t->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>