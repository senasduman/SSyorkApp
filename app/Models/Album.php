<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Album extends Model
{
    use HasFactory;
    protected $fillable = [

        'title',
        'cover_image',
        'description',
        'user_id',
        'is_public',
    ];

    // Albümün sahibi olan kullanıcı (sanatçı)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Albüme ait şarkılar
    public function songs()
    {
        return $this->hasMany(Song::class);
    }



}
