@extends('layouts.app')

@section('template_title')
Editar contactos
@endsection

@section('content')




@if ($Cotizacion)
<div class="container">
        <div class="card">
            <div class="card-header text-center">
<h5>Actualizar datos de la cotizacion</h5>
    <!-- Formulario de registro -->
    <form method="post" action="{{ route('modificarCotizacion', $Cotizacion->id) }}">
        
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="user_id" class="form-label">Nombre del trabajador que realiza la cotización</label>
                    <input type="text" class="form-control" id="nombreuser" name="nombreuser" value="{{ $Cotizacion->work->nombre }}" required readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="empre_id" class="form-label">Nombre de la empresa</label>
                    <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" value="{{ $Cotizacion->empre->nombre_empresa }}" required readonly>                    
                </div>
            </div>
        </div>

        <!-- Segunda línea: Dos inputs (servicio y fecha estimada) -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="service_id" class="form-label">Nombre del servicio</label>
                    <input type="text" class="form-control" id="nombreService" name="nombreService" value="{{ $Cotizacion->service->nombre_servicio }}" required readonly>                                            
                </div>
            </div>
            @endif  
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_estimada_termino" class="form-label">Fecha estimada de término</label>
                    <input type="date" class="form-control" id="fecha_estimada_termino" name="fecha_estimada_termino" value="{{ $Cotizacion->fecha_estimada_termino }}" required readonly>
                </div>
            </div>
        </div>
        
</div>


                    
    <table class="table table-striped text-center">
    <thead>           
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
                    @foreach ($Cotizacion->presupuestos as $index => $presupuesto)
                        <tr class="item-row">
                            <th scope="row">
                            <div class="mb-3">
                            <textarea type="text" class="form-control descripcion" id="descripcion"  name="presupuestos[{{$index}}][descripcion]" required readonly>{{ $presupuesto->descripcion }}</textarea>
                            </div>
                            </th>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control costo_unitario" id="costo_unitario" name="presupuestos[{{$index}}][costo_unitario]" value="{{ $presupuesto->costo_unitario }}" required readonly>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control utilidad" id="utilidad" name="presupuestos[{{$index}}][utilidad]" value="{{ $presupuesto->utilidad }}" readonly>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control financiamiento" id="financiamiento" name="presupuestos[{{$index}}][financiamiento]" value="{{ $presupuesto->financiamiento }}" readonly>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control riesgo" id="riesgo"  name="presupuestos[{{$index}}][riesgo]" value="{{ $presupuesto->riesgo }}" readonly>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control importe" id="importe" name="presupuestos[{{$index}}][importe]" value="{{ $presupuesto->importe }}" required readonly>
                            </div>
                            </td>
                            <th scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control cantidad" id="cantidad" name="presupuestos[{{$index}}][cantidad]" value="{{ $presupuesto->cantidad }}" required readonly>
                            </div>
                            </td>
                            
                            <td scope="row">
                                <div class="mb-3">
                                    <select class="form-select" id="unidad" name="presupuestos[{{$index}}][unidad]" required disabled>
                                        <option value="">Selecciona el servicio</option>
                                        <option value="Metro" {{ $presupuesto->unidad == 'Metro' ? 'selected' : '' }}>Metro</option>
                                        <option value="Lote" {{ $presupuesto->unidad == 'Lote' ? 'selected' : '' }}>Lote</option>
                                    </select>
                                </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control costo_total" id="costo_total" name="presupuestos[{{$index}}][costo_total]" value="{{ $presupuesto->costo_total }}" required readonly>
                            </div>
                            </td>
                            
                        </tr>
                        </tbody>
                        @endforeach
                </table>

               
                @if ($Cotizacion)
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <!-- Área de notas al lado izquierdo -->
            <div class="w-50">
                <div class="mb-3">
                    <label for="notas" class="form-label">Notas</label>
                    <textarea class="form-control" id="notas" name="notas" required readonly>{{ $Cotizacion->notas }}</textarea>
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
                                    <input type="number" class="form-control costo_t" id="costo_t" name="costo_t" value="{{ $Cotizacion->costo_total }}" required readonly>                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                <div class="mb-3">
        
        <div class="justify-content-between align-items-right mt-2">
        <button type="button" class="btn btn-outline-dark" onclick="history.back();">Cerrar</button>
    </div>
    @endif
</div>

</div>

</div>

</form>   

        </div>
    </div>


    
