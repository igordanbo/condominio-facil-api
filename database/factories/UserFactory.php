<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        static $tipos = ['sindico_condominio','sindico_bloco','ocupante_ap'];

        return [
            'tipo'       => $this->faker->randomElement($tipos),
            'nome'       => $this->faker->name(),
            'email'      => $this->faker->unique()->safeEmail(),
            'cpf'        => $this->faker->unique()->numerify('###.###.###-##'),
            'idade'      => $this->faker->numberBetween(25, 65),
            'observacao' => $this->faker->optional()->sentence(),
            'password'   => Hash::make('password'),   // senha padrão
        ];
    }
}