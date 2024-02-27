<?php

namespace App\Http\Controllers;

use App\Models\Pedido_incidencia;
use App\Models\Pedido;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    //
    public function incidencias()
    {
        $pedidos = Pedido::whereHas('pedido_incidencias.incidencia', function ($query) {
            $query->where('status', 1);
        })->get();

        return view('coordinador.incidencias', compact('pedidos'));
    }
}
