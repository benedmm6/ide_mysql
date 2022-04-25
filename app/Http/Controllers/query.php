<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;

class query extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $id=$request->bd;

        return view('datos.dataQuery', compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //    
        $valores = $request->except('table', '_token', 'id', 'bd', 'primary', 'clave');
        $id =$request->bd; 
        $string = implode("','", $valores);

        try {
            
            $base = DB::statement("USE $id");
            
            $data = DB::SELECT(DB::RAW($string));

            $array = json_decode(json_encode($data), true);

            [$col, $values] = Arr::divide($array[0]);

            $msj = 'Consulta realizada correctamente';

            return view('datos.dataRecive', compact('id','data','col','values'))->with('success', $msj);

        } catch (QueryException $ex) {
            
            $msj = $ex->getMessage(); 

            return redirect()->route('admin.query.index', $id)->with('error', $msj);
            
            // return redirect()->route('admin.tables.edit',["bd" => $request->db, "table"=> $request->table])->with('error',$msj);
        
        }

            // $base = DB::statement("USE $id");
            // $data  = DB::SELECT(DB::RAW($string));
            // return view('datos.dataRecive', compact('id','data'));
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
