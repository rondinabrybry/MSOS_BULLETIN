<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->take(6)->get();
    
        return view('dashboard', compact('posts'));
    }
    public function viewMore()
    {
        $posts = Post::with('user')->latest()->paginate(10); // Display 10 posts per page

        return view('view_more', compact('posts'));
    }
}
