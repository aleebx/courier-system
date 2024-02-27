<?php

namespace App\Http\Controllers;

use App\Models\Motorizado;
use App\Models\Pago;
use App\Models\Metodo_pago;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motorizados = Motorizado::where('status', true)->get();
        $metodos_pago = Metodo_pago::all();
        $hoy = date('Y-m-d');
        $pedidos = Pedido::with('negocio', 'motorizado', 'destinatario.distritos', 'pedido_seguimientos.seguimientos', 'pedido_detalles', 'pedido_pagos.metodo_pago', 'pedido_incidencias.incidencia')->where('fecha_asignado', 'like', '%'.$hoy.'%')->get();
        // dd($pedidos);
        return view('pago.index', compact('motorizados', 'pedidos', 'metodos_pago'));
    }

    public function obtenerPagos(Request $request)
    {
        
        $pagos = Pago::where('motorizado_id', $request->motorizado_id)->get();
        return response()->json($pagos);
    }

    public function motorizado(Request $request)
    {
        $hoy = $request->fecha_asignado;
        $metodos_pago = Metodo_pago::all();
        $pedidos = Pedido::with('negocio', 'user', 'destinatario.distritos', 'pedido_seguimientos.seguimientos', 'pedido_detalles', 'pedido_pagos.metodo_pago', 'pedido_incidencias.incidencia')->where('motorizado_id',$request->motorizado_id)->where('fecha_asignado', 'like', '%'.$hoy.'%')->get();
        $motorizado = Motorizado::find($request->motorizado_id);
        return view('pago.motorizado', compact('motorizado', 'pedidos', 'metodos_pago'));
    }

    public function consolidado()
    {
        $hoy = date('Y-m-d');
        $metodos_pago = Metodo_pago::all();
        $pedidos = Pedido::with('negocio', 'destinatario.distritos', 'motorizado' , 'pedido_seguimientos.seguimientos', 'pedido_detalles', 'pedido_pagos.metodo_pago')->where('fecha_asignado', 'like', '%'.$hoy.'%')->groupBy('motorizado_id','id')->get();
        // dd($pedidos);

        return view('pago.consolidado', compact('pedidos', 'metodos_pago'));
    }
}
