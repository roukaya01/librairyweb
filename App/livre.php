<?php

namespace App;
use media;
use Illuminate\Database\Eloquent\Model;

class livre extends Model
{
    protected $table = 'livres';
    protected $fillable = [
        'numero',
        'titre',
        'categorie',
        'resume',
        'image',
        'auteur',
        'date emission'

    ];
    public function media() {
        return$this->hasMany('App\media','livre_id', 'id');
    }

    }
