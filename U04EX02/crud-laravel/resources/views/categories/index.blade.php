<h1>Llista de categories</h1>
<a href="{{ route('categories.create') }}">Nova categoria</a>
<ul>
    @foreach ($categories as $categoria)
        <li>
            {{ $categoria->nom }}
            <a href="{{ route('categories.edit', $categoria) }}">
                Editar
            </a>
            <form action="{{ route('categories.destroy', $categoria) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>