@extends('layout.app')

@section('title', 'Tabla')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$table}}</h1>
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

        <h3 class="card-title">Datos</h3>
        <br>
      

    </div>
    
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <div class="card-footer">
        <div class="card-footer">
            <div class="card-tools">
                <a class="btn btn-primary" href="{{route('admin.datos.create',["clave"=>$id,"bd" => $bd,"table"=>$table,"primary"=>$key])}}"><i ></i>Añadir registro</a>
            </div>
        </div>  
    </div>               
                @foreach ($columns as $item)
             
                        <th>{{ $item->COLUMN_NAME }}</th>
                                    
                   
                        
               @endforeach 
            </thead>
            <tbody>

                @foreach ($datos as $item )

                <tr>
                    @foreach ($item as $datos=>$value)

                    <td>{{$value}} </td>                                                                              
                
                @endforeach  
                @if($key==('true'))
                <td>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{{route('admin.datos.edit',[$id,"bd" => $bd,"table"=>$table,"id"=>$item->$id,"clave"=>$id,"primary"=>$key])}}"><i class="fas fa-eye"></i></a>
    
                        <form action="{{ route('admin.datos.destroy',[$id,"bd" => $bd,"table"=>$table,"id"=>$item->$id,"primary"=>$key,"clave"=>$id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>   
                    </div>     
                </td>  
                @else           
                <td>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{{route('admin.datos.edit',[$id,"bd" => $bd,"table"=>$table,"id"=>$item->$id,"primary"=>$key,"clave"=>$id])}}"><i class="fas fa-eye"></i></a>
    
                        <form action="{{ route('admin.datos.destroy',[$id,"bd" => $bd,"table"=>$table,"id"=>$item->$id,"primary"=>$key,"clave"=>$id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>   
                    </div>     
                </td>
                @endif
                @endforeach

                
                
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        footer
    </div>

    <!-- /.card-footer-->

</div>
    
@endsection