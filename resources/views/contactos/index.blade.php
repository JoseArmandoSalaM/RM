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
    <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createmodal">Nuevo contacto</a>
</div>

<form action="{{ route('buscarContacto') }}" method="GET" class="d-flex align-items-center">
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
                <h5 class="modal-title" id="createmodal">Agregar nuevo contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Formulario de registro -->

               
<form method="post" action="{{route('registContacto') }}">
    @csrf
    <div class="mb-3">
        <label for="nombre_completo" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="Email" class="form-control" id="correo" name="correo" required>
    </div>

    <div class="mb-3">
        <label for="numero_telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" id="numero_telefono" name="numero_telefono" required>
    </div>

    <div class="mb-3">
        <label for="fecha_alianza" class="form-label">Fecha de alianza</label>
        <input type="date" class="form-control" id="fecha_alianza" name="fecha_alianza" required>
    </div>
    
    <div class="mb-3">
        <label for="rol_compra" class="form-label">Rol que cumple en la compra</label>
        <input type="text" class="form-control" id="rol_compra" name="rol_compra" required>
    </div>

    <div class="mb-3">
    <label for="empresa_id" class="form-label">Nombre de la empresa</label>
    <select class="form-select" id="empresa_id" name="empresa_id" required>
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
                <h5 class="card-title">Contactos</h5>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo electronico</th>
                            <th scope="col">Numero de telefono</th>
                            <th scope="col">Fecha de inicion de asociación</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Works as $work)
                        <tr>
                            <th scope="row">{{ $work->nombre_completo }}</th>
                            <th scope="row">{{ $work->correo }}</th>
                            <td>{{ $work->numero_telefono }}</td>
                            <td>{{ $work->fecha_alianza }}</td>
                            <td>{{ $work->empresa->nombre_empresa}}</td>
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
    <form method="post" action="{{ route('modificarContacto', $work->id) }}">
    @csrf
    <div class="mb-3">
        <label for="nombre_completo" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="{{ $work->nombre_completo }}"  required>
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo de la empresa</label>
        <input type="text" class="form-control" id="correo" name="correo" value="{{ $work->correo }}"  required>
    </div>

    <div class="mb-3">
        <label for="numero_telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" id="numero_telefono" name="numero_telefono" value="{{ $work->numero_telefono }}"  required>
    </div>

    <div class="mb-3">
        <label for="rol_compra" class="form-label">Rol en la compra</label>
        <input type="text" class="form-control" id="rol_compra" name="rol_compra" value="{{ $work->rol_compra }}"  required>
    </div>

    

            <div class="modal-footer">
               <a href="{{ route('eliminarContacto', $work->id) }}" onclick="return res()" class="btn btn-outline-warning btn-sm">Eliminar</a>
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


