<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Http\Requests\WorkRequest;
use Illuminate\Http\Request;
/**
 * Class WorkController
 * @package App\Http\Controllers
 */
class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Works = Work::all();
        return view('works.index', compact('Works'));
    
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $work = new Work();
        return view('work.create', compact('work'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    
        Work::create($request->all());

        return redirect()->route('works')
            ->with('success', 'Work created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $work = Work::find($id);

        return view('work.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $workse = Work::find($id);
    
        return view('works.index', compact('work'));
    }
    

    /**
     * Update the specified resource in storage.
     */
   /* public function update(Request $request, $id)
    {

     $trabajador = Work::findOrFail($id);
    // Actualizar la información del trabajador
    $trabajador->nombre = $request->nombre;
    $trabajador->apellido = $request->pellidos;
    $trabajador->correo = $request->correo;
    $trabajador->telefono = $request->telefono;
    $trabajador->cargo = $request->cargo;
    $trabajador->save();

    // Redireccionar con un mensaje de éxito
    return redirect()->route('works.index')->with('success', 'Trabajador actualizado correctamente');
    }
*/


public function update(Request $request, $id)
{
    // Encuentra el modelo Work con el ID proporcionado
    $work = Work::findOrFail($id);

    // Actualiza los datos del modelo Work con los datos proporcionados en la solicitud
    $work->update($request->all());

    // Redirige a alguna vista después de la actualización
    return redirect()->route('works')
                     ->with('success', 'Work updated successfully');
}

    public function eliminar($id)
    {
        Work::find($id)->delete();

        return redirect()->route('works')
            ->with('success', 'Work deleted successfully');
    }



    public function buscar(Request $request)
{
    $query = $request->input('query');
    
    // Realizar la búsqueda en la base de datos
    $Works = Work::where('nombre', 'LIKE', "%$query%")
                 ->orWhere('cargo', 'LIKE', "%$query%")
                 ->orWhere('apellido', 'LIKE', "%$query%")
                 ->orWhere('fecha_inicio', 'LIKE', "%$query%")
                 ->orWhere('telefono', 'LIKE', "%$query%")
                 ->get();
    
    // Devolver los resultados a la vista
    return view('works.index', compact('Works'));
}

}
