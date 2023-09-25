<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bio',
        'user_image',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
