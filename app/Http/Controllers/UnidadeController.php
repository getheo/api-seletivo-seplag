<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/unidades",
    *      summary="Unidades",
    *      description="Lista todas as Unidades e sua Lotação",
    *      tags={"Unidades"},
    *     @OA\Parameter(
    *         name="page",
    *         in="query",
    *         description="Nº de páginas",
    *         required=false,
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
    *          description="Unidade não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */    
    public function index()
    {
        $unidade = Unidade::with('unidadeEndereco')->get();        
        return response()->json($unidade);  
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Unidade $unidade)
    {
        $unidade = Unidade::where('unid_id', $unidade->unid_id)->with('unidadeEndereco')->first();
        return response()->json($unidade);
    }

    public function edit(Unidade $unidade)
    {
        //
    }

    public function update(Request $request, Unidade $unidade)
    {
        $validadeData = $request->validate([
            'unid_id' => 'required|integer',
            'unid_nome' => 'required|string',
            'unid_sigla' => 'required|string',
        ]);

        $unidade->update($validadeData);

        return response()->json($unidade, 200);
    }

    public function destroy(Unidade $unidade)
    {
        $unidade->delete();
        return response()->json(null, 204);
    }
}
