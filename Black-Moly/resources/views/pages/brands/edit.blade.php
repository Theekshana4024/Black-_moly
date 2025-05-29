<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Brand</h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('admin.brands.update', $brand) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Name</label>
                <input name="name" value="{{ $brand->name }}" required class="w-full border rounded px-3 py-2" />
            </div>

            <div class="mb-4">
                <label class="block">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ $brand->description }}</textarea>
            </div>

            <div class="flex gap-2">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('admin.brands.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back</a>
            </div>
        </form>
    </div>
</x-app-layout>
