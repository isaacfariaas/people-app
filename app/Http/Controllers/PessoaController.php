<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use Illuminate\Validation\Rule;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoas = Pessoa::with('telefones')->get();
        return response()->json($pessoas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePessoaRequest $request)
    {

        $pessoa = Pessoa::create($request->only([
            'nome',
            'cpf',
            'email',
            'data_nasc',
            'nacionalidade',
        ]));

        if ($request->has('telefones')) {
            foreach ($request->input('telefones') as $numero) {
                $pessoa->telefones()->create(['numero' => $numero]);
            }
        }

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pessoa = Pessoa::with('telefones')->findOrFail($id);
        return response()->json($pessoa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePessoaRequest $request, $id)
    {

        $pessoa = Pessoa::findOrFail($id);

        $pessoa->update($request->only([
            'nome',
            'cpf',
            'email',
            'data_nasc',
            'nacionalidade',
        ]));

        if ($request->has('telefones')) {
            $telefones = $request->input('telefones');
            $pessoa->telefones()->delete();
            foreach ($telefones as $numero) {
                $pessoa->telefones()->create(['numero' => $numero]);
            }
        }
        return response()->json($pessoa);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pessoa = Pessoa::find($id);
        if (!$pessoa) {
            return response()->json(['message' => 'Registro não encontrado.'], 404);
        }
    
        $pessoa->delete();
    
        return response()->json(['message' => 'Registro excluído com sucesso.', 200]);
    }
}
