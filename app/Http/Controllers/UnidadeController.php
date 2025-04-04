<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/unidade",
    *      summary="Lista informaçãoes de todas as Unidades",
    *      description="Exibe todas as Unidades com suas Lotação",
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
        $unidade = Unidade::with(['endereco', 'lotacao'])->paginate(10);        
        return response()->json($unidade);  
    }

    public function create()
    {
        //
    }

    /**
    *  @OA\POST(
    *      path="/api/unidade",
    *      summary="Cadastra uma nova Unidade",
    *      description="Registro de uma nova Unidade",
    *      tags={"Unidades"},
    *     @OA\Parameter(
    *         name="unid_nome",
    *         in="query",
    *         description="Nome da Unidade",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="unid_sigla",
    *         in="query",
    *         description="Sigla da Unidade",
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
    *          description="Unidade não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        $unidade = Unidade::where('unid_nome', $request->unid_nome)->first();  

        if (!$unidade) {             

            $validadeData = $request->validate([            
                'unid_nome' => 'required|string',
                'unid_sigla' => 'required|string',
            ]);
    
            $unidade = Unidade::create([                        
                'unid_nome' => $validadeData['unid_nome'],
                'unid_sigla' => $validadeData['unid_sigla'],
            ]);    
            
            return response()->json(['message' => 'Unidade cadastrada','unidade' => $unidade], 200);
        }

        return response()->json(['message' => 'Unidade já cadastrada', 404]);
        
    }

    /**
    *  @OA\GET(
    *      path="/api/unidade/{unid_id}",
    *      summary="Mostra informações de uma Unidade específica",
    *      description="Pesquisa por uma Unidade através do (unid_id)",
    *      tags={"Unidades"},
    *     @OA\Parameter(
     *         name="unid_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da Unidae",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Unidade Encontrada",
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
    public function show(int $unid_id)
    {
        $unidade = Unidade::where('unid_id', $unid_id)->with(['endereco', 'lotacao'])->first();
        //return response()->json($unidade);

        if (!$unidade) {            
            return response()->json(['message' => 'Unidade não encontrada', 404]);
        }
        return response()->json(['message' => 'Unidade encontrada','unidade' => $unidade]);
    }

    public function edit(Unidade $unidade)
    {
        //
    }
    
    /**
     * @OA\PUT(
     *     path="/api/unidade/{unid_id}",
     *     summary="Atualizar dados de uma Unidade",
     *     description="Editar os dados de uma Unidade através do (unid_id)",
     *     tags={"Unidades"},     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"unid_id", "unid_nome", "unid_sigla"},
     *             @OA\Property(property="unid_id", type="integer", example="1"),
     *             @OA\Property(property="unid_nome", type="string", example="Pirinópolis"),
     *             @OA\Property(property="unid_sigla", type="string", example="SIGLA")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Unidade atualizada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unidade atualizada com sucesso"),
     *             @OA\Property(property="unidade", type="object",
     *                 @OA\Property(property="unid_id", type="integer", example=1),
     *                 @OA\Property(property="unid_nome", type="string", example="Pirinópolis"),
     *                 @OA\Property(property="unid_sigla", type="string", example="MT")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição inválida"),
     *     @OA\Response(response=404, description="Unidade não encontrada"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function update(Request $request)
    {
        $unidade = Unidade::where('unid_id', $request->unid_id)->first();  

        if (!$unidade) {            
            return response()->json(['message' => 'Unidade não encontrada', 404]);
        }

        $validadeData = $request->validate([
            'unid_id' => 'required|integer',
            'unid_nome' => 'required|string',
            'unid_sigla' => 'required|string',
        ]);

        $unidade->update($validadeData);

        //return response()->json($unidade, 200);
        return response()->json(['message' => 'Unidade atualizada','unidade' => $unidade], 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/unidade/{unid_id}",
    *      summary="Exclui uma Unidade",
    *      description="Exclui uma Unidade através do (unid_id)",
    *      tags={"Unidades"},
    *     @OA\Parameter(
     *         name="unid_id",
     *         in="path",
     *         required=true,
     *         description="ID da Unidade",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Unidade excluída com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir a Unidade"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(Unidade $unidade)
    {
        $unidade->delete();
        return response()->json(null, 204);
    }
}
