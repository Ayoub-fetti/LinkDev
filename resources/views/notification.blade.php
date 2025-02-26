<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Notifications</h2>
        <div class="bg-white shadow-md rounded-lg p-6">
            @forelse($receivedConnections as $connection)
                <div class="flex items-center justify-between border-b pb-4 mb-4">
                    <div class="flex items-center gap-3">
                        <img class="w-12 h-12 rounded-full" src="{{ asset('storage/' . $connection->sourceUser->profile_picture) }}" alt="Profile Picture">
                        <p class="text-gray-800"><span class="font-semibold">{{ $connection->sourceUser->name }}</span> wants to connect with you.</p>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('connections.accept') }}" method="POST">
                            @csrf
                            <input type="hidden" name="connection_id" value="{{ $connection->id }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Accept</button>
                        </form>
                        <form action="{{ route('connections.reject') }}" method="POST">
                            @csrf
                            <input type="hidden" name="connection_id" value="{{ $connection->id }}">
                            <button type="submit" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Reject</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center">No new connection requests.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
