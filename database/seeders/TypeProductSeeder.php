<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\DB;
class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_products')->delete();

		$methods = array(
			array('name' => 'UN'),
			array('name' => 'GL'),
            array('name' => 'JG'),
			array('name' => 'KG'),
		);

		DB::table('type_products')->insert($methods);
    }
}
