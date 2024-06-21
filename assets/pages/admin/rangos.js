var base_url;
function baseurl(enlace) {
    base_url = enlace;
    //alert (base_url);

}
function calcularDatos()
{
    if(confirm('¿Estas seguro de calcular los rangos?'))
    { 
        var enlace = base_url + "admin/Rangos/calcularRangos";
        console.log(enlace)
        $.ajax({
            type: "POST",
            url: enlace,            
            success: function(data)
            {                                    
                var result = JSON.parse(data);
                $.each(result, function(i, datos)
                {
                    if(datos.resultado == 0)
                    {                            
                        alert(datos.mensaje);
                    }
                    else
                    {                                                
                        alert(datos.mensaje);
                        window.setTimeout('location.reload()', 100);
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error details:", jqXHR, textStatus, errorThrown);
            }
        }); 
    }
    else
    {
      return false;
    }  

}


