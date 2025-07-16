<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CondominioController;
use App\Http\Controllers\BlocoController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\TipoManutencaoController;
use App\Http\Controllers\ManutencaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('usuarios',         UserController::class);
Route::apiResource('condominios',      CondominioController::class);
Route::apiResource('blocos',           BlocoController::class);
Route::apiResource('apartamentos',     ApartamentoController::class);
Route::apiResource('produtos',         ProdutoController::class);
Route::apiResource('tipos-manutencao', TipoManutencaoController::class);
Route::apiResource('manutencaos',      ManutencaoController::class);



/*

GET /entidade → index()
Quando: Você quer listar todos os registros de uma entidade.

Exemplo real: Listar todos os condomínios cadastrados.

Uso no frontend: Mostrar uma tabela/listagem.

GET /entidade/{id} → show()
Quando: Você quer ver os detalhes de um único item.

Exemplo real: Ver as informações completas do Bloco com ID 3, incluindo apartamentos.

Uso no frontend: Tela de detalhes / edição.

POST /entidade → store()
Quando: Você quer criar um novo registro.

Exemplo real: Adicionar um novo usuário, novo condomínio, novo produto etc.

Uso no frontend: Formulário de cadastro, botão “Salvar”.

PUT /entidade/{id} ou PATCH → update()
Quando: Você quer atualizar um item existente.

Exemplo real: Atualizar o nome e telefone de um síndico.

Uso no frontend: Formulário de edição → botão “Atualizar”.

DELETE /entidade/{id} → destroy()
Quando: Você quer excluir permanentemente um item.

Exemplo real: Remover um produto cadastrado ou apagar um apartamento.

Uso no frontend: Botão “Excluir” com confirmação.

*/
