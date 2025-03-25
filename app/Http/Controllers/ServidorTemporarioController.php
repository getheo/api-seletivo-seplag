<?php

namespace App\Http\Controllers;

use App\Models\ServidorTemporario;
use Illuminate\Http\Request;

class ServidorTemporarioController extends Controller
{
    /**
     * Display a listing of the resource.
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
