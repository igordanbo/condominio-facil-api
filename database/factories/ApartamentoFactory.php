<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Apartamento;

class ApartamentoFactory extends Factory
{
    protected $model = Apartamento::class;

    public function definition(): array
    {
        return [
            'numero' => $this->faker->randomElement(range(101, 804)),
            'status' => $this->faker->randomElement(['livre','ocupado','interditado','em_reforma']),
            // bloco_id e dono_id atribuídos no seeder
        ];
    }
}
