<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produto;

class Categoria extends Model
{
    protected $fillable = [
        'name', 
        'name_en', 
        'slug',
        'slug_en', 
        'active',
    ];

    public function produtos() {
        return $this->hasMany(Produto::class);
    }
}
