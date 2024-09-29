<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }   

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Validar el username y la imagen
        $request->request->add(['username' => Str::slug($request->username)]);
    
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:5', 'max:20'],
            'password_actual' => ['required_with:password', 'current_password'], // Valida si se proporciona la contraseña actual
            'password' => ['nullable', 'confirmed', 'min:8'], // Valida la nueva contraseña solo si es proporcionada
        ]);
    
        // Procesar la imagen si se sube una nueva
        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
    
        // Actualizar el usuario
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
    
        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }
    
        $usuario->save();
    
        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
    
}
