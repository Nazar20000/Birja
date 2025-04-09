<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'service_id'];

    // Определяем связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Определяем связь с услугой
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}