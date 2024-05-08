@extends('layouts.app')

@section('template_title')
Servicios
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
    <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createmodal">Nuevo servicio</a>
</div>

<form action="{{ route('buscarServices') }}" method="GET" class="d-flex align-items-center">
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
                <h5 class="modal-title" id="createmodal">Agregar nuevo servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               
<form method="post" action="{{route('registServices') }}">
    @csrf
    <div class="mb-3">
        <label for="nombre_servicio" class="form-label">Nombre del servicio</label>
        <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio" required>
    </div>

    <div class="mb-3">
        <label for="caracteristicas" class="form-label">Caracteristicas</label>
        <textarea type="text" class="form-control" id="caracteristicas" name="caracteristicas" required></textarea>
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" required>
    </div>

    <div class="mb-3">
        <label for="tiempo_estimado" class="form-label">Tiempo estimado</label>
        <input type="tex" class="form-control" id="tiempo_estimado" name="tiempo_estimado" required>
    </div>

    <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <input type="tex" class="form-control" id="categoria" name="categoria" required>
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
                <h5 class="card-title">Servicios</h5>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            
                            <th scope="col">Nombre del servicio</th>
                            <th scope="col">Caracteristicas</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Tiempo estimado</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Works as $work)
                        <tr>
                            <th scope="row">{{ $work->nombre_servicio }}</th>
                            <th scope="row">{{ $work->caracteristicas }}</th>
                            <td>{{ $work->precio }}</td>
                            <td>{{ $work->tiempo_estimado }}</td>
                            <td>{{ $work->categoria }}</td>
                            <td>
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarmodal{{$work->id}}">Editar</a>   
                        </td>
                        </tr>



                        <div class="modal fade" id="editarmodal{{$work->id}}" tabindex="-1" aria-labelledby="editarmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarmodal">Actualizar servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->
    <form method="post" action="{{ route('modificarServices', $work->id) }}">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del servicio</label>
        <input type="text" class="form-control" id="nombre" name="nombre_servicio" value="{{ $work->nombre_servicio }}" required>
    </div>

    <div class="mb-3">
        <label for="caracteristicas" class="form-label">Caracteristicas</label>
        <textarea type="text" class="form-control" id="caracteristicas" name="caracteristicas" required>{{ $work->caracteristicas }}</textarea>
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="text" class="form-control" id="precio" name="precio" value="{{ $work->precio }}" required>
    </div>

    <div class="mb-3">
        <label for="tiempo_estimado" class="form-label">Tiempo estimado</label>
        <input type="text" class="form-control" id="tiempo_estimado" name="tiempo_estimado" value="{{ $work->tiempo_estimado }}" required>
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $work->categoria }}" required>
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


