<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use Illuminate\Http\Request;

class HerramientaController extends Controller
{
    
    public function index()
    {
        $Works = Herramienta::all();
        return view('herramientas.index', compact('Works'));
    
        }

    public function store(Request $request){

        Herramienta::create($request->all());

        return redirect()->route('worksHerramienta')
            ->with('success', 'Work created successfully.');
    }

    public function update(Request $request, $id)
{
    // Encuentra el modelo Work con el ID proporcionado
    $Services = Herramienta::findOrFail($id);

    // Actualiza los datos del modelo Work con los datos proporcionados en la solicitud
    $Services->update($request->all());

    // Redirige a alguna vista después de la actualización
    return redirect()->route('worksHerramienta')
                     ->with('success', 'Work updated successfully');
}
          public function eliminar($id)
    {
        Herramienta::find($id)->delete();

        return redirect()->route('worksHerramienta')
            ->with('success', 'Work deleted successfully');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realizar la búsqueda en la base de datos
        $Works = Herramienta::where('nombre', 'LIKE', "%$query%")
                     ->orWhere('cantidad_existente', 'LIKE', "%$query%")
                     ->get();
        
        // Devolver los resultados a la vista
        return view('herramientas.index', compact('Works'));
    }
}
