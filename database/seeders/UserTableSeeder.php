<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            ['name'=>'Ripon Chandra', 'email'=>'ripon@gmail.com', 'password'=>'12341234'],
            ['name'=>'Lolit Chandra', 'email'=>'lolit@gmail.com', 'password'=>'12341234'],
            ['name'=>'Gobinda Chandra', 'email'=>'gobinda@gmail.com', 'password'=>'12341234']
        ];
        User::insert($user);
    }
}
