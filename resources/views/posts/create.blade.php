@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush

@section('titulo')
    Crea un nuevo Post
@endsection

@section('contenido')   
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">
                Imagen
            </label>
            <form id="dropzone" 
                  class="dropzone border p-3 w-full rounded flex flex-col justify-center items-center" 
                  action="{{ route('images.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input id="title" name="title" type="text" placeholder="Titulo del post" class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea id="description" name="description" placeholder="Descripción del post" class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror   
                </div>

                <div class="mb-5">
                    <input name="image" type="hidden" value="{{ old('image') }}"
                    />
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror  
                </div>

                <div class="mb-5">
                    <input type="submit" value="Crear Post" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </div>
            </form>
        </div>
    </div>
@endSection