<?php
  
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'ADMIN',
            'last_name' => 'ADMIN',
            'phone' => '0123456789',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
  
        $role = Role::create([
            'name' => 'Admin',
            'description' => 'site administrator',
            ]);
   
        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}
