<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'authors', 'description', 'published', 'ready'];
    protected $casts = [
        'ready' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['id', 'received_at', 'return_at', 'note']);
    }
}
