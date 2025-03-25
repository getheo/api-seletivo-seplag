<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\PessoaEndereco;
use Illuminate\Http\Request;

class PessoaController extends Controller
{    
    public function index()
    {
        /**
        *  @OA\GET(
        *      path="/api/pessoas",
        *      summary="Lista todas as Pessoas",
        *      description="Lista todas as Pessoas",
        *      tags={"Pessoas"},
        *
        *  )
        */

        $pessoa = Pessoa::all();        
        return response()->json($pessoa);   
        
        return response()->json([
            'message' => 'Welcome to the API',
            'data' => $pessoa
          ]);
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        $validadeData = $request->validate([
            'pes_id' => 'required|integer',
            'pes_nome' => 'required|string',
            'pes_data_nascimento' => 'required|string',
            'pes_sexo' => 'required|string',
            'pes_mae' => 'required|string',
            'pes_pai' => 'required|string',
        ]);

        $pessoa = Pessoa::create([            
            'pes_id' => $validadeData['pes_id'],
            'pes_nome' => $validadeData['pes_nome'],
            'pes_data_nascimento' => $validadeData['pes_data_nascimento'],
            'pes_sexo' => $validadeData['pes_sexo'],
            'pes_mae' => $validadeData['pes_mae'],
            'pes_pai' => $validadeData['pes_pai'],
        ]);

        return response()->json($pessoa, 201);
    }

    
    public function show(Pessoa $pessoa)
    {
        $pessoa = Pessoa::where('pes_id', $pessoa->pes_id)->with('pessoaEndereco')->first();
        return response()->json($pessoa);
    }

    
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

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return response()->json(null, 204);
    }
}
