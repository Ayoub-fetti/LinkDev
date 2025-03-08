
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Talk - Connect and Chat</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
            </style>
        @endif
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div class="w-full max-w-5xl px-6">
                <header class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo_linkdev.png') }}" alt="Talk Logo" class="h-16 w-auto">
                    </div>
                    
                    @if (Route::has('login'))
                        <nav class="flex gap-4">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-semibold transition"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-semibold transition"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="px-5 py-3 border border-blue-600 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg font-semibold transition dark:text-blue-400 dark:border-blue-400"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="py-16">
                    <div class="flex flex-col md:flex-row items-center gap-12">
                        <div class="w-full md:w-1/2">
                            <h2 class="text-5xl font-bold text-gray-900 dark:text-white">Connect with friends and colleagues</h2>
                            <p class="mt-6 text-xl text-gray-600 dark:text-gray-300">
                                Talk is a modern chat application that helps you stay connected with the people who matter most. Share messages, files, and build meaningful connections.
                            </p>
                            <div class="mt-10 flex gap-4">
                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-semibold text-lg transition"
                                    >
                                        Get Started
                                    </a>
                                @endif
                                <a
                                    href="#features"
                                    class="px-8 py-4 border border-gray-300 hover:border-gray-400 dark:border-gray-700 dark:hover:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 font-semibold text-lg transition"
                                >
                                    Learn More
                                </a>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 flex justify-center">
                        </div>
                    </div>
                    
                    <div id="features" class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm">
                            <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-6">
                                <i class="fas fa-comments text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Connect, Collaborate, and Grow with Talk</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-300">
                                {{-- Send and receive messages instantly with our real-time chat platform. --}}
                                Talk is the ultimate social platform designed exclusively for developers. Whether you're a beginner learning to code or a seasoned engineer building cutting-edge solutions, Talk provides a space to share ideas, showcase projects, and connect with like-minded professionals. Join a global community where developers support each other, exchange knowledge, and stay updated with the latest tech trends.


                            </p>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm">
                            <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-6">
                                <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Showcase Your Work and Build Your Network</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-300">
                                {{-- Create groups to connect with multiple people at once for better team communication. --}}
                                On Talk, your profile is more than just a resume—it's a portfolio of your work. Share your open-source contributions, personal projects, and coding achievements to gain visibility in the tech community. Engage in discussions, receive feedback, and collaborate on real-world projects. From code snippets to in-depth articles, Talk helps you establish your presence as a developer.


                            </p>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm">
                            <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-6">
                                <i class="fas fa-globe-americas text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Stay Inspired and Advance Your Career</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-300">
                                Discover career opportunities, follow industry leaders, and stay ahead in the fast-evolving world of technology. With personalized feeds, job listings, and networking features, Talk empowers developers to grow both personally and professionally. Whether you’re looking for mentorship, hiring talent, or just want to share your thoughts on the latest tech trends, Talk is the place to be.
                            </p>
                        </div>
                    </div>
                </main>

                <footer class="py-8 border-t border-gray-200 dark:border-gray-800">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center">
                            <img src="{{ asset('images/logo_linkdev.png') }}" alt="Talk Logo" class="h-8 w-auto">
                            <span class="ml-2 text-gray-600 dark:text-gray-400">© {{ date('Y') }} Talk. All rights reserved.</span>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <ul class="flex space-x-6">
                                <li><a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Privacy</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Terms</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>