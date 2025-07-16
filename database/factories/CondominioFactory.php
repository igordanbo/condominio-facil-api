<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Condominio;

class CondominioFactory extends Factory
{
    protected $model = Condominio::class;

    public function definition(): array
    {
        return [
            'nome'          => 'Condomínio '.$this->faker->streetName(),
            'cnpj'          => $this->faker->unique()->numerify('##.###.###/####-##'),
            'endereco'      => $this->faker->streetAddress(),
            'cidade'        => $this->faker->city(),
            'uf'            => $this->faker->stateAbbr(),
            'telefone'      => $this->faker->phoneNumber(),
            'email'         => $this->faker->companyEmail(),
            // o responsável (síndico) será atribuído no seeder
        ];
    }
}
