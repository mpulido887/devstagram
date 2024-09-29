@extends('layouts.app')

@section('titulo')    
    {{ $post->titulo }}    
@endsection

@section('contenido')    
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <div class="flex flex-col items-center justify-center mb-4">
                <p class="text-lg text-gray-700 mb-2">Subida: {{ $post->created_at->diffForHumans() }}</p>
                <p class="text-lg font-bold text-gray-700">Por: {{ $post->user->username }}</p>
            </div>
            
            @if ($post->imagen)
                <div class="flex items-center justify-center">
                    <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->titulo }}">
                </div>
                <div class="p-3 flex items-center gap-4">
                    @auth
                        <livewire:like-post :post="$post"/>
                    @endauth
                </div>
            @endif
            <div class="text-lg text-gray-700 mt-4">
                {!! $post->descripcion !!}
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input 
                        type="submit" 
                        name="post_id" 
                        value="Eliminar esta Publicación"
                        class="bg-red-500 p-2 rounded-lg text-center mt-4 text-white w-full uppercase font-bold cursor-pointer"
                        />
                    </form>    
                @endif
            @endauth
            

        </div>

        <!-- comentarios -->
        <div class="md:w-1/2 bg-white shadow p-6">

            @auth
                <div class="shadow p-6  bg-white flex flex-col items-center justify-center mb-6" >
                    <p class="text-2xl text-center mb-4">
                        Agrega un Nuevo Comentario a esta publicación
                    </p>
                    @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg text-center mb-6 text-white w-full uppercase font-bold">
                        <p>{{ session('mensaje') }}</p>                    
                    </div>
                    @endif
                </div>
                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea
                            name="comentario"
                            id="comentario"
                            cols="30"
                            rows="5"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('comentario') border-red-500 @enderror"
                            placeholder="Agrega tu comentario..."
                        ></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input
                            type="submit"
                            value="Publicar Comentario"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                        />
                    </div>
                </form>
            @endauth
            
            <div class="flex flex-col items-center justify-center">

                @if ($post->comentarios->count())
                    <p class="text-2xl text-center mb-4">
                        Comentarios
                    </p>
                    @foreach ($post->comentarios as $comentario)
                        <div class="shadow bg-white p-6 mb-2 w-full">
                            <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold text-gray-700 text-sm">{{ $comentario->user->username }}</a>
                            <p class="text-sm text-gray-600">
                                {{ $comentario->comentario }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $comentario->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <div class="flex">
                        <p class="text-gray-700">
                            Este post no tiene comentarios aún
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection