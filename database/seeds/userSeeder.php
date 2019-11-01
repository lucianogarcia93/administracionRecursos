<?php

use Illuminate\Database\Seeder;
use App\User;


class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name="Admin";
        $user->email="admin@mail.com";
        $user->password=bcrypt('administrador');
        $user->save();

        $user = new User();
        $user->name="Gerente";
        $user->email="gerencia@mail.com";
        $user->password=bcrypt('gerencia');
        $user->save();

        $user = new User();
        $user->name="Contador";
        $user->email="contaduria@mail.com";
        $user->password=bcrypt('contaduria');
        $user->save();
        
    }
}
