<?php

namespace App\Http\Controllers;

use App\Models\TipoManutencao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoManutencaoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(TipoManutencao::with('manutencoes')->get());
    }

    public function show(TipoManutencao $tipos_manutencao): JsonResponse
    {
        return response()->json($tipos_manutencao->load('manutencoes'));
    }

    public function store(Request $request): JsonResponse
    {
        $tipo = TipoManutencao::create($request->validated());
        return response()->json($tipo, 201);
    }

    public function update(Request $request, TipoManutencao $tipos_manutencao): JsonResponse
    {
        $tipos_manutencao->update($request->validated());
        return response()->json($tipos_manutencao);
    }

    public function destroy(TipoManutencao $tipos_manutencao): JsonResponse
    {
        $tipos_manutencao->delete();
        return response()->json(null, 204);
    }
}
