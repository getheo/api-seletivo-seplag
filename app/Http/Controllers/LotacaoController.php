<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Unidade;
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

    /**
    *  @OA\POST(
    *      path="/api/lotacao",
    *      summary="Cadastra vinculo de Pessoa com Unidade",
    *      description="Registra Pessoa com Unidade",
    *      tags={"Lotações"},
    *     @OA\Parameter(
    *         name="pes_id",
    *         in="query",
    *         description="Nº identificação da pessoa",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="unid_id",
    *         in="query",
    *         description="Nº identificação da Unidade",
    *         required=true,  
    *      ),      
    *     @OA\Parameter(
    *         name="lot_data_lotacao",
    *         in="query",
    *         description="Data lotação",
    *         required=true,  
    *      ),  
    *     @OA\Parameter(
    *         name="lot_data_remocao",
    *         in="query",
    *         description="Data remoção",
    *         required=false,  
    *      ),          
    *     @OA\Parameter(
    *         name="lot_portaria",
    *         in="query",
    *         description="Portaria",
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
    *          description="Erro"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        $lotacao = Lotacao::where(['pes_id' => $request->pes_id, 'unid_id' => $request->unid_id])->first();
        //$pessoa = Pessoa::where('pes_id', $request->pes_id)->first();
        //$unidade = Unidade::where('unid_id', $request->unid_id)->first();

        if (!$lotacao) {             

            $validadeData = $request->validate([            
                'pes_id' => 'required|integer',
                'unid_id' => 'required|integer',
                'lot_data_lotacao' => 'required|string',
            ]);
    
            $lotacao = Lotacao::create([            
                'pes_id' => $validadeData['pes_id'],
                'unid_id' => $validadeData['unid_id'],
                'lot_data_lotacao' => $validadeData['lot_data_lotacao'],
                'lot_data_remocao' => $validadeData['lot_data_remocao'],
                'lot_portaria' => $validadeData['lot_portaria'],
            ]);
            
            return response()->json(['message' => 'Lotação da Pessoa com Unidade cadastrada com sucesso.','lotacao' => $lotacao], 200);
        }

        return response()->json(['message' => 'Lotação da Pessoa com Unidade já cadastrada.', 404]);
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
     * @OA\PUT(
     *     path="/api/lotacao/{lot_id}",
     *     summary="Atualiza Lotacao",
     *     description="Atualiza os dados de uma Lotacao",
     *     tags={"Lotações"},     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"lot_id", "pes_id", "unid_id", "lot_data_lotacao"},
     *             @OA\Property(property="lot_id", type="integer", example="1"),
     *             @OA\Property(property="pes_id", type="integer", example="1"),
     *             @OA\Property(property="unid_id", type="integer", example="1"),
     *             @OA\Property(property="lot_data_lotacao", type="string", example="2024-01-01"),
     *             @OA\Property(property="lot_data_remocao", type="string", example="2025-12-01"),
     *             @OA\Property(property="lot_portaria", type="string", example="Portaria 1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lotacao atualizada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lotacao atualizada com sucesso"),
     *             @OA\Property(property="lotacao", type="object",
     *                 @OA\Property(property="lot_id", type="integer", example=1),
     *                 @OA\Property(property="pes_id", type="integer", example=1), 
     *                 @OA\Property(property="unid_id", type="integer", example=1),
     *                 @OA\Property(property="lot_data_lotacao", type="string", example="2024-01-01"),
     *                 @OA\Property(property="lot_data_remocao", type="string", example="2025-12-01"),
     *                 @OA\Property(property="lot_portaria", type="string", example="Portaria 1")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição inválida"),
     *     @OA\Response(response=404, description="Lotacao não encontrado"),
     *     security={{"bearerAuth":{}}}
     * )
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
