<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PlatformTableSeeder extends Seeder {

    public function run()
    {
        DB::table('platforms')->delete();

        DB::table('platforms')->insert([
            array(
                "nome" => "PC"
            ),
            array(
                "nome" => "PS1"
            ),
            array(
                "nome" => "PS2"
            ),
            array(
                "nome" => "PS3"
            ),
            array(
                "nome" => "PS4"
            ),
            array(
                "nome" => "XBOX"
            ),
            array(
                "nome" => "XBOX 360"
            ),
            array(
                "nome" => "XBOX ONE"
            ),
            array(
                "nome" => "WII"
            ),
            array(
                "nome" => "WIIU"
            ),
            array(
                "nome" => "SWITCH"
            ),
            array(
                "nome" => "Outros"
            )
        ]);
    }

}