<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondominioRequest;   // veremos já já
use App\Models\Condominio;
use Illuminate\Http\JsonResponse;

class CondominioController extends Controller
{
    // GET /condominios
    public function index(): JsonResponse
    {
        $data = Condominio::with('sindico:id,nome', 'blocos')   // eager loading básico
                  ->paginate(10);                               // ou ->get()
        return response()->json($data);
    }

    // GET /condominios/{id}
    public function show(Condominio $condominio): JsonResponse
    {
        $condominio->load('blocos.apartamentos', 'produtos');
        return response()->json($condominio);
    }

    // POST /condominios
    public function store(CondominioRequest $request): JsonResponse
    {
        $condominio = Condominio::create($request->validated());
        return response()->json($condominio, 201);
    }

    // PUT/PATCH /condominios/{id}
    public function update(CondominioRequest $request, Condominio $condominio): JsonResponse
    {
        $condominio->update($request->validated());
        return response()->json($condominio);
    }

    // DELETE /condominios/{id}
    public function destroy(Condominio $condominio): JsonResponse
    {
        $condominio->delete();
        return response()->json(null, 204);
    }
}