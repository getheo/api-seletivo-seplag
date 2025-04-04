<?php

namespace App\Http\Controllers;

use App\Models\FotoPessoa;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FotoPessoaController extends Controller
{
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

    
    public function upload(Request $request)
    {
        $pessoa = Pessoa::findOrFail($request->pes_id);

        $fileName = Str::uuid() . '.' . $request->file->extension();

        $path = Storage::disk('s3')->put("fotos/{$fileName}", $request->file, 'public');
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
