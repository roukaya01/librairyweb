<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emprunt extends Model
{
    //
    protected $table = 'emprunts';
    protected $fillable = [
        'numlivre',
        'numchambre',
        'nomcient',
        'date sortie',
        'date rendu'

    ];
}
