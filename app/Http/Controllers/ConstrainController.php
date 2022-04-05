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
        // ALTER TABLE Persons
        // ADD CONSTRAINT PK_Person PRIMARY KEY (ID,LastName);
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
    public function destroy($id)
    {
        //
    }
}
