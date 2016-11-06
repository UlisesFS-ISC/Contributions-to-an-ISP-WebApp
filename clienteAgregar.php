<style type="text/css">

#info {
    width: 30%;
    float: left;
    height: auto;
}
@media(min-width: 1200px){  
  #map {
    width: 45% !important;
    float: right;
    height: 477px;
    top: 0px;
    margin-right: 0px;
    overflow: hidden;
    margin-top: -550px;
    overflow: auto;
}

}
@media(max-width: 1200px){  
  #map {
    width: 60%;
    height: 400px;
    margin-left: 10%;
  
    margin-top: 0px;
    overflow: auto;
}
}
</style>
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="js/fancy.js"></script>
  <script  type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>  
  <script type="text/javascript" src="js/host.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ4FGvG4iWHaTgG8KNsMo9Fz7me4wsC2o&signed_in=true&libraries=places&callback=initMap"
        async defer></script>
    </script>
  <script type="text/javascript">
    $(function()
    {
      $("#limpia").click(function()
      {
        limpiarEtiqueta();
        $("#extra").html('');
      });
    });
  </script>

<script>

var componentForm = {

  sublocality_level_1:'long_name',
  route: 'long_name',
  //locality: 'long_name',
};


function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 19.7113356, lng: -101.19914970000002},
    zoom: 13
  });
  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    draggable: true,
    anchorPoint: new google.maps.Point(0, -29)
  });

$('#coordenada').val('');
      
      google.maps.event.addListener(marker, "dragend", function() { 
        $('#zoom').val(map.getZoom());
      $('#coordenada').val(marker.getPosition().lat()+","+marker.getPosition().lng());
    }); 



  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();

    if (!place.geometry) {
      window.alert("Intente de nuevo");
      return;
    }


    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17); 
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';

    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
      console.log(place.address_components[0]);
       console.log(place.address_components[1]);
        console.log(place.address_components[2]);
         console.log(place.address_components[0].types);
         /* document.getElementById('route').value = place.address_components[0].short_name;
          document.getElementById('county').value = place.address_components[1].short_name;
           document.getElementById('locality').value = place.address_components[2].short_name;
            document.getElementById('administrative_area_level_1').value = place.address_components[4].short_name;
             document.getElementById('country').value = place.address_components[5].long_name;
              document.getElementById('postal_code').value = place.address_components[6].long_name;*/

              for (var component in componentForm) {
              document.getElementById(component).value = '';
              document.getElementById(component).disabled = false;
              }
   

              for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];

    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
            if(addressType === 'locality')
            {
               //$('#locality').val(val.toUpperCase());
               document.getElementById("locality.1").value = val.toUpperCase();
            }
     
    }
  }


    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
     getCoords(marker); 
  });

  

}

