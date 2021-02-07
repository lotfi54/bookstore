<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'nationalite',
    ];

    public function livre()
    {
        return $this->belongsTo('App\Models\livres')->withTimestamps();
    }

}
