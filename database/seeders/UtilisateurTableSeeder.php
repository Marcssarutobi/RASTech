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
        Utilisateur::create([
            'photo'=>'https://th.bing.com/th/id/OIP.PoS7waY4-VeqgNuBSxVUogAAAA?rs=1&pid=ImgDetMain',
            'nom'=>'DOE',
            'prenom'=>'Jonh',
            'tel'=>'+22966556688',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456789'),
            'role'=>'Super-Admin'
        ]);
        User::create([
            'username'=>'none',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456789'),
            'role'=>'Super-Admin'
        ]);
    }
}
