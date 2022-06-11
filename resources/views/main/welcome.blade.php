@extends('layouts.app')

@section('content')  
    
    <div class="py-20">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row items-center ">
                
                    <img class="rounded-full" src="{{ asset('img/portada2.jpg') }}" width="500" alt="">
                    
                    <div class="mt-6 lg:ml-20 ">  
                        <div class="flex justify-center">
                            <img src="{{ asset('img/logo_indigo.png') }}" width="70" alt="logo">
                            <h2 class="ml-4 mt-3 text-3xl text-indigo-400 font-medium text-center tracking-wider ">Somos Aurora Masajes & Spa!</h2>
                        </div>
                        <div class="mt-4 py-3 px-4 border border-gray-300 rounded-lg bg-gray-200">
                            <p class="leading-loose text-lg text-center font-medium text-indigo-800">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius leo justo. Sed scelerisque sit amet dolor non auctor. Nulla eu justo id mi placerat ullamcorper. Duis ut tincidunt libero. Ut maximus dictum libero, quis mattis sem. Vivamus eu luctus leo. Sed a massa eu orci sagittis tempor eu nec nulla. Nam viverra commodo urna, ac gravida quam placerat quis. Duis semper dapibus arcu. Nullam a lacus eget risus commodo finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla ut lorem ipsum. Nulla quis volutpat risus. Nulla hendrerit dui at condimentum commodo. Curabitur nec hendrerit nunc.
                            </p>
                        </div>
                        <div id="mira" class="mt-10 flex justify-evenly">
                            <a  class="bg-orange-300 inline-flex items-center px-4 pt-2 pb-3 rounded-full text-lg font-medium leading-5 text-white hover:bg-yellow-400 hover:text-gray-100 focus:outline-none transition duration-150 ease-in-out" href="{{route('bookings.index')}}">Sacá tu turno!</a>
                            <a  class="bg-indigo-400 inline-flex items-center px-4 pt-2 pb-3 rounded-full text-lg font-medium leading-5 text-white" href="#servicios">Mirá nuestros servicios</a>
                            {{-- <script>
                                document.getElementById("servicios").scrollIntoView({
                                    behavior: 'smooth'
                                });
                            </script> --}}
                        </div>
                    </div>
            </div> 
        </div>

    </div>
    <div class="bg-orange-300 py-10">
        <h2 class="text-4xl tracking-wider text-center text-white">¿Qué ofrecemos? 🏨</h2>
    </div>

    <div class="container mx-auto h-screen lg:h-auto">
        <div class="my-10">

            <div class="carousel relative">
                <div class="carousel-inner relative overflow-hidden w-full">
                  <!--Slide 1-->
                    <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
                    <div class="carousel-item absolute opacity-0" style="height:70vh;">
                        <div class="py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
    
                            <div class="h-screen md:h-auto max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/1.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">Masajes descontracturantes</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                
                                </div>
                            </div>
                    
                            <div class="sm:hidden md:block visible max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/2.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">Masajes relajantes</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                                    
                                </div>
                            </div>
                    
                            <div class="sm:hidden md:block max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/3.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">Masajes deportivos</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                    <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
                    
                    <!--Slide 2-->
                    <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
                    <div class="carousel-item absolute opacity-0" style="height:70vh;">
                        <div class="py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
    
                            <div class="h-screen md:h-auto max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/6.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">Spa (Medio dia o dia completo)</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                
                                </div>
                            </div>
                    
                            <div class="sm:hidden md:block visible max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/5.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">Ambiente climatizado</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                                    
                                </div>
                            </div>
                    
                            <div class="sm:hidden md:block max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/3.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">Cursos</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                    <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label> 
                    
                    <!--Slide 3-->
                    <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
                    <div class="carousel-item absolute opacity-0" style="height:70vh;">
                        <div class="py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
    
                            <div class="h-screen md:h-auto max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/4.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                
                                </div>
                            </div>
                    
                            <div class="sm:hidden md:block visible max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/2.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                                    
                                </div>
                            </div>
                    
                            <div class="sm:hidden md:block visible max-w-lg rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{ asset('img/services/6.jpg') }}" width="600" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                  <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                                  <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                  </p>
                                </div>
                                <div class="" >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                    <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

                    <!-- Add additional indicators for each slide-->
                    <ol class="carousel-indicators">
                        <li class="inline-block mr-3">
                            <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                        </li>
                        <li class="inline-block mr-3">
                            <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                        </li>
                        <li class="inline-block mr-3">
                            <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                        </li>
                    </ol>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div id="servicios" class="bg-orange-300 py-10">
        <h2 class="text-4xl tracking-wider text-center text-white">Nuestros servicios 🥇</h2>
    </div>

    <div class="container mx-auto">

        <div class="mt-6 mb-10">
            <h1 class="text-center text-3xl text-indigo-500 font-medium tracking-wider">Masajes & Spa</h1>
        </div>

        <div class="my-10 grid grid-cols-3 gap-6">
            @if(isset($services[0]))
    
                @foreach ($services as $service)
                @include('components.cards.service-card')
                @endforeach
    
            @endif
        </div>

    </div>

    <div class="bg-orange-300 py-10">
        <h2 class="text-4xl tracking-wider text-center text-white">Nuestro equipo 👨‍⚕️👩‍⚕️</h2>
    </div>

    <div class="py-10 container mx-auto">
        <div class="py-10 grid grid-cols-5 gap-6">
            <div>
                <img class="rounded-full" src="{{ asset('img/team/1.jpg') }}" alt="">
                <div class="font-bold text-center text-xl mt-4">Gachi</div>
            </div>
            <div>
                <img class="rounded-full" src="{{ asset('img/team/2.jpg') }}" alt="">
                <div class="font-bold text-center text-xl mt-4">Pachi</div>
            </div>
            <div>
                <img class="rounded-full" src="{{ asset('img/team/3.jpg') }}" alt="">
                <div class="font-bold text-center text-xl mt-4">Laura</div>
            </div>
            <div>
                <img class="rounded-full" src="{{ asset('img/team/4.jpg') }}" alt="">
                <div class="font-bold text-center text-xl mt-4">Lorena</div>
            </div>
            <div>
                <img class="rounded-full" src="{{ asset('img/team/5.jpg') }}" alt="">
                <div class="font-bold text-center text-xl mt-4">El ex novio</div>
            </div>
        </div>
        
        <h3 class="text-3xl tracking-wider text-center font-medium text-indigo-600">Contamos con los mejores profesionales...</h3>
        <div class="flex justify-center ">
            
            <div class="mt-5 p-3 max-w-5xl border-2 border-dotted border-indigo-400 rounded-lg">
                <p class="text-gray-600 font-medium">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, quaerat, rem eum cum tenetur ratione 
                    repellendus nostrum ipsum quia expedita deserunt ab saepe commodi laboriosam officiis 
                    velit veritatis incidunt eos! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus consequatur 
                    eius vero odit itaque ullam quaerat perferendis! Repellendus quia aspernatur earum. Qui consequatur 
                    dicta explicabo reprehenderit doloremque cumque ipsam. Odit!
                </p>
            </div>
        </div>
        
    </div>


    <div class="bg-orange-300 py-10">
        <h2 class="text-4xl tracking-wider text-center text-white">Novedades y blog ✒️📋</h2>
    </div>

    <div class="container mx-auto">
        <div class="mt-6 mb-10">
            <h1 class="text-center text-3xl text-indigo-500 font-medium tracking-wider">Mas recientes</h1>
        </div>
        <div class="grid grid-cols-3 gap-6 mb-10">

            @foreach ($onlyThreePosts as $post)
                @include('components.cards.post-card')
            @endforeach
        </div>

        <div class="pb-10 mt-10 flex justify-center">
            <x-app-link :href="route('blog')">
                Ver mas publicaciones
            </x-app-link>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function(){
            alert("jQuery Works")
        });
    </script> --}}

@endsection