<!-- Ventana modal -->
<div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createmodal">Agregar mas presupuestos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               @if ($Cotizacion)
               <form method="post" action="{{ route('presupuestoUpdate', $Cotizacion->id) }}">
               @endif
    @csrf
    <table class="table table-striped text-center">
    <thead>
    <tr>
        <th colspan="9">
            <button type="button" id="addRow2" class="btn btn-outline-dark">Agregar Item</button>
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
                    <tbody id="itemsTable2">
                        <tr class="item-row2">
                            <th scope="row">
                            <div class="mb-3">
                            <textarea type="text" class="form-control" id="descripcion" name="presupuestos[0][descripcion]" required></textarea>
                            </div>
                            </th>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control costo_unitario2" id="costo_unitario" name="presupuestos[0][costo_unitario]" required>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control utilidad2" id="utilidad" name="presupuestos[0][utilidad]">
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control financiamiento2" id="financiamiento" name="presupuestos[0][financiamiento]">
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control riesgo2" id="riesgo" name="presupuestos[0][riesgo]">
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control importe2" id="importe" name="presupuestos[0][importe]" required readonly>
                            </div>
                            </td>
                            <th scope="row">
                            <div class="mb-3">
                            <input type="number" class="form-control cantidad2" id="cantidad"  name="presupuestos[0][cantidad]" required>
                            </div>
                            </th>
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
                            <input type="number" class="form-control costo_total2" id="costo_total" name="presupuestos[0][costo_total]" required readonly>
                            </div>
                            </td>
                            <td scope="row">
                            <div class="mb-3">
                            <button type="button" class="removeRow2 btn btn-outline-warning btn-sm">Eliminar</button>
                            </div>
                            </td>
                        </tr>

                        </tbody>
                        
                </table>
                <div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <div class="w-50 d-flex justify-content-end">
                <table style="width: 25%;"> <!-- Ancho reducido para la tabla -->
                    <tbody>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label for="costo_t" class="form-label">Costo total</label>
                                    <input type="number" class="form-control costo_t2" id="costo_t2" name="costo_t" required readonly>
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
                         

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
$(document).ready(function() {
   function recalcularIndices() {
    $('.item-row2').each(function(index) {
        $(this).find('input, select, textarea').each(function() {
            var name = $(this).attr('name');
            if (name) {
                name = name.replace(/\[\d+\]/, '[' + index + ']');
                $(this).attr('name', name);
            }
        });
    });
}


   

    // Función para añadir fila al segundo grupo
    $("#addRow2").click(function() {
        var lastRow = $("#itemsTable2 .item-row2:last");
        var newRow = lastRow.clone(true);
        newRow.find('input, select, textarea').val('');
        newRow.insertAfter(lastRow);
        recalcularIndices();
        actualizarTotalCosto();

    });


});
$(document).on('click', '.removeRow2', function() {
    // Contamos las filas antes de intentar eliminar
    if ($('.item-row2').length > 1) {
        $(this).closest('.item-row2').remove();
        recalcularIndices();
        actualizarTotalCosto();
    } else {
        alert('No puedes eliminar la última fila.');
    }
});


function actualizarTotalCosto() {
        var total = 0;
        $('.costo_total2').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#costo_t2').val(total.toFixed(2));
    }

   
    function calcularValores($row) {
        var cantidad = parseFloat($row.find('.cantidad2').val()) || 0;
        var costoUnitario = parseFloat($row.find('.costo_unitario2').val()) || 0;
        var utilidad = parseFloat($row.find('.utilidad2').val()) || 0;
        var financiamiento = parseFloat($row.find('.financiamiento2').val()) || 0;
        var riesgo = parseFloat($row.find('.riesgo2').val()) || 0;
        var importe = costoUnitario + (costoUnitario * utilidad / 100) + (costoUnitario * financiamiento / 100) + (costoUnitario * riesgo / 100);
        $row.find('.importe2').val(importe.toFixed(2));
        var costoFinal = cantidad * importe;
        $row.find('.costo_total2').val(costoFinal.toFixed(2));

        actualizarTotalCosto();
    }

    $(document).on('input', '.cantidad2, .costo_unitario2, .utilidad2, .financiamiento2, .riesgo2', function() {
        calcularValores($(this).closest('.item-row2'));
    });

</script>


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

    $("#addRow").click(function() {
    var lastRow = $(".item-row:last"); 
    var newRow = lastRow.clone(true);

    // Limpiar los valores y actualizar índices
    newRow.find('input, select, textarea').each(function() {
        if (this.type === 'number' || this.type === 'textarea') {
            $(this).val('');
        } else if (this.type === 'checkbox' || this.type === 'radio') {
            this.checked = false;
        }
    });

    newRow.insertAfter(lastRow); // Añade la nueva fila después de la última fila existente
    recalcularIndices(); // Actualiza los índices cada vez que se añade una fila
    actualizarTotalCosto();
});

$(document).on('click', '.removeRow', function() {
    // Contamos las filas antes de intentar eliminar
    if ($('.item-row').length > 1) {
        $(this).closest('.item-row').remove();
        recalcularIndices();
        actualizarTotalCosto();
    } else {
        alert('No puedes eliminar la última fila.');
    }
});

    function actualizarTotalCosto() {
        var total = 0;
        $('.costo_total').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#costo_t').val(total.toFixed(2));
    }

   

    function calcularValores2($row) {
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

    $(document).on('input', '.cantidad, .costo_unitario, .utilidad, .financiamiento, .riesgo', function() {
        calcularValores2($(this).closest('.item-row'));
    });
});


</script>


@endsection