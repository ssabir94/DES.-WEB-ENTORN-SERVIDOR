<h1>Llista de tasques</h1>

<ul>
    @foreach ($tasques as $t)
        <li>
            <strong>{{ $t->title }}</strong>
            Categoria:
            {{ $t->categoria->nom ?? 'Sense categoria' }}
            <a href="{{ route('tasques.edit', $t) }}">Editar</a>

            <form action="{{ route('tasques.destroy', $t->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>