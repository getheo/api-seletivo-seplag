<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/endereco",
    *      summary="Mostra os Endereços cadastrados",
    *      description="Lista os Endereços",
    *      tags={"Endereços"},
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
        $endereco = Endereco::paginate(10);
        if(!$endereco)
        {
            return response('Não encontrado', 404)->json();
        }
        return response()->json(['message' => 'Endereços encontrados', 'endereco' => $endereco]);
    }
    
    public function create()
    {
        //
    }
    
    /**
    *  @OA\POST(
    *      path="/api/endereco",
    *      summary="Cadastra um novo Endereço",
    *      description="Registro de um novo Endereço",
    *      tags={"Endereços"},
    *      @OA\Parameter(
    *         name="end_id",
    *         in="query",
    *         description="Nº de identifição do Endereço",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="end_tipo_logradouro",
    *         in="query",
    *         description="Tipo logradouro",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="end_logradouro",
    *         in="query",
    *         description="Logradouro",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="end_numero",
    *         in="query",
    *         description="Número",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="end_bairro",
    *         in="query",
    *         description="Bairro",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="cid_id",
    *         in="query",
    *         description="Nº de identificação da Cidade",
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
    *          description="Endereço não encontrado"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        $validadeData = $request->validate([
            'end_id' => 'required|integer',
            'end_tipo_logradouro' => 'required|string',
            'end_logradouro' => 'required|string',
            'end_numero' => 'required|string',
            'end_bairro' => 'required|string',
            'cid_id' => 'required|integer',
        ]);

        // Verifica se já existe
        $endereco = Endereco::where('end_id', $request->end_id)->first();
        if(!$endereco){

            $endereco = Endereco::create([            
                'cid_id' => $validadeData['cid_id'],
                'cid_nome' => $validadeData['cid_nome'],
                'cid_uf' => $validadeData['cid_uf'],
            ]);
        }
        return response()->json(['message' => 'Endereço cadastrado com sucesso', 'endereco' => $endereco, 201]);
    }
    
    /**
    *  @OA\GET(
    *      path="/api/endereco/{end_id}",
    *      summary="Mostra um Endereco",
    *      description="Pesquisa por um Endereço através do (end_id)",
    *      tags={"Endereços"},
    *     @OA\Parameter(
     *         name="end_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação do Endereço",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Endereço Encontrado",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Endereço não encontrado"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function show(string $end_id)
    {
        $endereco = Endereco::where('end_id', $end_id)->first();        

        if (!$endereco) {            
            return response()->json(['message' => 'Endereço não encontrado', 404]);
        }
        return response()->json(['message' => 'Endereço encontrado','endereco' => $endereco]);
    }


    /**
    *  @OA\PUT(
    *      path="/api/endereco/{end_id}",
    *      summary="Atualizar dados de um Endereço",
    *      description="Editar os dados de um Endereço através do (end_id)",
    *      tags={"Endereços"},
    *     @OA\Parameter(
     *         name="end_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação do Endereço",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Dados do Endereço atualizado com sucesso.",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Erro ao atualizar o Endereço"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */    
    public function edit(Endereco $endereco)
    {
        //
    }
    
    
    public function update(Request $request, Endereco $endereco)
    {
        $validadeData = $request->validate([
            'end_id' => 'required|integer',
            'end_tipo_logradouro' => 'required|string',
            'end_logradouro' => 'required|string',
            'end_numero' => 'required|string',
            'end_bairro' => 'required|string',
            'cid_id' => 'required|integer',
        ]);

        $endereco->update($validadeData);

        return response()->json($endereco, 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/endereco/{end_id}",
    *      summary="Exclui um Endereço",
    *      description="Exclui um Endereço através do (end_id)",
    *      tags={"Endereços"},
    *     @OA\Parameter(
     *         name="end_id",
     *         in="path",
     *         required=true,
     *         description="ID do Endereço",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Endereço excluído com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir o Endereço"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(Endereco $endereco)
    {
        $endereco->delete();
        return response()->json(null, 204);
    }
}
