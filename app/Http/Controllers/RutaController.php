<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Ruta;
use App\Models\Pedido;
use App\Models\Motorizado;
use App\Models\Distritos;
use App\Models\Pedido_seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $fecha = date('Y-m-d', strtotime('+1 day'));  
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
        $distritos = DB::table('pedidos')->join('destinatarios', 'pedidos.id', '=', 'destinatarios.pedido_id')
            ->join('distritos', 'destinatarios.distrito_id', '=', 'distritos.id')
            ->select('distritos.name','distritos.id', DB::raw('count(*) as total'))
            ->where('pedidos.seguimiento_id', 1)
            ->orWhere('pedidos.seguimiento_id', 2)
            ->groupBy('distritos.name','distritos.id')
            ->orderBy('distritos.name')
            ->get();
        // dd($distritos);
        $motorizados = Motorizado::where('status', true)->get();
        // $pedidos_asignados = [];

        return  view('ruta.index', compact('pedidos', 'distritos', 'motorizados'));
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
    public function show(Ruta $ruta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruta $ruta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruta $ruta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruta $ruta)
    {
        //
    }

    public function asignar(Request $request){

        $request->validate([
            'motorizado_id' => 'required',
            'distrito_id' => 'required',
            'cantidad_pedidos' => 'required'
        ]);

        $hoy = date('Y-m-d');

        $pedidos_libres = DB::table('pedidos')
        ->select('pedidos.id')
        ->join('destinatarios', 'pedidos.id', '=', 'destinatarios.pedido_id')
        ->join('distritos', 'distritos.id', '=', 'destinatarios.distrito_id')
        ->where(function ($query) {
            $query->where('pedidos.seguimiento_id', 1)
                ->orWhere('pedidos.seguimiento_id', 2);
        })
        ->where('distritos.id', $request->distrito_id)
        ->where('pedidos.fecha_entrega', '<=', $hoy)
        ->limit($request->cantidad_pedidos)
        ->get();

        foreach ($pedidos_libres as $pedido) {
            $pedido = Pedido::find($pedido->id);
            $pedido->motorizado_id = $request->motorizado_id;
            $pedido->seguimiento_id = 3;
            $pedido->fecha_asignado = date('Y-m-d H:i:s');
            $pedido->save();

            Pedido_seguimiento::create([
                'pedido_id' => $pedido->id,
                'user_id' => auth()->user()->id,
                'seguimiento_id' => 3,
                'observacion' => 'Pedido asignado a motorizado '.$request->motorizado_id.' por el usuario '.auth()->user()->name.' '.auth()->user()->lastname.'. Fecha: '.date('Y-m-d H:i:s')
            ]);
        }

        $pedidos_asignados = DB::table('pedidos')
        ->select('pedidos.id AS id', 'destinatarios.namefull as nombre', 'destinatarios.phone as tlf', 'distritos.name as distrito', 'pedidos.fecha_entrega as fecha')
        ->join('destinatarios', 'pedidos.id', '=', 'destinatarios.pedido_id')
        ->join('distritos', 'distritos.id', '=', 'destinatarios.distrito_id')
        ->where(function ($query) {
            $query->where('pedidos.seguimiento_id', 1)->orWhere('pedidos.seguimiento_id', 2)->orWhere('pedidos.seguimiento_id', 3);
        })
        ->where('distritos.id', $request->distrito_id)
        ->where('pedidos.motorizado_id', $request->motorizado_id)
        ->where('pedidos.fecha_entrega', '<=', $hoy)
        ->get();

        return response()->json([
            'pedidos_asignados' => $pedidos_asignados
        ]);

    }

    public function eliminarRuta(Request $request){

        $pedido = Pedido::find($request->id);
        $motorizado_antes = $pedido->motorizado_id;
        $pedido->motorizado_id = null;
        $pedido->seguimiento_id = 1;
        $pedido->save();

        Pedido_seguimiento::create([
            'pedido_id' => $request->id,
            'user_id' => auth()->user()->id,
            'seguimiento_id' => 1,
            'observacion' => 'Pedido eliminado de la ruta del motorizado '.$motorizado_antes.' por el usuario '.auth()->user()->name.' '.auth()->user()->lastname.'. Fecha: '.date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'status' => 'ok'
        ]);

    }

    public function pedidos_asignados(Request $request){
        $hoy = date('Y-m-d');
        $pedidos_asignados = DB::table('pedidos')
        ->select('pedidos.id AS id', 'destinatarios.namefull as nombre', 'destinatarios.phone as tlf', 'distritos.name as distrito', 'pedidos.fecha_entrega as fecha')
        ->join('destinatarios', 'pedidos.id', '=', 'destinatarios.pedido_id')
        ->join('distritos', 'distritos.id', '=', 'destinatarios.distrito_id')
        ->where(function ($query) {
            $query->where('pedidos.seguimiento_id', 1)->orWhere('pedidos.seguimiento_id', 2)->orWhere('pedidos.seguimiento_id', 3);
        })
        ->where('pedidos.motorizado_id', $request->id)
        ->where('pedidos.fecha_entrega', '<=', $hoy)
        ->get();

        return response()->json([
            'pedidos_asignados' => $pedidos_asignados
        ]);
    }

    public function asignarPedidos()
        {
            // Obtener la cantidad total de pedidos pendientes
            $totalPedidosPendientes = Pedido::whereIn('seguimiento_id', [1, 2, 3])->count();
            
            // Obtener la cantidad de motorizados activos
            $totalMotorizadosActivos = Motorizado::where('status', true)->count();
            
            // Obtener la lista de distritos con pedidos cargados
            $distritosConPedidos = DB::table('pedidos')->join('destinatarios', 'pedidos.id', '=', 'destinatarios.pedido_id')
            ->join('distritos', 'destinatarios.distrito_id', '=', 'distritos.id')
            ->select('distritos.id', DB::raw('count(*) as total'))
            ->where('pedidos.seguimiento_id', 1)
            ->groupBy('distritos.id')
            ->get();
            // $distritosConPedidos = $this->pedido->where('estado', 'pendiente')->select('distrito')->distinct()->get();
            // dd($distritosConPedidos);
            
            // Calcular la cantidad de pedidos por motorizado
            $pedidosPorMotorizado = $totalPedidosPendientes / $totalMotorizadosActivos;

            // dd($pedidosPorMotorizado);
            $motorizadosActivos = Motorizado::where('status', true)->get();
            // Recorrer los distritos con pedidos cargados
            foreach ($distritosConPedidos as $distrito) {
                // Recorrer los motorizados activos
                foreach ($motorizadosActivos as $motorizado) {
                    // Si el motorizado tiene una frecuencia de visita mayor a 0 para el distrito actual
                    if ($motorizado->frecuencia_distritos[$distrito->distrito] > 0) {
                        // Asignar un pedido al motorizado
                        $pedidos_asignados = Pedido::where('destinatarios.id_distrito', $distrito->distrito)->update(['motorizado_id' => $motorizado->id, 'seguimiento_id' => 3]);
                        // Incrementar la cantidad de pedidos asignados al motorizado
                        $motorizado->pedidos_asignados++;
                        $motorizado->save();

                        // Disminuir la cantidad de pedidos disponibles en 1
                        $pedidosPorMotorizado--;

                        // Si la cantidad de pedidos disponibles llega a 0, salir del bucle de motorizados
                        if ($pedidosPorMotorizado == 0) {
                            break;
                        }
                    }
                }
            }

            // Mostrar un mensaje de éxito
            return redirect()->back()->with('success', 'Pedidos asignados correctamente');
        }
}
