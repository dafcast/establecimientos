
// import
import { OpenStreetMapProvider } from 'leaflet-geosearch';
// setup
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#mapa')){
        const lat = document.querySelector('#lat').value === '' ? 4.6617515: document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value === '' ? -74.0922002: document.querySelector('#lng').value;

        // const lat = 4.6617515;
        // const lng = -74.0922002;
    
        const mapa = L.map('mapa').setView([lat, lng], 16);

        //conjunto de pines

        let markers = new L.featureGroup().addTo(mapa);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);
    
        let marker;
    
        // agregar el pin
        marker = new L.marker([lat, lng],{
            draggable: true,
            autoPan: true,
        }).addTo(mapa);

        //asignar al contenedor de pines

        markers.addLayer(marker);
        
        //evento del buscador

        document.querySelector('#buscadorUbicacion').addEventListener('blur', buscarUbiacion);


        //Geocode Service

        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: 'AAPKe93247042d3a4472b45350e126f53381fkuHJOpOS5SJVGj6PeOKxmsywH3gdCA1ULNaADOXhrErPKc3S3odgVE17WdvafKA'
        });
        
        
        //detectar movimiento del marker

        reubicarPin(marker);

        function reubicarPin(marker){
            marker.on('moveend', function(e) {
                marker = e.target;
    
                const posicion = marker.getLatLng();
    
                mapa.panTo(new L.LatLng( posicion.lat, posicion.lng));
    
                // Reverse Geocoding, cuadno el usuario  reubica el pin
    
    
                geocodeService.reverse().latlng(posicion).run(function(error, resultado){
                    
                    // console.log(error);
                    // console.log(resultado);
                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();
                    rellenarDireccion(resultado);
                });
            });
        }
        function buscarUbiacion(e){
            provider.search({ query: e.target.value + " Bogotá COL"})
                .then( resultado => {

                    //limpiar pines

                    markers.clearLayers();

                    // console.log(resultado)
                    if(resultado.length > 0){
                        geocodeService.reverse().latlng(resultado[0].bounds[0],16).run(function(error, resultado){
                            // console.log(resultado)                
                            
                            // marker.bindPopup(resultado.address.LongLabel);
                            // marker.openPopup();


                            //llenar inputs
                            rellenarDireccion(resultado);

                            //centrar mapa

                            mapa.setView(resultado.latlng, 16);

                            //agregar pin

                            // agregar el pin
                            marker = new L.marker(resultado.latlng,{
                                draggable: true,
                                autoPan: true,
                            }).addTo(mapa);

                            //agrear pin a grupo de pines 

                            markers.addLayer(marker);

                            //mover pin

                            reubicarPin(marker);
                        });
                    }
                })
        }

        function rellenarDireccion(resultado){
            // console.log(resultado.latlng.lat);
            // console.log('se llamo el metodo');
            document.querySelector('#direccion').value = resultado.address.Address || '';
            document.querySelector('#colonia').value = resultado.address.Neighborhood || '';
            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';
        }


    }

});