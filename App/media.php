<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class media extends Model
{
    //
    protected $table = 'medias';
    protected $fillable = [
        'livre_id',
        'link',
    ];
  /* public function livre() {
        return$this->belongsTo('App\media', 'id', 'livre_id');
    }  */
}
