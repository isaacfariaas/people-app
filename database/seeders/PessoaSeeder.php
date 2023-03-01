<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pessoa::factory()
            ->count(10)
            ->create()
            ->each(function ($pessoa) {
                $telefones = [];

                for ($i = 0; $i < random_int(1, 3); $i++) {
                    $telefones[] = ['numero' => \Faker\Factory::create('pt_BR')->phoneNumber()];
                }

                $pessoa->telefones()->createMany($telefones);
            });
    }
}
