<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->command->warn(PHP_EOL . 'Creating New Permissions...');
        $permission1 = Permission::create(['name' => 'userview']);
        $permission2 = Permission::create(['name' => 'usercreate']);
        $permission3 = Permission::create(['name' => 'userupdate']);
        $permission4 = Permission::create(['name' => 'userdelete']);
        $permission5 = Permission::create(['name' => 'roleview']);
        $permission6 = Permission::create(['name' => 'rolecreate']);
        $permission7 = Permission::create(['name' => 'roleupdate']);
        $permission8 = Permission::create(['name' => 'roledelete']);
        $permission9 = Permission::create(['name' => 'permissionview']);
        $permission10 = Permission::create(['name' => 'permissioncreate']);
        $permission11 = Permission::create(['name' => 'permissionupdate']);
        $permission12 = Permission::create(['name' => 'permissiondelete']);
        $this->command->info('Permissions created.');

        $this->command->warn(PHP_EOL . 'Creating New Role...');
        $sadminRole = Role::create(['name' => 'Superadmin']);
        $userRole = Role::create(['name' => 'User']);
        $this->command->info('Role created.');

        $this->command->warn(PHP_EOL . 'Giving Permissions to Role...');
        $sadminRole->givePermissionTo(Permission::all());
        $this->command->info('Permissions Given.');

        $this->command->warn(PHP_EOL . 'Creating Super Admin user...');
        $sadminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name'  =>  'Super Admin',
            'password' => bcrypt( 'admin123' ),
        ]);
        $this->command->info('Super Admin user created.');
        
        $this->command->warn(PHP_EOL . 'Adding some fake users...');
        $users = User::factory(10)->create();
        $this->command->info('Role Assigned.');

        $this->command->warn(PHP_EOL . 'Assigning Roles...');
        $sadminUser->assignRole($sadminRole);
        foreach($users as $user){
            $user->assignRole($userRole);
        }
        $this->command->info('Role Assigned.');

    }
}
