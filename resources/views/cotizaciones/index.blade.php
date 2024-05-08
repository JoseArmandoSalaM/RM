@extends('layouts.app')

@section('template_title')
Contactos
@endsection

@section('content')


<style>
        .modal-dialog {
            max-width: 60%; /* Ajusta el máximo ancho de la modal a 90% del ancho de la ventana */
        }
    </style>
<script>
    var res=function(){
        var not=confirm("¿Estas seguro de eliminar?");
        return not;
    }
</script>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
            <div>
    <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createmodal">Nueva cotizacion</a>
</div>

<form action="{{ route('buscarCotizacion') }}" method="GET" class="d-flex align-items-center">
    <div class="form-outline mb-1" data-mdb-input-init>
        <input type="search" class="form-control" id="datatable-search-input" name="query" placeholder="Buscar...">
    </div>
    <button type="submit" class="btn btn-outline-info mb-1">Buscar</button>
</form>

          
    





<!-- Ventana modal -->
<div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createmodal">Agregar nueva cotizacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               
               <form method="post" action="{{route('registCotizacion') }}">
    @csrf
    <div class="row">
        <!-- Primera línea: Dos inputs -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="user_id" class="form-label">Nombre del trabajador que realiza la cotización</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <option value="">Selecciona un trabajador</option>
                    @foreach($Users as $user)
                        <option value="{{ $user->id }}">{{ $user->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="empre_id" class="form-label">Nombre de la empresa</label>
                <select class="form-select" id="empre_id" name="empre_id" required>
                    <option value="">Selecciona una empresa</option>
                    @foreach($Empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre_empresa }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Segunda línea: Tres inputs -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="service_id" class="form-label">Nombre del servicio</label>
                <select class="form-select" id="service_id" name="service_id" required>
                    <option value="">Selecciona el servicio</option>
                    @foreach($Servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre_servicio }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="fecha_estimada_termino" class="form-label">Fecha estimada de termino</label>
                <input type="date" class="form-control" id="fecha_estimada_termino" name="fecha_estimada_termino" required>
            </div>
        </div>
    </div>

    <table class="table table-striped text-center">
    <thead>
    <tr>
        <th colspan="10">
            <button type="button" id="addRow" class="btn btn-outline-dark">Agregar Item</button>
        </th>
    </tr>
                            
                            <th scope="col">Descripcion</th>
                            <th scope="col">Costo Unitario</th>
                            <th scope="col">Utilidad</th>
                            <th scope="col">Financiamiento</th>
                            <th scope="col">Riesgo</th>
                            <th scope="col">Precio Total de pieza</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Costo Total</th>
                        </tr>
                    </thead>
                    <tbody id="itemsTable">
                        <tr class="item-row">
                            <th scope="row">
                            <div class="mb-3">
                            <textarea type="text" class="form-control" id="descripcion" name="presupuestos[0][descripcion]" required></textarea>
                            </div>
                            </th>
                            <th scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control costo_unitario" id="costo_unitario" name="presupuestos[0][costo_unitario]" required>
                            </div>
                            </th>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control utilidad" id="utilidad" name="presupuestos[0][utilidad]">
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control financiamiento" id="financiamiento" name="presupuestos[0][financiamiento]">
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control riesgo" id="riesgo" name="presupuestos[0][riesgo]">
                            </div>
                            </td>
                            
                            <td scope="row">
                            <div class="mb-3">
                         <input type="number" class="form-control importe" id="importe" name="presupuestos[0][importe]" required readonly>
                        </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control cantidad" id="cantidad"  name="presupuestos[0][cantidad]" required>
                            </div>
                            </td>
                            <td scope="row">
                            
                            <div class="mb-3">
                                <select class="form-select" id="unidad" name="presupuestos[0][unidad]" required>
                                    <option value="">Selecciona el servicio</option>
                                    <option value="Metro">Metro</option>
                                    <option value="Lote">Lote</option>
                                </select>
                            </div>
                    
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control costo_total" id="costo_total" name="presupuestos[0][costo_total]" required readonly>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <button type="button" class="removeRow btn btn-outline-warning btn-sm">Eliminar</button>
                            </div>
                            </td>
                        </tr>

                        </tbody>
                        
                </table>
                <div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <!-- Área de notas al lado izquierdo -->
            <div class="w-50">
                <div class="mb-3">
                    <label for="notas" class="form-label">Notas</label>
                    <textarea class="form-control" id="notas" name="notas" required></textarea>
                </div>
            </div>

            <!-- Área de costo total al lado derecho, pegada a la derecha -->
            <div class="w-50 d-flex justify-content-end">
                <table style="width: 25%;"> <!-- Ancho reducido para la tabla -->
                    <tbody>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label for="costo_t" class="form-label">Costo total</label>
                                    <input type="number" class="form-control costo_t" id="costo_t" name="costo_t" required readonly>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




         



    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary">Agregar</button>
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
    </div>
</form>



            </div>
        </div>
    </div>
</div>

  </div>
  
  
            <div class="card-body">
                <h5 class="card-title">Cotizaciones</h5>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">Usuario que realizo la cotizacion</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Servicio</th>
                            <th scope="col">Costo Total</th>
                            <th scope="col">PDF</th>
                            <th scope="col">¿Servicio realizado?</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    @foreach($Coti as $coti)
                        
                            <td scope="row">{{ $coti->work->nombre }}</td>
                            <td scope="row">{{ $coti->empre->nombre_empresa }}</td>
                            <td scope="row">{{ $coti->service->nombre_servicio }}</td>
                            <td scope="row">${{ $coti->costo_total }}</td>
                            <td>
                                <a href="{{ route('cotizacion.pdf', $coti->id) }}" target="_blank" class="btn btn-outline-primary btn-pdf">PDF</a>
                            </td>
                            
                            <td>
                            @if($coti->factura)
                            <button class="btn btn-outline-primary" disabled>Facturado</button>
                        @else
                           
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#customModal{{ $coti->id }}">
                            Facturar
                        </button>
                                              
                        @endif 
                            </td>
                            <td>
                            @if($coti->factura)
                                <span class="btn btn-outline-primary disabled" style="cursor: not-allowed; color: gray;">Editar</span>
                            @else
                                <a href="{{ route('editCotizacion', ['id' => $coti->id]) }}" class="btn btn-outline-primary">Editar</a>
                            @endif                                
                            <a href="{{ route('showCotizacion', ['id' => $coti->id]) }}" class="btn btn-outline-primary btn-edit">Ver</a>  
                            </td>
                        </tr>

                     <!-- Modal -->
                     <div class="modal fade" id="customModal{{ $coti->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $coti->id }}" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="modalLabel">Confirmación de Facturación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            <p style="font-size: 20px;">¿Estás seguro de que quieres facturar?</p>
            <img src="/factura.png" alt="Factura" style="height: 200px;">
    <p><strong>(YA NO PODRAS HACER MODIFICACIONES DESPUES DE FACTURAR)</strong></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('facturarCotizacion', $coti->id) }}" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Confirmar Facturación</button>
                </form>
            </div>
        </div>
    </div>
