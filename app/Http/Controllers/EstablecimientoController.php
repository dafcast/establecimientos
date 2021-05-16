<?php

namespace App\Http\Controllers;

use App\Categoria;
use Carbon\Carbon;
use App\Establecimiento;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EstablecimientoController extends Controller
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
        $categorias = Categoria::all();
        return view('establecimientos.create',['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar información
        $data = $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required|exists:App\Categoria,id',
            'imagen_principal' => 'required|image|max:1000',
            'direccion' => 'required',
            'colonia' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'required|date_format:H:i',
            'cierre' => 'required|date_format:H:i|after:apertura',
            'uuid' => 'required',
        ]);

        //guardar imagen
        $ruta_imagen = $request->file('imagen_principal')->store('principal','public');
        //redimensionar imagen

        $imagen = Image::make(storage_path('app/public/' . $ruta_imagen))->fit(800,600);
        $imagen->save();

        //enviar a base de datos

        $establecimiento = new Establecimiento($data);
        $establecimiento->imagen_principal = $ruta_imagen;
        $establecimiento->user_id = auth()->user()->id;

        $establecimiento->save();

        return back()->with([
            'mensaje' => 'El establecimiento fue regitrado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }

    // public function imagenes(Request $request){

    //     $imagen = $request->file;
    //     $nombreImagen = time() . '.' . $imagen->extension();
    //     // $path = Storage::move($imagen, public_path('storage/images') . $nombreImagen);

    //     $path = $imagen->storeAs(
    //         '/public/imagenes', $nombreImagen
    //     );


    //     return $path;
    // }
}
