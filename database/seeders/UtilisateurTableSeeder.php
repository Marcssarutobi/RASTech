<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilisateurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                'username'=>'Client',
                'email'=>'client@gmail.com',
                'password'=>bcrypt('123456789'),
                'role'=>'Client'
            ]
        );
        User::insert(
            [
                'username'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> bcrypt('123456789'),
                'role'=> 'Admin',
            ]
        );
        User::insert(
            [
                'username'=> 'SuperAdmin',
                'email'=> 'superadmin@gmail.com',
                'password'=> bcrypt('123456789'),
                'role'=> 'Super-Admin',
            ]
        );
    }
}
