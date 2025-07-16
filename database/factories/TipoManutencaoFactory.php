<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TipoManutencao;

class TipoManutencaoFactory extends Factory
{
    protected $model = TipoManutencao::class;

    public function definition(): array
    {
        return ['nome' => ucfirst($this->faker->word().' preventiva')];
    }
}
