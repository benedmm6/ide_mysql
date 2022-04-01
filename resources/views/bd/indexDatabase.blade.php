@extends('layout.app')

@section('title', 'Inicio')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bases de datos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Bases de datos</li>
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

        <h3 class="card-title">Bases de datos</h3>

    </div>
    
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>CHARACTER SET</th>
                    <th>DEFAULT COLLATION</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($db as $item)

                <tr>
                    <td>{{$item->SCHEMA_NAME}}</td>
                    <td>{{ $item->DEFAULT_CHARACTER_SET_NAME}}</td>
                    <td>{{ $item->DEFAULT_COLLATION_NAME}}</td>
                    <td width='10px'>
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{route('admin.databases.edit',$item->SCHEMA_NAME)}}"><i class="fas fa-eye"></i></a>

                            <form action="{{ route('admin.databases.destroy', $item->SCHEMA_NAME)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>   
                        </div>
                        
                    </td>
                </tr>


                    
                @endforeach


                {{-- <tr>
                    <td>MySQL</td>
                    <td>utf8</td>
                    <td>2MB</td>
                    <td>Editar | Eliminar</td>
                </tr> --}}
                
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