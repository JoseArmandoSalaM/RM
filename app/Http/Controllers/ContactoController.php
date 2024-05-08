<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $Empresas = Empresa::all();
        $Works = Contacto::all();
        return view('contactos.index', compact('Works', 'Empresas'));
    
    }

    public function store(Request $request){

        Contacto::create($request->all());

        return redirect()->route('worksContacto')
            ->with('success', 'Work created successfully.');
    }

    public function update(Request $request, $id)
{
    // Encuentra el modelo Work con el ID proporcionado
    $Services = Contacto::findOrFail($id);

    // Actualiza los datos del modelo Work con los datos proporcionados en la solicitud
    $Services->update($request->all());

    // Redirige a alguna vista después de la actualización
    return redirect()->route('worksContacto')
                     ->with('success', 'Work updated successfully');
}
          public function eliminar($id)
    {
        Contacto::find($id)->delete();

        return redirect()->route('worksContacto')
            ->with('success', 'Work deleted successfully');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realizar la búsqueda en la base de datos
        $Works = Contacto::where('nombre_completo', 'LIKE', "%$query%")
                     ->orWhere('correo', 'LIKE', "%$query%")
                     ->orWhere('numero_telefono', 'LIKE', "%$query%")
                     ->orWhere('fecha_alianza', 'LIKE', "%$query%")
                     ->orWhere('rol_compra', 'LIKE', "%$query%")
                     ->orWhere('empresa_id', 'LIKE', "%$query%")
                     ->get();
        
        // Devolver los resultados a la vista
        return view('contactos.index', compact('Works'));
    }
}
