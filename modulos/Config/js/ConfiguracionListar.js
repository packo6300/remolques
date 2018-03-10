/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function actualizarFolio() {
    var iva = $('#renta').serialize();
    if(iva!=''){
        if(confirm('¿Actualizar?')){
            $.ajax({
                type: 'POST',url:"modulos/Config/ConfiguracionActualizar.php",data:iva           
            });
        }       
    }
}

function actualizarIVA() {
    var iva = $('#iva').serialize();
    if(iva!=''){
        if(iva!=''){
            if(confirm('¿Actualizar?')){
                $.ajax({
                    type: 'POST',url:"modulos/Config/ConfiguracionActualizar.php",data:iva
                });         
            }
        }
    }
}