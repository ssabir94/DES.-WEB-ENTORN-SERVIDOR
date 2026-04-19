<a href="{{ route('tasques.index') }}">Tasques</a> |
<a href="{{ route('categories.index') }}">Categories</a>

<hr>

<h1>Llista de categories</h1>

<p>
    <a href="{{ route('categories.create') }}">+ Nova categoria</a>
</p>

<ul>
    @foreach ($categories as $categoria)
        <li>
            {{ $categoria->nom }}<br>

            <a href="{{ route('categories.edit', $categoria) }}">
                Editar
            </a>

            <form action="{{ route('categories.destroy', $categoria) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>