<?php
// app/Http/Requests/CondominioRequest.php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest; 
class CondominioRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome'           => 'required|string|max:255',
            'cnpj'           => 'nullable|string|max:18|unique:condominios,cnpj,' . $this->id,
            'endereco'       => 'nullable|string|max:255',
            'cidade'         => 'nullable|string|max:100',
            'uf'             => 'nullable|string|size:2',
            'telefone'       => 'nullable|string|max:20',
            'email'          => 'nullable|email',
            'responsavel_id' => 'required|exists:users,id',
        ];
    }
}
