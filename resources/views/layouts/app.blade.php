<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
			.carousel-open:checked + .carousel-item {
				position: static;
				opacity: 100;
			}
			.carousel-item {
				-webkit-transition: opacity 0.6s ease-out;
				transition: opacity 0.6s ease-out;
			}
			#carousel-1:checked ~ .control-1,
			#carousel-2:checked ~ .control-2,
			#carousel-3:checked ~ .control-3 {
				display: block;
			}
			.carousel-indicators {
				list-style: none;
				margin: 0;
				padding: 0;
				position: absolute;
				bottom: 2%;
				left: 0;
				right: 0;
				text-align: center;
				z-index: 10;
			}
			#carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
			#carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
			#carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
				color: #2b6cb0;  /*Set to match the Tailwind colour you want the active one to be */
			}
		</style>
        
    </head>
    <body class="font-sans antialiased">
        
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                {{-- <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div> --}}
            </header>

            <!-- Page Content -->
            <main>
                {{-- {{ $slot }} --}}

                <div class="container mx-auto">
                
                    @if (session()->has('success'))   
                        <div class="mt-2 w-96 bg-green-500 text-white font-medium px-4 py-2 rounded-lg">
                            {{ session()->get('success') }}
                        </div>
                    @endif
    
                    @if(isset($errors) && $errors->any())    
                        <div class="mt-2 w-96 bg-red-600 text-white font-medium px-4 py-2 rounded-lg">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                    
                @yield('content')
            </main>
        </div>
        
        @yield('scripts')
    </body>

    <footer>
        <div class="h-24 py-2 bg-orange-300">
            <div class="container mx-auto">
                {{-- <div class="flex"></div> --}}
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}">
                            <x-application-logo class="block " />
                        </a>
                        <p class="ml-3 text-white text-lg font-medium">v1.0 Desarrollado por Ivan Larrañaga © {{ now()->format('Y') }}</p>
                    </div>
                    <p class="ml-2 text-white text-lg font-medium">Morón, Buenos Aires, Argentina</p>
                </div>
            </div>
        </div>
    </footer>
</html>
