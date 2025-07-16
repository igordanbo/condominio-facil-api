<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ManutencaoProgramada;

use DateTime;
class ManutencaoProgramadaFactory extends Factory
{
    protected $model = ManutencaoProgramada::class;

    public function definition(): array
    {
         $status = $this->faker->randomElement(['agendado','concluido']);
    $dataAgendada = $this->faker->dateTimeBetween('-1 month', '+2 months');

    // Garante que a data final é sempre igual ou posterior à inicial
    $dataFinal = (new DateTime() < $dataAgendada) ? $dataAgendada : 'now';

    return [
        'data_agendada'  => $dataAgendada->format('Y-m-d'),
        'data_conclusao' => $status === 'concluido'
                           ? $this->faker->dateTimeBetween($dataAgendada, $dataFinal)->format('Y-m-d')
                           : null,
        'status'         => $status,
        // demais FKs serão setadas no seeder
    ];
    }
}
