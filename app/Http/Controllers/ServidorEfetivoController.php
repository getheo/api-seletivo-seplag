<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\ServidorEfetivo;
use Illuminate\Http\Request;

class ServidorEfetivoController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/servidor-efetivo",
    *      summary="Servidores Efetivos",
    *      description="Lista todos os Servidores Efetivos ligados a sua Unidade-Lotação",
    *      tags={"Servidores Efetivos"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Servidores efetivos não encontrados"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function index()
    {
        $servidorEfetivo = ServidorEfetivo::with('pessoa')->paginate(10);
        return response()->json($servidorEfetivo, 200);        
    }
    
    public function create()
    {
        //
    }

    /**
    *  @OA\POST(
    *      path="/api/servidor-efetivo",
    *      summary="Cadastra um Novo Servidor Efetivo",
    *      description="Registro de uma nova Cidade",
    *      tags={"Servidores Efetivos"},
    *      @OA\Parameter(
    *         name="pes_id",
    *         in="query",
    *         description="Nº de identifição da Pessoa",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="se_matricula",
    *         in="query",
    *         description="Nº da matrícula",
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
                'se_matricula' => 'required|string',
            ]);
    
            $servidorEfetivo = ServidorEfetivo::create([            
                'pes_id' => $validadeData['pes_id'],
                'pes_nome' => $validadeData['se_matricula'],
            ]);
    
            return response()->json("Servidor Efetivo cadastrado com sucesso.", 201);
            

        } else {
            return response()->json("Pessoa não encontrada. Necessário informar a Pessoa.", 204);
        }

        /*
        $validadeData = $request->validate([
            'pes_id' => 'required|integer',
            'se_matricula' => 'required|string',
        ], [
            'pes_id' => 'Informe o ID da Pessoa',
            'se_matricula' => 'Informa a matrícula do servidor',
        ]);

        $servidorEfetivo = ServidorEfetivo::create([            
            'pes_id' => $validadeData['pes_id'],
            'se_matricula' => $validadeData['se_matricula'],
        ]);

        return response()->json($servidorEfetivo, 201);
        */
    }

    /**
    *  @OA\GET(
    *      path="/api/servidor-efetivo/{pes_id}",
    *      summary="Mostra um Servidor Efetivo",
    *      description="Pesquisa um Servidor Efetivo através da Pessoa (pes_id)",
    *      tags={"Servidores Efetivos"},
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
    public function show(ServidorEfetivo $servidorEfetivo)
    {
        $servidorEfetivo = ServidorEfetivo::where('pes_id', $servidorEfetivo->pes_id)->with('pessoa')->first();
        return response()->json($servidorEfetivo);
    }

    
    public function edit(ServidorEfetivo $servidorEfetivo)
    {
        //
    }
    
    /**
    *  @OA\PUT(
    *      path="/api/servidor-efetivo/{pes_id}",
    *      summary="Atualiza a matrícula um Servidor Efetivo",
    *      description="Edita a matrícula de um Servidor Efetivo (pes_id)",
    *      tags={"Servidores Efetivos"},
    *     @OA\Parameter(
     *         name="se_matricula",
     *         in="path",
     *         required=true,
     *         description="Nº da Matrícula do Servidor Efetivo",
     *         @OA\Schema(type="integer", example=1)
     *     ),
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
    public function update(Request $request, ServidorEfetivo $servidorEfetivo)
    {
        $validadeData = $request->validate([
            'pes_id' => 'required|integer',
            'se_matricula' => 'required|string',
        ]);

        $servidorEfetivo->update($validadeData);

        return response()->json($servidorEfetivo, 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/servidor-efetivo/{pes_id}",
    *      summary="Exclui a informação do Servidor Efetivo",
    *      description="Exclui a informação do Servidor Efetivo (pes_id)",
    *      tags={"Servidores Efetivos"},
    *     @OA\Parameter(
     *         name="pes_id",
     *         in="path",
     *         required=true,
     *         description="ID da Pessoa",
     *         @OA\Schema(type="integer", example=1)
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
    *          description="Não foi possível excluir a informação de servidor efetivo."
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(ServidorEfetivo $servidorEfetivo)
    {
        $servidorEfetivo->delete();
        return response()->json(null, 204);
    }
}
