<x-app-layout>
    <div class="container mx-auto mt-10 flex justify-center">
        <div class="w-full max-w-xl">
            <div>
                <input type="text" wire:model="search" placeholder="Search posts..." class="w-full p-2 mb-4 border rounded">
                @foreach($posts as $post)
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col justify-between mb-6">
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <h4 class="text-lg font-semibold">{{ $post->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <p class="text-gray-800 text-sm">{{ $post->content }}</p>
                        <p class="text-blue-800 text-xs">
                            @foreach($post->hashtags as $hashtag)
                                {{ $hashtag->name }}
                            @endforeach
                        </p>
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-auto mt-2 rounded-lg">
                        @endif
                        <div class="flex items-center justify-between mt-3 text-gray-600 text-sm">
                            <button class="flex items-center hover:text-red-600">
                                <i class="far fa-heart text-red-500 mr-1"></i>Like
                            </button>
                            <button onclick="toggleCommentSection({{ $post->id }})" class="flex items-center hover:text-blue-600">
                                <i class="far fa-comment text-blue-500 mr-1"></i> Comment <span class="ml-2" id="comment-count-{{ $post->id}}">({{$post->comments->count()}})</span>
                            </button>
                            <button class="flex items-center hover:text-green-500">
                                <i class="fas fa-share text-green-500 mr-1"></i> Share
                            </button>
                            @if (Auth::id() === $post->user_id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="flex items-center hover:text-orange-500">
                                    <i class="fas fa-pen text-orange-500 mr-1"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer ce post ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center hover:text-red-600">
                                        <i class="far fa-minus-square text-red-500 mr-1"></i> Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                        <!-- Comment Section -->
                        <div id="comment-section-{{ $post->id }}" class="hidden mt-4 border-t pt-4">
                            <!-- Scrollable Comments Container -->
                            <div class="max-h-40 overflow-y-auto mb-4">
                                @foreach($post->comments as $comment)
                                    <div class="flex items-start mb-2">
                                        <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                                        <div>
                                            <p class="text-sm font-semibold">{{ $comment->user->name }}</p>
                                            <p class="text-xs text-gray-600">{{ $comment->content }}</p>
                                            <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        @if($comment->user_id == Auth::id())
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i class="far fa-trash-alt text-red-500 ml-12"></i></button>
                                        </form>
                                    @endif
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Comment Input Form -->
                            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex">
                                @csrf
                                <input type="text" name="content" placeholder="Write a comment..." class="flex-grow p-2 border rounded-l-lg text-sm">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg text-sm">Send</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add pagination links -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>