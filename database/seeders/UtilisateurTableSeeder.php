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
            ],
            [
                'username'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> bcrypt('123456789'),
                'role'=> 'Admin',
            ]
        );
    }
}
