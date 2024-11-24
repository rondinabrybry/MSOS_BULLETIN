<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('dashboard', compact('posts'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string',
                'content' => 'required|string',
                'cover_photo' => 'required|image|max:2048',
            ]);
    
            $coverPhotoPath = null;
            if ($request->hasFile('cover_photo')) {
                $coverPhoto = $request->file('cover_photo');
                $destinationPath = public_path('storage/cover_photos');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                $fileName = uniqid() . '_' . $coverPhoto->getClientOriginalName();
                $coverPhoto->move($destinationPath, $fileName);
                $coverPhotoPath = 'cover_photos/' . $fileName;
            }
    
            $content = $request->content;
            $content = $this->processEditorImages($content);
    
            Post::create([
                'title' => $request->title,
                'category' => $request->category,
                'content' => $content,
                'cover_photo' => $coverPhotoPath,
                'user_id' => auth()->id(),
            ]);
    
            return response()->json(['message' => 'Post created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Post $post)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'cover_photo' => 'nullable|image|max:2048',
        ]);

        $coverPhotoPath = $post->cover_photo;
        if ($request->hasFile('cover_photo')) {
            $coverPhoto = $request->file('cover_photo');
            $destinationPath = public_path('storage/cover_photos');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($coverPhotoPath && file_exists(public_path('storage/' . $coverPhotoPath))) {
                unlink(public_path('storage/' . $coverPhotoPath));
            }

            $fileName = uniqid() . '_' . $coverPhoto->getClientOriginalName();
            $coverPhoto->move($destinationPath, $fileName);
            $coverPhotoPath = 'cover_photos/' . $fileName;
        }

        $content = $request->content;
        $content = $this->processEditorImages($content);
        
        $post->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $content,
            'cover_photo' => $coverPhotoPath,
        ]);

        return response()->json(['message' => 'Post updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function destroy(Post $post)
{
    if (auth()->user()->usertype !== 'super') {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized action.'
        ], 403);
    }

    try {
        if ($post->cover_photo) {
            Storage::delete('public/' . $post->cover_photo);
        }

        // Delete the post
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.',
            'redirect' => route('dashboard')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting post: ' . $e->getMessage()
        ], 500);
    }
}
    
    /**
     * Handle embedded images in the editor content.
     */
    private function processEditorImages($content)
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
    
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
    
            if (strpos($src, 'data:image') === 0) {
                $fileName = uniqid() . '.png';
                $path = public_path('storage/editor_images/' . $fileName);
    
                if (!file_exists(dirname($path))) {
                    mkdir(dirname($path), 0755, true);
                }
    
                list(, $base64Data) = explode(',', $src);
                file_put_contents($path, base64_decode($base64Data));
    
                $img->setAttribute('src', asset('storage/editor_images/' . $fileName));
            }
        }
    
        return $dom->saveHTML();
    }
    

    public function show(Post $post)
    {
        return view( 'article', compact('post'));
    }

     public function toggleReaction(Post $post)
    {
        $user = auth()->user();
        $hasReacted = $post->reactions()->where('user_id', $user->id)->exists();
        
        if ($hasReacted) {
            $post->reactions()->where('user_id', $user->id)->delete();
            $message = 'Reaction removed';
        } else {
            $post->reactions()->create(['user_id' => $user->id]);
            $message = 'Reaction added';
        }
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'reactionCount' => $post->reactions()->count(),
            'hasReacted' => !$hasReacted
        ]);
    }
}
