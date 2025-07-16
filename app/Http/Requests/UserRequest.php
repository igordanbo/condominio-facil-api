<?php
// app/Http/Requests/CondominioRequest.php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest; 
class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome'           => 'required|string|max:255',
            'cpf'           => 'nullable|string|max:14|unique:users,cpf,' . $this->id,
            'observacao'         => 'nullable|string|max:255',
            'idade'       => 'nullable|string|max:3',
            'email'          => 'nullable|email'
        ];
    }
}
 