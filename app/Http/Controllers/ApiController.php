<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function categorias(){
        $categorias = Categoria::all();
        return response()->json($categorias);
    }


    /**
     * @param \App\Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function categoria(Categoria $categoria){
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        return response()->json($establecimientos);
    }


}
