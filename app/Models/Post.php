<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class); // Post belongs to a user
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
