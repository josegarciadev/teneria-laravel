<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

		$methods = array(
			array('name' => 'Hombre'),
			array('name' => 'Mujer'),
            array('name' => 'Otro'),
		);

		DB::table('genders')->insert($methods);
    }
}
