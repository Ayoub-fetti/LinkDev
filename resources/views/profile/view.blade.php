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
    <div class="mt-2 mb-2 mr-20 ml-20 bg-gray-300 shadow-lg rounded-lg overflow-hidden">

        <div class="flex gap-x-2 gap-y-0 flex-wrap">
            <div class="grow-[3] bg-white">1
            </div>
            <div class="grow bg-white ">
                @foreach ($users as $user)
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <img class="w-12 h-12 rounded-full" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold">{{ $user->name }}</h4>
                            </div>
                            <div class="ml-4 mt-2">
                                @php
                                    $connectionStatus = auth()->user()->connectionStatus($user->id);
                                @endphp
                                @if($connectionStatus == 'pending')
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-yellow-500 to-orange-500 group-hover:from-yellow-500 group-hover:to-orange-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-yellow-200 dark:focus:ring-yellow-800" disabled>
                                        <span class="relative px-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                                        Pending
                                        </span>
                                    </button>
                                @elseif($connectionStatus == 'accepted')
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-500 to-teal-500 group-hover:from-green-500 group-hover:to-teal-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800" disabled>
                                        <span class="relative px-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                                        Connected
                                        </span>
                                    </button>
                                @else
                                    <form action="{{ route('connections.send')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target_user_id" value="{{ $user->id }}">
                                        <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                                            <span class="relative px-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                                            + Connect
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    <div class="ml-auto">
                @endforeach
            </div>
            <div>
            </div>
        </div>
    </div>
    
   
     

</x-app-layout>