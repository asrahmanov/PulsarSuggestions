<?php

namespace Database\Seeders;


use App\Models\Defect;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           SuggestionsCategorySeeder::class,
           SuggestionsSubdivisionSeeder::class,
           SuggestionsFAQSeeder::class,
        ]);
    }
}

