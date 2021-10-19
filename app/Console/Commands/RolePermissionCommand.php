<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel_api:create_roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $roles = ["admin", "user", "root"];


        $permissions = [
            "user_permission",
            "admin_permission",
            "root_permission"
        ];


        $this->line('------------- Setting Up Roles:');

        foreach ($roles as $role) {
            $role = Role::updateOrCreate(['name' => $role, 'guard_name' => 'api']);
            $this->info("Created " . $role->name . " Role");
        }

        $this->line('------------- Setting Up Permissions:');

        $superAdminRole = Role::where('name', "admin")->first();
        foreach ($permissions as $perm_name) {
            $permission = Permission::updateOrCreate([
                'name' => $perm_name,
                'guard_name' => 'api'
            ]);

            $superAdminRole->givePermissionTo($permission);

            $this->info("Created " . $permission->name . " Permission");
        }

        $this->info("All permissions are granted to Super Admin");
        $this->line('-------------  Complete: \n');
    }
}
