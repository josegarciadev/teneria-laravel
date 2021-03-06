<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Administrador de sistema',
            'email' => 'admin@teneriarubio.com',
            'password' => bcrypt('Yc-q3{S)ksGnkOS-')
        ];
        $user = User::create($data);
        $user->createToken('authToken')->accessToken;
        $user->assignRole('admin');


        $rootData = [
            'name' => 'Root',
            'email' => 'root@teneriarubio.com',
            'password' => bcrypt('261->!G_h1da214das1')
        ];
        $root = User::create($rootData);
        $root->createToken('authToken')->accessToken;
        $root->assignRole('root');
    }
}
