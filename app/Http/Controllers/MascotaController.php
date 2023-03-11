<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Mascota::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMascota">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteMascota">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('mascota');
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
        Mascota::updateOrCreate([
                    'id' => $request->mascota_id
                ],
                [
                    'idMascota' => $request->idMascota, 
                    'nombreMascota' => $request->nombreMascota,
                    'tipoMascota' => $request->tipoMascota
                ]);

     
        return response()->json(['success'=>'Mascota Agregada con Exito.']);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mascota = Mascota::find($id);
        return response()->json($mascota);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Mascota::find($id)->delete();
        return response()->json(['success'=>'Mascota borrada exitosamente']);
    }
}
