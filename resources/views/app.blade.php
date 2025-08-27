<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>LXMAN</title>
        <title inertia>{{ config('app.name', 'LXMAN') }}</title>

        <!-- Funtên Profesyonel (Inter) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

        <!-- Dîzayna Skrolbarê -->
        <style>
            /* Ji bo Chrome, Edge, Safari */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #111827; /* Rengê paşxana tarî */
            }

            ::-webkit-scrollbar-thumb {
                background: #4b5563; /* Rengê skrolbarê */
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #facc15; /* Rengê zêrîn dema hover */
            }
        </style>
        
        <!-- Skrîptên Serekî -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-inter bg-gray-900 text-gray-200 antialiased">
        @inertia
    </body>
</html>