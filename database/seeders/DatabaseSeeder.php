<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
//        $this->call(DepartmentTableSeeder::class);
//        $this->call(GroupPermissionTableSeeder::class);
//        $this->call(PermissionTableSeeder::class);
//        $this->call(RolesTableSeeder::class);
//        $this->call(PermissionRoleTableSeeder::class);
//        $this->call(RoleUserTableSeeder::class);
//        $this->call(TypeDocumentsSeeder::class);
//        $this->call(NewsTableSeeder::class);
    }
}
