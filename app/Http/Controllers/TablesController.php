<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tables.createTable');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        

        try {

            $query = '';

            if($request->nombreTabla != null || $request->nombreTabla != ''){

                if(!empty($request->nombre)){
    
                    $query = "CREATE TABLE $request->nombreTabla (";
    
                    $count = count($request->nombre);
    
                    for ($i=0; $i < $count; $i++) {
                        
                        if($request->predeterminado[$i] == 'NULL'){
                            $default = 'DEFAULT '.$request->predeterminado[$i];
                        }elseif ($request->predeterminado[$i] == 'AUTO_INCREMENT') {
                            $default = $request->predeterminado[$i];
                        }else{
                            $default = ' ';
                        }
    
                        $comentarioCampo = ' ';
    
                        if($request->comentario[$i] != null || $request->comentario[$i] != ''){
                            $c = $request->comentario[$i];
                            $comentarioCampo = " COMMENT '$c'";
                        }
    
                        $query .= $request->nombre[$i].' '.$request->tipo[$i].' '.$request->isNull[$i].' '.$default.$comentarioCampo;
    
                        if($i  != $count-1){
                            $query .= ',';
                        }
                         
                    }
    
                    $query .= ')';
    
                    if($request->comentariosTabla != null || $request->comentariosTabla!= ''){
                        $query .= "COMMENT '$request->comentariosTabla'";
                    }
    
                    // return $query;
    
                    $useDB =  DB::statement("USE $request->bd;");
    
                    if($useDB){
    
                        $newTable = DB::insert(DB::raw($query));
    
                        if($newTable){
    
                            $msj = "La tabla $request->nombreTabla se creo correctamente";
    
                            return redirect()->route('admin.databases.edit',$request->bd)->with('success', $msj);
                        }else{
    
                            $msj = 'Error al crear la nueva tabla';
                            return redirect()->route('admin.databases.edit',$request->bd)->with('error', $msj);
    
                        }
    
                    }else{
                        $msj = 'Error al crear la tabla, intentalo nuevamente';
                    }
    
                }else{
    
                    $msj = 'La tabla debe llevar al menos una columna';
                    return redirect()->route('admin.tables.create')->with('error', $msj);
    
                }
    
            }else{
    
                $msj = 'La tabla debe llevar un nombre';
                return redirect()->route('admin.tables.create')->with('error', $msj);
    
            }
                        
        } catch (QueryException $ex) {
            $msj = $ex->getMessage(); 
            return redirect()->route('admin.databases.index')->with('error',$msj);
        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $query = "SELECT * FROM TABLES WHERE TABLE_SCHEMA= '$request->bd' AND TABLE_NAME='$id';";

        $query2 = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='$request->bd' AND TABLE_NAME='$id' ORDER BY ORDINAL_POSITION;";

        DB::statement("USE information_schema;");

        $dataTable = DB::select( DB::RAW($query));

        $columnsTable = DB::select(DB::raw($query2));

        return view('tables.editTable',compact('id','dataTable','columnsTable'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $query1= '';

        $query2= '';

        $msj = '';

        // return $request;

        if($request->tableName == ''){

            $msj = 'Los datos no pueden ir vacios';

            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->oldName])->with('warning',$msj);

        }else{

            if($request->tableComment == $request->oldComment and $request->tableName == $request->oldName){
            
                $msj = 'Los datos son los mismos';
    
                return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->oldName])->with('warning',$msj);
    
            }else{
    
                if($request->tableComment != $request->oldComment){
                
                    $query1 = "ALTER TABLE $request->oldName COMMENT = '$request->tableComment';";
        
                    $useDB = DB::statement("USE $request->bd;");
        
                    $comment = DB::insert(DB::raw($query1));
        
                }
        
                if($request->tableName != $request->oldName){
        
                    $query2 = "RENAME TABLE $request->oldName TO $request->tableName;";
        
                    $useDB = DB::statement("USE $request->bd;");
        
                    // $useDB2 = DB::statement("USE information_schema;");
        
                    $rename = DB::insert(DB::raw($query2));
        
                }
    
                $msj = 'Los datos de actualizaron correctamente';
    
                return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->tableName])->with('success',$msj);
    
            }

        }

        $msj = 'Error al actualizar los datos';

        return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->oldName])->with('error',$msj);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $table)
    {

        $useDB =  DB::statement("USE $request->bd;");

        $query = "DROP TABLE $table;";

        $delete = DB::delete($query);

        if(!$delete){
            $msj = "La tabla ".$table." se elimino correctamente";
            return redirect()->route('admin.databases.edit',$request->bd)->with('success',$msj);
        }else{
            $msj = "La tabla ".$table." no se elimino correctamente";
            return redirect()->route('admin.databases.edit',$request->bd)->with('success',$msj);
        }

    }
}
