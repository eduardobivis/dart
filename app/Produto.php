<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'name', 
        'categoria_id', 
        'indicacao_id',
        'idioma', 
        'title', 
        'description', 
        'description_en', 
        'details', 
        'details_en',
    ];

    public function categoria() {
        return $this->belongsTo('App\Categoria')->withDefault();
    }

    public function indicacao() {
        return $this->belongsTo('App\Indicacao')->withDefault();
    }
}
