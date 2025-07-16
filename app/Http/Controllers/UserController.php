<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::all());
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
