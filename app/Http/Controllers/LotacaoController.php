<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/lotacao",
    *      summary="Todas as Lotações",
    *      description="Lista todas as Lotações",
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
        $lotacao = Lotacao::with(['pessoa', 'unidade'])->paginate(10);        
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

    /**
    *  @OA\GET(
    *      path="/api/lotacao/{lot_id}",
    *      summary="Mostra uma Lotação",
    *      description="Pesquisa por uma Lotação (lot_id)",
    *      tags={"Lotações"},
    *     @OA\Parameter(
     *         name="lot_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da Lotação",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Lotação Encontrada",
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
    public function show(int $lot_id)
    {
        $lotacao = Lotacao::where('lot_id', $lot_id)->with(['pessoa', 'unidade'])->first();               

        if (!$lotacao) {            
            return response()->json(['message' => 'Lotação não encontrada', 404]);
        }
        return response()->json(['message' => 'Lotação encontrada','lotacao' => $lotacao]);
    }

    /**
    *  @OA\GET(
    *      path="/api/lotacao/unidade/{unid_id}",
    *      summary="Mostra pessoas lotadas na Unidade",
    *      description="Pesquisa por pessoas lotadas na Unidade (unid_id)",
    *      tags={"Lotações"},
    *     @OA\Parameter(
     *         name="unid_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da Unidade",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Unidade - Lotação Encontrada",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Unidade - Lotação não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function showUnidade(int $unid_id)
    {
        $lotacao = Lotacao::where('unid_id', $unid_id)->with(['pessoa', 'unidade'])->first();               

        if (!$lotacao) {            
            return response()->json(['message' => 'Unidade - Lotação não encontrada', 404]);
        }
        return response()->json(['message' => 'Unidade - Lotação encontrada','lotacao' => $lotacao]);
    }

    public function edit(Lotacao $lotacao)
    {
        //
    }

    /**
    *  @OA\PUT(
    *      path="/api/lotacao/{lot_id}",
    *      summary="Atualizar dados de uma Lotação",
    *      description="Editar os dados de uma Lotação através do (lot_id)",
    *      tags={"Lotações"},
    *     @OA\Parameter(
     *         name="lot_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da lotação",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Dados da Lotação atualizado com sucesso.",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Erro ao atualizar a Lotação"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */ 
    public function update(Request $request, Lotacao $lotacao)
    {
        $validadeData = $request->validate([            
            'pes_id' => 'required|integer',
            'unid_id' => 'required|integer',
            'lot_data_lotacao' => 'required|string',
            'lot_portaria' => 'required|string',
        ]);

        $lotacao->update($validadeData);

        return response()->json($lotacao, 200);
    }


    /**
    *  @OA\DELETE(
    *      path="/api/lotacao/{lot_id}",
    *      summary="Exclui uma Lotação",
    *      description="Exclui uma Lotação através do (lot_id)",
    *      tags={"Lotações"},
    *     @OA\Parameter(
     *         name="lot_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da Lotação",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Lotação excluída com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir a Lotação"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(Lotacao $lotacao)
    {
        $lotacao->delete();
        return response()->json(null, 204);
    }
}
