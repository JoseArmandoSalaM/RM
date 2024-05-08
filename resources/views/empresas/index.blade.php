@extends('layouts.app')

@section('template_title')
Empresas
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
    <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createmodal">Nueva empresa</a>
</div>

<form action="{{ route('buscarEmpresa') }}" method="GET" class="d-flex align-items-center">
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
                <h5 class="modal-title" id="createmodal">Agregar nueva empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               
<form method="post" action="{{route('registEmpresa') }}">
    @csrf
    <div class="mb-3">
        <label for="dueño" class="form-label">Dueño de la empresa</label>
        <input type="text" class="form-control" id="dueño" name="dueño" required>
    </div>

    <div class="mb-3">
        <label for="nombre_empresa" class="form-label">Nombre de la empresa</label>
        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
    </div>

    <div class="mb-3">
        <label for="numero_telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" id="numero_telefono" name="numero_telefono" required>
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" required>
    </div>

    <div class="mb-3">
        <label for="sector" class="form-label">Sector</label>
        <input type="text" class="form-control" id="sector" name="sector" required>
    </div>
    
    <div class="mb-3">
        <label for="correo_electronico" class="form-label">Correo electronico</label>
        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
    </div>

    <div class="mb-3">
        <label for="sitio_web" class="form-label">Sitio web</label>
        <input type="text" class="form-control" id="sitio_web" name="sitio_web" required>
    </div>

    <div class="mb-3">
        <label for="fecha_inicio_asociacion" class="form-label">Fecha de inicio de la asosiacion</label>
        <input type="date" class="form-control" id="fecha_inicio_asociacion" name="fecha_inicio_asociacion" required>
    </div>

    <div class="mb-3">
        <label for="notas" class="form-label">Notas</label>
        <input type="text" class="form-control" id="notas" name="notas" required>
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
                <h5 class="card-title">Empresas</h5>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            
                            <th scope="col">Dueño</th>
                            <th scope="col">Nombre de la empresa</th>
                            <th scope="col">Numero de telefono</th>
                            <th scope="col">Correo electronico</th>
                            <th scope="col">Fecha de inicion de asosiacion</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Works as $work)
                        <tr>
                            <th scope="row">{{ $work->dueño }}</th>
                            <th scope="row">{{ $work->nombre_empresa }}</th>
                            <td>{{ $work->numero_telefono }}</td>
                            <td>{{ $work->correo_electronico }}</td>
                            <td>{{ $work->fecha_inicio_asociacion}}</td>
                            <td>
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarmodal{{$work->id}}">Editar</a>   
                        </td>
                        </tr>



                        <div class="modal fade" id="editarmodal{{$work->id}}" tabindex="-1" aria-labelledby="editarmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarmodal">Actualizar datos de la empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->
    <form method="post" action="{{ route('modificarEmpresa', $work->id) }}">
    @csrf
    <div class="mb-3">
        <label for="dueño" class="form-label">Dueño de la empresa</label>
        <input type="text" class="form-control" id="dueño" name="dueño" value="{{ $work->dueño }}"  required>
    </div>

    <div class="mb-3">
        <label for="nombre_empresa" class="form-label">Nombre de la empresa</label>
        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="{{ $work->nombre_empresa }}"  required>
    </div>

    <div class="mb-3">
        <label for="numero_telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" id="numero_telefono" name="numero_telefono" value="{{ $work->numero_telefono }}"  required>
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" value="{{ $work->estado }}"  required>
    </div>

    <div class="mb-3">
        <label for="sector" class="form-label">Sector</label>
        <input type="text" class="form-control" id="sector" name="sector"  value="{{ $work->sector }}" required>
    </div>
    
    <div class="mb-3">
        <label for="correo_electronico" class="form-label">Correo electronico</label>
        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $work->correo_electronico }}"  required>
    </div>

    <div class="mb-3">
        <label for="sitio_web" class="form-label">Sitio web</label>
        <input type="text" class="form-control" id="sitio_web" name="sitio_web" value="{{ $work->sitio_web }}" required>
    </div>


    <div class="mb-3">
        <label for="notas" class="form-label">Notas</label>
        <input type="text" class="form-control" id="notas" name="notas" value="{{ $work->notas }}"  required>
    </div>
            <div class="modal-footer">
               <a href="{{ route('eliminarEmpresa', $work->id) }}" onclick="return res()" class="btn btn-outline-warning btn-sm">Eliminar</a>
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
            </div>
        </div>

    </div>
    <div class="col-md-2"></div>
</div>


@endsection


