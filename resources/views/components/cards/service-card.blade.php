<div class="max-w-lg overflow-hidden">
    <img class="w-full rounded-lg" src="{{ asset($service->image->path) }}" alt="Imagen servicio">
    <div class="mt-4">
        <div class="px-6 py-4 border-2 border-dotted border-indigo-400 rounded-lg">
            <div class="font-bold text-xl text-indigo-700">{{ $service->title }}</div>
            <div class="mt-2 border-b border-indigo-300"></div>
            <div class="mt-2 font-bold text-xl text-orange-400">${{ $service->price }}</div>  
            <p class="mt-2 font-bold">
                Descripción:
                <p class=" text-gray-700 text-base">
                    {{ $service->description }}
                </p>
            </p>
        </div>
    </div>
</div>


    

