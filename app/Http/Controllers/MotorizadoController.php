<?php

namespace App\Http\Controllers;

use App\Models\Motorizado;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Pedido_detalle;
use App\Models\Pedido_pago;
use App\Models\Pedido_seguimiento;
use App\Models\Pedido_incidencia;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;

class MotorizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motorizados = Motorizado::with('user')->latest()->get();
        return view('moto.index', ['motorizados' => $motorizados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $type_documents = DB::table('type_document')->get();
        $departamentos = DB::table('departamentos')->where('status', true)->get();
        $provincias = DB::table('provincias')->where('status', true)->get();
        $distritos = DB::table('distritos')->where('status', true)->get();

        return view('moto.addMoto', compact('type_documents', 'departamentos', 'provincias', 'distritos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:255'],
            'namefull' => ['required', 'string', 'max:255'],
            'type_document' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:255'],
            'departamento_id' => ['required', 'string', 'max:255'],
            'provincia_id' => ['required', 'string', 'max:255'],
            'distrito_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'photo_license' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'photo_soat' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'photo_document' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $name_photo = '';
        $name_photo_license = '';
        $name_photo_soat = '';
        $name_photo_document = '';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->phone),
        ]);

        $lastInsertedId = $user->id;

        $motorizado = Motorizado::create([
            'user_id' => $lastInsertedId,
            'namefull' => $request->namefull,
            'phone' => $request->phone,
            'status' => 1,
            'type_document' => $request->type_document,
            'document' => $request->document,
            'departamento_id' => $request->departamento_id,
            'provincia_id' => $request->provincia_id,
            'distrito_id' => $request->distrito_id,
            'address' => $request->address,
            'placa' => $request->placa,
            'color' => $request->color,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'license_expiration' => $request->license_expiration,
            'soat_expiration' => $request->soat_expiration,
        ]);

        $lastInsertedIdMoto = $motorizado->id;
        $motorizado = Motorizado::find($lastInsertedIdMoto);
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name_photo = 'perfil_'.$lastInsertedIdMoto.'.'.$file->extension();
            $file->move(public_path().'/images/motorizado/', $name_photo);
        }

        if ($request->hasFile('photo_license')) {
            $file = $request->file('photo_license');
            $name_photo_license = 'license_'.$lastInsertedIdMoto.'.'.$file->extension();
            $file->move(public_path().'/images/motorizado/', $name_photo_license);
        }

        if ($request->hasFile('photo_soat')) {
            $file = $request->file('photo_soat');
            $name_photo_soat = 'soa_'.$lastInsertedIdMoto.'.'.$file->extension();
            $file->move(public_path().'/images/motorizado/', $name_photo_soat);
        }

        if ($request->hasFile('photo_document')) {
            $file = $request->file('photo_document');
            $name_photo_document = 'document_'.$lastInsertedIdMoto.'.'.$file->extension();
            $file->move(public_path().'/images/motorizado/', $name_photo_document);
        }

        $motorizado->update([
        'photo_document' => $name_photo_document,
        'photo' => $name_photo,
        'photo_license' => $name_photo_license,
        'photo_soat' => $name_photo_soat,
        ]);

        event(new Registered($user));

        $user->assignRole('motorizado');

        $motorizados = Motorizado::all();

        return redirect()->route('moto.index', compact('motorizados'));
    }

    public function storeMax()
    {

        for($i = 0; $i < 60; $i++){    

        $user = User::create([
            'name' => 'motorizado'.$i,
            'email' => 'motorizado'.$i.'@gmail.com',
            'password' => Hash::make('motorizado'.$i),
        ]);

        $lastInsertedId = $user->id;

        $motorizado = Motorizado::create([
            'user_id' => $lastInsertedId,
            'namefull' => 'motorizado'.$i,
            'phone' => '9865856'.$i,
            'status' => 1,
            'type_document' => 1,
            'document' => '485156'.$i,
            'departamento_id' => '15',
            'provincia_id' => '1501',
            'distrito_id' => '150101',
            'address' => 'Direccion del motorizado'.$i,
            'placa' => 'placa'.$i,
            'color' => 'color'.$i,
            'brand' => 'brand'.$i,
            'model' => 'model'.$i,
            'year' => '2021',
            'license_expiration' => '2021-12-31',
            'soat_expiration' => '2021-12-31'
        ]);

        $lastInsertedIdMoto = $motorizado->id;
        $motorizado = Motorizado::find($lastInsertedIdMoto);

        event(new Registered($user));

        $user->assignRole('motorizado');

        }

        $motorizados = Motorizado::all();

        return view('moto.index', compact('motorizados'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Motorizado $motorizado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motorizado $motorizado)
    {
        // dd($motorizado);
        return view('moto.editMoto', compact('motorizado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motorizado $motorizado)
    {
        //
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:255'],
            'namefull' => ['required', 'string', 'max:255'],
            'type_document' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:255'],
            'departamento_id' => ['required', 'string', 'max:255'],
            'provincia_id' => ['required', 'string', 'max:255'],
            'distrito_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $motorizado->update([
            'namefull' => $request->namefull,
            'phone' => $request->phone,
            'type_document' => $request->type_document,
            'document' => $request->document,
            'departamento_id' => $request->departamento_id,
            'provincia_id' => $request->provincia_id,
            'distrito_id' => $request->distrito_id,
            'address' => $request->address,
            'placa' => $request->placa,
            'color' => $request->color,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'license_expiration' => $request->license_expiration,
            'soat_expiration' => $request->soat_expiration,
        ]);

        $motorizados = Motorizado::all();

        return redirect()->route('moto.index', compact('motorizados'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motorizado $motorizado)
    {
        //
        $user = User::find($motorizado->user_id);
        $user->delete();
        $motorizado->delete();    
        $motorizados = Motorizado::all();
        return redirect()->route('moto.index', compact('motorizados'));
    }

    public function pedidos()
    {
        $motorizado = Motorizado::where('user_id', auth()->user()->id)->first();
        $metodos_pago = DB::table('metodo_pago')->where('status',true)->get();
        $incidencias = DB::table('incidencias')->where('status',true)->get();
        $motorizados = Motorizado::where('status', true)->get();
        if ($motorizado) {
            $pedidos = Pedido::with('negocio', 'user', 'destinatario.distritos', 'pedido_seguimientos.seguimientos', 'pedido_detalles', 'pedido_pagos.metodo_pago', 'pedido_incidencias.incidencia')->where('motorizado_id', $motorizado->id)->get();
            return view('moto.pedidoMoto', compact('pedidos', 'metodos_pago','incidencias','motorizados'));
        }else{
            $pedidos = [];
            return view('moto.pedidoMoto', compact('pedidos', 'metodos_pago','incidencias','motorizados'));
        }
    }

    public function entregado(Request $request)
    {
        
       $request->validate([
            'pedido_id' => 'required',
            'metodo_pago_id.*' => 'required',
            'monto_cobrar.*' => 'required',
            'observacion' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $name_photo = '';
            
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name_photo = 'pedido_'.$request->pedido_id.'.'.$file->extension();
            $file->move(public_path().'/images/pedidos/', $name_photo);
        }        

        foreach ($request->monto_cobrar as $key => $value) {
            if ($value > 0) {
                Pedido_pago::create([
                    'pedido_id' => $request->pedido_id,
                    'metodo_pago_id' => $request->metodo_pago_id[$key],
                    'monto' => $value,
                    'status' => 1,
                ]);
            }
        }

        Pedido::find($request->pedido_id)->update([
            'seguimiento_id' => 4,
        ]);

        Pedido_seguimiento::create([
            'pedido_id' => $request->pedido_id,
            'user_id' => auth()->user()->id,
            'seguimiento_id' => 4,
            'observacion' => $request->observacion
        ]);
        $detalle = Pedido_detalle::where('pedido_id', $request->pedido_id)->first();
        $detalle->update([
            'photo' => $name_photo,
        ]);

        return redirect()->route('moto.pedidos');
    }

    public function rechazado(Request $request)
    {
    //    dd($request->all());
        $request->validate([
            'pedido_id' => 'required',
            'observacion' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $name_photo = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name_photo = 'pedido_'.$request->pedido_id.'.'.$file->extension();
            $file->move(public_path().'/images/pedidos/', $name_photo);
        }        

        if ($request->monto_cobrar){
            foreach ($request->monto_cobrar as $key => $value) {
                if ($value > 0) {
                    Pedido_pago::create([
                        'pedido_id' => $request->pedido_id,
                        'metodo_pago_id' => $request->metodo_pago_id[$key],
                        'monto' => $value,
                        'status' => 2,
                    ]);
                }
            }           
        }

        Pedido::find($request->pedido_id)->update([
            'seguimiento_id' => 15,
        ]);

        Pedido_seguimiento::create([
            'pedido_id' => $request->pedido_id,
            'user_id' => auth()->user()->id,
            'seguimiento_id' => 15,
            'observacion' => $request->observacion
        ]);

        $detalle = Pedido_detalle::where('pedido_id', $request->pedido_id)->first();
        $detalle->update([
            'photo' => $name_photo,
        ]);

        return redirect()->route('moto.pedidos');
    }

    public function reiniciar(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required'
        ]);

        $ped_seguimiento = Pedido_seguimiento::where('pedido_id', $request->pedido_id)->latest()->first();
        $pago = Pedido_pago::where('pedido_id', $request->pedido_id)->get();
        $detalle = Pedido_detalle::where('pedido_id', $request->pedido_id)->first();
        
        $eliminarPhoto = public_path('images/pedidos/'.$detalle->photo);
        if (Storage::exists($eliminarPhoto)) {
            Storage::delete($eliminarPhoto);
          }
          
          // dd($ped_seguimiento);
        if ($ped_seguimiento) {
            $ped_seguimiento->delete();
        }
        if ($pago) 
        {
            foreach ($pago as $key => $pago) {
                $pago->delete();
            }
        }
        $seguimiento = Pedido_seguimiento::where('pedido_id', $request->pedido_id)->latest()->first();
        Pedido::find($request->pedido_id)->update([
           'seguimiento_id' => $seguimiento->seguimiento_id,
        ]);
        $detalle->update([
            'photo' => null,
        ]);

        return redirect()->route('moto.pedidos');
    }

    public function incidencia(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required',
            'incidencia_id' => 'required'
        ]);

        $name_photo = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name_photo = 'incidencia_'.$request->pedido_id.'.'.$file->extension();
            $file->move(public_path().'/images/incidencia/', $name_photo);
        }        

        Pedido_incidencia::create([
            'pedido_id' => $request->pedido_id,
            'user_id' => auth()->user()->id,
            'incidencia_id' => $request->incidencia_id,
            'foto' => $request->foto
        ]);

        return redirect()->route('moto.pedidos');
    }

    public function intercambiar(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required',
            'motorizado_id' => 'required'
        ]);
        
        $pedido = Pedido::find($request->pedido_id);
        $pedido->update([
            'motorizado_id' => $request->motorizado_id
        ]);

        $motorizado = Motorizado::find($request->motorizado_id);
        $motorizadoAnterior = Motorizado::where('user_id', auth()->user()->id)->first();

        $pedido_seguimiento = Pedido_seguimiento::where('pedido_id', $request->pedido_id)->latest()->first();
        if ($motorizado && $motorizadoAnterior) {
            $observacion = 'Pedido intercambiado por '. $motorizadoAnterior->namefull . 'con el motorizado '. $motorizado->namefull;
        }else{
            $observacion = 'Pedido intercambiado entre motorizados';
        }

        Pedido_seguimiento::create([
            'pedido_id' => $request->pedido_id,
            'user_id' => auth()->user()->id,
            'seguimiento_id' => $pedido_seguimiento->seguimiento_id,
            'observacion' => $observacion
        ]);

        return redirect()->route('moto.pedidos');
    }

    public function recojos()
    {
        $motorizado = Motorizado::where('user_id', auth()->user()->id)->first();
        if ($motorizado) {
            $pedidos = Pedido::where('motorizado_id', $motorizado->id)->where('tipo_pedido_id', 1)->get();
            $metodos_pago = DB::table('metodo_pago')->where('status',true)->get();
            return view('moto.recojoMoto', compact('pedidos'));
        }else{
            $pedidos = Pedido::where('tipo_pedido_id', 1)->get();
            return view('moto.recojoMoto', compact('pedidos'));
        }
    }

    public function devoluciones()
    {
        $motorizado = Motorizado::where('user_id', auth()->user()->id)->first();
        if ($motorizado) {
            $pedidos = Pedido::where('motorizado_id', $motorizado->id)->where('tipo_pedido_id', 2)->get();
            return view('moto.devolucionMoto', compact('pedidos'));
        }else{
            $pedidos = Pedido::where('tipo_pedido_id', 2)->get();
            return view('moto.devolucionMoto', compact('pedidos'));
        }
    }

    public function reportes()
    {
        $motorizado = Motorizado::where('user_id', auth()->user()->id)->first();
        if ($motorizado) {
            $pedidos = Pedido::where('motorizado_id', $motorizado->id)->get();
            return view('moto.reporteMoto', compact('pedidos'));
        }else{
            $pedidos = Pedido::all();
            return view('moto.reporteMoto', compact('pedidos'));
        }
    }
}
