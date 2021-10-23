<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();
        

        $admin = Admin::create([
            'admin_name' => 'hoangadmin',
            'admin_email' => 'hoangadmin@icloud.com',
            'admin_phone' => '1234567',
            'admin_password' => md5('123')
        ]);
        $author = Admin::create([
            'admin_name' => 'hoangauthor',
            'admin_email' => 'hoangauthor@icloud.com',
            'admin_phone' => '1234567',
            'admin_password' => md5('123')
        ]);
        $user = Admin::create([
            'admin_name' => 'hoanguser',
            'admin_email' => 'hoanguser@icloud.com',
            'admin_phone' => '1234567',
            'admin_password' => md5('123')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
