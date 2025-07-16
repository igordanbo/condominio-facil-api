<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApartamentoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Apartamento::with('bloco.condominio', 'dono', 'manutencoes')->get());
    }

    public function show(Apartamento $apartamento): JsonResponse
    {
        return response()->json($apartamento->load('bloco.condominio', 'dono', 'manutencoes'));
    }

    public function store(Request $request): JsonResponse
    {
        $apartamento = Apartamento::create($request->validated());
        return response()->json($apartamento, 201);
    }

    public function update(Request $request, Apartamento $apartamento): JsonResponse
    {
        $apartamento->update($request->validated());
        return response()->json($apartamento);
    }

    public function destroy(Apartamento $apartamento): JsonResponse
    {
        $apartamento->delete();
        return response()->json(null, 204);
    }
}
