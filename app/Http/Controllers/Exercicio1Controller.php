<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Exercicio1Service;

class Exercicio1Controller extends Controller
{

    private $service;

    public function __construct(Exercicio1Service $service){
        $this->service = $service;
    }
    
    public function exercicio1(){
        $this->service->registraJson();
    }

}
