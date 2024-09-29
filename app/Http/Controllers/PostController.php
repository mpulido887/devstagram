<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct(){
        //permite que solo los usuarios autenticados
        $this->middleware('auth')->except('index', 'show');
    }

    function index(User $user) {

        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() { 
        return view('posts.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required']
        ]);
        
        //crear el post en la base de datos
        Post::create([
            'titulo' => $request->title,
            'descripcion' => $request->description,
            'imagen' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        //redireccionar al index
        return redirect()->route('posts.index', auth()->user()->username);      
        
    } 

    public function show(User $user, Post $post) {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post) {

        $this->authorize('delete', $post);

        //Eliminar post
        $post->delete();

        //Eliminar imagen
        $image_path = public_path('uploads/' . $post->imagen);

        if(File::exists($image_path)){
            unlink($image_path);
        }   


        return redirect()->route('posts.index', auth()->user()->username)->with('mensaje', 'Post eliminado correctamente');

    }

        
}