function getCoords(marker){ 
    $('#coordenada').val(marker.getPosition().lat()+","+marker.getPosition().lng());
    
}


    </script>


  <script type="text/javascript">
    function limpiarEtiqueta()
    {
      $('#divnombre').html('');
      $('#divap_pat').html('');
      $('#divap_mat').html('');
      $('#divnick').html('');
      $('#divpassword').html('');
      $('#divrecibo').html('');
       $('#divfolio').html('');
      $('#divtelefono').html('');
      $('#divpac-input').html('');
      $('#divreferencia').html('');
      $('#divfecha').html('');
      $('#divlocalidad').html('');
      $('#divservicio').html('');
      $('#divconcepto').html('');
      $('#divcoordenada').html('');
      $('#divlocality').html('');
      $('#divsublocality_level_1').html('');
      $('#divpaquete').html('');
      $('#divroute').html('');

    }
  </script>
  <script type="text/javascript">
    $(function()
    { 
      $("#clienteAgregar").click(function(e)
      {               
        limpiarEtiqueta();
        $('#extra').html('');
        var nombre=$('#nombre').val();
        var paterno=$('#ap_pat').val();
        var materno=$('#ap_mat').val();
        var telefono=$('#telefono').val();
        var coordenada=$('#coordenada').val();
        var recibo=$('#recibo').val();
        var dircomp = $('#pac-input').val();
        var comunidad = $('#locality').find(':selected').text();
        var localidad = $('#localidad').find(':selected').text();
        var vendedor = $('#vendedor').find(':selected').text();
        var servicio = $('#servicio').find(':selected').text();
        var calle=$('#route').val();
        var colonia=$('#sublocality_level_1').val();
        var referencia=$('#referencia').val();
        var concepto = $('#concepto').find(':selected').text();
        var paquete = $('#paquete').find(':selected').text();
        var folio=$('#folio').val();
        var fecha=$('#fecha').val();     
        var coordenada=$('#coordenada').val();
        var observacion=$('#ObserDiv').val();
        var zoom=$('#zoom').val();
        var archivos = document.getElementById("INE");//Damos el valor del input
        var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo 
        var archivos2 = document.getElementById("reciboimg");//Damos el valor del input
        var archivo2 = archivos2.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo 
        var archivos3 = document.getElementById("comprobante");//Damos el valor del input
        var archivo3= archivos3.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo 
        var flag=true;
        var flag1=true;
        var flag2=true;
        var flag3=true;  
          flag=validar(folio,'folio','numero','Folio');
           
          flag1*=validar(recibo,'recibo','numero','Recibo');
          flag1*=validar(concepto,'concepto','combo','Concepto');
          flag1*=validar(paquete,'paquete','combo','Paquete');
          flag1*=validar(servicio,'servicio','combo','Servicio');

          flag3*=validar(nombre,'nombre','nombre','Nombre');
          flag3*=validar(paterno,'ap_pat','nombre','Paterno');
          flag3*=validar(materno,'ap_mat','nombre','Materno');
          flag3*=validar(telefono,'telefono','telefono','Telefono');
          flag3*=validar(comunidad,'locality','combo','Comunidad');
          flag3*=validar(localidad,'localidad','combo','Localidad');
          flag3*=validar(calle,'route','numerosletras','Calle');
          flag3*=validar(colonia,'sublocality_level_1','nombre','Colonia');
          flag3*=validar(referencia,'referencia','nombre','Referencia');
          flag3*=validar(coordenada,'coordenada','coordenada','Coordenada');
          
          if(!(flag1*flag3))
            valSeccion(0,'Paquetes','Contratos');
          if(!flag3){
            valSeccion(0,'Imagenes','Paquetes');
            valSeccion(0,'Clientes','Imagenes');
          }

          flag=flag*flag1*flag2*flag3;
          
         if(document.getElementById("INE").value.length>0)
        {
          if (!/.(gif|jpeg|jpg|png)$/i.test(document.getElementById("INE").value))
          {
            $("#divArchivos").html('Error extenciones validas .gif, .jpeg, .jpg y .png');
            $('#INE').focus();
            document.getElementById("INE").focus();
          }
        }

        if(document.getElementById("reciboimg").value.length>0)
        {
          if (!/.(gif|jpeg|jpg|png)$/i.test(document.getElementById("reciboimg").value))
          {
            $("#divArchivos2").html('Error extenciones validas .gif, .jpeg, .jpg y .png');
            $('#reciboimg').focus();
            document.getElementById("reciboimg").focus();
          }
        }
        if(document.getElementById("comprobante").value.length>0)
        {
          if (!/.(gif|jpeg|jpg|png)$/i.test(document.getElementById("comprobante").value))
          {
            $("#divArchivos3").html('Error extenciones validas .gif, .jpeg, .jpg y .png');
            $('#comprobante').focus();
            document.getElementById("comprobante").focus();
          }
        }

        var splitPaquete=paquete.split("$");
        var paq=splitPaquete[0];


        var splitConcepto=concepto.split("$");
        var concep=splitConcepto[0];

        var data = new FormData();
        data.append('nombre',nombre); 
        data.append('ap_pat',paterno); 
        data.append('ap_mat',materno); 
        data.append('vendedor',vendedor); 
        data.append('telefono',telefono);
        data.append('recibo',recibo);
        data.append('zoom',zoom);

          data.append('dircomp',dircomp);
        data.append('comunidad',comunidad);
        data.append('localidad',localidad);
        data.append('calle',calle);
        data.append('colonia',colonia);
        data.append('referencia',referencia);
        data.append('concepto',concep);    
        data.append('paquete',paq);
        data.append('folio',folio);
        data.append('fecha',fecha);
        data.append('observacion',observacion);
        data.append('coordenada',coordenada.replace(" ",""));
        for(i=0; i<archivo.length; i++)
        {             
          if(i>1)
          {
            $("#divArchivos").html('Error solo 2 imagenes');            
            break;
          }
          else
          data.append('INE',archivo[i]);
        }
         for(i=0; i<archivo2.length; i++)
        {             
          if(i>1)
          {
            $("#divArchivos").html('Error solo 2 imagenes');            
            break;
          }
          else
          data.append('reciboimg',archivo2[i]);
        }
        for(i=0; i<archivo3.length; i++)
        {             
          if(i>1)
          {
            $("#divArchivos").html('Error solo 2 imagenes');            
            break;
          }
          else
          data.append('comprobante',archivo3[i]);
        }
          if(!flag)
          {
            FBM("Regresa a rebisar los campos \n o contacte al administrador","advertencia");
          }
           else{
            $.ajax({
                  url:host+"/Mega/clientes/clienteInsertar", //Url a donde la enviaremos
                  type:'POST', 
                  contentType:false,
                  data:data, 
                  processData:false, 
                  cache:false, 
                  success: function(msg)
                  {                       
                      FBM("Cliente agregado con exito","correcto");
                  },
                 error: function()
                 {
                    FBM("Error fatal contacte al administrador","error");
                 }
                });}
      return false;
    });
  });
  </script>
  <script type="text/javascript">
  $(document).ready(function() {

    $("#locality").change(function(event)
    {
      $('#divComunidad').html('');                    
      var comunidad = $(this).find(':selected').text();
      var re = /\s/g;
      var comunidad = comunidad.replace(re,'+');

      if(comunidad!="Escoge Municipio") 
      {
        $("#localidad").load(host+'/Mega/comunidades/comunidadCambiar?municipio='+comunidad);  
      }
      
    });
  });
  </script>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#servicio").change(function(event)
    {
      $('#divServicio').html('');                    
      var servicio = $(this).find(':selected').text();
      if(servicio!="Escoge Municipio") 
      {
        $("#paquete").load(host+'/Mega/paquetes/paqueteCambiar?servicio='+servicio);  
      }
      
    });
  });
  </script>
  <script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
  $(function()
  {
     $("#telefono").mask("(999) 999-99-99?-999 ext:999");
     $("#fecha").mask("9999-99-99");  
  });
