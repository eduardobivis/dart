<?php

namespace App\Http\Services;

use App\Categoria;
use App\Indicacao;
use App\Produto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Exercicio1Service {

    public $mockJsonCategorias = '[
        {
            "id": 1,
            "name": "Romance",
            "name_en": "Novel",
            "slug": "rom",
            "slug_en": "nov",
            "active": "1"
        }
    ]';

    public $mockJsonIndicacoes = '[
        {
            "id": 1,
            "name": "Indicação 1",
            "name_en": "Recommendetion 1",
            "slug": "ind1",
            "slug_en": "rec1",
            "image": "https://www.gardendesign.com/pictures/images/675x529Max/site_3/helianthus-yellow-flower-pixabay_11863.jpg",
            "active": "1"
        }
    ]';

    public $mockJsonProdutos = '[
        {
            "categoria_id": "1",
            "indicacao_id": "1",
            "idioma": "en-US",
            "title": "Admirável Mundo Novl",
            "description": "Admirável Mundo Novo (Brave New World na versão original em língua inglesa) é um romance escrito por Aldous Huxley e publicado em 1932.",
            "description_en": "Brave New World is a dystopian social science fiction novel by English author Aldous Huxley, written in 1931 and published in 1932.",
            "details": "Escrito por Aldous Huxley e publicado em 1932.",
            "details_en": "Written by Aldous Huxley and published in 1932."
        }
    ]';

    public function registraJson() {

        //Trunca Tabelas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('produtos')->truncate();
        DB::table('categorias')->truncate();
        DB::table('indicacoes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  

        $categorias = json_decode($this->mockJsonCategorias, true);
        $indicacoes = json_decode($this->mockJsonIndicacoes, true);
        $produtos = json_decode($this->mockJsonProdutos, true);

        foreach($categorias as $categoria) {
            Categoria::create($categoria);            
        }

        foreach($indicacoes as $indicacao) {   

            $nomeArquivo = 
                substr(uniqid().md5('Y-m-d H:i:s'), 0, 50).'.'.
                pathinfo($indicacao['image'], PATHINFO_EXTENSION);

            if( 
                Storage::disk('local')->put(
                    $nomeArquivo, 
                    file_get_contents($indicacao['image'])
                )
            ) {
                $indicacao['image'] = $nomeArquivo;
            }

            Indicacao::create($indicacao); 

        }

        foreach($produtos as $produtos) {
            Produto::create($produtos);            
        }
    }

}