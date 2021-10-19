<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
class ResetDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:reset', [ '--force' => false ]);
        $this->info('Migrate:reset has been executed');
        Artisan::call('migrate',  [ '--force' => false ]);
        $this->info('Migrate has been executed');
        Artisan::call('laravel_api:create_roles');
        $this->info('laravel_api:create_roles has been executed');
        Artisan::call('passport:install', ['--force' => true]);
        $this->info('Passport keys has been updated');
        Artisan::call('db:seed', ['--class' => 'AdminSeeder']);
        $this->info('Admin seeder has been executed');
        Artisan::call('db:seed', ['--class' => 'TypeProductSeeder']);
        $this->info('TypeProducts seeder has been executed'); 
        Artisan::call('db:seed', ['--class' => 'GenderSeeder']);
        $this->info('Genders seeder has been executed');
        Artisan::call('db:seed', ['--class' => 'EmployeeSceneSeeder']);
        $this->info('EmployeeScene seeder has been executed');
        Artisan::call('optimize:clear');
        $this->info('Cache has been cleared');
    }
    
}
