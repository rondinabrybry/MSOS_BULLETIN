<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected $with = ['reactions']; // Always eager load reactions

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function hasReactionFrom($userId)
    {
        return $this->reactions->where('user_id', $userId)->count() > 0;
    }
}