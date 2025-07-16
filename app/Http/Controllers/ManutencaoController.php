<?php

namespace App\Http\Controllers;

use App\Models\ManutencaoProgramada;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManutencaoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            ManutencaoProgramada::with('tipo', 'condominio', 'bloco', 'apartamento')->get()
        );
    }

    public function show(ManutencaoProgramada $manutencao): JsonResponse
    {
        return response()->json($manutencao->load('tipo', 'condominio', 'bloco', 'apartamento'));
    }

    public function store(Request $request): JsonResponse
    {
        $manutencao = ManutencaoProgramada::create($request->validated());
        return response()->json($manutencao, 201);
    }

    public function update(Request $request, ManutencaoProgramada $manutencao): JsonResponse
    {
        $manutencao->update($request->validated());
        return response()->json($manutencao);
    }

    public function destroy(ManutencaoProgramada $manutencao): JsonResponse
    {
        $manutencao->delete();
        return response()->json(null, 204);
    }
}
