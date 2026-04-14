<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">
            Genres
        </h1>

        <a href="{{ route('genres.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            New genre
        </a>

        <a href="{{ route('games.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded ml-2">
            Back to games
        </a>

        @if(session('success'))
            <p class="mt-4 text-green-600">
                {{ session('success') }}
            </p>
        @endif

        <table class="w-full mt-5 border" style="table-layout: fixed;">
            <tr class="bg-gray-100">
                <th class="p-2" style="text-align: left; width: 70%;">Name</th>
                <th class="p-2" style="text-align: left; width: 30%;">Actions</th>
            </tr>

            @foreach($genres as $genre)
                <tr>
                    <td class="p-2">
                        {{ $genre->name }}
                    </td>

                    <td class="p-2" style="white-space: nowrap;">
                        <a href="{{ route('genres.edit', $genre) }}"
                            style="background-color: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 8px; font-size: 14px;">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('genres.destroy', $genre) }}" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button
                                style="background-color: #fee2e2; color: #b91c1c; padding: 4px 10px; border-radius: 6px; border: none; font-size: 14px; cursor: pointer;"
                                onclick="return confirm('Delete this genre?')">
                                Delete
                            </button>
                        </form>
                    </td>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>