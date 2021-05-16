<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Htttp\Response
     */
    public function store(Request $request){
        
        //leer y almacenar
        $ruta_imagen = $request->file('file')->store('establecimientos','public');

        //redimensionar
        $imagen = Image::make(public_path('storage/' . $ruta_imagen))->fit(800,450);
        $imagen->save();

        //guardar en base de datos
        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request->uuid;
        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();

        $respuesta = [
            'imagen_id' => $imagenDB->id
        ];

        return response()->json($respuesta);
        //redimencionar
        //guardar en DB
    }


    /**
     * @param \App\Imagen $imagen
     * @return \Illuminate\Http\Response
     */

    public function destroy(Imagen $imagen){
       
        if(Storage::disk('public')->exists($imagen->ruta_imagen)){
            Storage::disk('public')->delete($imagen->ruta_imagen);
        }

        $imagen->delete();

        $response = [
            'messsage' => 'Imagen eliminada'
        ];

        return response()->json($response);
    }
}
