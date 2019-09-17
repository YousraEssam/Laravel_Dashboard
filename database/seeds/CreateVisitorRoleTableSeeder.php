<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateVisitorRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Visitor',
            'description' => 'guest',
            ]);
        
        $permissions = [
            'role-list', 'city-list'
        ];

        $role->syncPermissions($permissions);
        
    }
}
