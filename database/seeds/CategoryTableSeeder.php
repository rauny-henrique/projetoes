<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\DB;
use Laracasts\TestDummy\Factory as TestDummy;

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            array(
                "nome" => "Ação"
            ),
            array(
                "nome" => "Aventura"
            ),
            array(
                "nome" => "Arcade"
            ),
            array(
                "nome" => "Estratégia"
            ),
            array(
                "nome" => "RPG"
            ),
            array(
                "nome" => "Esporte"
            ),
            array(
                "nome" => "FPS"
            ),
            array(
                "nome" => "Corrida"
            ),
            array(
                "nome" => "On-line"
            ),
            array(
                "nome" => "Simulação"
            ),
            array(
                "nome" => "Outros"
            )
        ]);
    }

}