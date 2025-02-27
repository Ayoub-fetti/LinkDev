<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{'linkdev'}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

  
   
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
                <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
            </main>
        </div>

        <!-- Livewire Scripts -->
        @livewireScripts

        <script>
            function updateSelectedSkills() {
                let select = document.getElementById('skills');
                let selectedSkillsContainer = document.getElementById('selectedSkills');
                
                // Efface l'affichage précédent
                selectedSkillsContainer.innerHTML = '';
                
                // Ajoute les compétences sélectionnées sous forme de badges
                for (let option of select.selectedOptions) {
                    let skillBadge = document.createElement('span');
                    skillBadge.textContent = option.text;
                    skillBadge.classList.add('px-2', 'py-1', 'bg-blue-500', 'text-white', 'rounded-lg', 'text-sm');
                    selectedSkillsContainer.appendChild(skillBadge);
                }
            }
        
            // Initialiser l'affichage des compétences sélectionnées lors du chargement de la page
            document.addEventListener('DOMContentLoaded', function() {
                updateSelectedSkills();
            });
        </script>
    </body>
</html>
