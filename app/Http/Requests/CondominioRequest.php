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
            'status'         => 'required|in:ativo,inativo',  
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do condomínio é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'cnpj.unique' => 'Já existe um condomínio cadastrado com este CNPJ.',
            'cnpj.size' => 'O CNPJ deve ter 18 caracteres.',
            'endereco.max' => 'O endereço não pode ter mais de 255 caracteres.',
            'cidade.max' => 'A cidade não pode ter mais de 100 caracteres.',
            'uf.size' => 'A UF deve ter exatamente 2 caracteres.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'responsavel_id.required' => 'O responsável pelo condomínio é obrigatório.',
            'responsavel_id.exists' => 'O responsável pelo condomínio deve ser um usuário válido.',
      ];
    }
}
