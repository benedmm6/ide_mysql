@extends('layout.app')

@section('title', 'Editar tabla')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Table: {{ $id }}</h1>
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

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Primary Key</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.constraints.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="tipoADD" value="PK">
                        <input type="hidden" name="table" value="{{ $id }}">
                        <input type="hidden" name="db" value="{{ $_GET["bd"] }}">

                    <div class="form-group">
                        <label>Seleccionar campo</label>
                        
                        <select class="form-control" name="campo">
                            @foreach ($columnsTable as $item)

                                <option value="{{ $item->COLUMN_NAME}}">{{ $item->COLUMN_NAME}}</option>
                                
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input class="btn btn-primary" type="submit" value="Crear primary key" />
                </div>

                </form>
        </div>
        </div>
    </div>

    {{-- MODAL AFK --}}

    <div class="modal fade" id="addFK" tabindex="-1" role="dialog" aria-labelledby="addFK" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">FOREIGN KEY</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.constraints.store')}}" method="post">
                    @csrf
                        <input type="hidden" name="tipoADD" value="FK">
                        <input type="hidden" name="table" value="{{ $id }}">
                        <input type="hidden" name="db" value="{{ $_GET["bd"] }}">

                    <div class="form-group">
                        <label>Nombre de la llave</label>

                        <input type="text" name="nombrellave" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Columna</label>

                        <input type="text" name="campo" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Tabla de referenia</label>

                        <input type="text" name="tablaFK" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Columna foránea</label>

                        <input type="text" name="campoFK" class="form-control">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input class="btn btn-primary" type="submit" value="Crear primary key" />
                </div>

                </form>
        </div>
        </div>
    </div>

    @if(Session::has('warning'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
            {{ Session::get('warning') }}
            @php
            Session::forget('warning');
            @endphp
        </div>
    @endif

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

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">General</h3>
    
            <div class="card-tools">

            </div>
        </div>

        <form action="{{ route('admin.tables.update', $id) }}" method="POST">
            
            @method('put')

            @csrf
                
            
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="bd" value="{{ $dataTable[0]->TABLE_SCHEMA }}">
                    <label for="inputName">Nombre de la tabla</label>
                    <input type="text" name="tableName" class="form-control" value="{{ $id }}">
                    <input type="hidden" name="oldName" class="form-control" value="{{ $id }}">
                    <input type="hidden" name="oldComment" class="form-control" value="{{ $dataTable[0]->TABLE_COMMENT }}">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Comentario</label>
                    <textarea class="form-control" name="tableComment"
                        rows="4">{{ $dataTable[0]->TABLE_COMMENT }}</textarea>
                </div>
            </div>

            <div class="card-footer">
                <input class="btn btn-success" type="submit" value="Guardar" />
            </div>

        </form>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <div class="card-header">
            
            <h3 class="card-title">Agregar columna</h3>

        </div>
        <form action="{{ route('admin.columns.store') }}" method="POST">

            @csrf

            <input type="hidden" name="bd" value="{{ $_GET["bd"] }}">
            <input type="hidden" name="table" value="{{ $id }}">

        
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Column Name</th>
                            <th>Datatype</th>
                            <th>Permitir NULL</th>
                            <th>Predeterminado</th>
                            <th>Comentarios</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="nombre">
                            </td>
                            <td>
                                <select name="tipo" class="form-control">
                                    <option value="TINYINT">TINYINT</option>
                                    <option value="SMALLINT">SMALLINT</option>
                                    <option value="MEDIUMINT">MEDIUMINT</option>
                                    <option value="INT">INT</option>
                                    <option value="BIGINT">BIGINT</option>
                                    <option value="FLOAT">FLOAT</option>
                                    <option value="DOUBLE">DOUBLE</option>
                                    <option value="DECIMAL">DECIMAL</option>
                                    <option value="VARCHAR">VARCHAR</option>
                                    <option value="CHAR">CHAR</option>
                                    <option value="TINYTEXT">TINYTEXT</option>
                                    <option value="TEXT">TEXT</option>
                                    <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                                    <option value="LONGTEXT">LONGTEXT</option>
                                    <option value="JSON">JSON</option>
                                    <option value="BINARY">BINARY</option>
                                    <option value="VARBINARY">VARBINARY</option>
                                    <option value="TINYBLOB">TINYBLOB</option>
                                    <option value="BLOB">BLOB</option>
                                    <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                                    <option value="LONGBLOB">LONGBLOB</option>
                                    <option value="DATE">DATE</option>
                                    <option value="TIME">TIME</option>
                                    <option value="YEAR">YEAR</option>
                                    <option value="DATETIME">DATETIME</option>
                                    <option value="TIMESTAMP">TIMESTAMP</option>
                                    <option value="POINT">POINT</option>
                                    <option value="LINESTRING">LINESTRING</option>
                                    <option value="POLYGON">POLYGON</option>
                                    <option value="GEOMETRY">GEOMETRY</option>
                                    <option value="MULTIPOINT">MULTIPOINT</option>
                                    <option value="MULTILINESTRING">MULTILINESTRING</option>
                                    <option value="MULTIPOLYGON">MULTIPOLYGON</option>
                                    <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
                                    <option value="UNKNOWN">UNKNOWN</option>
                                    <option value="ENUM">ENUM</option>
                                    <option value="SET">SET</option>
                                </select>
                            </td>
                            <td>
                                <select name="isNull" class="form-control">
                                    <option value="NULL">Permitir NULL</option>
                                    <option value="NOT NULL">Not NULL</option>
                                </select>
                            </td>
                            <td>
                                <select name="predeterminado" class="form-control">
                                    <option value="">Sin valor predeterminado</option>
                                    <option value="NULL">NULL</option>
                                    <option value="AUTO_INCREMENT">AUTO_INCREMENT</option>
                                </select>
                        
                            </td>
                            <td>
                                <input type="text" name="comentario" class="form-control">
                            </td>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Agregar columna" />
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>

        </form>
    </div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">Columnas</h3>

        <div class="card-tools">
            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">PRIMARY KEY</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#addFK">FOREIGN KEY</button>
        </div>


    </div>
    
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th>KEY</th>
                    <th>Column Name</th>
                    <th>Datatype</th>
                    <th>Permitir NULL</th>
                    <th>Predeterminado</th>
                    <th>Comentarios</th>
                    <th></th>
                </tr>
            </thead>

                @if (count($columnsTable) != 0)

                    <tbody>
                        @foreach ($columnsTable as $item)

                        <form action="{{ route('admin.columns.update',$id) }}" method="POST">

                            @method('put')

                            @csrf
                
                            <input type="hidden" name="bd" value="{{ $_GET["bd"] }}">
                            <input type="hidden" name="table" value="{{ $id }}">
                            <input type="hidden" name="oldNombre" value="{{ $item->COLUMN_NAME }}">

                            <tr>
                                <td>
                                    @if ($item->COLUMN_KEY == 'PRI' )
                                       PK
                                    @endif

                                    @if($item->COLUMN_KEY == 'MUL')

                                        FK
                                    @endif
                               
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="nombre" value="{{ $item->COLUMN_NAME}}">
                                    
                                </td>
                                <td>
                                    <select name="tipo" class="form-control">
                                        <option value="{{ $item->DATA_TYPE }}">{{ $item->DATA_TYPE  }}</option>
                                        <option value="TINYINT">TINYINT</option>
                                        <option value="SMALLINT">SMALLINT</option>
                                        <option value="MEDIUMINT">MEDIUMINT</option>
                                        <option value="INT">INT</option>
                                        <option value="BIGINT">BIGINT</option>
                                        <option value="FLOAT">FLOAT</option>
                                        <option value="DOUBLE">DOUBLE</option>
                                        <option value="DECIMAL">DECIMAL</option>
                                        <option value="VARCHAR">VARCHAR</option>
                                        <option value="CHAR">CHAR</option>
                                        <option value="TINYTEXT">TINYTEXT</option>
                                        <option value="TEXT">TEXT</option>
                                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                                        <option value="LONGTEXT">LONGTEXT</option>
                                        <option value="JSON">JSON</option>
                                        <option value="BINARY">BINARY</option>
                                        <option value="VARBINARY">VARBINARY</option>
                                        <option value="TINYBLOB">TINYBLOB</option>
                                        <option value="BLOB">BLOB</option>
                                        <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                                        <option value="LONGBLOB">LONGBLOB</option>
                                        <option value="DATE">DATE</option>
                                        <option value="TIME">TIME</option>
                                        <option value="YEAR">YEAR</option>
                                        <option value="DATETIME">DATETIME</option>
                                        <option value="TIMESTAMP">TIMESTAMP</option>
                                        <option value="POINT">POINT</option>
                                        <option value="LINESTRING">LINESTRING</option>
                                        <option value="POLYGON">POLYGON</option>
                                        <option value="GEOMETRY">GEOMETRY</option>
                                        <option value="MULTIPOINT">MULTIPOINT</option>
                                        <option value="MULTILINESTRING">MULTILINESTRING</option>
                                        <option value="MULTIPOLYGON">MULTIPOLYGON</option>
                                        <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
                                        <option value="UNKNOWN">UNKNOWN</option>
                                        <option value="ENUM">ENUM</option>
                                        <option value="SET">SET</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="isNull" class="form-control">
                                        <option value="NULL">Permitir NULL</option>
                                        <option value="NOT NULL">Not NULL</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="predeterminado" class="form-control">
                                        <option value="">Sin valor predeterminado</option>
                                        <option value="NULL">NULL</option>
                                        <option value="AUTO_INCREMENT">AUTO_INCREMENT</option>
                                    </select>
                            
                                </td>
                                <td>
                                    <input type="text" name="comentario" class="form-control" value="{{ $item->COLUMN_COMMENT}}">
                                </td>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="Actualizar" />
                                </form>
                                </td>

                                <td>
                                    <form action="{{ route('admin.columns.destroy', [$id, "bd" => $dataTable[0]->TABLE_SCHEMA, "columna" => $item->COLUMN_NAME])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>           

                @else

                    <tr ALIGN=CENTER>
                        <td COLSPAN=7>Esta tabla no tiene ningua columna</td>
                    </tr>

                @endif
            
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        
    </div>

    <!-- /.card-footer-->

</div>
    
@endsection

