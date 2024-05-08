@extends('layouts.app')

@section('template_title')
Contactos
@endsection

@section('content')

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
    <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createmodal">Nuevo prestamo</a>
</div>

<form action="{{ route('buscarEncargado') }}" method="GET" class="d-flex align-items-center">
    <div class="form-outline mb-1" data-mdb-input-init>
        <input type="search" class="form-control" id="datatable-search-input" name="query" placeholder="Buscar...">
    </div>
    <button type="submit" class="btn btn-outline-info mb-1">Buscar</button>
</form>

          
    





<!-- Ventana modal -->
<div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createmodal">Agregar nuevo prestamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               
<form method="post" action="{{route('registEncargado') }}">
    @csrf

    <div class="mb-3">
    <label for="user_id" class="form-label">Nombre del usuario</label>
    <select class="form-select" id="user_id" name="user_id" required>
        <option value="">Selecciona el trabajador</option>
        @foreach($Trabajadore as $trabajadore)
            <option value="{{ $trabajadore->id }}">{{ $trabajadore->nombre }}</option>
        @endforeach
    </select>
</div>


<div class="mb-3">
    <label for="herramienta_id" class="form-label">Nombre de la herramienta</label>
    <select class="form-select" id="herramienta_id" name="herramienta_id" required>
        <option value="">Selecciona la herramienta</option>
        @foreach($Herramienta as $herramienta)
            <option value="{{ $herramienta->id }}">{{ $herramienta->nombre }}</option>
        @endforeach
    </select>
</div>

    <div class="mb-3">
        <label for="fecha_entrega" class="form-label">Fecha de prestamo</label>
        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
    </div>

    <div class="mb-3">
        <label for="fecha_devolucion" class="form-label">Fecha de la devolucion</label>
        <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" required>
    </div>
    
    <div class="mb-3">
        <label for="cantidad_prestada" class="form-label">Cantidad prestada</label>
        <input type="number" class="form-control" id="cantidad_prestada" name="cantidad_prestada" required>
    </div>
    

    
    <div class="mb-3">
    <label for="entregado" class="form-label">Entregado</label>
    <select class="form-select" id="entregado" name="entregado" required>
        <option value="No">No</option>
    </select>
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
  @if(session("inventario"))
    <div class="alert alert-danger">{{session("inventario")}}</div>
    @endif
  
            <div class="card-body">
                <h5 class="card-title">Encargados</h5>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            
                            <th scope="col">Nombre del trabajador</th>
                            <th scope="col">Nombre de la herramienta</th>
                            <th scope="col">Fecha de entrega</th>
                            <th scope="col">Fecha de devolucion</th>
                            <th scope="col">Cantidad de herramientas prestadas</th>
                            <th scope="col">Cantidad de herramientas disponibles</th>
                            <th scope="col">Entregado</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Encargado as $encargado)
                        <tr>
                            <th scope="row">{{ $encargado->work->nombre }}</th>
                            <th scope="row">{{ $encargado->herramienta->nombre }}</th>
                            <td>{{ $encargado->fecha_entrega }}</td>
                            <td>{{ $encargado->fecha_devolucion }}</td>
                            <td>{{ $encargado->cantidad_prestada }}</td>
                            <td>{{ $encargado->herramienta->cantidad_existente}}</td>
                            <td>{{ $encargado->entregado}}</td>
                            <td>
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarmodal{{$encargado->id}}">Editar</a>   
                        </td>
                        </tr>



                        <div class="modal fade" id="editarmodal{{$encargado->id}}" tabindex="-1" aria-labelledby="editarmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarmodal">Actualizar datos del prestamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->
    <form method="post" action="{{ route('modificarEncargado', $encargado->id) }}">
    @csrf

    <div class="mb-3">
    <label for="user_id" class="form-label">Nombre del usuario</label>
    <select class="form-select" id="user_id" name="user_id" required>
        <option value="">Selecciona un trabajador</option>
        @foreach($Trabajadore as $trabajadore)
            <option value="{{ $trabajadore->id }}" @if($trabajadore->id == $encargado->user_id) selected @endif>{{ $trabajadore->nombre }}</option>
        @endforeach
    </select>
</div>



    <div class="mb-3">
        <label for="fecha_devolucion" class="form-label">Fecha de devolucion</label>
        <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" value="{{ $encargado->fecha_devolucion }}"  required>
    </div>
    <div class="mb-3">
    <label for="entregado" class="form-label">Entregado</label>
    <select class="form-select" id="entregado" name="entregado" required @if($encargado->entregado == 'Si') disabled @endif>
        <option value="No" @if($encargado->entregado == 'No') selected @endif>No</option>
        <option value="Si" @if($encargado->entregado == 'Si') selected @endif>Si</option>
    </select>
</div>

    

            <div class="modal-footer">
               <a href="{{ route('eliminarEncargado', $encargado->id) }}" onclick="return res()" class="btn btn-outline-warning btn-sm">Eliminar</a>
                <button type="submit" class="btn btn-outline-primary">Guardar cambios</button>
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
            </div>
</form>

            </div>
        </div>
    </div>
</div>




                        @endforeach
                    </tbody>
                </table>
                {{ $Encargado->links() }}
            </div>
          
        </div>
       
    </div>
    <div class="col-md-2"></div>
    
</div>




@endsection


