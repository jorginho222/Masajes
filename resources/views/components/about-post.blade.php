<div class="mt-6 flex">
    <img 
    src="{{ asset($post->user->profile_image ) }}" 
    alt="Avatar"
    class="rounded-full"
    width="40"
    height="40"
    >
    <div class="mt-1 ml-2">
        <p class="text-md font-medium">{{ $post->user->name }} · {{$post->created_at->format('d/m/y')}} · {{ $post->quantity }} {{ $post->quantity == 1  ? 'comentario' : 'comentarios'}} {{ ($post->created_at != $post->updated_at) ? '· (editado)' : '' }} </p>
    </div>
</div>  