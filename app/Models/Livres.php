<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livres extends Model
{
    use HasFactory;
    protected $fillable = [
        'auteur_id',
        'genre_id',
        'titre',
        'langue_livre',
        'isbn',
        'annee',
        'nbr_pages',
        'date_parution',
        'photo',
    ];

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre')->withTimestamps();
    }

    public function auteur()
    {
        return $this->hasMany('App\Models\Auteur')->withTimestamps();
    }
}
