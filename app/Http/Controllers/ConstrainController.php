<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ConstrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('constrain.indexConstraint');
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
        // return $request;
        
        $query = '';
        
        $msj = '';

        if($request->tipoADD != 'FK'){

            try {

                $query .= "ALTER TABLE $request->table";
                
                $query .= " ADD CONSTRAINT PK_$request->table PRIMARY KEY($request->campo);";
    
                $useDB =  DB::statement("USE $request->db;");
    
                $addPK = DB::insert(DB::raw($query)); 
    
                if($addPK){
    
                    $msj = 'La Primary key se creo correctamente';
    
                    return redirect()->route('admin.tables.edit',["bd" => $request->db, "table"=> $request->table])->with('success',$msj);
                }
      
            } catch (QueryException $ex) {
                $msj = $ex->getMessage(); 
                return redirect()->route('admin.tables.edit',["bd" => $request->db, "table"=> $request->table])->with('error',$msj);
            }

        }else{

            try {
                
                if(!$request->tablaFK){
                    $nameFK = 'FK_'.$request->table.'_'.$request->tablaFK;
                }else{
                    $nameFK = $request->tablaFK;
                }
                
                $query .= "ALTER TABLE $request->table";
                
                $query .= " ADD CONSTRAINT $nameFK FOREIGN KEY($request->campo)";
                
                $query .=" REFERENCES $request->tablaFK ($request->campoFK) ON UPDATE NO ACTION ON DELETE NO ACTION;";

                $useDB =  DB::statement("USE $request->db;");
    
                $addFK = DB::insert(DB::raw($query)); 

                if($addFK){
    
                    $msj = 'Constraint  FK_'.$request->table.'_'.$request->tablaFK.' se creo correctamente';
    
                    return redirect()->route('admin.tables.edit',["bd" => $request->db, "table"=> $request->table])->with('success',$msj);
                }
            
            } catch (QueryException $ex) {
            
                $msj = $ex->getMessage(); 
            
                return redirect()->route('admin.tables.edit',["bd" => $request->db, "table"=> $request->table])->with('error',$msj);
            
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
    //     ALTER TABLE `colores`
	// DROP FOREIGN KEY `razas`;

    // 
 
    public function destroy(Request $request, $id)
    {
        
        $useDB =  DB::statement("USE $request->bd;");

        

        if($request->tipo == 'FK'){
            $query = "ALTER TABLE $id DROP FOREIGN KEY $request->llave;";
        }else if($request->tipo == 'PK'){
            $query = "ALTER TABLE $id DROP PRIMARY KEY;";
        }

        try {
            $delete = DB::delete($query);
        } catch (QueryException $ex) {
            $msj = $ex->getMessage(); 
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $id])->with('error',$msj);
        }

        if(!$delete){
            $msj = "La llave ".$request->llave." se elimino correctamente";
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $id])->with('success',$msj);
        }else{
            $msj = "La llave ".$request->llave." no se elimino correctamente";
            return redirect()->route('admin.tables.edit',["bd" => $request->bd, "table"=> $id])->with('error',$msj);
        }

    }
}
