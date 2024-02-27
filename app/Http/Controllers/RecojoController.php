<?php

namespace App\Http\Controllers;

use App\Models\Recojo;
use App\Models\Motorizado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RecojoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hoy = date('Y-m-d');     
        $pedidos = DB::table('pedidos')
                    ->select('pedidos.id')
                    ->join('destinatarios', 'pedidos.id', '=', 'destinatarios.pedido_id')
                    ->join('distritos', 'distritos.id', '=', 'destinatarios.distrito_id')
                    ->where(function ($query) {
                        $query->where('pedidos.seguimiento_id', 1)
                            ->orWhere('pedidos.seguimiento_id', 2);
                    })
                    ->where('pedidos.fecha_entrega', '<=', $hoy)
                    ->get();
        $negocios = DB::table('negocios')->join('pedidos', 'negocios.id', '=', 'pedidos.negocio_id')
            ->join('distritos', 'negocios.distrito_id', '=', 'distritos.id')
            ->select('negocios.name as nombre','distritos.name as distrito', DB::raw('count(*) as total'))
            ->where('pedidos.seguimiento_id', 1)
            ->orWhere('pedidos.seguimiento_id', 2)
            ->groupBy('nombre','distrito')
            ->orderBy('nombre')
            ->get();

        $motorizados = Motorizado::with('distritos')->where('status', true)->get();
        return view('recojo.index', compact('pedidos', 'negocios', 'motorizados'));
    }

}
