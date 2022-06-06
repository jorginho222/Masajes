<div class="relative h-screen">
    <img src="{{asset('img/registration.jpg')}}" alt="">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"> 
        <div class="w-96 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
