<x-app-layout>
  
    <div class="mt-10 mr-20 ml-20 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Cover Photo -->
        
        <div class="relative h-48 bg-gray-300">
            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $user->cover) }}" alt="Cover Photo">
            
        </div>


        
        <!-- Profile Info -->
        <div class="p-8">
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
    <div class="mt-2 mb-2 mr-20 ml-20 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Skills Section -->
        <div class="p-6">
            <h3 class="text-xl font-bold mb-4">Skills</h3>
            <div class="flex flex-wrap">
                @foreach($user->skills as $skill)
                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold mr-2 mb-2 px-4 py-2 rounded-full">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
     

</x-app-layout>