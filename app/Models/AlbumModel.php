<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumModel extends Model
{
    use HasFactory;
    protected $table = 'albums';
    protected $fillable = ['title', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function foto()
    {
        return $this->hasMany(FotoModel::class);
    }
}
