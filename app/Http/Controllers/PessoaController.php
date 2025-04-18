<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\PessoaEndereco;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/pessoa",
    *      summary="Todas as Pessoas",
    *      description="Lista todas as Pessoas com seu endereço",
    *      tags={"Pessoas"},
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
        $pessoa = Pessoa::with(['pessoaEndereco', 'pessoaFoto'])->paginate(10);
        return response()->json($pessoa);
    }
    
        
    /**
    *  @OA\GET(
    *      path="/api/pessoa/{pes_id}",
    *      summary="Mostra uma Pessoa",
    *      description="Pesquisa por uma pessoa através do (pes_id)",
    *      tags={"Pessoas"},
    *     @OA\Parameter(
     *         name="pes_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da pessoa",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Pessoa Encontrada",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Pessoa não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function show(string $pes_id)
    {
        $pessoa = Pessoa::where('pes_id', $pes_id)->with(['pessoaEndereco', 'pessoaFoto'])->first();        

        if (!$pessoa) {
            //return response('Não encontrado', 404)->json();
            return response()->json(['message' => 'Pessoa não encontrada', 404]);
        }
        return response()->json(['message' => 'Pessoa encontrada','pessoa' => $pessoa]);
    }

    public function create()
    {
        //
    }
    
    /**
    *  @OA\POST(
    *      path="/api/pessoa",
    *      summary="Cadastra nova Pessoa",
    *      description="Registra uma nova Pessoa",
    *      tags={"Pessoas"},
    *     @OA\Parameter(
    *         name="pes_nome",
    *         in="query",
    *         description="Nome",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="pes_data_nascimento",
    *         in="query",
    *         description="Data Nascimento",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="pes_sexo",
    *         in="query",
    *         description="Sexo (M / F)",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="pes_mae",
    *         in="query",
    *         description="Nome da Mãe",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="pes_pai",
    *         in="query",
    *         description="Nome do Pai",
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
    *          description="Pessoa não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        $pessoa = Pessoa::where('pes_nome', $request->pes_nome)->first();  

        if (!$pessoa) {             

            $validadeData = $request->validate([            
                'pes_nome' => 'required|string',
                'pes_data_nascimento' => 'required|string',
                'pes_sexo' => 'required|string',
                'pes_mae' => 'required|string',
                'pes_pai' => 'required|string',
            ]);
    
            $pessoa = Pessoa::create([            
                'pes_nome' => $validadeData['pes_nome'],
                'pes_data_nascimento' => $validadeData['pes_data_nascimento'],
                'pes_sexo' => $validadeData['pes_sexo'],
                'pes_mae' => $validadeData['pes_mae'],
                'pes_pai' => $validadeData['pes_pai'],
            ]);
            
            return response()->json(['message' => 'Pessoa cadastrada com sucesso.','pessoa' => $pessoa], 200);
        }

        return response()->json(['message' => 'Pessoa com esse nome já cadastrada.', 404]);
    }


    /**
    *  @OA\PUT(
    *      path="/api/pessoa/{pes_id}",
    *      summary="Atualizar dados de uma Pessoa",
    *      description="Editar os dados de uma pessoa através do (pes_id)",
    *      tags={"Pessoas"},
    *     @OA\Parameter(
     *         name="pes_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da pessoa",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Dados da Pessoa atualizado com sucesso.",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Erro ao atualizar a Pessoa"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */   
    
    /**
     * @OA\PUT(
     *     path="/api/pessoa/{pes_id}",
     *     summary="Atualizar dados de uma Pessoa",
     *     description="Editar os dados de uma pessoa através do (pes_id)",
     *     tags={"Pessoas"},     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"pes_id", "pes_nome", "pes_data_nascimento", "pes_sexo", "pes_mae", "pes_pai"},
     *             @OA\Property(property="pes_id", type="integer", example="1"),
     *             @OA\Property(property="pes_nome", type="string", example="Nome pessoa"),
     *             @OA\Property(property="pes_data_nascimento", type="string", example="2020-10-10"),
     *             @OA\Property(property="pes_sexo", type="string", example="M"),
     *             @OA\Property(property="pes_mae", type="string", example="Mae Pessoa"),
     *             @OA\Property(property="pes_pai", type="string", example="Pai Pessoa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pessoa atualizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Endereço atualizado com sucesso"),
     *             @OA\Property(property="pessoa", type="object",
     *             @OA\Property(property="pes_id", type="integer", example="1"),
     *             @OA\Property(property="pes_nome", type="string", example="Nome Pessoa"),
     *             @OA\Property(property="pes_data_nascimento", type="string", example="2020-01-01"),
     *             @OA\Property(property="pes_sexo", type="string", example="M"),
     *             @OA\Property(property="pes_mae", type="string", example="Mae Pessoa"),
     *             @OA\Property(property="pes_pai", type="string", example="Pai Pessoa")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição inválida"),
     *     @OA\Response(response=404, description="Endereco não encontrado"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function edit(Pessoa $pessoa)
    {
        //
    }
    
    
    public function update(Request $request, Pessoa $pessoa)
    {
        $validadeData = $request->validate([
            'pes_id' => 'required|integer',
            'pes_nome' => 'required|string',
            'pes_data_nascimento' => 'required|string',
            'pes_sexo' => 'required|string',
            'pes_mae' => 'required|string',
            'pes_pai' => 'required|string',
        ]);

        $pessoa->update($validadeData);

        return response()->json($pessoa, 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/pessoa/{pes_id}",
    *      summary="Exclui uma Pessoa",
    *      description="Exclui uma pessoa através do (pes_id)",
    *      tags={"Pessoas"},
    *     @OA\Parameter(
     *         name="pes_id",
     *         in="path",
     *         required=true,
     *         description="ID da pessoa",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Pessoa excluída com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir a pessoa"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return response()->json(null, 204);
    }
}
