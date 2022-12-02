<?php

namespace Database\Seeders;

use App\Models\Suggestions;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuggestionsFAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        \DB::table('suggestions_faq')->insert([
            ['name' => 'Вопрос № 1', 'description' => 'Ответ 1'],
            ['name' => 'Вопрос № 2', 'description' => 'Ответ 2'],
            ['name' => 'Вопрос № 3', 'description' => 'Ответ 3'],
            ['name' => 'Вопрос № 4', 'description' => 'Ответ 4'],
            ['name' => 'Вопрос № 5', 'description' => 'Ответ 5'],
            ['name' => 'Вопрос № 6', 'description' => 'Ответ 6'],
            ['name' => 'Вопрос № 7', 'description' => 'Ответ 7'],
        ]);


    }
}
