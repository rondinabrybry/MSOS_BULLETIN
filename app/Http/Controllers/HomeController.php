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
    
        $postsGroupedByCategory = Post::whereNotNull('category')
            ->latest()
            ->orderBy('category')
            ->get()
            ->groupBy('category');
    
        return view('dashboard', compact('posts', 'postsGroupedByCategory'));
    }
    
    public function viewMore()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('view_more', compact('posts'));
    }

    public function showPosts()
    {
        $postsGroupedByCategory = Post::whereNotNull('category')
            ->orderBy('category')
            ->get()
            ->groupBy('category');

        return view('dashboard', compact('postsGroupedByCategory'));
    }
}
