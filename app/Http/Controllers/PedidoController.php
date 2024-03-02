<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Pedido;
use App\Models\Pedido_detalle;
use App\Models\Pedido_pago;
use App\Models\Pedido_seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pedidos = Pedido::with('negocio', 'user',  'pedido_seguimientos.seguimientos', 'pedido_detalles','destinatario.distritos')->get();
        // dd($pedidos);
        return view('pedido.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $distritos = DB::table('distritos')->where('status', true)->orderBy('name', 'asc')->get();
        $negocios = DB::table('negocios')->where('user_id', auth()->user()->id)->get();
        $type_pedidos = DB::table('type_pedido')->where('status',true)->get();
        $metodos_pago = DB::table('metodo_pago')->where('status',true)->get();

        return view('pedido.addPedido', compact('distritos', 'negocios', 'type_pedidos', 'metodos_pago'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namefull' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'departamento_id' => ['required', 'string', 'max:255'],
            'provincia_id' => ['required', 'string', 'max:255'],
            'distrito_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'negocio_id' => ['required', 'string', 'max:255'],
            'type_pedido_id' => ['required', 'string', 'max:255'],
            'metodo_pago_id' => ['required', 'string', 'max:255'],            
            'monto_cobrar' => ['required', 'string', 'max:255'],
            'fecha_entrega' => ['required', 'date', 'max:255'],
            'detalle' => ['required', 'string', 'max:255'],
            'medida_largo' => ['required', 'numeric', 'max:255'],
            'medida_ancho' => ['required', 'numeric', 'max:255'],
            'medida_alto' => ['required', 'numeric', 'max:255'],
            'medida_peso' => ['required', 'numeric', 'max:255']
        ]);

        DB::transaction(function () use ($request) {
        $extra = array();
        $igv = $request->total2 - $request->servicio2 - $request->extra2;
        if ($request->pedido_pedido == 2) {
            $reutilizado =  array("reutilizado" => 2);
            array_push($extra, $reutilizado);
            $medida = $request->extra2 - 2;
        }
        if ($request->adiccional) {
                foreach ($request->adiccional as $key => $value) {
                    if ($value == 'igv') {
                        $igv = array("igv" => $igv);
                        array_push($extra, $igv);
                }
            }
        }
        if ($medida > 0){
            $pesoExtra = array("medidas_extra" => $medida);
            array_push($extra, $pesoExtra);
        }     

            $precioAdicional = json_encode($extra);
            $tarifa = DB::table('distritos')->where('id', $request->distrito_id)->first();

            $pedido = Pedido::create([
                'user_id' => auth()->user()->id,
                'negocio_id' => $request->negocio_id,
                'type_pedido_id' => $request->type_pedido_id,
                'seguimiento_id' => 1,
                'fecha_entrega' => $request->fecha_entrega,
                'servicio' => $tarifa->tarifa,
                'extra' => $precioAdicional,
                'reutilizado' => $request->reutilizado,
                'reagendado' => $request->reagendado
            ]);

            $lastInsertedId = $pedido->id;

            Destinatario::create([
                'pedido_id' => $lastInsertedId,
                'namefull' => $request->namefull,
                'phone' => $request->phone,
                'email' => $request->email,
                'departamento_id' => $request->departamento_id,
                'provincia_id' => $request->provincia_id,
                'distrito_id' => $request->distrito_id,
                'address' => $request->address
            ]);

            Pedido_seguimiento::create([
                'pedido_id' => $lastInsertedId,
                'user_id' => auth()->user()->id,
                'seguimiento_id' => 1,
                'observacion' => 'Pedido registrado correctamente'
            ]);

            Pedido_detalle::create([
                'pedido_id' => $lastInsertedId,
                'detalle' => $request->detalle,
                'monto_cobrar' => $request->monto_cobrar,
                'metodo_pago_id' => $request->metodo_pago_id,
                'observacion' => $request->observacion,
                'type_paquete' => $request->type_paquete,
                'medida_largo' => $request->medida_largo,
                'medida_ancho' => $request->medida_ancho,
                'medida_alto' => $request->medida_alto,
                'medida_peso' => $request->medida_peso
            ]);
        
        });

        $pedidos = Pedido::with('negocio', 'user', 'destinatario.distritos', 'pedido_seguimientos.seguimientos', 'pedido_detalles')->get();

        return redirect()->route('pedido.index', compact('pedidos'));


    }

    public function storeMax()
    {
        $distrito = 150103;
        $provincia  = '1501';
        $departamento = '15';
        // DB::transaction(function () {
            for($i = 1001; $i < 2000; $i++) {
                
            $tarifa = DB::table('distritos')->where('id', $distrito)->first();

            $pedido = Pedido::create([
                'user_id' => 1,
                'negocio_id' => 2,
                'type_pedido_id' => 1,
                'seguimiento_id' => 1, // '1' es el estado 'Registrado
                'fecha_entrega' => '2024-02-20',
                'servicio' => $tarifa->tarifa,
                'extra' => 0,
                'reutilizado' => null,
                'reagendado' => null
            ]);

            $lastInsertedId = $pedido->id;

            Destinatario::create([
                'pedido_id' => $lastInsertedId,
                'namefull' => 'destinatario'.$i,
                'phone' => '999999999'.$i,
                'email' => 'destinatario'.$i.'@gmail.com',
                'departamento_id' => $departamento,
                'provincia_id' => $provincia,
                'distrito_id' => $distrito,
                'address' => 'direccion entrega'.$i
            ]);

            Pedido_seguimiento::create([
                'pedido_id' => $lastInsertedId,
                'user_id' => 1,
                'seguimiento_id' => 1,
                'observacion' => 'Pedido registrado correctamente'
            ]);

            Pedido_detalle::create([
                'pedido_id' => $lastInsertedId,
                'detalle' => 'detalle pedido '.$i,
                'monto_cobrar' => 10,
                'metodo_pago_id' => 1,
                'observacion' => '',
                'type_paquete' => 1,
                'medida_largo' => 20,
                'medida_ancho' => 15,
                'medida_alto' => 30
            ]);
        }
        // });

        $pedidos = Pedido::with('negocio', 'user', 'destinatario.distritos', 'pedido_seguimientos.seguimientos', 'pedido_detalles')->get();

        return redirect()->route('pedido.index', compact('pedidos'));


    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
        $detalle = Pedido::with('negocio', 'user', 'destinatario', 'pedido_seguimientos.seguimientos', 'pedido_detalles')->where('id', $pedido->id)->first();
        $distritos = DB::table('distritos')->where('status', true)->orderBy('name', 'asc')->get();
        $negocios = DB::table('negocios')->where('user_id', auth()->user()->id)->get();
        $type_pedidos = DB::table('type_pedido')->where('status',true)->get();
        $metodos_pago = DB::table('metodo_pago')->where('status',true)->get();
        $reutilizado = false;
        if($detalle->reutilizado){
            $reutilizado = Pedido::with('destinatario', 'pedido_detalles')->where('id', $detalle->reutilizado)->first();
        }
        $reagendado = false;
        if($detalle->reagendado){            
            $reagendado = Pedido::with('destinatario', 'pedido_detalles')->where('id', $detalle->reagendado)->first();
        }

        return view('pedido.editPedido', compact('detalle', 'distritos', 'negocios', 'type_pedidos', 'metodos_pago', 'reutilizado', 'reagendado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'namefull' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'distrito_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'negocio_id' => ['required', 'string', 'max:255'],
            'type_pedido_id' => ['required', 'string', 'max:255'],
            'metodo_pago_id' => ['required', 'string', 'max:255'],            
            'monto_cobrar' => ['required', 'string', 'max:255'],
            'fecha_entrega' => ['required', 'date', 'max:255'],
            'detalle' => ['required', 'string', 'max:255'],
            'type_paquete' => ['required', 'string', 'max:255'],
            'medida_largo' => ['required', 'numeric', 'max:255'],
            'medida_ancho' => ['required', 'numeric', 'max:255'],
            'medida_alto' => ['required', 'numeric', 'max:255']
        ]);

        DB::transaction(function () use ($request , $pedido) {
        
        $tarifa = DB::table('distritos')->where('id', $request->distrito_id)->first();

        $pedido->update([
            'user_id' => auth()->user()->id,
            'negocio_id' => $request->negocio_id,
            'type_pedido_id' => $request->type_pedido_id,
            'fecha_entrega' => $request->fecha_entrega,
            'servicio' => $tarifa->tarifa,
            'extra' => 0
        ]);

        Destinatario::where('pedido_id', $pedido->id)->update([
            'namefull' => $request->namefull,
            'phone' => $request->phone,
            'email' => $request->email,
            'departamento_id' => $tarifa->departamento_id,
            'provincia_id' => $tarifa->provincia_id,
            'distrito_id' => $request->distrito_id,
            'address' => $request->address
        ]);

        Pedido_seguimiento::where('pedido_id', $pedido->id)->update([
            'user_id' => auth()->user()->id,
            'seguimiento_id' => 1,
            'observacion' => 'Pedido registrado correctamente'
        ]);

        Pedido_detalle::where('pedido_id', $pedido->id)->update([
            'detalle' => $request->detalle,
            'monto_cobrar' => $request->monto_cobrar,
            'metodo_pago_id' => $request->metodo_pago_id,
            'observacion' => $request->observacion,
            'type_paquete' => $request->type_paquete,
            'medida_largo' => $request->medida_largo,
            'medida_ancho' => $request->medida_ancho,
            'medida_alto' => $request->medida_alto
        ]);

    });

        return redirect()->back()->with('success', 'Pedido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        
        $pedido_seguimiento = Pedido_seguimiento::where('pedido_id', $pedido->id)->orderBy('created_at', 'desc')->get();
        if ($pedido_seguimiento[0]->seguimiento_id == 1) {
            Pedido_seguimiento::where('pedido_id', $pedido->id)->delete();
            Pedido_detalle::where('pedido_id', $pedido->id)->delete();
            Destinatario::where('pedido_id', $pedido->id)->delete();
            Pedido_pago::where('pedido_id', $pedido->id)->delete();
            $pedido->delete();
            return redirect()->back()->with('success', 'Pedido eliminado correctamente');
        } else {
            return redirect()->back()->with('error', 'El pedido no se puede eliminar');
        }


    }

    public function xcargamasiva()
    {
        //
        $distritos = DB::table('distritos')->where('status', true)->orderBy('name', 'asc')->get();
        $negocios = DB::table('negocios')->where('user_id', auth()->user()->id)->get();
        $type_pedidos = DB::table('type_pedido')->where('status',true)->get();
        $metodos_pago = DB::table('metodo_pago')->where('status',true)->get();

        return view('pedido.addPedidoMasivo', compact('negocios', 'type_pedidos', 'metodos_pago', 'distritos'));
    }

    public function guardar(Request $request)
    {
        $pedido = [];
        $des = [];
        $peds = [];
        $ped = [];
        DB::transaction(function () use ($request) {
            foreach ($request->namefull as $key => $value) {
                $extra = array();
        if ($request->namefull[$key] != null &&  $request->phone[$key] != null && $request->distrito_id[$key] != null && $request->address[$key] != null && $request->monto_cobrar[$key] != null && $request->detalle[$key] != null && $request->fecha_entrega[$key] != null && $request->medida_largo[$key] != null) { 
        $igv = $request->totalT[$key] - $request->servicioT[$key] - $request->extraT[$key];
        if (isset($request->adiccional[$key])) {
                foreach ($request->adiccional[$key] as $keyss => $val) {
                    if ($val == 'igv') {
                        $igv = array("igv" => $igv);
                        array_push($extra, $igv);
                }
            }
        }
        if ($request->extraT[$key] > 0){
            $pesoExtra = array("medidas_extra" => $request->extraT[$key]);
            array_push($extra, $pesoExtra);
        }     

        $precioAdicional = json_encode($extra);

            $tarifa = DB::table('distritos')->where('id', $request->distrito_id[$key])->first();
            $pedido = Pedido::create([
                'user_id' => auth()->user()->id,
                'negocio_id' => $request->negocio_id,
                'type_pedido_id' => $request->type_pedido_id[$key],
                'seguimiento_id' => 1, // '1' es el estado 'Registrado
                'fecha_entrega' => $request->fecha_entrega[$key],
                'servicio' => $tarifa->tarifa,
                'extra' => $precioAdicional
            ]);

            $lastInsertedId = $pedido->id;

            $des = Destinatario::create([
                'pedido_id' => $lastInsertedId,
                'namefull' => $request->namefull[$key],
                'phone' => $request->phone[$key],
                'email' => $request->email[$key],
                'departamento_id' => $request->departamento_id[$key],
                'provincia_id' => $request->provincia_id[$key],
                'distrito_id' => $request->distrito_id[$key],
                'address' => $request->address[$key]
            ]);

            $peds = Pedido_seguimiento::create([
                'pedido_id' => $lastInsertedId,
                'user_id' => auth()->user()->id,
                'seguimiento_id' => 1,
                'observacion' => 'Pedido registrado correctamente por carga masiva'
            ]);

            $ped = Pedido_detalle::create([
                'pedido_id' => $lastInsertedId,
                'detalle' => $request->detalle[$key],
                'monto_cobrar' => $request->monto_cobrar[$key],
                'metodo_pago_id' => $request->metodo_pago_id[$key],
                'observacion' => $request->observacion[$key],
                'type_paquete' => $request->type_paquete[$key],
                'medida_largo' => $request->medida_largo[$key],
                'medida_ancho' => $request->medida_ancho[$key],
                'medida_alto' => $request->medida_alto[$key],
                'medida_peso' => $request->medida_peso[$key]
            ]);

            unset($extra);
        } else {
            
        }
        }
    });
        // dd($pedido, $des, $peds, $ped);
        return redirect()->back()->with('success', 'Pedidos registrado correctamente por carga masiva');
    }

    public function obtenerTipoPedido()
    {
        $type_pedidos = DB::table('type_pedido')->where('status',true)->get();
        return response()->json($type_pedidos);
    }

    public function obtenerMetodoPago()
    {
        $metodos_pago = DB::table('metodo_pago')->where('status',true)->get();
        return response()->json($metodos_pago);
    }

    public function anular(Request $request)
    {   
        $user = User::find(auth()->user()->id);
        $pedido_seguimiento = Pedido_seguimiento::where('pedido_id', $request->pedido_id)->orderBy('created_at', 'desc')->get();
        
        if ($pedido_seguimiento[0]->seguimiento_id == 1 || $pedido_seguimiento[0]->seguimiento_id == 2 || $pedido_seguimiento[0]->seguimiento_id == 3 ) {         
            
            if ($user->hasRole('admin')) {
                Pedido::where('id', $request->pedido_id)->update(['seguimiento_id' => 6]);
                Pedido_seguimiento::create([
                    'pedido_id' => $request->pedido_id,
                    'user_id' => auth()->user()->id,
                    'seguimiento_id' => 6,
                    'observacion' => 'Pedido anulado por el administrador'
                ]);
            } else {
                Pedido::where('id', $request->pedido_id)->update(['seguimiento_id' => 6]);
                Pedido_seguimiento::create([
                    'pedido_id' => $request->pedido_id,
                    'user_id' => auth()->user()->id,
                    'seguimiento_id' => 5,
                    'observacion' => 'Pedido anulado por el negocio'
                ]);
            } 
            return redirect()->back()->with('anulado', 'Pedido anulado correctamente');
        } else {
            return redirect()->back()->with('anulado', 'El pedido no se puede anular');
        }
    }
    
    public function obtenerPedidos()
    {
        $id= auth()->user()->id;
        $pedidos = Pedido::with('negocio', 'user', 'destinatario', 'pedido_seguimientos', 'pedido_detalles')->whereHas('pedido_seguimientos', function ($query) {
            $query->whereIn('seguimiento_id', [5, 6, 7, 8, 9, 10, 11, 12, 13, 14]);
        })->get();
        
        return response()->json($pedidos);
    }

    public function obtenerPedido($id_pedido)
    {
        $pedido = Pedido::with('negocio', 'user', 'destinatario', 'pedido_seguimientos', 'pedido_detalles')->where('id', $id_pedido)->first();
        return response()->json($pedido);
    }

    public function obtenerPedidosNegocio($negocio_id)
    {
        $pedido = Pedido::with('negocio', 'user', 'destinatario', 'pedido_seguimientos', 'pedido_detalles')->where('negocio_id', $negocio_id)->whereIn('seguimiento_id',[1,2])->get();
        return response()->json($pedido);
    }

}
