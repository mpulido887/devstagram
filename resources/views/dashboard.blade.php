@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5 my-4 mx-auto">
                <img 
                    src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg')}}" 
                    alt="Imagen de Perfil" 
                    class="rounded-lg"
                >
            </div>
            
            <div class="md:w-8/12 lg:w-6/12 px5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-0">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                
                <div class="flex items-center gap-4">
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 text-sm mt-3 hover:text-gray-600">Editar Perfil</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            
                        @endif
                    @endauth
                </div>
                
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{$user->followers->count()}}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count()) </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    <span class="font-normal"> Siguiendo </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->posts->count() }}
                    <span class="font-normal">Posts </span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user())) 
                            
                            <form action="{{ route('users.follow', $user )}}" method="POST">
                                @csrf
                                <input 
                                type="submit" 
                                value="SEGUIR" 
                                class="bg-blue-600 text-white rounded-lg px-3 py-1  text-xs font-bold cursor-pointer">
                            </form>

                        @else

                            <form action="{{ route('users.unfollow', $user )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input 
                                type="submit" 
                                value="DEJAR DE SEGUIR" 
                                class="bg-red-600 text-white rounded-lg px-3 py-1  text-xs font-bold cursor-pointer">
                            </form>

                        @endif
                    @endif
                @endauth


            </div>

        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center my-10">Publicaciones</h2>
    
        @if ($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}"> 
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>
    
        <div class="mt-6">
            {{ $posts->links() }} <!-- Mostrando los enlaces de paginación -->
        </div>
    
        @else
            <p class="text-center text-2xl text-gray-600 my-10">No hay publicaciones aún</p>
        @endif
    </section>
    

@endsection