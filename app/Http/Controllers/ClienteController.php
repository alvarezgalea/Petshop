<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Cliente::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCliente">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCliente">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('clienteMascota');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cliente::updateOrCreate([
                    'id' => $request->cliente_id
                ],
                [
                    'documento' => $request->documento, 
                    'nombresApellidos' => $request->nombresApellidos,
                    'celular' => $request->celular,
                    'email' => $request->email
                ]);

     
        return response()->json(['success'=>'Cliente Agregado con Exito.']);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::find($id)->delete();
        return response()->json(['success'=>'Cliente borrado exitosamente']);
    }
}
