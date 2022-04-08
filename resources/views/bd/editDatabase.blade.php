@extends('layout.app')

@section('title', 'Editar DB')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Base de datos: {{ $id }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.databases.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">{{ $id }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
@endsection

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('error') }}
            @php
            Session::forget('error');
            @endphp
        </div>
    @endif

<div class="card">

    <div class="card-header">

        <h3 class="card-title">Tablas</h3>

        <div class="card-tools">

            <a class="btn btn-primary" href="{{route('admin.query.index', ["bd" => $id])}}" ><i class="fas fa-fw fa-plus"></i>Query</a>
            <a class="btn btn-primary" href="{{route('admin.tables.create',["bd" => $id])}}" ><i class="fas fa-fw fa-plus"></i>Nueva tabla</a>
        </div>


    </div>
    
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Registros</th>
                    <th>COLLATION</th>
                    <th>Comentarios</th>     
                    <th>CREATE_TIME</th>
                    <th>UPDATE_TIME</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>

                @if (count($tables) != 0)
                    @foreach ($tables as $item)

                        <tr>
                            <td>{{ $item->TABLE_NAME }}</td>
                            <td>{{ $item->TABLE_ROWS}}</td>
                            <td>{{ $item->TABLE_COLLATION }}</td>
                            <td>{{ $item->TABLE_COMMENT}}</td>
                            <td>{{ $item->CREATE_TIME}}</td>
                            <td>{{ $item->UPDATE_TIME}}</td>
                            <td width='10px'>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="{{route('admin.datos.index',["table"=>$item->TABLE_NAME, "bd" => $id,])}}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-warning" href="{{ route('admin.tables.edit',["bd" => $id, "table"=> $item->TABLE_NAME] )}}">
                                        <i class="fa fa-pencil"></i>Editar
                                    </a>
        
                                    <form action="{{ route('admin.tables.destroy', [$item->TABLE_NAME, "bd" => $id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>   
                                </div>
                                
                            </td>
                        </tr>
                        
                    @endforeach
                    
                @else

                    <tr ALIGN=CENTER>
                        <td COLSPAN=7>Esta base de datos no tiene tablas</td>        
                    </tr>
                    
                @endif
      
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        
    </div>

    <!-- /.card-footer-->

</div>
    
@endsection

