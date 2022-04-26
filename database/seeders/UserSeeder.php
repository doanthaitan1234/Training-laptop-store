<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $users = [
            [
                'name' => 'Thai Tan',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '0123456789',
                'role_id' => '2'
            ],
            [
                'name' => 'Thai Tan',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '0123456789',
                'role_id' => '1'
            ]
        ];
        DB::table('users')->delete();
        DB::table('users')->insert($users);
    }  
}
