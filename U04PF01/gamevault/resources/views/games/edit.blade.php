<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">
            Edit game
        </h1>

        {{-- mostrar errors de validació --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('games.update', $game) }}">
            @csrf
            @method('PUT')

            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $game->title) }}" class="border w-full p-2 mb-3">

            <label>Platform</label>
            <input type="text" name="platform" value="{{ old('platform', $game->platform) }}"
                class="border w-full p-2 mb-3">

            <label>Release year</label>
            <input type="number" name="release_year" value="{{ old('release_year', $game->release_year) }}"
                class="border w-full p-2 mb-3">

            <label>Description</label>
            <textarea name="description"
                class="border w-full p-2 mb-3">{{ old('description', $game->description) }}</textarea>

            <label>Genre</label>
            <select name="genre_id" class="border w-full p-2 mb-3">
                {{-- opció per deixar el joc sense categoria --}}
                <option value="">No category</option>

                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id', $game->genre_id) == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>

            <label>Status</label>
            <select name="status" class="border w-full p-2 mb-3">
                <option value="pending" {{ old('status', $game->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="playing" {{ old('status', $game->status) == 'playing' ? 'selected' : '' }}>Playing</option>
                <option value="completed" {{ old('status', $game->status) == 'completed' ? 'selected' : '' }}>Completed
                </option>
            </select>

            <label>Rating (1-10)</label>
            <input type="number" name="rating" min="1" max="10" value="{{ old('rating', $game->rating) }}"
                class="border w-full p-2 mb-3">

            <label>Notes</label>
            <textarea name="notes" class="border w-full p-2 mb-3">{{ old('notes', $game->notes) }}</textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>