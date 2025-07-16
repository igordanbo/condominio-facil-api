<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Produto::with('condominio')->get());
    }

    public function show(Produto $produto): JsonResponse
    {
        return response()->json($produto->load('condominio'));
    }

    public function store(Request $request): JsonResponse
    {
        $produto = Produto::create($request->validated());
        return response()->json($produto, 201);
    }

    public function update(Request $request, Produto $produto): JsonResponse
    {
        $produto->update($request->validated());
        return response()->json($produto);
    }

    public function destroy(Produto $produto): JsonResponse
    {
        $produto->delete();
        return response()->json(null, 204);
    }
}
