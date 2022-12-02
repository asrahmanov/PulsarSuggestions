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
            ['name' => 'НО № 4'],
            ['name' => 'НО № 5 - ИЦ'],
            ['name' => 'НО № 7'],
            ['name' => 'НО № 8'],
            ['name' => 'НО № 9'],
            ['name' => 'НО № 10'],
            ['name' => 'ОКС'],
            ['name' => 'Метрологический отдел'],
        ]);

    }
}
