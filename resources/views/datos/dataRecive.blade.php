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



                    <tr>
                        @foreach ($col as $item)

                            <th>{{$item}} </th> 
                            
                        @endforeach
                    </tr>
{{-- 
                @php

                    print_r($col);
                   
                @endphp --}}
            </thead>
            <tbody>



                @foreach ($data as $item )

                <tr>
                    @foreach ($item as $datos=>$value)

                    <td>{{$value}} </td>
                    
                    @endforeach  
                    
                </tr>
                           
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