<?php

use Illuminate\Database\Seeder;
use App\Endereco;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Endereco::class, 30)->create();
    }
}
