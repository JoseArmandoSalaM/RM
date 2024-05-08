<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Empresa;
use App\Models\Presupuesto;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use NumberToWords\NumberToWords;

class CotizacionController extends Controller
{


    public function generatePDF($id)
    {
        $cotizacion = Cotizacion::findOrFail($id); // Encuentra la cotización o falla si no existe

        // Convierte el costo total a letras
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('es');
        $costoEnLetras = $numberTransformer->toWords($cotizacion->costo_total);

        

        // Asumiendo que tienes una vista llamada 'cotizaciones.pdf'
        $pdf = PDF::loadView('cotizaciones.pdf', [
            'cotizacion' => $cotizacion,
            'costoEnLetras' => $costoEnLetras
        ]);

        return $pdf->stream('cotizacion-' . $cotizacion->id . '.pdf');
    }

    public function index()
    {
        $Coti = Cotizacion::all();
        $Empresas = Empresa::all();
        $Users = Work::all();
        $Servicios = Servicio::all();

        return view('cotizaciones.index', compact('Coti','Empresas','Users','Servicios'));
    
        }

    public function store(Request $request){

          // Validar los datos aquí...

        // Crear la cotización
        $cotizacion = Cotizacion::create([
            'user_id' => $request->user_id,
            'empre_id' => $request->empre_id,
            'service_id' => $request->service_id,
            'costo_total' => $request->costo_t,
            'notas' => $request->notas,
            'fecha_estimada_termino' => $request->fecha_estimada_termino
        ]);

     
        if ($request->has('presupuestos')) {
            $presupuestos = $request->input('presupuestos');
        
            foreach ($presupuestos as $index => $presupuesto) {
                $cotizacion->presupuestos()->create([
                    'descripcion' => $presupuesto['descripcion'],
                    'cantidad' => $presupuesto['cantidad'],
                    'unidad' => $presupuesto['unidad'],
                    'costo_unitario' => $presupuesto['costo_unitario'],
                    'importe' => $presupuesto['importe'],
                    'utilidad' => $presupuesto['utilidad'],
                    'financiamiento' => $presupuesto['financiamiento'],
                    'riesgo' => $presupuesto['riesgo'],
                    'costo_total' => $presupuesto['costo_total']
                ]);
            }
        }
    

        return redirect()->route('worksCotizacion')
        ->with('success', 'Work updated successfully');
    
    }

    public function edit($id) {
        $Empresas = Empresa::all();
        $Users = Work::all();
        $Servicios = Servicio::all();


        $Cotizacion = Cotizacion::with('presupuestos')->find($id);
        if (!$Cotizacion) {
            // Redirigir si la cotización no existe
            return redirect()->route('cotizaciones.index')->with('error', 'Cotización no encontrada.');
        }
        return view('cotizaciones.edit', compact('Cotizacion','Empresas','Users','Servicios'));
    }

