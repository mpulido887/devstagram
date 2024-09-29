@extends('layouts.app')

@section('titulo')

    Inicia Sesión en DevStagram

 @endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center p-5">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Login">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if(session('mensaje'))
                    <p class="text-red-500 text-sm mt-2">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div class="mb-5">
                    <label  class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">Email</label>
                    <input type="email"
                           id="email"
                           name="email" 
                           placeholder="Ingresa Tu email" 
                           class="border border-gray-400 p-2 w-full @error('email') border-red-500 
                           @enderror"
                           value="{{ old('email') }}"  
                    />
                    @error('email')

                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        
                    @enderror
                </div>

                <div class="mb-5">
                    <label  class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password" 
                           placeholder="Ingresa Tu password" 
                           class="border border-gray-400 p-2 w-full @error('password') border-red-500 
                           @enderror"
                           value="{{ old('password') }}"  
                    />
                    @error('password')

                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    <label class="text-gray-500 text-xs" for="remember">Mantener mi sesión iniciada</label>
                </div>

                <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>  
        </div>
    </div>
@endsection  
        