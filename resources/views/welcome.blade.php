<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Control Escolar</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        /* Full-screen layout */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .full-screen {
            height: calc(100vh - 56px); /* Account for header height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .carousel-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1A202C; /* Dark background */
        }
        .info-container {
            padding: 2rem;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .info-container {
                padding: 1rem;
            }
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-3.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="#" class="flex items-center">
                    <svg class="h-8 w-8 text-red-500 mx-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                      </svg>
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Control Escolar</span>
                </a>
                <div class="flex items-center lg:order-2">
                    @auth
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 dark:text-white hover:bg-gray-50 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                            Iniciar Sesión
                        </a>
                    @endauth
                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 text-gray-500 lg:hidden dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    @auth
                        <div class="">
                            @if (Auth::user()->role === 'Administrador')
                                <a href="{{ url('/admin') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                    Dashboard Admin</a>
                                    <a href="{{ url('/home') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                        Home Admin</a>
                            @elseif (Auth::user()->role === 'Alumno')
                            <a href="{{ url('/alumno') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                Dashboard Alumno</a>
                                <a href="{{ url('/home') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                    Home Alumno</a>
                            @elseif (Auth::user()->role === 'Profesor')
                            <a href="{{ url('/profesor') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                Dashboard Profesor</a>
                                    <a href="{{ url('/home') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                        Home Profesor</a>
                            @else
                                <a href="{{ url('/dashboard') }}"  class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                    Dashboard
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('login') }}" class="bg-gray-200 text-gray-800 rounded-md px-4 py-2 transition hover:bg-gray-300 focus:outline-none">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gray-200 text-gray-800 rounded-md px-4 py-2 transition hover:bg-gray-300 focus:outline-none">Registro de Alumnos</a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        
        </nav>
    </header>

    <div class="full-screen">
        <div class="flex flex-col lg:flex-row h-full">
            <!-- Carousel Section -->
                <div class="carousel-container">
                    <div id="default-carousel" class="relative w-full h-full" data-carousel="slide">
                        <div class="relative h-full overflow-hidden rounded-lg">
                            <!-- Slide 1 -->
                        <div class="duration-700 ease-in-out" data-carousel-item>
                            <img src="https://i1.wp.com/jaenense.com/wp-content/uploads/2020/05/mejores-caificaciones.jpg?fit=712%2C350&ssl=1" class="absolute w-full h-full object-cover" alt="...">
                        </div>
                        <!-- Slide 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://image.freepik.com/foto-gratis/estudiante-haciendo-tarea_1098-21489.jpg" class="absolute w-full h-full object-cover" alt="...">
                        </div>
                        <!-- Slide 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://www.una.edu.pl/wp-content/uploads/2022/02/Que-es-mejor-estudiar-en-la-universidad-o-en-un-instituto-2048x1366.jpeg" class="absolute w-full h-full object-cover" alt="...">
                        </div>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50">
                            <svg class="w-4 h-4 text-white dark:text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-width="2" d="M5 1L1 5l4 4"/></svg>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50">
                            <svg class="w-4 h-4 text-white dark:text-gray-800" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-width="2" d="M1 1l4 4-4 4"/></svg>
                        </span>
                    </button>
                </div>
            </div>
            </div>

            <!-- Information Section -->
           <div class="info-container bg-gray-100 dark:bg-gray-900">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-md w-full flex flex-col justify-center text-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-blue mb-4">Sistema de Control Escolar</h1>
                    @auth
                        <div class="flex justify-center">
                            @if (Auth::user()->role === 'Administrador')
                                <a href="{{ url('/home') }}" class="w-full bg-[#FF2D20] text-white rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none">
                                    Home Admin
                                </a>
                            @elseif (Auth::user()->role === 'Alumno')
                                <a href="{{ url('/home') }}" class="w-full bg-[#FF2D20] text-white rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none">
                                    Home Alumno
                                </a>
                            @elseif (Auth::user()->role === 'Profesor')
                                <a href="{{ url('/home') }}" class="w-full bg-[#FF2D20] text-white rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none">
                                    Home Profesor
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="w-full bg-[#FF2D20] text-white rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none">
                                    Dashboard
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('login') }}" class="bg-gray-200 text-gray-800 rounded-md px-4 py-2 transition hover:bg-gray-300 focus:outline-none">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gray-200 text-gray-800 rounded-md px-4 py-2 transition hover:bg-gray-300 focus:outline-none">Registro de Alumnos</a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
