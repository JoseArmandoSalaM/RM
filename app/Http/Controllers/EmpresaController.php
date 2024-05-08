<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    

    public function index()
    {
        $Works = Empresa::all();
        return view('empresas.index', compact('Works'));
    
        }

    public function store(Request $request){

        Empresa::create($request->all());

        return redirect()->route('worksEmpresa')
            ->with('success', 'Work created successfully.');
    }

    public function update(Request $request, $id)
{
    // Encuentra el modelo Work con el ID proporcionado
    $Services = Empresa::findOrFail($id);

    // Actualiza los datos del modelo Work con los datos proporcionados en la solicitud
    $Services->update($request->all());

    // Redirige a alguna vista después de la actualización
    return redirect()->route('worksEmpresa')
                     ->with('success', 'Work updated successfully');
}


          public function eliminar($id)
    {
        Empresa::find($id)->delete();

        return redirect()->route('worksEmpresa')
            ->with('success', 'Work deleted successfully');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realizar la búsqueda en la base de datos
        $Works = Empresa::where('dueño', 'LIKE', "%$query%")
                     ->orWhere('nombre_empresa', 'LIKE', "%$query%")
                     ->orWhere('numero_telefono', 'LIKE', "%$query%")
                     ->orWhere('correo_electronico', 'LIKE', "%$query%")
                     ->orWhere('fecha_inicio_asociacion', 'LIKE', "%$query%")
                     ->get();
        
        // Devolver los resultados a la vista
        return view('empresas.index', compact('Works'));
    }

}
