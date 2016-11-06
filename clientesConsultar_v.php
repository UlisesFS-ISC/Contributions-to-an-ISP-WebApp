    <script type="text/javascript" src="js/host.js"></script>
    <link href="style/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    <link href="js/jtable/themes/lightcolor/red/jtable.css" rel="stylesheet" type="text/css" /> 
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="js/jtable/jquery.jtable.js" type="text/javascript"></script> 
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>  
  <link rel="stylesheet" type="text/css" href="jquery.fancybox.css" />   
  <script type="text/javascript">
  
  </script>   
  <script type="text/javascript">
    function FBS(EXP)
  {
       $.fancybox(
     {  
     'height':'50px',
     'width':'300px',
            'href': host+'/Mega/FormAPP.php?opc='+EXP+'&file=0',
            'type': 'iframe'
      
        });
  }
      function PDF(EXP)
  {
       $.fancybox(
     {  

            'href': host+'/Mega/'+EXP,
            'type': 'iframe'
      
        });
  }
  function Agendar(obj){
    var contrato=obj.name;
        var data = new FormData();
        data.append('contrato',contrato); 
        data.append('status','true'); 

           $.ajax({
                  url:host+"/Mega/clientes/clienteAgendar", //Url a donde la enviaremos
                  type:'POST', 
                  contentType:false,
                  data:data, 
                  processData:false, 
                  cache:false, 
                  success: function(msg)
                  {                       
                      window.locationf=host+"/Mega/clientes/clienteAgregar";
                      FBM("Cliente agregado con exito","correcto");

                  },
                 error: function()
                 {
                    $("#extra").html('Error cliente Duplicado');
                 }
                });
  }
    var file1=host+"/Mega/clientes";
    var file2=host+"/Mega/tecnicos";
    var tablaid='#PeopleTableContainer';
    var bottonFiltro='#LoadRecordsButton';
    $(document).ready(function () 
    {        
        $(tablaid).jtable(
        {
          title: 'Clientes',
          paging: true,
          pageSize: 8,
          sorting: true,
          defaultSorting: 'fecha ASC',
          actions: 
          {
            listAction: file1+'/consultaCliente',
            //updateAction: file1+'/clienteUpdate',
            deleteAction: file1+'/eliminaCliente'
          },
          fields: 
          {
            id: 
            {
              title: 'ID',
                     key:true,
              edit: false,
                    create:false,
                    list:false

            },
            fechaini:
            {
              title:'fechaini',
              list:false
            },
            fechafin:
            {
              title:'fechafin',
              list:false
            },
            nombre: 
            {
              title: 'Nombre',
              edit: false,
              create:true,
              list: true
            },
            paterno: 
            {
              title: 'Paterno',
              edit: false
            },
            materno: 
            {
              title: 'Materno',
              edit: false,
              create:true,
              create:false
            },
            calle: 
            {
              title: 'Calle',
              edit: false,
              create:true,
              list: true
            },
            referencia: 
            {
              title: 'Referencia',
              create:true,
              edit: false
            },
            telefono : 
            {
              title: 'Telefono',
              edit: false,
              create:true
            },
            comunidad: 
            {
              title: 'Comunidad',
              edit: false,
              create:true
            },
            vendedor: 
            {
              title: 'Vendedor',
              edit: false,
              create:true
            },
            tecnico: 
            {
              title: 'Tecnico',
              create:false,
              list:false,
              edit: true,
              options: file2+'/obtenerTecnicos'
            },
            id_contrato: 
            {
              title: '',
              create:false,
              list:false,
              edit: true,
                input: function (data) 
                {
                  return '<input type="number" name="contrato" style="display:none;" value="' + data.record.id_contrato + '" />';
                  
                }
            },
              fecha: 
            {
                title: 'Fecha',
                edit: false,
                create:true,
                display: function (data) 
                {
                  var x=(data.record.fecha).split('/');
                  {
                    var fecha=x[0].split('-');
                    var f = new Date();
                    var difYear=parseInt(f.getFullYear())-parseInt(fecha[0]);
                    var difMes=parseInt(f.getMonth() +1)-parseInt(fecha[1]);
                    var difDia=parseInt(f.getDate())-parseInt(fecha[2]);
                    var diferencia=((difYear*365)+(difMes*30)+difDia);
                    if(diferencia>16)
                      return '<div style="width:100%;height:100%;background:red;color:white;text-align:center;">Urgente</div>';
                    else if(diferencia>8)
                      return '<div style="width:100%;height:100%;background:yellow;color:black;text-align:center;">Pendiente</div>';
                    else if(diferencia<=8)
                      return '<div style="width:100%;height:100%;background:blue;color:white;text-align:center;">Nuevo</div>';
                  }
                } 
              },
            agendar: 
            {
                title: 'Agendar',
                edit: false,
                create:true,
                display: function (data) 
                {
                      return '<input type="button" style="width:100%;height:auto;background:green;color:white;text-align:center;" name="'+data.record.agendar+'" onClick="Agendar(this)" value="Agenda"/>';



                } 
              }
            }
          });

        $(bottonFiltro).click(function (e) 
        {
            e.preventDefault();
            $(tablaid).jtable('load', 
            {
                nombre: $('#cliente').val(),
                fechaini: $('#fecha1').val(),
                fechafin: $('#fecha2').val()
            });

        });        
        $(bottonFiltro).click();
    });      
  </script>  
    <div class="well login-register">
      <div class="filtering">
        <form>      
          <label>Nombre:</label>
          <input type="text"  id="cliente" name="cliente" />
          <label>Fecha inicial:</label>
          <input type="date"  id="fecha1" name="fecha1" />
          <label>Fecha final:</label>
          <input type="date"  id="fecha2" name="fecha2" />
          <input type="submit" id="LoadRecordsButton" value="cargar"/>
        </form>
      </div>
    <div id="PeopleTableContainer" style="width: 100%;"></div> 
<input type='button' onClick='PDF("clientes/generarPdf")' class='btn' value='imprimir' id='pdfBoton'>
    </div>  

                
