<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ShareController extends Controller
{
    public function generateShortUrl(Request $request)
    {
        $request->validate([
            'post_id' => 'required|numeric'
        ]);

        // Check if a short URL already exists for this post
        $existingUrl = DB::table('short_urls')
            ->where('post_id', $request->post_id)
            ->first();

        if ($existingUrl) {
            return response()->json([
                'shortUrl' => "m.sos/{$existingUrl->code}"
            ]);
        }

        // Generate new short URL if none exists
        $shortCode = Str::random(6);
        
        DB::table('short_urls')->insert([
            'code' => $shortCode,
            'post_id' => $request->post_id,
            'created_at' => now(),
        ]);
        
        return response()->json([
            'shortUrl' => "m.sos/{$shortCode}"
        ]);
    }

    public function redirectToPost($code)
    {
        $urlMapping = DB::table('short_urls')->where('code', $code)->first();
        
        if ($urlMapping) {
            return redirect("/posts/{$urlMapping->post_id}");
        }
        
        abort(404);
    }
}