</script>

<?php
echo "<form class='form-horizontal' id='formulario' method='POST'>";
    echo '<div class="principal"><div id="Clientes" class="fms" >';
      apartado('Clientes',"apartado");
       "<div id='info'>";
      setItemTextForm('Ingresa un Nombre',"Nombre","nombre","divnombre");
      setItemTextForm('Ingresa tu Apellido Paterno',"Apellido Paterno","ap_pat","divap_pat");
      setItemTextForm('Ingresa tu Apellido Materno',"Apellido Materno","ap_mat","divap_mat");
      setItemTextForm('Ingresa tu numero telefonico',"Telefono","telefono","divtelefono");
      $municipio=array("Escoge Municipio");
      $localidad=array("Escoge Localidad");
      foreach ($comunidades->result() as $model) 
      {
          array_push($municipio,$model->municipio);
          array_push($localidad,$model->localidad);                    
      }   
      $municipio=array_unique($municipio);
      $localidad=array_unique($localidad);
       setItemTextForm('Ingresa Direccion completa'," ","pac-input","divpac-input");
      setItemComboForm($municipio,'Municipio','locality','divlocality');      
      setItemComboForm($localidad,'Localidad','localidad','divlocalidad');
      setItemTextForm('Ingresa tu Calle',"Calle","route","divroute");
      setItemTextForm('Ingresa tu Colonia',"Colonia","sublocality_level_1","divsublocality_level_1");
      setItemTextForm('Ingresa tu referecia',"Calle referencia","referencia","divreferencia");
      setItemTextForm('Ingresa coordenadas',"Coordenadas","coordenada","divcoordenada");
