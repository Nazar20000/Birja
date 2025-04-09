<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Если images — это JSON:
    protected $casts = [
        'images' => 'array',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByCurrentUser()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', ' ') . ' ₽';
    }
}