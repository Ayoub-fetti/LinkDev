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
                        <div class="flex items-center justify-between mt-3 text-gray-600 text-sm " >
     
                            <button onclick="toggleLike({{ $post->id }})"
                                class="like-button flex items-center space-x-2 hover:text-blue-600"
                                data-post-id="{{ $post->id }}">
                                <svg class="h-5 w-5 like-icon" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="likes-count">{{ $post->likes->count() }}</span>
                                <span>likes</span>
                            </button>

                            <button onclick="toggleCommentSection({{ $post->id }})" class="flex items-center hover:text-blue-600">
                                <i class="far fa-comment text-blue-500 mr-1"></i> Comment <span class="ml-2" id="comment-count-{{ $post->id}}">({{ $post->comments->count() }})</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.like-button').forEach(button => {
                        const postId = button.dataset.postId;
                        checkLikeStatus(postId);
                    });
                });
                async function toggleLike(postId) {
    try {
        const response = await fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        console.log(data);
        if (data.success) {
            const button = document.querySelector(`.like-button[data-post-id="${postId}"]`);
            const icon = button.querySelector('.like-icon');
            const count = button.querySelector('.likes-count');
            
            // Update like count
            count.textContent = data.likesCount;
            
            // Update icon state
            if (data.isLiked) {
                icon.style.fill = 'currentColor';
            } else {
                icon.style.fill = 'none';
            }
        }
    } catch (error) {
        console.error('Error toggling like:', error);
    }
}
        async function checkLikeStatus(postId) {
            try {
                const response = await fetch(`/posts/${postId}/check-like`);
                const data = await response.json();
                
                const button = document.querySelector(`.like-button[data-post-id="${postId}"]`);
                const icon = button.querySelector('.like-icon');
                
                if (data.isLiked) {
                    icon.style.fill = 'currentColor';
                }
            } catch (error) {
                console.error('Error checking like status:', error);
            }
        }
    </script>
    <script>
                function toggleCommentSection(postId) {
            const commentSection = document.getElementById(`comment-section-${postId}`);
            commentSection.classList.toggle('hidden');
        }
    </script>
</x-app-layout>