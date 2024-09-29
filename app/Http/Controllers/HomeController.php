<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function __invoke()
    {
        //obtener a los que seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(4);


        return view('home', [
            'posts' => $posts
        ]);
    }
}
