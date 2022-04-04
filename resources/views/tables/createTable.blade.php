@extends('layout.app')

@section('title', 'Crear Tabla')

@section('content-header')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Nueva base de datos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Tablas</a></li>
                    <li class="breadcrumb-item active">Nueva Tabla</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('content')

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            {{ Session::get('error') }}
            @php
            Session::forget('error');
            @endphp
        </div>
    @endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nueva tabla</h3>

        <div class="card-tools">



            <button class="btn btn-primary add-row">Agregar Columna</button>
            <button class="btn btn-danger delete-row">Eliminar campos</button>

        </div>
    </div>

    <form action="{{ route('admin.tables.store') }}" method="POST">
        @csrf

        @if (isset($_GET["bd"]))

            <input type="hidden" name="bd" value="{{ $_GET["bd"] }}">
            
        @endif

        

    <div class="card-body">
        <div class="form-group">
          <label>Nombre de la tabla</label>
          <input type="text" name="nombreTabla" class="form-control" placeholder="example: newTable" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label>Comentarios</label>
            <textarea class="form-control" rows="3" name="comentariosTabla"></textarea>
          </div>
    </div>

    



    <div class="card-body table-responsive p-0">
        


        <table class="table table-head-fixed text-nowrap" id="results">
            <thead>
                <tr>
                    <th> </th>
                    <th>Column Name</th>
                    <th>Datatype</th>
                    <th>Permitir NULL</th>
                    <th>Predeterminado</th>
                    <th>Comentarios</th>

                </tr>
            </thead>

            

                <tbody class="body">
                    
                </tbody>

        </table>

    </div>

    <div class="card-footer">
        <input class="btn btn-primary" type="submit" value="Crear Tabla" />
    </div>

    </form>
</div>

@endsection