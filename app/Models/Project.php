<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = array('title', 'description', 'slug', 'image', 'is_visible', 'category_id');

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isImageAValidUrl(){
        return filter_var($this->image, FILTER_VALIDATE_URL);
    }

    public function getRouteName() {
        return Route::currentRouteName();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
