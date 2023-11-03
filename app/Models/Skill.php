<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'slug', 'image'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function isImageAValidUrl(){
        return filter_var($this->image, FILTER_VALIDATE_URL);
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }

}
