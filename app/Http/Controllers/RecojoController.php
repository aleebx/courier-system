<?php

namespace App\Http\Controllers;

use App\Models\Recojo;
use App\Models\Motorizado;
use App\Models\Pedido;
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
        $negocios = DB::table('negocios')
        ->select('negocios.name as nombre', 'negocios.id as negocio_id', DB::raw('count(*) as total'))
        ->groupBy('nombre', 'courier_system.negocios.id') // Add 'courier_system.negocios.id' to GROUP BY
        ->addSelect(DB::raw('(SELECT distritos.name FROM distritos WHERE distritos.id = negocios.distrito_id) as distrito_nombre'))
        ->join('pedidos', 'negocios.id', '=', 'pedidos.negocio_id')
        ->where('pedidos.seguimiento_id', 1)
        ->orWhere('pedidos.seguimiento_id', 2)
        ->get();
        
        $motorizados = Motorizado::with('distritos')->where('status', true)->get();

        return view('recojo.index', compact('pedidos', 'negocios', 'motorizados'));
    }

    public function asignarRecojo(Request $request){

        dd($request->all());
        $validated = $request->validate([
            'negocio_id' => ['required', 'number', 'max:255'],
            'motorizado_id' => ['required', 'string', 'max:255'],
            'pedidos.*' => ['required', 'string', 'max:255']
        ]);
    }

}
