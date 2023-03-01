<?php

namespace Database\Factories;

use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PessoaFactory extends Factory
{
    protected $model = Pessoa::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        $pessoa = [
            'nome' => $faker->name(),
            'cpf' => $faker->unique()->numberBetween(10000000000, 99999999999),
            'email' => $faker->unique()->safeEmail(),
            'data_nasc' => $faker->date(),
            'nacionalidade' => $faker->country(),
        ];

        return $pessoa;
    }
}
