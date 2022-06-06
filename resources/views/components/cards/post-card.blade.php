<div class="max-w-lg overflow-hidden">
    <img class="w-full rounded-lg" src="{{ $post->image->path }}" width="200" >
    <div class="bg-gray-200">

        <div class="mt-4 px-6 py-4 border-dotted border-2 border-gray-300">
            <div class="font-bold text-xl text-indigo-700">
                {{ $post->title }}
            </div>
            <div class="mt-2 border-b border-gray-300"></div>
            <div class="mt-2 text-gray-700 text-base ">
                {{ $post->description }}                                        
            </div>
            <div class="hover:cursor-pointer mt-3" >
                <a href="{{ route('post', ['post' => $post->id]) }}" class="text-orange-400 text-lg">Leer mas...</a>
            </div>
            
            @include('components.about-post')
            
        </div> 
    </div>
</div>