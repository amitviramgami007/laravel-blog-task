<?php

namespace App\Models;

use App\Models\Post;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'title',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
