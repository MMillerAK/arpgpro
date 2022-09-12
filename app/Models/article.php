<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class article extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'user_id',
        'author',
        'title',
        'text',
    ];

    public function user()
    {
        return $this->belongsto(User::Class,'user_id');
    }
}
