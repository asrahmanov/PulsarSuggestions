<?php

namespace Database\Seeders;

use App\Models\Suggestions;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuggestionsSubdivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        \DB::table('suggestions_subdivision')->insert([
            ['name' => 'Подразделение № 1'],
            ['name' => 'Подразделение № 2'],
            ['name' => 'Подразделение № 3'],
            ['name' => 'Подразделение № 4'],
            ['name' => 'Подразделение № 5'],
            ['name' => 'Подразделение № 6'],
            ['name' => 'Подразделение № 7'],
            ['name' => 'Подразделение № 8'],
        ]);


    }
}
