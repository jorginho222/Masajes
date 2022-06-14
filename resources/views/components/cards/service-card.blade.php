<div class="max-w-lg overflow-hidden">
    <img class="w-full rounded-lg" src="{{ asset($service->image->path) }}" alt="Imagen servicio">
    <div class="mt-4">
        <div class="px-6 py-4 border-2 border-dotted border-indigo-400 rounded-lg">
            <div class="font-bold text-indigo-700">
                @if($service->isMostSold($service->id))
                    <div class="bg-yellow-200">

                        <p class="ml-2 mb-1 text-md text-orange-400 text-center uppercase">★ Más elegido</p>
                    </div>
                @endif
                <p class="text-xl">
                    {{ $service->title }}
                </p>  
            </div>
            <div class="mt-2 border-b border-indigo-300"></div>
            <p class="my-2 text-gray-600 text-base">
                {{ $service->description }}
            </p>
            <p class="mt-3 font-bold text-xl text-orange-400">${{ $service->price }}</p>  
        </div>
    </div>
</div>


    

