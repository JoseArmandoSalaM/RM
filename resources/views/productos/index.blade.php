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
    <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createmodal">Nuevo producto</a>
</div>

<form action="{{ route('buscarProducto') }}" method="GET" class="d-flex align-items-center">
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
                <h5 class="modal-title" id="createmodal">Agregar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               
<form method="post" action="{{route('registProducto') }}">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <div class="mb-3">
        <label for="cantidad_existente" class="form-label">Cantidad existente</label>
        <input type="number" class="form-control" id="cantidad_existente" name="cantidad_existente" required>
    </div>

    <div class="mb-3">
    <label for="lugar_adquirido" class="form-label">Empresa donde se compro</label>
    <select class="form-select" id="lugar_adquirido" name="lugar_adquirido" required>
        <option value="">Selecciona una empresa</option>
        @foreach($Empresas as $empresa)
            <option value="{{ $empresa->id }}">{{ $empresa->nombre_empresa }}</option>
        @endforeach
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
  
            <div class="card-body">
                <h5 class="card-title">Productos</h5>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad existente</th>
                            <th scope="col">Lugar adquirido</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Works as $work)
                        <tr>
                            <th scope="row">{{ $work->nombre }}</th>
                            <th scope="row">{{ $work->cantidad_existente }}</th>
                            <td>{{ $work->empresa->nombre_empresa }}</td>
                            <td>
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarmodal{{$work->id}}">Editar</a>   
                        </td>
                        </tr>



                        <div class="modal fade" id="editarmodal{{$work->id}}" tabindex="-1" aria-labelledby="editarmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarmodal">Actualizar datos de los productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->
    <form method="post" action="{{ route('modificarProducto', $work->id) }}">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $work->nombre }}"  required>
    </div>

    <div class="mb-3">
        <label for="cantidad_existente" class="form-label">Cantidad Existente</label>
        <input type="text" class="form-control" id="cantidad_existente" name="cantidad_existente" value="{{ $work->cantidad_existente }}"  required>
    </div>



    

            <div class="modal-footer">
               <a href="{{ route('eliminarProducto', $work->id) }}" onclick="return res()" class="btn btn-outline-warning btn-sm">Eliminar</a>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection


