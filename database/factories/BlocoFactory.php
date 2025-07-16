<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bloco;

class BlocoFactory extends Factory
{
    protected $model = Bloco::class;

    public function definition(): array
    {
        return [
            'nome' => 'Bloco '.$this->faker->randomLetter().$this->faker->randomDigit(),
            // condominio_id e sindico_id serão preenchidos no seeder
        ];
    }
}
