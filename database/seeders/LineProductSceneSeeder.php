<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LineProductSceneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('line_product_scenes')->delete();

		$methods = array(
			array('name' => 'Entrada'),
			array('name' => 'Salida'),
		);

		DB::table('line_product_scenes')->insert($methods);
    }
}
