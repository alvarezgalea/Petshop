<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
  
class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
  
        if($request->ajax()) {
       
             $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title' ,'fechaCita','horaCita','mascota', 'start', 'end']);
  
             return response()->json($data);
        }
  
        return view('fullcalender');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                
                  'fechaCita' => $request->fechaCita,
                  'horaCita' => $request->horaCita,
                  'mascota' => $request->mascota,
                  'start' => $request->start,
                  'end' => $request->end,
                  'title' => $request->mascota,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'fechaCita' => $request->fechaCita,
                  'horaCita' => $request->horaCita,
                  'mascota' => $request->mascota,
                  //'start' => $request->start,
                  //'end' => $request->end,
                  'title' => $request->mascota,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}