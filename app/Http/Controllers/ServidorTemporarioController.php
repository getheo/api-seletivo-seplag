<?php

namespace App\Http\Controllers;

use App\Models\ServidorTemporario;
use Illuminate\Http\Request;

class ServidorTemporarioController extends Controller
{
    /**
    *  @OA\GET(
    *      path="/api/servidor-temporario",
    *      summary="Servidores Temporários",
    *      description="Lista todos os Servidores Temporários ligados a sua Unidade/Lotação",
    *      tags={"Servidores Temporários"},
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
    *         description="Nº de páginas",
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
    *          description="Pessoa não encontrada"
    *      ),
    *      security={{"bearerAuth":{}}}
    *  )
    */
    
    public function index()
    {
        $servidorTemporario = ServidorTemporario::all();
        return response()->json($servidorTemporario);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ServidorTemporario $servidorTemporario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServidorTemporario $servidorTemporario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServidorTemporario $servidorTemporario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServidorTemporario $servidorTemporario)
    {
        //
    }
}
