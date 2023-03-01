<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePessoaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'min:14', Rule::unique("pessoas","cpf")->ignore($this->id)],
            'email' => ['required', 'string', 'max:255', Rule::unique("pessoas","email")->ignore($this->id)],
            'data_nasc' => ['required', 'string', 'date'],
            'nacionalidade' => ['required', 'string'],
            'telefones.*' => ['required', 'string'],
        ];
    }
}