/*
      $vendedor=array("Escoge Vendedor");
      foreach ($vendedores->result() as $modelV) 
      {
          array_push($vendedor,$modelV->nombre. " ".$modelV->ap_pat." ".$modelV->ap_mat);
      }   
      setItemComboForm($vendedor,'Vendedor','vendedor','divVendedor');      

*/
      changeResetButtons('','Clientes','Imagenes');
      echo "<div id='map' ></div>";

      
     
      cerrarApartado();
      echo '</div>';

//--------------Imagenes
    echo '<div id="Imagenes" class="fms desactivado" style="display:none;">';
      apartado('Imagenes',"apartado");
      setItemFileForm('divArchivos','INE','INE');
      setItemFileForm('divArchivos2','Comprobante','comprobante');
      setItemFileForm('divArchivos3','Recibo','reciboimg');
      changeResetButtons('Clientes','Imagenes','Paquetes');
      cerrarApartado();
      echo '</div>';
    

//--------------Paquetes
    echo '<div id="Paquetes" class="fms desactivado" style="display:none;">';
      apartado('Paquetes',"apartado");


      $servicio=array("Escoge Servicio");
      foreach ($servicios->result() as $model3) 
      {
          array_push($servicio,$model3->tipo_servicio);          
      }
      setItemComboForm($servicio,'Servicio','servicio','divservicio');
       
      
      $paquete=array("Escoge Paquete");
      foreach ($paquetes->result() as $model2) 
      {
          array_push($paquete,$model2->paquete."$".$model2->precio);          
      }
      setItemComboForm($paquete,'Paquete','paquete','divpaquete');
      setItemTextForm('Ingresa el numero de recibo',"Recibo","recibo","divrecibo","","number");

      $concepto=array("Escoge Concepto");
      foreach ($conceptos->result() as $model3) 
      {
          array_push($concepto,$model3->concepto."$".$model3->precio);          
      }
      setItemComboForm($concepto,'Concepto','concepto','divconcepto');


      /*
      Este no era el proposito del paquete pues chavo :v
      setItemTextForm('Ingresa tu precio',"Precio","precio","divPrecio","","number");
      setItemTextForm('Ingresa tipo de servicio',"Servicio","servicio","divServicio");*/

      changeResetButtons('Imagenes','Paquetes','Contratos');
      cerrarApartado();
      echo '</div>';






/*--------------Recibos
    echo '<div id="Recibos" class="fms desactivado" style="display:none;">';
      apartado('Recibos',"apartado");
       
      
      changeResetButtons('Paquetes','Recibos','Contratos');
      cerrarApartado();
      echo '</div>';  */









//--------------Contratos
    echo '<div id="Contratos" class="fms desactivado" style="display:none;">';
      apartado('Contratos',"apartado");
       
      
      setItemTextForm('Ingresa el numero de folio',"Folio","folio","divfolio","","number");
      setItemTextForm('Ingresa Fecha',"Fecha","fecha","divfecha","","dateNow");
      setItemDescribeForm('observacion',"ObserDiv");
      aceptResetButtons('clienteAgregar','','Contratos','Paquetes');
      setHidenItem('zoom','17');


      cerrarApartado();
      echo '</div>';
//--------------Instalaciones
      /*
    echo '<div id="Instalaciones" class="fms desactivado" style="display:none;">';
      apartado('Instalaciones',"apartado");
       
      
      setItemTextForm('Ingresa una mac',"Mac","mac","divMac");
      setItemTextForm('Ingresa numero de serie',"Serie","serie","divSerie");

      aceptResetButtons('clienteAgregar','','Instalaciones','Contratos');
      cerrarApartado();*/
      echo '</div>';


  echo "</div></div></div></div></form>";                                
?> 
