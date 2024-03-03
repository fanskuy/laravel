<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['user_id', 'foto_id', 'content'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function foto()
    {
        return $this->belongsTo(FotoModel::class);
    }
    public function comments()
    {
        return $this->hasMany(CommentModel::class);
    }
}
