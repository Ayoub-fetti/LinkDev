<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach($receivedConnections as $connection)
    <p>{{ $connection->sourceUser->name }} wants to connect with you.</p>
    <form action="{{ route('connections.accept') }}" method="POST">
        @csrf
        <input type="hidden" name="connection_id" value="{{ $connection->id }}">
        <button type="submit">Accept</button>
    </form>
    <form action="{{ route('connections.reject') }}" method="POST">
        @csrf
        <input type="hidden" name="connection_id" value="{{ $connection->id }}">
        <button type="submit">Reject</button>
    </form>
@endforeach
    </div>
</x-app-layout>