    public function show($id) {
        $Empresas = Empresa::all();
        $Users = Work::all();
        $Servicios = Servicio::all();


        $Cotizacion = Cotizacion::with('presupuestos')->find($id);
        if (!$Cotizacion) {
            // Redirigir si la cotización no existe
            return redirect()->route('cotizaciones.index')->with('error', 'Cotización no encontrada.');
        }
        return view('cotizaciones.view', compact('Cotizacion','Empresas','Users','Servicios'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
            // Actualizar Cotizacion
            $cotizacion = Cotizacion::findOrFail($id);
            $cotizacion->update([
                'user_id' => $request->user_id,
                'empre_id' => $request->empre_id,
                'service_id' => $request->service_id,
                'costo_total' => $request->costo_t,
                'notas' => $request->notas,
                'fecha_estimada_termino' => $request->fecha_estimada_termino,
            ]);

            // Actualizar Presupuestos
            $presupuestosInput = $request->get('presupuestos');
            $presupuestoIds = [];

            foreach ($presupuestosInput as $index => $data) {
                $presupuesto = $cotizacion->presupuestos()->updateOrCreate(
                    ['id' => $data['id'] ?? null],  // Si `id` es nulo, crea un nuevo registro
                    [
                        'descripcion' => $data['descripcion'],
                        'cantidad' => $data['cantidad'],
                        'unidad' => $data['unidad'],
                        'costo_unitario' => $data['costo_unitario'],
                        'importe' => $data['importe'],
                        'utilidad' => $data['utilidad'] ?? 0,
                        'financiamiento' => $data['financiamiento'] ?? 0,
                        'riesgo' => $data['riesgo'] ?? 0,
                        'costo_total' => $data['costo_total'],  // Aquí deberías añadir las fórmulas para utilidad, financiamiento y riesgo si es necesario
                    ]
                );
                $presupuestoIds[] = $presupuesto->id;
            }

            // Eliminar presupuestos que no están en la entrada
            $cotizacion->presupuestos()->whereNotIn('id', $presupuestoIds)->delete();

           
            return redirect()->route('worksCotizacion')->with('success', 'Cotización actualizada correctamente.');
        
    }
    public function facturar(Request $request, $id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $cotizacion->factura = 1; // Asume que tienes una columna 'facturada' en tu tabla 'cotizaciones'
        $cotizacion->save();
    
        return redirect()->route('worksCotizacion')->with('success', 'Cotización facturada correctamente.');
    }
    

          public function eliminar($id)
    {
        Cotizacion::find($id)->delete();

        return redirect()->route('worksCotizacion')
            ->with('success', 'Work deleted successfully');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realizar la búsqueda en la base de datos
            // Búsqueda por costo total
        $Works = Cotizacion::where('costo_total', 'LIKE', "%$query%")->get();

        // Búsqueda por nombre del trabajo asociado
        $Users = Cotizacion::whereHas('work', function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%$query%");
        })->get();

        // Búsqueda por nombre de empresa
        $Empresas = Cotizacion::whereHas('empre', function ($q) use ($query) {
            $q->where('nombre_empresa', 'LIKE', "%$query%");
        })->get();

        // Búsqueda por nombre de servicio
        $Servicios = Cotizacion::whereHas('service', function ($q) use ($query) {
            $q->where('nombre_servicio', 'LIKE', "%$query%");
        })->get();

        $Coti = Cotizacion::where('costo_total', 'LIKE', "%$query%")
            ->orWhereHas('work', function ($q) use ($query) {
                $q->where('nombre', 'LIKE', "%$query%");
            })
            ->orWhereHas('empre', function ($q) use ($query) {
                $q->where('nombre_empresa', 'LIKE', "%$query%");
            })
            ->orWhereHas('service', function ($q) use ($query) {
                $q->where('nombre_servicio', 'LIKE', "%$query%");
            })
            ->get();


        // Devolver los resultados a la vista
        return view('cotizaciones.index', compact('Works','Users','Empresas','Servicios','Coti'));
    }



    public function presupuestoupdate(Request $request,$id){
    

        //dd($request->all());
            // Validar los datos aquí...
            $cotizacion = Cotizacion::findOrFail($id); // Encuentra la cotización o falla si no existe

          // Crear la cotización
         
            $cotizacion->costo_total += $request->costo_t;
            $cotizacion->save();
       
          if ($request->has('presupuestos')) {
              $presupuestos = $request->input('presupuestos');
          
              foreach ($presupuestos as $index => $presupuesto) {
                  $cotizacion->presupuestos()->create([
                      'descripcion' => $presupuesto['descripcion'],
                      'cantidad' => $presupuesto['cantidad'],
                      'unidad' => $presupuesto['unidad'],
                      'costo_unitario' => $presupuesto['costo_unitario'],
                      'importe' => $presupuesto['importe'],
                      'utilidad' => $presupuesto['utilidad'],
                      'financiamiento' => $presupuesto['financiamiento'],
                      'riesgo' => $presupuesto['riesgo'],
                      'costo_total' => $presupuesto['costo_total']
                  ]);
              }
          }
          return redirect()->route('worksCotizacion')
          ->with('success', 'Work updated successfully');
      }
    }
    
 
