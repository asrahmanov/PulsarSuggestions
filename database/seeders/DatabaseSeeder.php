<?php

namespace Database\Seeders;


use App\Models\Defect;
use App\Models\SuggestionsStatus;
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
           SuggestionsStatusSeeder::class,
        ]);
    }
}

