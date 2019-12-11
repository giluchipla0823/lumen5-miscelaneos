<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    public $resource = CategoryResource::class;

    protected $fillable = [
        'name',
        'active'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
