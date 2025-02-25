<x-app-layout>
  
    <div class="mt-10 mr-20 ml-20 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Cover Photo -->
        
        <div class="relative h-full bg-gray-300">
            <img class="w-full h-40 object-cover" src="{{ asset('storage/' . $user->cover) }}" alt="Cover Photo">
            
        </div>


        
        <!-- Profile Info -->
        <div class="p-6">
            <div class="flex items-center">
                <img class="w-16 h-16 rounded-full border-4 border-white -mt-12" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                <div class="ml-4">
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->bio }}</p>
                </div>
            </div>
        </div>
        
        <!-- Contact & Links -->
        <div class="p-6 border-t">
            <p><a href="#" class="hover:font-bold"> <i class="fas fa-envelope text-yellow-600 mr-2 "></i>{{ $user->email }}</a></p>
            @if($user->website)
                <p><a href="{{ $user->website }}" class="hover:font-bold"> <i class="fas fa-globe-africa text-blue-500 mr-2"></i>Website</a></p>
            @endif
            @if($user->github_url)
                <p><a href="{{ $user->github_url }}" class="hover:font-bold"><i class="fab fa-github mr-2"></i>GitHub</a></p>
            @endif
            @if($user->linkedin_url)
                <p><a href="{{ $user->linkedin_url }}" class="hover:font-bold"> <i class="fab fa-linkedin mr-2 text-blue-500"></i>LinkedIn</a></p>
            @endif
        </div>
    </div>
     

</x-app-layout>