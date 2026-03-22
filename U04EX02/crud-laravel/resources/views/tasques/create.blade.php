<h1>Crear tasca</h1>

<form action="{{ route('tasques.store') }}" method="POST">
    @csrf

    <label>Títol</label>
    <input type="text" name="title">

    <label>Descripció</label>
    <input type="text" name="description">

    <label>Categoria</label>
    <select name="categoria_id">
        <option value="">Sense categoria</option>
        @foreach ($categories as $c)
            <option value="{{ $c->id }}" @if(old('categoria_id') == $c->id) selected @endif>
                {{ $c->nom }}
            </option>
        @endforeach
    </select>

    <button type="submit">Guardar</button>
</form>

<a href="{{ route('tasques.index') }}">Tornar</a>