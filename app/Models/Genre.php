<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
    ];

    public function livre()
    {
        return $this->belongsToMany('App\Model\Livres')->withTimestamps();
    }
}