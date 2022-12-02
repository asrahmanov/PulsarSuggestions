<?php

namespace Database\Seeders;

use App\Models\Suggestions;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuggestionsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        \DB::table('suggestions_status')->insert([
            ['name' => 'на рассмотрении'],
            ['name' => 'принято РРП'],
            ['name' => 'принято РПС'],
            ['name' => 'отклонено'],
            ['name' => 'реализовано'],
        ]);


    }
}
