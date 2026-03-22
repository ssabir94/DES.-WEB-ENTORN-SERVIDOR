<h1>Editar categoria</h1>
<form action="{{ route('categories.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nom categoria</label>
    <input type="text" name="nom" value="{{ $categoria->nom }}">

    <button type="submit">
        Actualitzar
    </button>
</form>

<a href="{{ route('categories.index') }}">
    Tornar
</a>