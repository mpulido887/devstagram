<div>
    @if ($posts->count())

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}"> 
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }} <!-- Mostrando los enlaces de paginación -->
        </div>

    @else

        <p class="text-center text-2xl text-gray-600 my-10">No hay publicaciones aún, empieza a seguir a alguien</p>
        
    @endif
</div>