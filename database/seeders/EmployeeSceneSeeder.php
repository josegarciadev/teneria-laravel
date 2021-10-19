<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSceneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_scenes')->delete();

		$methods = array(
			array('name' => 'Entrada'),
			array('name' => 'Salida'),
		);

		DB::table('employee_scenes')->insert($methods);
    }
}
