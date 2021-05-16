@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <!-- Esri Leaflet Geocoder -->
    <link
    rel="stylesheet"
    href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />

    <!-- dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Registrar Establecimiento</h1>
        <div class="row justify-content-center">
            <form class="col-md-9 bg-white p-3" action="{{route('establecimientos.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre, Categoría, e Imagen Principal</legend>
                    
                    <div class="form-group">
                        <label for="nombre">Nombre Establecimiento</label>
                        <input type="text"
                                id="nombre"
                                name="nombre"
                                placeholder="Nombre Establecimiento"
                                value="{{old('nombre')}}"
                                class="form-control @error('nombre') is-invalid @enderror">
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria_id">Categoría</label>
                        <select id="categoria_id"
                                name="categoria_id"
                                class="form-control @error('categoria_id') is-invalid @enderror">
                                <option value="" selected disabled>-- Seleccion una categoria --</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}" {{old('categoria_id') == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                                @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="imagen_principal">Imagen Principal</label>
                        <input type="file"
                                id="imagen_principal"
                                name="imagen_principal"
                                class="form-control @error('imagen_principal') is-invalid @enderror">
                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Ubicación</legend>
                    
                    <div class="form-group">
                        <label for="buscadorUbicacion">Coloca la dirección del Establecimiento</label>
                        <input type="text"
                            id="buscadorUbicacion"
                            placeholder="Digite la direccion del establecimiento"
                            class="form-control">
                        <p class="text-center text-secondary my-3">El buscador dara ubicación aproximada, mueva el cursor a la ubicación exacta</p>
                    </div>
                    <div class="form-group">
                        <div id="mapa" style="height: 400px"></div>
                    </div>
                    <p class="informacion">Confirme que los siguientes datos son correctos</p>
                    
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text"
                            id="direccion"
                            name="direccion"
                            class="form-control @error('direccion') is-invalid @enderror"
                            value="{{old('direccion')}}"
                        >
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input type="text"
                            id="colonia"
                            name="colonia"
                            class="form-control @error('colonia') is-invalid @enderror"
                            value="{{old('colonia')}}"
                        >
                        @error('colonia')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" name="lat" id="lat" value="{{old('lat')}}">
                    <input type="hidden" name="lng" id="lng" value="{{old('lng')}}">

                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input 
                                type="tel" 
                                class="form-control @error('telefono')  is-invalid  @enderror" 
                                id="telefono" 
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ old('telefono') }}"
                            >
    
                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
    
                        
    
                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror" 
                                name="descripcion"
                            >{{ old('descripcion') }}</textarea>
    
                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input 
                                type="time" 
                                class="form-control @error('apertura')  is-invalid  @enderror" 
                                id="apertura" 
                                name="apertura"
                                value="{{ old('apertura') }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input 
                                type="time" 
                                class="form-control @error('cierre')  is-invalid  @enderror" 
                                id="cierre" 
                                name="cierre"
                                value="{{ old('cierre') }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>

                
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div id="dropzone" class="dropzone form-group"></div>
                </fieldset>

                <input type="hidden" id="uuid" name="uuid" value="{{Str::uuid()->toString()}}">
                <input type="submit" class="d-block btn btn-primary mt-3" value="Registrar Establecimiento">
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>

    <!-- Esri Leaflet Geocoder -->
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

    <!-- Dropzone -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" defer></script>
@endsection