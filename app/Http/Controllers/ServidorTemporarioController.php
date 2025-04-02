<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\ServidorTemporario;
use Illuminate\Http\Request;

class ServidorTemporarioController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/servidor-temporario",
    *      summary="Servidores Temporários",
    *      description="Lista todos os Servidores Temporários ligados a sua Unidade-Lotação",
    *      tags={"Servidores Temporários"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Servidores temporários não encontrados"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */    
    public function index()
    {
        $servidorTemporario = ServidorTemporario::with('pessoa')->paginate(10);
        return response()->json($servidorTemporario);
    }

    
    public function create()
    {
        //
    }

    /**
    *  @OA\POST(
    *      path="/api/servidor-temporario",
    *      summary="Cadastra um Novo Servidor Temporário",
    *      description="Registro de um novo Servidor Temporário",
    *      tags={"Servidores Temporários"},
    *      @OA\Parameter(
    *         name="pes_id",
    *         in="query",
    *         description="Nº de identifição da Pessoa",
    *         required=true,
    *         @OA\Schema(type="integer", example=1)
    *      ),
    *      @OA\Parameter(
    *         name="st_data_admissao",
    *         in="query",
    *         description="Data de Admissão",
    *         required=true,
    *         @OA\Schema(type="date", example="2025-01-01")
    *      ),
    *      @OA\Parameter(
    *         name="st_data_demissao",
    *         in="query",
    *         description="Data de Demissão",
    *         required=true,
    *         @OA\Schema(type="date", example="2025-01-01")
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
    *          description="Erro no cadastro"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        // Necessario informar a Pessoa (pes_id) para cadastrar o Servidor Efetivo
        $pessoa = Pessoa::where('pes_id', $request->pes_id)->first();

        if($pessoa){

            $validadeData = $request->validate([
                'pes_id' => 'required|integer',
                'st_data_admissao' => 'required|date',
                'st_data_demissao' => 'required|date',
            ]);
    
            $servidorTemporario = ServidorTemporario::create([            
                'pes_id' => $validadeData['pes_id'],
                'st_data_admissao' => $validadeData['st_data_admissao'],
                'st_data_demissao' => $validadeData['st_data_demissao'],
            ]);
    
            return response()->json("Servidor Temporário cadastrado com sucesso.", 201);
            

        } else {
            return response()->json("Pessoa não encontrada.", 204);
        }
    }

    /**
    *  @OA\GET(
    *      path="/api/servidor-temporario/{pes_id}",
    *      summary="Mostra um Servidor Temporário",
    *      description="Pesquisa um Servidor Temporário através da Pessoa (pes_id)",
    *      tags={"Servidores Temporários"},
    *     @OA\Parameter(
     *         name="pes_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da Pessoa",
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
    public function show(ServidorTemporario $servidorTemporario)
    {
        $servidorTemporario = ServidorTemporario::where('pes_id', $servidorTemporario->pes_id)->with('pessoa')->first();
        return response()->json($servidorTemporario);
    }

    
    public function edit(ServidorTemporario $servidorTemporario)
    {
        //
    }

    /**
    *  @OA\PUT(
    *      path="/api/servidor-temporario/{pes_id}",
    *      summary="Atualiza os dados do Servidor Temporário",
    *      description="Edita os dados do Servidor Temporário através do (pes_id)",
    *      tags={"Servidores Temporários"},
    *      @OA\Parameter(
    *         name="st_data_admissao",
    *         in="path",
    *         required=true,
    *         description="Data de Admissão",
    *         @OA\Schema(type="date", example="2025-01-01")
    *      ),
    *      @OA\Parameter(
    *         name="st_data_demissao",
    *         in="path",
    *         required=true,
    *         description="Data de Demissão",
    *         @OA\Schema(type="date", example="2025-01-01")
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Dados atualizados do Servidor Efetivo.",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Erro ao atualizar os dados do Servidor Efetivo"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */ 
    public function update(Request $request, ServidorTemporario $servidorTemporario)
    {
        $validadeData = $request->validate([
            'st_data_admissao' => 'required|date',
            'st_data_demissao' => 'required|date',
        ]);

        $servidorTemporario->update($validadeData);

        return response()->json($servidorTemporario, 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/servidor-temporario/{pes_id}",
    *      summary="Exclui a informação do Servidor Temporário",
    *      description="Exclui a informação do Servidor Temporário (pes_id)",
    *      tags={"Servidores Temporários"},
    *     @OA\Parameter(
    *          name="pes_id",
    *          in="path",
    *          required=true,
    *          description="ID da Pessoa",
    *          @OA\Schema(type="integer", example=1)
    *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Informação excluído com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir a informação de servidor temporário."
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(ServidorTemporario $servidorTemporario)
    {
        $servidorTemporario->delete();
        return response()->json(null, 204);
    }
}
