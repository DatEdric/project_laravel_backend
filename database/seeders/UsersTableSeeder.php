<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->insert([
            [
                'password' => bcrypt('12345678'),
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'status' => 1,
                'remember_token' => str_random(10),
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now()
            ]
        ]);
    }
}
