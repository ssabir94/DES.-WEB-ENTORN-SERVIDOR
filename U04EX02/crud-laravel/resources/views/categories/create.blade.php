<h1>Crear categoria</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label>Nom categoria</label>
    <input type="text" name="nom">
    <button type="submit">
        Guardar
    </button>
</form>
<a href="{{ route('categories.index') }}">
    Tornar
</a>