<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/cidade",
    *      summary="Mostra as Cidades cadastradas",
    *      description="Lista todas as Cidades",
    *      tags={"Cidades"},
    *     @OA\Parameter(
    *         name="page",
    *         in="query",
    *         description="Nº da página",
    *         required=false,
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function index()
    {
        $cidade = Cidade::paginate(10);
        if (!$cidade) {            
            return response()->json(['message' => 'Cidades não encontradas', 404]);
        }
        return response()->json(['message' => 'Cidades encontradas','cidade' => $cidade]);
    }
    
        
    /**
    *  @OA\GET(
    *      path="/api/cidade/{cid_id}",
    *      summary="Mostra uma Cidade",
    *      description="Pesquisa por uma cidade através do (cid_id)",
    *      tags={"Cidades"},
    *     @OA\Parameter(
     *         name="cid_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da cidade",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Cidade Encontrada",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Cidade não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function show(int $cid_id)
    {
        $cidade = Cidade::where('cid_id', $cid_id)->first();        

        if (!$cidade) {            
            return response()->json(['message' => 'Cidade não encontrada', 404]);
        }
        return response()->json(['message' => 'Cidade encontrada','cidade' => $cidade]);
    }

    public function create()
    {
        //
    }
    
    /**
    *  @OA\POST(
    *      path="/api/cidade",
    *      summary="Cadastra uma nova Cidade",
    *      description="Registro de uma nova Cidade",
    *      tags={"Cidades"},
    *     @OA\Parameter(
    *         name="cid_nome",
    *         in="query",
    *         description="Nome da cidade",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="cid_uf",
    *         in="query",
    *         description="UF",
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
    *          description="Cidade não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        // Verifica ultimo ID da Cidade (problemas com increments)
        $cidade = Cidade::where('cid_nome', $request->cid_nome)->first();

        if(!$cidade){

            $validadeData = $request->validate([            
                'cid_nome' => 'required|string',
                'cid_uf' => 'required|string',
            ]);
    
            $cidade = Cidade::create([                  
                'cid_nome' => $validadeData['cid_nome'],
                'cid_uf' => $validadeData['cid_uf'],
            ]);
    
            return response()->json($cidade, 201);
        }
        return response()->json(['message' => 'Cidade já cadastrada', 404]);
    }
    
    
    public function edit(Cidade $cidade)
    {
        //
    }


    /**
     * @OA\PUT(
     *     path="/api/cidade/{cid_id}",
     *     summary="Atualiza Cidade",
     *     description="Atualiza os dados de uma Cidade",
     *     tags={"Cidades"},     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cid_id", "cid_nome", "cid_uf"},
     *             @OA\Property(property="cid_id", type="integer", example="1"),
     *             @OA\Property(property="cid_nome", type="string", example="Pirinópolis"),
     *             @OA\Property(property="cid_uf", type="string", example="MT")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cidade atualizada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Cidade atualizada com sucesso"),
     *             @OA\Property(property="cidade", type="object",
     *                 @OA\Property(property="cid_id", type="integer", example=1),
     *                 @OA\Property(property="cid_nome", type="string", example="Pirinópolis"),
     *                 @OA\Property(property="cid_uf", type="string", example="MT")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição inválida"),
     *     @OA\Response(response=404, description="Cidade não encontrado"),
     *     security={{"bearerAuth":{}}}
     * )
     */   
    public function update(Request $request)
    {
        $cidade = Cidade::where('cid_id', $request->cid_id)->first();        

        if (!$cidade) {            
            return response()->json(['message' => 'Cidade não encontrada', 404]);
        }        

        $validadeData = $request->validate([
            'cid_id' => 'required|integer',
            'cid_nome' => 'required|string',
            'cid_uf' => 'required|string',
        ]);

        $cidade->update($validadeData);

        //return response()->json($cidade, 200);
        return response()->json(['message' => 'Cidade atualizada','cidade' => $cidade], 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/cidade/{cid_id}",
    *      summary="Exclui uma Cidade",
    *      description="Exclui uma Cidde através do (cid_id)",
    *      tags={"Cidades"},
    *     @OA\Parameter(
     *         name="cid_id",
     *         in="path",
     *         required=true,
     *         description="ID da Cidade",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Cidade excluída com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir a Cidade"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(int $cid_id)
    {
        $cidade = Cidade::where('cid_id', $cid_id)->first();        

        if (!$cidade) {            
            return response()->json(['message' => 'Cidade não encontrada', 404]);
        }        
        $cidade->delete();
        //return response()->json(null, 204);
        return response()->json(['message' => 'Cidade Excluída','cidade' => $cidade]);

    }
}

