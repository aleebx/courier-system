<?php

namespace App\Http\Controllers;

use App\Models\Distritos;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistritosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Distritos $distritos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distritos $distritos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distritos $distritos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distritos $distritos)
    {
        //
    }

    public function obtenerProvincia($departamento_id)
    {
        $provincias = DB::table('provincias')
            ->where('departamento_id', $departamento_id)->where('status', true)
            ->get();
        return response()->json($provincias);
    }

    public function obtenerDistrito($provincia_id)
    {
        $distritos = DB::table('distritos')
            ->where('provincia_id', $provincia_id)->where('status', true)
            ->get();
        return response()->json($distritos);
    }

}
