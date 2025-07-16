<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition(): array
    {
        return [
            'nome'        => ucfirst($this->faker->words(2, true)),
            'descricao'   => $this->faker->sentence(),
            'preco'       => $this->faker->randomFloat(2, 10, 500),
            // condominio_id no seeder
        ];
    }
}
