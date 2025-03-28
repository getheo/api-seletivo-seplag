<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/lotacoes",
    *      summary="Todas as Lotações",
    *      description="Lista as Lotações",
    *      tags={"Lotações"},
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
    *          description="Lotação não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function index()
    {
        $lotacao = Lotacao::with('unidades')->with('pessoas')->get();        
        return response()->json($lotacao);  
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Lotacao $lotacao)
    {
        $lotacao = Lotacao::where('unid_id', $lotacao->unid_id)->with('unidade')->first();
        return response()->json($lotacao);
    }

    public function edit(Lotacao $lotacao)
    {
        //
    }

    public function update(Request $request, Lotacao $lotacao)
    {
        $validadeData = $request->validate([
            'lot_id' => 'required|integer',
            'pes_id' => 'required|integer',
            'unid_id' => 'required|integer',
            'lot_data_lotacao' => 'required|string',
            'lot_portaria' => 'required|string',
        ]);

        $lotacao->update($validadeData);

        return response()->json($lotacao, 200);
    }

    public function destroy(Lotacao $lotacao)
    {
        $lotacao->delete();
        return response()->json(null, 204);
    }
}
