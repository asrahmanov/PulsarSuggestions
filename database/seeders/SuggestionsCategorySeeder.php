<?php

namespace Database\Seeders;

use App\Models\Suggestions;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuggestionsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        \DB::table('suggestions_category')->insert([
            ['name' => 'Выберите категорию'],
            ['name' => 'Время процесса'],
            ['name' => 'Качество'],
            ['name' => 'Охрана труда и безопасность'],
            ['name' => 'Организация рабочих мест и 5С'],
            ['name' => 'Прочее'],
        ]);


    }
}
