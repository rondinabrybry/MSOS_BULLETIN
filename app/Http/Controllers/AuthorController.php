<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->get();
    
        return view('author', compact('user', 'posts'));
    }
    
    
}
