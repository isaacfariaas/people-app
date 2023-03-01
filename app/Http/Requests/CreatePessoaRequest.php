<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePessoaRequest extends FormRequest
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
            'cpf' => ['required', 'string', 'max:14', Rule::unique("pessoas", "cpf")],
            'email' => ['required', 'string', 'max:255', Rule::unique("pessoas", "email")],
            'data_nasc' => ['required', 'string', 'date'],
            'nacionalidade' => ['required', 'string'],
            'telefones.*' => ['required', 'string'],

        ];
    }
}
