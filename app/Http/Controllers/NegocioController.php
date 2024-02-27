<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $negocios = Negocio::all();
        //$negocios = Negocio::with('user')->latest()->get();
        return view('negocio.index', compact('negocios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $type_negocios = DB::table('type_negocio')->get();
        $type_documents = DB::table('type_document')->get();
        // $departamentos = DB::table('departamentos')->where('status', true)->get();
        // $provincias = DB::table('provincias')->where('status', true)->get();
        $distritos = DB::table('distritos')->where('status', true)->get();

        return view('negocio.addNegocio', compact('type_negocios', 'type_documents', 'distritos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'type_document' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:255'],
            'departamento_id' => ['required', 'string', 'max:255'],
            'provincia_id' => ['required', 'string', 'max:255'],
            'distrito_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name_encargado' => ['required', 'string', 'max:255']           
        ]);

        $name_photo = '';

        $negocio = Negocio::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'type_negocio' => $request->type_negocio,
            'type_document' => $request->type_document,
            'document' => $request->document,
            'departamento_id' => $request->departamento_id,
            'provincia_id' => $request->provincia_id,
            'distrito_id' => $request->distrito_id,
            'address' => $request->address,
            'coordenate_x' => $request->coordenate_x,
            'coordenate_x' => $request->coordenate_x,
            'pos' => $request->pos,
            'name_encargado' => $request->name_encargado
        ]);

        $lastInsertedIdNegocio = $negocio->id;
        $negocio = Negocio::find($lastInsertedIdNegocio);

        $name_photo_pre = str_replace(' ', '-', $request->name);
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name_photo = $name_photo_pre.'-'.$lastInsertedIdNegocio.'.'.$file->extension();
            $file->move(public_path().'/images/negocios/', $name_photo);
        }

        $negocio->update([
        'photo' => $name_photo,
        ]);

        $negocios = Negocio::all();

        return redirect()->route('negocio.index', compact('negocio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Negocio $negocio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Negocio $negocio)
    {
        $type_negocios = DB::table('type_negocio')->get();
        $type_documents = DB::table('type_document')->get();
        $distritos = DB::table('distritos')->where('status', true)->get();

        return view('negocio.editNegocio', compact('negocio', 'type_negocios', 'type_documents', 'distritos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Negocio $negocio)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'type_document' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:255'],
            'departamento_id' => ['required', 'string', 'max:255'],
            'provincia_id' => ['required', 'string', 'max:255'],
            'distrito_id' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $negocio->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'type_document' => $request->type_document,
            'document' => $request->document,
            'departamento_id' => $request->departamento_id,
            'provincia_id' => $request->provincia_id,
            'distrito_id' => $request->distrito_id,
            'address' => $request->address,
            'coordenate_x' => $request->coordenate_x,
            'coordenate_x' => $request->coordenate_x,
            'pos' => $request->brand,
            'name_encargado' => $request->name_encargado,
        ]);

        $negocios = Negocio::all();

        return redirect()->route('negocio.index', compact('negocios'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Negocio $negocio)
    {
        $negocio->delete();
        $negocios = Negocio::all();
        return redirect()->route('negocio.index', compact('negocios'));
    }
}
