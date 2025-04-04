<?php

namespace App\Http\Controllers;

use App\Models\FotoPessoa;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FotoPessoaController extends Controller
{
    
    public function index()
    {
        // Mostra todas as fotos de cada pessoa
        $fotoPessoa = FotoPessoa::with('pessoa')->paginate(10);      
        return response()->json($fotoPessoa);
        
    }
    
    public function create()
    {
        //
    }
    
    
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
    
    
    public function show(string $fp_id)
    {
        $fotoPessoa = FotoPessoa::where('fp_id', $fp_id)->first();        

        if (!$fotoPessoa) {
            //return response('Não encontrado', 404)->json();
            return response()->json(['message' => 'Foto não encontrada', 404]);
        }
        return response()->json(['message' => 'Foto encontrada','foto' => $fotoPessoa]);
    }


     
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

    
    public function destroy(FotoPessoa $fotoPessoa)
    {
        $fotoPessoa->delete();
        return response()->json(null, 204);
    }

    /**
     * Upload de Arquivo
     *
     * @OA\POST(
     *     path="/api/foto-pessoa",
     *     summary="Faz o upload de um arquivo",
     *     tags={"Foto Upload"},
     *     @OA\Parameter(
     *         name="pes_id",
     *         in="query",
     *         description="Nº de identificação da Pessoa",
     *         required=true,
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Arquivo enviado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="file_path", type="string")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Erro no upload"),
     *     security={{"bearerAuth":{}}}
     * )
     */

    
    public function upload(Request $request, $pes_id)
    {
        $pessoa = Pessoa::findOrFail($pes_id);

        $fileName = Str::uuid() . '.' . $request->foto->extension();

        $path = Storage::disk('s3')->put("fotos/{$fileName}", $request->foto, 'public');
        $foto = FotoPessoa::create([
            'pes_id' => $pessoa->pes_id,
            'fp_bucket' => env('AWS_BUCKET'),
            'fp_hash' => $fileName,
            'fp_data' => now(),
        ]);

        return response()->json([
            'message' => 'Foto enviada com sucesso!',
            'foto_url' => Storage::disk('s3')->url($path),
        ]);
    }
}
