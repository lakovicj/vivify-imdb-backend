<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'name' => 'action'
        ]);

        Genre::create([
            'name' => 'crime'
        ]);

        Genre::create([
            'name' => 'drama'
        ]);

        Genre::create([
            'name' => 'comedy'
        ]);

        Genre::create([
            'name' => 'sci-fi'
        ]);

        Genre::create([
            'name' => 'horror'
        ]);
    }
}
