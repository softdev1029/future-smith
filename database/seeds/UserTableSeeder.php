<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([[
            'name' => 'admin',
            'email' => 'admin@futuresmith.com',
            'password' => '$2y$10$Hu2YU6jc4GXDTxf4VEg5AuNdRkoDrUlGcmB.gq2RipRj5NEezglkG',
            'role' => '2',
            'status' => '1',
            'created_at' => '2018-10-02 09:12:13',
            'updated_at' => '2018-10-02 09:12:13',
        ],]);
    }
}
