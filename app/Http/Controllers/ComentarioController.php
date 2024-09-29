<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function store(Request $request, User $user, Post $post)
    {
        //validar el formulario de los comentarios
        $this->validate($request, [
            'comentario' => ['required', 'max:255', 'string']
        ]);

        //crear el comentario en la base de datos
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //redireccionar al index
        // return redirect()->route('posts.show', [
        //     'user' => $user,
        //     'post' => $post
        // ]);

        return back()->with('mensaje', 'Comentario agregado correctamente');
    }
}
