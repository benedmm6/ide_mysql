@extends('layout.app')

@section('title', 'Nueva BD')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nueva base de datos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.databases.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Nueva base de datos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
@endsection

@section('content')

    {{-- Notificaciones --}}

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

    <!-- Default box -->
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">Crear base de datos</h3>

           
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.databases.store']) !!}

            <div class="form-group">
                {!! Form::label('Nombre de la base de datos') !!}
                {!! Form::text('schema_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre base de datos']) !!}
                <small id="helpId" class="text-muted">Nombre de la base de datos</small>
            </div>

            <div class="form-group">
                {!! Form::label('Cotejamiento de la base de datos') !!}
            
                <select name="cotejamiento" class="form-control">
            
                    <option value="0">Cotejamiento</option>
            
                    @foreach ($collation as $value)
            
                    <option value="{{ $value->Collation }}">{{ $value->Collation }}
                    </option>
            
                    @endforeach
            
                </select>
                <small id="helpId" class="text-muted">Cotejamiento de la base de datos</small>
            
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            {!! Form::submit('Crear base de datos', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
        <!-- /.card-footer-->

    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- /.card -->
    
@endsection