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
        
    }
}
