@extends('layout.app')

@section('title', 'Tabla')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
                    <label>Insertar consulta</label>
  
            <div class="card-tools">
               
            </div>
        </div>  
    </div>               
               
            </thead>
            <tbody>
                <form action="{{route('admin.query.store',['bd'=> $id])}}" method="POST">
                    @csrf
                      <td><input type="textarea" name="query" ></td>
                    <div class="card-footer">
                        <input class="btn btn-primary" type="submit" value="Ejecutar query" />
                    </div>
                </form>
                       
                
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