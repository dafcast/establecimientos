<?php

namespace App\Http\Controllers;

use App\Imagen;
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

    /**
     * @param \App\Establecimiento $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento){
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

        $establecimiento->imagenes = $imagenes;
        return response()->json($establecimiento);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $establecimientos= Establecimiento::with('categoria')->get();
        return response()->json($establecimientos);
    }

    
}
