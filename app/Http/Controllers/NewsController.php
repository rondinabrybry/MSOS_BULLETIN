<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class NewsController extends Controller
{
    public function show(Post $post)
    {
        $post->loadCount('reactions'); // Adds a `reactions_count` property to the model.
        return view('posts.show', compact('post'));
    }
    

}
