<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondominioRequest;  
use App\Models\Condominio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CondominioController extends Controller
{
    // GET /condominios
    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->input('sort_by');        // exemplo: tipo.nome
        $sortOrder = $request->input('sort_order', 'asc');

        $query = Condominio::with([
            'sindico',
            'blocos'
        ]);


        switch ($sortBy) {
            case 'nome':
                $query->orderBy('nome', $sortOrder);
                break;
            case 'created_at':
                $query->orderBy('created_at', $sortOrder);
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        if ( $request->filled('nome') ) {
            $query->where(function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->input('nome') . '%')
                  ->orWhere('cnpj', 'like', '%' . $request->input('nome') . '%')
                  ->orWhereHas('sindico', function($subQuery) use ($request) {
                      $subQuery->where('nome', 'like', '%' . $request->input('nome') . '%');
                  });
            });
        }

        if ( $request->filled('status')){
            $query->where('status', $request->input('status'));
        }

        if ( $request->filled('cnpj') ) {
            $query->where('cnpj', 'LIKE', '%' . $request->input('cnpj') . '%');
        }

        $data = $query->paginate(10); 
        
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
        return response()->json($condominio->fresh());
    }

    // DELETE /condominios/{id}
    public function destroy(Condominio $condominio): JsonResponse
    {
        $condominio->delete();
        return response()->json(null, 204);
    }
}