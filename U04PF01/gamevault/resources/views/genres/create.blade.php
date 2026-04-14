<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">
            Create genre
        </h1>

        <form method="POST" action="{{ route('genres.store') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border w-full p-2 mb-3">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>