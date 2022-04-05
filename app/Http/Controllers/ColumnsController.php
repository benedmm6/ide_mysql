<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\QueryException;

class ColumnsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $query = '';

        $msj = '';

        if($request->nombre != '' || $request->nombre != null){

            $query .= "ALTER TABLE $request->table ADD COLUMN $request->nombre";
            $query .= " $request->tipo "."$request->isNull";
            $query .= " $request->predeterminado";
            if($request->comentario != '' || $request->comentario != null) {
                $query .= " COMMENT '$request->comentario'";
            }

        }else{
            
            $msj = 'El nombre de la columna no puede ir vacio';

            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('warning',$msj);

        }

        try {

            $useDB =  DB::statement("USE $request->bd;");

            $addColumn = DB::insert(DB::raw($query));

            if($addColumn){
                $msj = "La columna ".$request->nombre." se creo correctamente";
                return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('success',$msj);
            }else{
                $msj = "La columna ".$request->nombre." no se creo correctamente";
                return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('error',$msj);
            }

        } catch (QueryException $ex) {
            
            $msj = $ex->getMessage(); 
            
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('error',$msj);
        
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
        // return $request;
        $query = '';

        if($request->nombre != '' || $request->nombre != null){

            $query .= "ALTER TABLE $request->table";
            $query .= " CHANGE COLUMN $request->oldNombre $request->nombre";
            $query .= " $request->tipo $request->predeterminado";
            if($request->comentario != '' || $request->comentario != null) {
                $query .= " COMMENT '$request->comentario'";
            }

            try {

                $useDB =  DB::statement("USE $request->bd;");
    
                $updateColumn = DB::insert(DB::raw($query));
    
                if($updateColumn){
                    $msj = "La columna ".$request->nombre." se actualizo correctamente";
                    return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('success',$msj);
                }else{
                    $msj = "La columna ".$request->nombre." no se actualizo correctamente";
                    return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('error',$msj);
                }
    
            } catch (QueryException $ex) {
                
                $msj = $ex->getMessage(); 
                
                return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('error',$msj);
            
            }

        }else{

            $msj = 'El nombre de la columna no puede ir vacio';

            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $request->table])->with('warning',$msj);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $useDB =  DB::statement("USE $request->bd;");

        $query = "ALTER TABLE $id DROP COLUMN $request->columna;";

        try {
            $delete = DB::delete($query);
        } catch (QueryException $ex) {
            $msj = $ex->getMessage(); 
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $id])->with('error',$msj);
        }

        if(!$delete){
            $msj = "La columna ".$request->columna." se elimino correctamente";
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $id])->with('success',$msj);
        }else{
            $msj = "La columna ".$request->columna." no se elimino correctamente";
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $id])->with('error',$msj);
        }

    }
}
