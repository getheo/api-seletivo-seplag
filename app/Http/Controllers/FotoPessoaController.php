<?php

namespace App\Http\Controllers;

use App\Models\FotoPessoa;
use Illuminate\Http\Request;

class FotoPessoaController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/foto-pessoa",
    *      summary="Mostra as Foto das Pessoas",
    *      description="Lista as fotos das pessoas",
    *      tags={"Fotos Pessoas"},
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
        $fotoPessoa = FotoPessoa::with('pessoa')->paginate(10);      
        return response()->json($fotoPessoa);
    }
    
    public function create()
    {
        //
    }
    
    /**
    *  @OA\POST(
    *      path="/api/foto-pessoa",
    *      summary="Cadastra uma nova Foto da Pessoa",
    *      description="Registro de uma nova Foto",
    *      tags={"Fotos Pessoas"},
    *      @OA\Parameter(
    *         name="fp_id",
    *         in="query",
    *         description="Nº de identifição da Foto",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="pes_id",
    *         in="query",
    *         description="Nº de identificação da Pessoa",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="fp_data",
    *         in="query",
    *         description="Data do cadastro da foto",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="fp_bucket",
    *         in="query",
    *         description="Identificação do Bucket da Foto",
    *         required=true,
    *      ),
    *     @OA\Parameter(
    *         name="fp_hash",
    *         in="query",
    *         description="Código de cadastro da Foto",
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
    *          description="Foto não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function store(Request $request)
    {
        $validadeData = $request->validate([
            'fp_id' => 'required|integer',
            'pes_id' => 'required|integer',
            'fp_data' => 'required|string',
            'fp_bucket' => 'required|string',
            'fp_hash' => 'required|string',
        ]);

        $fotoPessoa = FotoPessoa::create([            
            'fp_id' => $validadeData['fp_id'],
            'pes_id' => $validadeData['pes_id'],
            'fp_data' => $validadeData['fp_data'],
            'fp_bucket' => $validadeData['fp_bucket'],
            'fp_hash' => $validadeData['fp_hash'],
        ]);

        return response()->json($fotoPessoa, 201);
    }
    
    /**
    *  @OA\GET(
    *      path="/api/foto-pessoa/{fp_id}",
    *      summary="Mostra uma Foto",
    *      description="Pesquisa por uma foto através do (fp_id)",
    *      tags={"Fotos Pessoas"},
    *     @OA\Parameter(
     *         name="fp_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da foto",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Foto Encontrada",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Foto não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function show(string $fp_id)
    {
        $fotoPessoa = FotoPessoa::where('fp_id', $fp_id)->first();        

        if (!$fotoPessoa) {
            //return response('Não encontrado', 404)->json();
            return response()->json(['message' => 'Foto não encontrada', 404]);
        }
        return response()->json(['message' => 'Foto encontrada','foto' => $fotoPessoa]);
    }


    /**
    *  @OA\PUT(
    *      path="/api/foto-pessoa/{fp_id}",
    *      summary="Atualizar dados de uma Foto",
    *      description="Editar os dados de uma Foto através do (fp_id)",
    *      tags={"Fotos Pessoas"},
    *     @OA\Parameter(
     *         name="fp_id",
     *         in="path",
     *         required=true,
     *         description="Nº de identificação da Foto",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Dados da Foto atualizado com sucesso.",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Erro ao atualizar a Foto"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */    
    public function edit(FotoPessoa $fotoPessoa)
    {
        //
    }
    
    
    public function update(Request $request, FotoPessoa $fotoPessoa)
    {
        $validadeData = $request->validate([
            'fp_id' => 'required|integer',
            'pes_id' => 'required|integer',
            'fp_data' => 'required|string',
            'fp_bucket' => 'required|string',
            'fp_hash' => 'required|string',
        ]);

        $fotoPessoa->update($validadeData);

        return response()->json($fotoPessoa, 200);
    }

    /**
    *  @OA\DELETE(
    *      path="/api/foto-pessoa/{fp_id}",
    *      summary="Exclui uma Foto",
    *      description="Exclui uma Foto através do (fp_id)",
    *      tags={"Fotos Pessoas"},
    *     @OA\Parameter(
     *         name="fp_id",
     *         in="path",
     *         required=true,
     *         description="ID da Foto",
     *         @OA\Schema(type="integer", example=1)
     *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Foto excluída com sucesso",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Não foi possível excluir a Foto"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    public function destroy(FotoPessoa $fotoPessoa)
    {
        $fotoPessoa->delete();
        return response()->json(null, 204);
    }
}
