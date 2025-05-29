<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <div class="mb-4">
                <strong>Name:</strong> {{ $message->first_name }}
            </div>
            <div class="mb-4">
                <strong>Email:</strong> {{ $message->email }}
            </div>
            <div class="mb-4">
                <strong>Subject:</strong> {{ $message->subject ?? '—' }}
            </div>
            <div class="mb-4">
                <strong>Message:</strong>
                <p class="mt-1 text-gray-700">{{ $message->message }}</p>
            </div>

            <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 hover:underline">← Back to all messages</a>
        </div>
    </div>
</x-app-layout>
