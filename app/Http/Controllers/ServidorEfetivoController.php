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
    *      @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="name",
    *         required=false,
    *      ),
    *     @OA\Parameter(
    *         name="email",
    *         in="query",
    *         description="email",
    *         required=false,
    *      ),
    *     @OA\Parameter(
    *         name="page",
    *         in="query",
    *         description="Page Number",
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
            return response()->json("Pessoa não encontrada.", 204);
        }

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
    }

    
    public function show(ServidorEfetivo $servidorEfetivo)
    {
        $servidorEfetivo = ServidorEfetivo::where('pes_id', $servidorEfetivo->pes_id)->with('pessoa')->first();
        return response()->json($servidorEfetivo);
    }

    
    public function edit(ServidorEfetivo $servidorEfetivo)
    {
        //
    }
    
    
    public function update(Request $request, ServidorEfetivo $servidorEfetivo)
    {
        $validadeData = $request->validate([
            'pes_id' => 'required|integer',
            'se_matricula' => 'required|string',
        ]);

        $servidorEfetivo->update($validadeData);

        return response()->json($servidorEfetivo, 200);
    }

    public function destroy(ServidorEfetivo $servidorEfetivo)
    {
        $servidorEfetivo->delete();
        return response()->json(null, 204);
    }
}
