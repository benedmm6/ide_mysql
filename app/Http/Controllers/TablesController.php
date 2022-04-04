<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit($id)
    {
        //
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
        //
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
