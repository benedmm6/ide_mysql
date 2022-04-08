<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
   
        $bd = $request->bd;
        $table = $request->table;
        $base = DB::statement("USE $bd");
        $datos = DB::select(" select*from $table ");
        $query2 = "SELECT * FROM information_schema.columns where table_name ='$table' ";
        $columns = DB::select($query2);
        $object = '';
        $key = 'false';
        $keym = 'false';
        foreach ($columns as $item) {
            if ($item->COLUMN_KEY == ('PRI')) {
                $key = 'true';
                $nombreid = $item->COLUMN_NAME;
            }if($item->COLUMN_KEY == ('MUL')){
                $keym = 'true';
                $idr = $item->COLUMN_NAME;
            } else {
                if ($object == ('')) {
                    $object = $item->COLUMN_NAME;
                }
            }
        }
        if ($key == ('true')) {
            $id = $nombreid;
            if($keym == ('true')){
                $foreign=$idr;
                return view('datos.dataShow', compact('id', 'key','foreign','keym', 'bd', 'table', 'datos', 'columns'));
            }         
            return view('datos.dataShow', compact('id', 'key', 'bd', 'table', 'datos', 'columns'));
        } else
            $id = $object;
        return view('datos.dataShow', compact('id', 'key', 'bd','table', 'datos', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $bd = $request->bd;
        $table = $request->table;
        $id = $request->clave;
        $key = $request->primary;
        $campos = DB::select(DB::raw("SELECT count( COLUMN_NAME ) as campos
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE table_name = '$table'"));
        $query2 = "SELECT * FROM information_schema.columns where table_name ='$table' ";
        $columns = DB::select($query2);
        return view('datos.dataIndex', compact('id', 'key', 'bd', 'table', 'campos', 'columns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // 
        $table = $request->table;
        $bd = $request->bd;
        $id = $request->clave;
        $key = $request->primary;
        if ($key != ('false')) {
            $valores = $request->except('table', '_token', 'id', 'bd', 'primary', 'clave');
            $base = DB::statement("USE $bd");
            $columns  = DB::SELECT(DB::RAW("SHOW COLUMNS FROM `$table` FROM `$bd`"));
            $lastid  = DB::table($table)->SELECT($id)->orderBy($id, 'desc')->value($id) + 1;
            // SELECT MAX(id) AS id FROM tabla
            $string = implode("','", $valores);
            $newReg = DB::insert(DB::raw("INSERT INTO $table VALUES('$lastid','$string');"));
            if ($newReg) {
                $msj = "El registro se a insertado correctamente";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            } else {
                $msj = "El registro no se a insertado";
                return redirect()->route('admin.datostables.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            }
        } else {
            $valores = $request->except('table', '_token', 'id', 'bd', 'primary', 'clave');
            $base = DB::statement("USE $bd");
            $columns  = DB::SELECT(DB::RAW("SHOW COLUMNS FROM `$table` FROM `$bd`"));
            // SELECT MAX(id) AS id FROM tabla
            $string = implode("','", $valores);

            $newReg = DB::insert(DB::raw("INSERT INTO $table VALUES('$string');"));
            if ($newReg) {
                $msj = "El registro se a insertado correctamente";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            } else {
                $msj = "El registro no se a insertado";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            }
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
       
        
        //

    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

        $table = $request->table;
        $bd = $request->bd;
        $id = $request->clave;
        $valor = $request->id;
        $key = $request->primary;
        $campos = DB::select(DB::raw("SELECT count( COLUMN_NAME ) as campos
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE table_name = '$table'"));
        $query2 = "SELECT * FROM information_schema.columns where table_name ='$table' ";
        $columns = DB::select($query2);
        return view('datos.dataUpdate', compact('table', 'valor', 'id', 'key', 'bd', 'campos', 'columns'));
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
        // $id=$request->tabla;
        $table = $request->table;
        $bd = $request->bd;
        $id = $request->clave;
        $valor = $request->id;
        $key = $request->primary;
        $valores = $request->except('table', '_token', '_method', 'id', 'bd', 'primary', 'clave', 'tabla');
        $base = DB::statement("USE $bd");
        $columns  = DB::SELECT(DB::RAW("SHOW COLUMNS FROM `$table` FROM `$bd`"));
        $cadena=[];
        if($key!=('false')){
            foreach ($columns as $item) {
                if ($item->Field != ($id)) {
                    $campo = $item->Field;
                    foreach ($valores as $data) {                    
                        $val = $data;
                        if(!in_array($campo, $cadena)) {
                            if(!in_array($val, $cadena)){
                                $resultado[]= $campo."='".$val."'";
                                $cadena[]= $campo;
                                $cadena[]= $val; 
                            }
                            
                        }
                                          
                    }
                }
            }
    
            $string = implode(",", $resultado); 
    
            $newReg = DB::insert(DB::raw("UPDATE $table SET $string WHERE $id=$valor;"));
            if ($newReg) {
                $msj = "El registro se acatualizo correctamente";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            } else {
                $msj = "El registro no se a insertado";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            }
        }if($key==('false')){
            foreach ($columns as $item) {                
                    $campo = $item->Field;
                    foreach ($valores as $data) {                    
                        $val = $data;
                        if(!in_array($campo, $cadena)) {
                            if(!in_array($val, $cadena)){
                                $resultado[]= $campo."='".$val."'";
                                $cadena[]= $campo;
                                $cadena[]= $val; 
                            }
                            
                        }
                                          
                    }            
            }
    
            $string = implode(",", $resultado); 
    
            $newReg = DB::insert(DB::raw("UPDATE $table SET $string WHERE $id=$valor;"));
            if ($newReg) {
                $msj = "El registro se acatualizo correctamente";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            } else {
                $msj = "El registro no se a insertado";
                return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
            } 

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $table = $request->table;
        $bd = $request->bd;
        $id = $request->clave;
        $bd = DB::table('information_schema.tables')->SELECT('table_schema')->WHERE('TABLE_NAME', '=', $table)->value('Table_schema');
        $base = DB::statement("USE $bd");
        $query = "DELETE FROM $table WHERE $id=$request->id;";

        $delete = DB::delete($query);

        if ($delete) {
            $msj = "El registro se elimino correctamente";
            return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
        } else {
            $msj = "El registro no se elimino correctamente";
            return redirect()->route('admin.datos.index', ["bd" => $request->bd, "table" => $table])->with('success', $msj);
        }
    }
}
