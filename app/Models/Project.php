<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = array('title', 'description', 'slug', 'image');

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isImageAValidUrl(){
        return filter_var($this->image, FILTER_VALIDATE_URL);
    }
}
