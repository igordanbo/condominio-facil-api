<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->input('sort_by');
        $sortOrder = $request->input('sort_order', 'asc');
        $search = $request->input('search');
        $user_type = $request->input('user_type');
    
        $query = User::with([
            'condominiosSindico',
            'blocosSindico',
            'apartamentos'
        ])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('cpf', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('observacao', 'like', "%{$search}%");
            });
        })
        ->when($user_type, function ($query, $user_type) {
            $query->where('tipo', $user_type);
        });
    
        // Aplica a ordenação, se necessário
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
    
        $data = $query->paginate(10); 
    
        return response()->json($data);
    }
    public function show(User $usuario): JsonResponse
    {
        return response()->json($usuario->load('apartamentos', 'condominiosSindico', 'blocosSindico'));
    }

    public function store(UserRequest $request): JsonResponse
    {
        $usuario = User::create($request->validated());
        return response()->json($usuario, 201);
    }

    public function update(UserRequest $request, User $usuario): JsonResponse
    {
        $usuario->update($request->validated());
        return response()->json($usuario);
    }

    public function destroy(User $usuario): JsonResponse
    {
        $usuario->delete();
        return response()->json(null, 204);
    }
}
