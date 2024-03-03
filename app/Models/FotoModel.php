<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoModel extends Model
{
    use HasFactory;
    protected $table = 'fotos';
    protected $fillable = ['title', 'image', 'user_id', 'album_id', 'like', 'user_like'];
    protected $casts = ['user_like' => 'array'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function album()
    {
        return $this->belongsTo(AlbumModel::class);
    }
    public function comments()
    {
        return $this->hasMany(CommentModel::class);
    }
}
