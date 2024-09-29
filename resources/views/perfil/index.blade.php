@extends('layouts.app')

@section('titulo')
    Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')    
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">

            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>

                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario" 
                        class="border w-full p-3 rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                    
                <div class="mb-5">  
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de Perfil
                    </label>

                    <input
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border w-full p-3 rounded-lg"
                        accept=".jpg, .jpeg, .png"
                    />
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Email"
                        class="border w-full p-3 rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"
                        disabled
                    />
                </div>
                <!-- Contraseña actual -->
                <div class="mb-5">  
                    <label for="password_actual" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña Actual
                    </label>
                    <input
                        id="password_actual"
                        name="password_actual"
                        type="password"
                        placeholder="Tu Contraseña Actual"
                        class="border w-full p-3 rounded-lg @error('password_actual') border-red-500 @enderror"
                    />
                    @error('password_actual')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón para mostrar/ocultar los campos de contraseña -->
                <div class="mb-5">
                    <button 
                        type="button" 
                        id="togglePasswordFields"
                        class="bg-gray-600 border text-blue-400 p-2 rounded-lg"
                    >
                        Modificar Contraseña
                    </button>
                </div>

                <!-- Campos de nueva contraseña, inicialmente ocultos -->
                <div id="passwordFields" style="display: none;">
                    <!-- Nueva contraseña -->
                    <div class="mb-5">  
                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Nueva Contraseña
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Nueva Contraseña"
                            class="border w-full p-3 rounded-lg @error('password') border-red-500 @enderror"
                        />
                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar nueva contraseña -->
                    <div class="mb-5">  
                        <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                            Confirmar Nueva Contraseña
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Confirma la Nueva Contraseña"
                            class="border w-full p-3 rounded-lg"
                        />
                    </div>
                </div>

                <div class="mb-5">  
                    <input type="submit" value="Actualizar Perfil" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </div>  
            </form>

            <script>
                document.getElementById('togglePasswordFields').addEventListener('click', function() {
                    var passwordFields = document.getElementById('passwordFields');
                    if (passwordFields.style.display === 'none') {
                        passwordFields.style.display = 'block';
                    } else {
                        passwordFields.style.display = 'none';
                    }
                });
            </script>
        </div>

    </div>
@endsection



