<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Condominio;
use App\Models\Bloco;
use App\Models\Apartamento;
use App\Models\Produto;
use App\Models\ManutencaoProgramada;
use App\Models\TipoManutencao;
use Faker\Factory as Faker;

// ...existing code...

// ...restante do código...



class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // ------- Usuários -------
        $sindicosCondominio = User::factory(3)->create(['tipo' => 'sindico_condominio']);
        $sindicosBloco      = User::factory(4)->create(['tipo' => 'sindico_bloco']);
        $ocupantes          = User::factory(8)->create(['tipo' => 'ocupante_ap']);

        
      
        // ------- Condomínios -------
        $condominios = Condominio::factory(3)->make()->each(function ($condominio) use ($sindicosCondominio) {
            $condominio->responsavel_id = $sindicosCondominio->random()->id;
            $condominio->save();

            // Produtos
            Produto::factory(10)
                ->for($condominio)
                ->create();

            // Blocos (2 cada)
            $blocos = Bloco::factory(2)->make()->each(function ($bloco) use ($condominio) {
                $bloco->condominio_id = $condominio->id;
                // random síndico de bloco
                $bloco->sindico_id    = User::where('tipo','sindico_bloco')->inRandomOrder()->first()->id;
                $bloco->save();

                $faker = \Faker\Factory::create();   // cria uma instância só uma vez
                $ocupanteIds = User::where('tipo', 'ocupante_ap')->pluck('id'); 
                // Apartamentos (8 cada bloco)
                Apartamento::factory(8)
                ->make()
                ->each(function ($ap) use ($bloco, $faker, $ocupanteIds) {   //  ← inclua as 3 variáveis aqui
                    if ($faker->boolean(70)) {            // agora $faker funciona
                        $ap->status  = 'ocupado';
                        $ap->dono_id = $faker->randomElement($ocupanteIds);
                    }
                    $ap->bloco_id = $bloco->id;           // não esqueça!
                    $ap->save();
                });

            });

              // ------- Tipos de manutenção -------
            $tipos = TipoManutencao::factory()->sequence(
                ['nome' => 'Limpeza de Caixa d\'Água'],
                ['nome' => 'Inspeção de Extintores'],
                ['nome' => 'Revisão de Elevadores'],
                ['nome' => 'Pintura de Fachada'],
                ['nome' => 'Dedetização']
            )->count(5)->create();


            // Manutenções (algumas no nível condomínio, outras por bloco / ap)
            ManutencaoProgramada::factory(6)->create([
                'tipo_manutencao_id' => $tipos->random()->id,
                'condominio_id'      => $condominio->id,
                'bloco_id'           => null,
                'apartamento_id'     => null,
            ]);

            foreach ($condominio->blocos as $bloco) {
                ManutencaoProgramada::factory(3)->create([
                    'tipo_manutencao_id' => $tipos->random()->id,
                    'condominio_id'      => $condominio->id,
                    'bloco_id'           => $bloco->id,
                    'apartamento_id'     => null,
                ]);

                // aleatoriamente criar para alguns apartamentos
                foreach ($bloco->apartamentos->random(3) as $ap) {
                    ManutencaoProgramada::factory()->create([
                        'tipo_manutencao_id' => $tipos->random()->id,
                        'condominio_id'      => $condominio->id,
                        'bloco_id'           => $bloco->id,
                        'apartamento_id'     => $ap->id,
                    ]);
                }
            }
        });
    }
}
