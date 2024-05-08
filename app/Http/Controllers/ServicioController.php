<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $Works = Servicio::all();
        return view('servicios.index', compact('Works'));
    
        }

    public function store(Request $request){

        Servicio::create($request->all());

        return redirect()->route('worksServices')
            ->with('success', 'Work created successfully.');
    }

    public function update(Request $request, $id)
{
    // Encuentra el modelo Work con el ID proporcionado
    $Services = Servicio::findOrFail($id);

    // Actualiza los datos del modelo Work con los datos proporcionados en la solicitud
    $Services->update($request->all());

    // Redirige a alguna vista después de la actualización
    return redirect()->route('worksServices')
                     ->with('success', 'Work updated successfully');
}
          public function eliminar($id)
    {
        Servicio::find($id)->delete();

        return redirect()->route('worksServices')
            ->with('success', 'Work deleted successfully');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realizar la búsqueda en la base de datos
        $Works = Servicio::where('nombre_servicio', 'LIKE', "%$query%")
                     ->orWhere('caracteristicas', 'LIKE', "%$query%")
                     ->orWhere('precio', 'LIKE', "%$query%")
                     ->orWhere('tiempo_estimado', 'LIKE', "%$query%")
                     ->orWhere('categoria', 'LIKE', "%$query%")
                     ->get();
        
        // Devolver los resultados a la vista
        return view('servicios.index', compact('Works'));
    }
}
