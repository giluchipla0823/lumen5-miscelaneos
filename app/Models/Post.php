<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
      'category_id',
      'title',
      'body',
      'active'
    ];


    public function category(){
        return $this->belongsTo(Post::class);
    }
}
