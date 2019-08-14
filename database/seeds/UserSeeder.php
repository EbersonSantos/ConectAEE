<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => "Mariel",
            'username' => "mariel",
            'email' => "mariel@gmail.com",
            'telefone' => "(81) 91111-1111",
        ]);

        factory(User::class)->create([
            'name' => "Igor",
            'username' => "igor",
            'telefone' => "(81) 91111-1111",
        ]);

        factory(User::class)->create([
            'name' => "Anderson",
            'username' => "anderson",
            'telefone' => "(81) 91111-1111",
        ]);

        factory(User::class)->create([
            'name' => "Eberson",
            'username' => "eberson.lmts",
            'telefone' => "(81) 91111-1111",
        ]);

        factory(User::class)->create([
            'name' => "Adelino",
            'username' => "adelino.lmts",
            'telefone' => "(81) 91111-1111",
        ]);

        //factory(User::class, 45)->create();
    }
}
