<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\PessoaEndereco;
use App\Models\UnidadeEndereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/endereco",
    *      summary="Mostra os Endereços cadastrados",
    *      description="Lista todas os Endereços",
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
        $endereco = Endereco::with('cidade')->paginate(10);
        if(!$endereco)
        {
            return response('Não encontrado', 404)->json();
        }
        return response()->json(['message' => 'Endereços encontrados', 'endereco' => $endereco]);
    }
    
       
    /**
    *  @OA\GET(
    *      path="/api/endereco/{end_id}",
    *      summary="Mostra um Endereco",
    *      description="Pesquisa Endereço através do (end_id)",
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
        $endereco = Endereco::where('end_id', $end_id)->with('cidade')->first();        

        if (!$endereco) {            
            return response()->json(['message' => 'Endereço não encontrado', 404]);
        }
        return response()->json(['message' => 'Endereço encontrado','endereco' => $endereco]);
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
        $endereco = Endereco::where('end_tipo_logradouro', $request->end_tipo_logradouro)->first();

        if (!$endereco) {             

            $validadeData = $request->validate([                
                'end_tipo_logradouro' => 'required|string',
                'end_logradouro' => 'required|string',
                'end_numero' => 'required|string',
                'end_bairro' => 'required|string',
                'cid_id' => 'required|integer',
            ]);
    
            $endereco = Endereco::create([            
                'end_tipo_logradouro' => $validadeData['end_tipo_logradouro'],
                'end_logradouro' => $validadeData['end_logradouro'],
                'end_numero' => $validadeData['end_numero'],
                'end_bairro' => $validadeData['end_bairro'],
                'cid_id' => $validadeData['cid_id'],
            ]);
            
            return response()->json(['message' => 'Endereço cadastrado com sucesso.','endereco' => $endereco], 200);
        }

        return response()->json(['message' => 'Endereço com esse nome já cadastrado.', 404]);



    }    
    
    
    public function edit(Endereco $endereco)
    {
        //
    }
    
    /**
     * @OA\PUT(
     *     path="/api/endereco/{end_id}",
     *     summary="Atualizar dados de um Endereço",
     *     description="Editar os dados de um Endereço através do (end_id)",
     *     tags={"Endereços"},     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"end_tipo_logradouro", "end_logradouro", "end_numero", "end_bairro", "cid_id"},
     *             @OA\Property(property="end_id", type="integer", example="1"),
     *             @OA\Property(property="end_tipo_logradouro", type="string", example="Tipo Logradouro"),
     *             @OA\Property(property="end_logradouro", type="string", example="Logradouro"),
     *             @OA\Property(property="end_numero", type="integer", example="1"),
     *             @OA\Property(property="end_bairro", type="string", example="Bairro"),
     *             @OA\Property(property="cid_id", type="integer", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Endereco atualizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Endereço atualizado com sucesso"),
     *             @OA\Property(property="endereco", type="object",
     *             @OA\Property(property="end_id", type="integer", example="1"),
     *             @OA\Property(property="end_tipo_logradouro", type="string", example="Tipo Logradouro"),
     *             @OA\Property(property="end_logradouro", type="string", example="Logradouro"),
     *             @OA\Property(property="end_numero", type="integer", example="1"),
     *             @OA\Property(property="end_bairro", type="string", example="Bairro"),
     *             @OA\Property(property="cid_id", type="integer", example="1")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição inválida"),
     *     @OA\Response(response=404, description="Endereco não encontrado"),
     *     security={{"bearerAuth":{}}}
     * )
     */
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
    public function destroy(int $end_id)
    {
        $pessoaEndereco = PessoaEndereco::where('end_id', $end_id)->first();
        $unidadeEndereco = UnidadeEndereco::where('end_id', $end_id)->first();
        $endereco = Endereco::where('end_id', $end_id)->first();

        if(!$endereco){ 
            return response()->json(['message' => 'Endereço não encontrado.', 404]); 
        }
        if (!$pessoaEndereco) {
            return response()->json(['message' => 'Endereço não pode ser excluído pois existe vinculo com pessoa.', 404]);
        }
        if (!$unidadeEndereco) {
            return response()->json(['message' => 'Endereço não pode ser excluído pois existe vinculo com unidade.', 404]);
        }

        //$endereco->delete();
        //return response()->json(null, 204);
        return response()->json(['message' => 'Endereço excluído','endereco' => $endereco, 200]);
        
        
    }
}
