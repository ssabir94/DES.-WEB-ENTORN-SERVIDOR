<h1>Editar tasca</h1>

<form action="{{ route('tasques.update', $tasca->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Títol</label>
    <input type="text" name="title" value="{{ $tasca->title }}">

    <label>Descripció</label>
    <input type="text" name="description" value="{{ $tasca->description }}">

    <label>Categoria</label>
    <select name="categoria_id">
        <option value="">Sense categoria</option>
        @foreach ($categories as $c)
            <option value="{{ $c->id }}" @if(old('categoria_id', $tasca->categoria_id) == $c->id) selected @endif>
                {{ $c->nom }}
            </option>
        @endforeach
    </select>

    <button type="submit">Actualitzar</button>
</form>

<a href="{{ route('tasques.index') }}">Tornar</a>