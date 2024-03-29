<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list', 'role-create', 'role-edit', 'role-delete',
           'city-list', 'city-create', 'city-edit', 'city-delete',
           'job-list', 'job-create', 'job-edit', 'job-delete',
           'staffmember-list', 'staffmember-create', 'staffmember-edit', 'staffmember-delete',
           'visitor-list', 'visitor-create', 'visitor-edit', 'visitor-delete',
           'news-list', 'news-create', 'news-edit', 'news-delete',
           'events-list', 'events-create', 'events-edit', 'events-delete',
           'folder-add',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