</div>


                        
                    @endforeach
                    </tbody>
                    </table>
    
        </div>





   


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
$(document).ready(function() {
    function recalcularIndices() {
        $('#itemsTable .item-row').each(function(index) {
            $(this).find('input, select, textarea').each(function() {
                var name = $(this).attr('name');
                if (name) {
                    name = name.replace(/\[\d+\]/, '[' + index + ']');  // Reemplaza el índice actual con el nuevo
                    $(this).attr('name', name);
                }
            });
        });
    }

    function calcularImporte() {
        var $row = $(this).closest('.item-row');
        var cantidad = parseFloat($row.find('.cantidad').val()) || 0;
        var costoUnitario = parseFloat($row.find('.costo_unitario').val()) || 0;
        var utilidad = parseFloat($row.find('.utilidad').val()) || 0;
        var financiamiento = parseFloat($row.find('.financiamiento').val()) || 0;
        var riesgo = parseFloat($row.find('.riesgo').val()) || 0;
        var importe = costoUnitario + (costoUnitario * utilidad / 100) + (costoUnitario * financiamiento / 100) + (costoUnitario * riesgo / 100);
        $row.find('.importe').val(importe.toFixed(2));
        var costoFinal = cantidad * importe;
        $row.find('.costo_total').val(costoFinal.toFixed(2));

        actualizarTotalCosto();
    }

    function actualizarTotalCosto() {
        var total = 0;
        $('.costo_total').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#costo_t').val(total.toFixed(2));
    }

    $("#addRow").click(function() {
        var newRow = $(".item-row:last").clone(true);
        newRow.find('input, select, textarea').val('');
        newRow.appendTo("#itemsTable");
        recalcularIndices();  // Actualiza los índices después de añadir la fila
        actualizarTotalCosto(); // Actualiza el total al añadir una fila
    });

    function removeRow() {
        if ($("#itemsTable .item-row").length > 1) {
            $(this).closest('tr').remove();
            recalcularIndices();  // Actualiza los índices después de remover la fila
            actualizarTotalCosto(); // Actualiza el total al remover una fila
        } else {
            alert('No se puede eliminar la última fila.');
        }
    }
    

    $(document).on('input', '.cantidad, .costo_unitario, .utilidad, .financiamiento, .riesgo', calcularImporte);
    $(document).on('click', '.removeRow', removeRow);
});
</script>




    </div>
    <div class="col-md-2"></div>
</div>


@endsection


