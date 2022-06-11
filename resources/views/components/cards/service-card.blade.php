<div class="max-w-lg overflow-hidden">
    <img class="w-full rounded-lg" src="{{ asset($service->image->path) }}" alt="Imagen servicio">
    <div class="mt-4">
        <div class="px-6 py-4 border-2 border-dotted border-indigo-400 rounded-lg">
            <div class="font-bold text-xl text-indigo-700">{{ $service->title }}</div>
            <div class="mt-2 border-b border-indigo-300"></div>
            <p class="my-2 text-gray-600 text-base">
                {{ $service->description }}
            </p>
            <p class="mt-3 font-bold text-xl text-orange-400">${{ $service->price }}</p>  
        </div>
    </div>
</div>


    

