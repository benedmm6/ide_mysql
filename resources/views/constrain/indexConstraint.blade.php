@extends('layout.app')

@section('title', 'Constraints')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Table: PLACEHOLDER</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Inicio</a></li>
                        <li class="breadcrumb-item active">Constraints</li>
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

        <h3 class="card-title">Constraints</h3>

        <div class="card-tools">
            <button class="btn btn-success">PRIMARY KEY</button>
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
            
                <tr ALIGN=CENTER>
                    <td COLSPAN=7>Esta base de datos no tiene tablas</td>
                </tr>
            
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        
    </div>

    <!-- /.card-footer-->

</div>
    
@endsection

