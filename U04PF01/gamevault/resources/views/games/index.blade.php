<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">
            My games
        </h1>

        <a href="{{ route('games.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            New game
        </a>

        <a href="{{ route('genres.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded ml-2">
            Manage genres
        </a>

        @if(session('success'))
            <p class="mt-4 text-green-600">
                {{ session('success') }}
            </p>
        @endif

        @if($games->isEmpty())
            <p class="mt-4">No games yet.</p>
        @endif

        <table class="w-full mt-5 border">
            <tr class="bg-gray-100">
                <th class="p-2">Title</th>
                <th class="p-2">Platform</th>
                <th class="p-2">Year</th>
                <th class="p-2">Genre</th>
                <th class="p-2">Status</th>
                <th class="p-2">Rating</th>
                <th class="p-2">Notes</th>
                <th class="p-2" style="width: 30%;">Description</th>
                <th class="p-2" style="width: 140px;">Actions</th>
            </tr>

            @foreach($games as $game)
                <tr>
                    <td class="p-2">{{ $game->title }}</td>
                    <td class="p-2">{{ $game->platform }}</td>
                    <td class="p-2">{{ $game->release_year }}</td>
                    <td class="p-2">
                        {{ optional($game->genre)->name ?? 'No category' }}
                    </td>

                    <td class="p-2">
                        {{ ucfirst($game->status) }}
                    </td>

                    <td class="p-2">
                        {{ $game->rating ?? '-' }}
                    </td>

                    <td class="p-2" style="word-break: break-word; overflow-wrap: break-word;">
                        {{ $game->notes ?? '-' }}
                    </td>

                    <td class="p-2" style="word-break: break-word; overflow-wrap: break-word;">
                        {{ $game->description }}
                    </td>

                    <td class="p-2" style="white-space: nowrap;">
                        <a href="{{ route('games.edit', $game) }}"
                            style="background-color: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 8px; font-size: 14px;">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('games.destroy', $game) }}" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button
                                style="background-color: #fee2e2; color: #b91c1c; padding: 4px 10px; border-radius: 6px; border: none; font-size: 14px; cursor: pointer;"
                                onclick="return confirm('Delete this game?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>