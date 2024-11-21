<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
            // Process cover photo
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
    
            // Process editor content
            $content = $request->content;
            $content = $this->processEditorImages($content);
    
            // Save the post
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
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'cover_photo' => 'nullable|image|max:2048', // Make cover photo optional for update
        ]);

        // Process cover photo if provided
        $coverPhotoPath = $post->cover_photo; // Keep the existing cover photo if not updated
        if ($request->hasFile('cover_photo')) {
            $coverPhoto = $request->file('cover_photo');
            $destinationPath = public_path('storage/cover_photos');

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Delete old cover photo if exists
            if ($coverPhotoPath && file_exists(public_path('storage/' . $coverPhotoPath))) {
                unlink(public_path('storage/' . $coverPhotoPath));
            }

            // Save the new cover photo
            $fileName = uniqid() . '_' . $coverPhoto->getClientOriginalName();
            $coverPhoto->move($destinationPath, $fileName);
            $coverPhotoPath = 'cover_photos/' . $fileName;
        }

        // Process editor content
        $content = $request->content;
        $content = $this->processEditorImages($content); // Reprocess any embedded images if needed

        // Update the post with the new data
        $post->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $content,
            'cover_photo' => $coverPhotoPath,
        ]);

        // Return a success response
        return response()->json(['message' => 'Post updated successfully']);
    } catch (\Exception $e) {
        // Handle any errors
        return response()->json(['error' => $e->getMessage()], 500);
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
    
            // Check if image is base64-encoded
            if (strpos($src, 'data:image') === 0) {
                $fileName = uniqid() . '.png'; // Adjust extension based on content type
                $path = public_path('storage/editor_images/' . $fileName);
    
                // Create directory if not exists
                if (!file_exists(dirname($path))) {
                    mkdir(dirname($path), 0755, true);
                }
    
                // Decode base64 and save image
                list(, $base64Data) = explode(',', $src);
                file_put_contents($path, base64_decode($base64Data));
    
                // Update the src attribute in the DOM
                $img->setAttribute('src', asset('storage/editor_images/' . $fileName));
            }
        }
    
        return $dom->saveHTML();
    }
    

    public function show(Post $post)
    {
        return view( 'article', compact('post'));
    }

}
