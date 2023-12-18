<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'foreign_key');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
