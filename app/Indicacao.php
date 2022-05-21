<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produto;

class Indicacao extends Model
{
    protected $table = "indicacoes";

    protected $fillable = [
        'name', 
        'name_en', 
        'slug',
        'slug_en', 
        'active', 
        'image',
    ];

    public function produtos() {
        return $this->hasMany(Produto::class);
    }
}
