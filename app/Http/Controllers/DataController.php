<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\QueryException;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $dbs = DB::Select("SELECT schema_name as name FROM information_schema.schemata");

        $db = DB::select("SELECT * FROM information_schema.schemata");

        return view('bd.indexDatabase',compact('db'));


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collation = DB::select('SHOW COLLATION');
        
        return view('bd.createDatabase', compact('collation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'schema_name' => 'required',
            'cotejamiento' => 'required',
        ]);

        $exist = DB::select(DB::raw("select count(*) as aggregate from information_schema.schemata where schema_name = '$request->schema_name'"));

        if($request->cotejamiento == 0){

            $query = "CREATE DATABASE $request->schema_name";

        }else{

            $query = "CREATE DATABASE $request->schema_name COLLATE $request->cotejamiento";

        }
        
        if($exist[0]->aggregate == 0){
            
            try {
                $newDataBase = DB::insert(DB::raw($query));
            } catch (QueryException $ex) {
                $msj = $ex->getMessage(); 
                return redirect()->route('admin.databases.index')->with('error',$mensaje);
            }

            if($request->cotejamiento == 0){

                $mensaje = "La base de datos se creo con el cotejamiento por default";

            }else{
                $mensaje = "La base de datos se creo correctamente"; 
            }

            return redirect()->route('admin.databases.index')->with('success', $mensaje);

        }else{
            $mensaje = "La BD ".$request->schema_name." ya existe en el servidor";
            return redirect()->route('admin.databases.index')->with('error', $mensaje);
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
        $query = "SELECT * FROM information_schema.tables where table_schema = '$id'";

        $tables = DB::select($query);
        
        return view('bd.editDatabase', compact('id','tables'));


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
        // CREATE TABLE `prueba1`.`usuarios` (
        //     `idusuarios` INT NOT NULL COMMENT 'awdawdawd',
        //     PRIMARY KEY (`idusuarios`))
        //   COMMENT = 'awdawdawd';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $query = "DROP DATABASE $id";

        try {
            $delete = DB::delete($query);
        } catch (QueryException $ex) {
            $msj = $ex->getMessage(); 
            return redirect()->route('admin.databases.index')->with('error',$msj);
        }

        $delete = DB::delete($query);

        if($delete){
            $msj = "La base de datos ".$id." se elimino correctamente";
            return redirect()->route('admin.databases.index')->with('success',$msj);
        }else{
            $msj = "La base de datos ".$id." no se elimino correctamente";
            return redirect()->route('admin.databases.index')->with('success',$msj);
        }

    }
}
