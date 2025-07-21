<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\TipoManutencao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class TipoManutencaoController extends Controller
{
    public function index(): JsonResponse
    {

        $data = TipoManutencao::paginate(10);
        
        return response()->json($data);
    
    }

    public function show(TipoManutencao $tipos_manutencao): JsonResponse
    {
        return response()->json($tipos_manutencao->load('manutencoes'));
    }

  public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $tipo = TipoManutencao::create($validated);

        return response()->json($tipo, 201);
    } catch (\Exception $e) {
        Log::error($e);
        return response()->json([
            'message' => 'Erro ao criar tipo de manutenção',
            'erro' => $e->getMessage()
        ], 500);
    }
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
