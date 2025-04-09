<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\PessoaEndereco;
use Illuminate\Http\Request;

class PessoaEnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
    *  @OA\POST(
    *      path="/api/pessoaendereco",
    *      summary="Cadastra vinculo de Pessoa com endereco",
    *      description="Registra o endereço de uma pessoa",
    *      tags={"Pessoas"},
    *     @OA\Parameter(
    *         name="pes_id",
    *         in="query",
    *         description="Nº identificação da pessoa",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="end_id",
    *         in="query",
    *         description="Nº identificação do endereço",
    *         required=true,  
    *      ),      
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Erro"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        $pessoa = Pessoa::where('pes_id', $request->pes_id)->first();

        if ($pessoa) {             

            $validadeData = $request->validate([            
                'pes_id' => 'required|integer',
                'end_id' => 'required|integer',
            ]);
    
            $pessoaEndereco = PessoaEndereco::create([            
                'pes_id' => $validadeData['pes_id'],
                'end_id' => $validadeData['end_id'],
            ]);
            
            return response()->json(['message' => 'Vinculo de pessoa com endereço cadastrada com sucesso.','pessoa-endereco' => $pessoaEndereco], 200);
        }

        return response()->json(['message' => 'Vinculo de pessoa com endereço já cadastrado.', 404]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PessoaEndereco $pessoaEndereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PessoaEndereco $pessoaEndereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaEndereco $pessoaEndereco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PessoaEndereco $pessoaEndereco)
    {
        //
    }
}
