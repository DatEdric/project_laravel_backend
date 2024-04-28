<?php

use Illuminate\Database\Seeder;

class GroupPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('group_permission')->insert([
            [
                'id' => '1',
                'name' => 'Loại văn bản',
                'description' => 'Quản lý loại văn bản',
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now()
            ],
        ]);
    }
}
