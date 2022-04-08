@extends('layout.app')

@section('title', 'Tabla')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Insertar registro</h1>
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

        <h3 class="card-title">{{$table}}</h3>
        <br>      

    </div>
    
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap">
            
            @foreach ($columns as $item)
            <thead>  
                @if($item->COLUMN_NAME!=('$id'))
                <th>{{ $item->COLUMN_NAME }}</th> 
                @endif                           
                                        
            </thead>
            <tbody>                

               <form action="{{ route('admin.datos.store',['bd'=>$bd,'table'=>$table,'clave'=>$id,"primary"=>$key]) }}" method="POST">
                @csrf
                    @if($item->COLUMN_NAME!=('$id'))
                    <td><input type="text" placeholder="Insertar texto" name={{$item->COLUMN_NAME}}></td> 
                    @endif                    
                           
            </tbody>
            @endforeach  
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <input class="btn btn-primary" type="submit" value="Crear registro" />
    </div>
</form> 

    <!-- /.card-footer-->

</div>

@endsection