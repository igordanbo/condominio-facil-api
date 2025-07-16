<?php

namespace App\Http\Controllers;


use App\Models\Bloco;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlocoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Bloco::with('condominio', 'sindico', 'apartamentos', 'manutencoes')->get());
    }

    public function show(Bloco $bloco): JsonResponse
    {
        return response()->json($bloco->load('condominio', 'sindico', 'apartamentos', 'manutencoes'));
    }

    public function store(Request $request): JsonResponse
    {
        $bloco = Bloco::create($request->validated());
        return response()->json($bloco, 201);
    }

    public function update(Request $request, Bloco $bloco): JsonResponse
    {
        $bloco->update($request->validated());
        return response()->json($bloco);
    }

    public function destroy(Bloco $bloco): JsonResponse
    {
        $bloco->delete();
        return response()->json(null, 204);
    }
}
