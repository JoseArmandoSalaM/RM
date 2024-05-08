<?php

namespace App\Http\Controllers;

use App\Models\Encargado;
use App\Models\Herramienta;
use App\Models\Work;
use Illuminate\Http\Request;

class EncargadoController extends Controller
{
    public function index()
    {
        $Herramienta = Herramienta::all();
        $Trabajadore = Work::all();
        $Encargado = Encargado::paginate(15);

        
        return view('encargados.index', compact('Trabajadore', 'Herramienta','Encargado'));
    
    }

    public function store(Request $request)
    {

   
       
        // Obtener la cantidad prestada del formulario
        $cantidadPrestada = $request->input('cantidad_prestada');
    
        // Restar la cantidad prestada del total en la base de datos
        $herramienta = Herramienta::findOrFail($request->input('herramienta_id'));

        if ($cantidadPrestada > $herramienta->cantidad_existente || $herramienta->cantidad_existente <= 0) {
            return back()->with('inventario', 'No hay inventario disponible.');
        }

        
        $herramienta->cantidad_existente -= $cantidadPrestada;
        $herramienta->save();
    
        // Crear el nuevo registro Encargado
        Encargado::create($request->all());
    
        return redirect()->route('worksEncargado')
            ->with('success', 'Work created successfully.');
        }
    
    

    public function update(Request $request, $id)
{
    // Encuentra el modelo Encargado con el ID proporcionado
    $encargado = Encargado::findOrFail($id);
    $entregado = $request->input('entregado');
 
    // Verifica si el campo 'entregado' se ha actualizado y su nuevo valor es 'si'
    if ($entregado == 'Si') {
       

        // Obtener la cantidad prestada de este registro de encargado
        $cantidadPrestada = $encargado->cantidad_prestada;

        // Obtener la herramienta asociada y sumar la cantidad prestada al total
        $herramienta = Herramienta::findOrFail($encargado->herramienta_id);
        $herramienta->cantidad_existente += $cantidadPrestada;
        $herramienta->save();
    }
    
       // Actualiza los datos del modelo Encargado con los datos proporcionados en la solicitud
       $encargado->update($request->all());
    // Redirige a alguna vista después de la actualización
    return redirect()->route('worksEncargado')
                     ->with('success', 'Work updated successfully');
}



          public function eliminar($id)
    {
        Encargado::find($id)->delete();

        return redirect()->route('worksEncargado')
            ->with('success', 'Work deleted successfully');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realizar la búsqueda en la base de datos

        $Trabajadore = Encargado::whereHas('work', function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%$query%");
        })->paginate(10);
        $Herramienta = Encargado::whereHas('herramienta', function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%$query%");
        })->paginate(10);

        $Encargado = Encargado::query()
            ->when($query, function ($q) use ($query) {
                $q->where('fecha_entrega', 'LIKE', "%$query%")
                  ->orWhere('entregado', 'LIKE', "%$query%")
                  ->orWhere('fecha_devolucion', 'LIKE', "%$query%")
                  ->orWhere('cantidad_prestada', 'LIKE', "%$query%");
            })
            ->paginate(10);
        
        // Devolver los resultados a la vista
        return view('encargados.index', compact('Encargado','Trabajadore','Herramienta'));
    }
    
}
