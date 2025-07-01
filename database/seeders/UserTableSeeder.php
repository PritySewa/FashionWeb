<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name'=>'Admin',
        'email'=>'admin@gmail.com',
        'password'=>bcrypt('qwertyuiop'),
        'role'=>'admin'
    ]);
        User::create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('asdfghjkl'),
            'role'=>'user'
        ]);
}

}
