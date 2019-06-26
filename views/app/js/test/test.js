function selectlocalidad(){
var localidad=document.getElementById('cmbactividad').value;
var formz=new FormData();
  formz.append('localidad',localidad);
  $.ajax({
      type : 'POST',
      url : 'api/Mdlavar_localidad',
      contentType: false,
      processData: false,
      data: formz,
      success : function(json) {
          if(json.success==1){
              $('#divviatico').html(" ");
              $('#divviatico').html(json.html);
              $('#divpeaje').html(" ");
              $('#divpeaje').html(json.html2);
              $('#divpasaje').html(" ");
              $('#divpasaje').html(json.html3);
              $('#divhospedaje').html(" ");
              $('#divhospedaje').html(json.html4);
          }
      },
      error : function(xhr, status) {
          msg_box_alert(99,'Error',xhr.responseText);
      }
  });
}

function seleccionar(opcion){
  var tipo=document.getElementById('cmbtipotrabajo').value;
  var forme = new FormData();
  forme.append('tipo',tipo);
  forme.append('opcion',opcion);
      $.ajax({
          type: "POST",
          url: "api/Mdlavar_seleccionar",
          contentType: false,
          processData: false,
          data: forme,
          success: function (data) {
              if (data.success == 1) {
                $('#modal_lista').modal('show');
                $('#modallista').html(" ");
                $('#modallista').html(data.html);
              }else{
                msg_box_alert(data.success,"Personal",data.message);
              }

          },
          error: function (xhr, status) {
              msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
          }
      });

  }

  function aceptarusuariostransporte(){
    try {
      var personal=document.getElementById('contador').value;
      var pasaje=document.getElementById('txtcostopasaje').value;
      document.getElementById('txtpersonal').value=personal;
      var transporte=parseInt(personal)*parseInt(pasaje);
      document.getElementById('txttotaltransportes').value=transporte;
      sumartotal();
    } catch (e) {

    } finally {
      var personal=document.getElementById('contador').value;
      document.getElementById('txtpersonal').value=personal;
      var formper = new FormData();
      $.ajax({
          type: "POST",
          url: "api/Mdlavar_mostrar_personal",
          contentType: false,
          processData: false,
          data: formper,
          success: function (data) {
              if (data.success == 1) {
                $('#divpersonaltransporte').html(" ");
                $('#divpersonaltransporte').html(data.html);
              }

          },
          error: function (xhr, status) {
              msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
          }
      });
      calculardatos();
      sumartotal();

    }
  }
  function aceptarusuarioshospedaje(){
  var personal=document.getElementById('contador').value;
  document.getElementById('txtpersonal').value=personal;
  try {
    calc_dias()
  } catch (e) {

  } finally {

  }
  var formper = new FormData();
  $.ajax({
      type: "POST",
      url: "api/Mdlavar_mostrar_personal",
      contentType: false,
      processData: false,
      data: formper,
      success: function (data) {
          if (data.success == 1) {
            $('#divpersonalhospedaje').html(" ");
            $('#divpersonalhospedaje').html(data.html);
          }

      },
      error: function (xhr, status) {
          msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
      }
  });
  sumartotal();
  }

  function calculardatos(){
    var dias=document.getElementById('txtdias').value;
    var viatico=document.getElementById('txtviatico').value;
    var orden=document.getElementById('txtidproyecto').value;
    var inicio=document.getElementById('txtinicio').value;
    var fin=document.getElementById('txtfinal').value;
    var formrev = new FormData();
    formrev.append('orden',orden);
    formrev.append('inicio',inicio);
    formrev.append('fin',fin);
    formrev.append('dias',dias);
    formrev.append('viatico',viatico);
    $.ajax({
        type: "POST",
        url: "api/Mdlavar_revisarpersonal",
        contentType: false,
        processData: false,
        data: formrev,
        success: function (data) {
            if (data.success == 1) {
              document.getElementById('txtrest').value=data.res;
              document.getElementById('txtpersonal').value=data.cantidad;
              document.getElementById('txttotalcontrol').value=data.res;
              sumartotal();
            }

        },
        error: function (xhr, status) {
            msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
        }
    });
  }

  function aceptarusuarios(){
    var dias=document.getElementById('txtdias').value;
    var viatico=document.getElementById('txtviatico').value;
    var orden=document.getElementById('txtidproyecto').value;
    var inicio=document.getElementById('txtinicio').value;
    var fin=document.getElementById('txtfinal').value;
    var formrev = new FormData();
    formrev.append('orden',orden);
    formrev.append('inicio',inicio);
    formrev.append('fin',fin);
    formrev.append('dias',dias);
    formrev.append('viatico',viatico);
    $.ajax({
        type: "POST",
        url: "api/Mdlavar_revisarpersonal",
        contentType: false,
        processData: false,
        data: formrev,
        success: function (data) {
            if (data.success == 1) {
              document.getElementById('txtrest').value=data.res;
              document.getElementById('txtpersonal').value=data.cantidad;
              document.getElementById('txttotalcontrol').value=data.res;
              try {
                calculopasajes();
              } catch (e) {

              } finally {

              }
            }

        },
        error: function (xhr, status) {
            msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
        }
    });
    try {
      calculopasajes();
    } catch (e) {

    } finally {

    }
    try {
      calcularmovil();
    } catch (e) {

    } finally {

    }
    var viatico=document.getElementById('txtrest').value;
    //var transporte=document.getElementById('txttotaltransportes').value;
    try {
      var hospedaje=document.getElementById('txttotalhospedaje').value;
    } catch (e) {

    } finally {
     var hospedaje='0';
    }
    var formper = new FormData();
    $.ajax({
        type: "POST",
        url: "api/Mdlavar_mostrar_personal",
        contentType: false,
        processData: false,
        data: formper,
        success: function (data) {
            if (data.success == 1) {
              $('#divpersonal').html(" ");
              $('#divpersonal').html(data.html);
            }

        },
        error: function (xhr, status) {
            msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
        }
    });
    sumartotal();
  }

function calculo(){
  var dias=document.getElementById('txtdias').value;
  var viatico=document.getElementById('txtviatico').value;

  suma=(dias*viatico);
  document.getElementById('txtrest').value=suma;
}
// function calculo_viatico(){
//   try {
//     var personas=document.getElementById('txtpersonal').value;
//     var viatico=document.getElementById('txtviatico').value;
//     var dias=document.getElementById('txtdias').value;
//     var total_viatico=parseInt(personas)*parseInt(viatico)*parseInt(dias);
//     document.getElementById('txtrest').value=total_viatico;
//     sumartotal();
//   } catch (e) {
//
//   } finally {
//
//   }
//
// }
function calcularpasaje(){
      var personas=document.getElementById('txtpersonal').value;
      var pasajes=document.getElementById('txtcostopasaje').value;
      total_pasajes=parseInt(personas)*parseInt(pasajes);
      document.getElementById('txttotaltransportes').value=total_pasajes;
      sumartotal();
}
function modificardatos(){
  var fechaini=document.getElementById('txtinicio').value;
  var fechafinal=document.getElementById('txtfinal').value;
  var inicio=new Date (document.getElementById('txtinicio').value);
  var final= new Date (document.getElementById('txtfinal').value);
  var diasdif= final.getTime()-inicio.getTime();
  var contdias = Math.round(diasdif/(1000*60*60*24)+1);
  document.getElementById('txtdias').value=contdias;
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_modificardatos',
      data : $('#formmodif').serialize(),
      success : function(json) {
        if(json.success==1){
          document.getElementById('txtrest').value=json.resultado;
        sumartotal();
        }

      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

function seleccionopcion(opcion){
  var area=document.getElementById('cmbtipotrabajo').value;
  var localidades=document.getElementById('cmblocalidades').value;
  var contador=document.getElementById('idcount').value;
  var check;
  if(opcion==1){
    check='checkviatico';
  }else if(opcion==2){
    check='checktransporte';
  }else{
    check='checkhospedaje';
  }
  checkop=document.getElementById(check);
  if(checkop.checked == true){
      var formopcion=new FormData();
      formopcion.append('opcion',opcion);
      formopcion.append('area',area);
      formopcion.append('localidades',localidades);
      formopcion.append('contador',contador);
      $.ajax({
        type:"POST",
        url: "api/avar_cargaropciones",
        contentType: false,
        processData: false,
        data: formopcion,
        success: function (data){
          if(data.success==1){
            if(data.estado==0){
              $('#divviatico').html(" ");
              $('#divviatico').html(data.html);
            }else{
              $('#divviatico').html(" ");
              $('#divviatico').html(data.html);
                calc_dias();
            }
          }else if(data.success==2){
            $('#divtransporte').html(" ");
            $('#divtransporte').html(data.html2);
          }else if(data.success==3){
            $('#divhospedaje').html(" ");
            $('#divhospedaje').html(data.html3);
          }else{

        }
        contador=parseInt(contador)+parseInt(opcion);
        document.getElementById('idcount').value=contador;
        },
        error: function (xhr, status){
          msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
        }
  });
}else{
    if(check=='checkviatico'){
      $('#divviatico').html(" ");
    }else if(check=='checktransporte'){
      $('#divtransporte').html(" ");
    }else if(check=='checkhospedaje'){
    $('#divhospedaje').html(" ");
    }
    contador=parseInt(contador)-parseInt(opcion);
    document.getElementById('idcount').value=contador;

    var resultado=document.getElementById('idcount').value;
    var formeliminar=new FormData();
    formeliminar.append('resultado',resultado);
    $.ajax({
      type:"POST",
      url: "api/avar_eliminardatos",
      contentType: false,
      processData: false,
      data: formeliminar,
      success: function (data){
        if(data.success==1){
          document.getElementById('contador2').value='0';
        }
      },
      error: function (xhr, status){
        msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
      }
    });
  }
  sumartotal();
}

function editaropcion(num){
  var area=document.getElementById('cmbtipotrabajo').value;
  var localidades=document.getElementById('textlocalidades').value;
  if(num==1){
    check='checkeditarviatico';
  }else if(num==2){
    check='checkeditartransporte';
  }else{
    check='checkeditarhospedaje';
  }
  checkedit=document.getElementById(check);
  if(checkedit.checked == true){
      var formeditar=new FormData();
      formeditar.append('opcion',num);
      formeditar.append('area',area);
      formeditar.append('localidades',localidades);
      $.ajax({
        type:"POST",
        url: "api/Mdlavar_editaropciones",
        contentType: false,
        processData: false,
        data: formeditar,
        success: function (data){
          if(data.success==1){
            if(data.estado==0){
              $('#divviatico').html(" ");
              $('#divviatico').html(data.html);
            }else{
              $('#divviatico').html(" ");
              $('#divviatico').html(data.html);
                calc_dias();

            }
          }else if(data.success==2){
            $('#divtransporte').html(" ");
            $('#divtransporte').html(data.html2);
          }else if(data.success==3){
            $('#divhospedaje').html(" ");
            $('#divhospedaje').html(data.html3);
          }else{
        }
        },
        error: function (xhr, status){
          msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
        }

  });
}else{
    if(check=='checkeditarviatico'){
      $('#divviatico').html(" ");
    }else if(check=='checkeditartransporte'){
      $('#divtransporte').html(" ");
    }else if(check=='checkeditarhospedaje'){
    $('#divhospedaje').html(" ");
    }
  sumartotal();
}
}

function calc_dias_hospedaje(){
  var fechaini=document.getElementById('txtinicio').value;
  var fechafinal=document.getElementById('txtfinal').value;
  var inicio=new Date (document.getElementById('txtinicio').value);
  var final= new Date (document.getElementById('txtfinal').value);
  var diasdif= final.getTime()-inicio.getTime();
  var contdias = Math.round(diasdif/(1000*60*60*24)+1);
  document.getElementById('txtdiashospedaje').value=parseInt(contdias)-parseInt('1');
  try {
    var diasviatico=document.getElementById('txtdias').value


  } catch (e) {

  } finally {

  }
  modificardatos();

}

function calc_dias(opcion){
      var fechaini=document.getElementById('txtinicio').value;
      var fechafinal=document.getElementById('txtfinal').value;
      //contador calendario
      var inicio=new Date (document.getElementById('txtinicio').value);
      var final= new Date (document.getElementById('txtfinal').value);
      var diasdif= final.getTime()-inicio.getTime();
      var contdias = Math.round(diasdif/(1000*60*60*24)+1);
      document.getElementById('txtdias').value=contdias;
      calculardatos()
}

function calculopasajes(){
    var personas=document.getElementById('txtpersonal').value;
    var pasajebus=document.getElementById('txtcostopasaje').value;
    suma=(personas*pasajebus);
    document.getElementById('txttotaltransportes').value=suma;
    sumartotal();
}
// function calculoavion(){
//   var personas=document.getElementById('txtpersonal').value;
//   var pasajeavion=document.getElementById('txtcostopasaje').value;
//
//   suma=(personas*pasajeavion);
//   document.getElementById('txttotaltransportes').value=suma;
// }

function sumar(id){
    var opcion='check'+id;
    var num=document.getElementById('contador').value;
    var check=document.getElementById(opcion);
    if(check.checked == true){
      contador=(parseInt(num)+parseInt('1'));
      document.getElementById('contador').value=contador;
      var formt=new FormData();
        formt.append('id',id);
        $.ajax({
            type : 'POST',
            url : 'api/Mdlavar_usuariotemporalsum',
            contentType: false,
            processData: false,
            data: formt,
            success : function(json) {
                if(json.success==1){
                }
            },
            error : function(xhr, status) {
                msg_box_alert(99,'Error',xhr.responseText);
            }
        });

  }else{
    contador=(parseInt(num)-parseInt('1'));
    document.getElementById('contador').value=contador;
    var formt=new FormData();
      formt.append('id',id);
      $.ajax({
          type : 'POST',
          url : 'api/Mdlavar_usuariotemporalres',
          contentType: false,
          processData: false,
          data: formt,
          success : function(json) {
              if(json.success==1){
              }
          },
          error : function(xhr, status) {
              msg_box_alert(99,'Error',xhr.responseText);
          }
      });
  }
}

function enviar(){
    $.ajax({
        type : "POST",
        url : 'api/Mdlavar_enviarproyecto',
        data : $('#formtest').serialize(),
        success : function(json) {
          msg_box_alert(json.success,"Ingreso",json.message,"reload");
        },error : function(xhr, status) {
            msg_box_alert(99,'error',xhr.responseText);
        }
    });
  }
function elegirtransporte(res){
  var contador=document.getElementById('contador2').value;
  var localidades=document.getElementById('cmblocalidades').value;
  var area=document.getElementById('cmbtipotrabajo').value;
  var forme=new FormData();
    forme.append('res',res);
    forme.append('localidades',localidades);
    forme.append('area',area);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_cargarresultado',
        contentType: false,
        processData: false,
        data: forme,
        success : function(json) {
            if(json.success==1){
              $('#divtransporte').html(" ");
              $('#divtransporte').html(json.html);
                if(contador=="0"){
                    recalcular();
                    sumartotal();
                  }
                }else if(json.success==2){
                  $('#divtransporte').html(" ");
                  $('#divtransporte').html(json.html2);
                  sumartotal();
                }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });


}
function calcularmovil(){
  var personas=document.getElementById('txtpersonal').value;
  var moviles=document.getElementById('txtcantmovil').value;
  var monto=document.getElementById('txtmontopeaje').value;
  try {
      document.getElementById('txtnummovil').value='0';
  } catch (e) {

  } finally {

  }
  if(moviles>personas){
    alert("No puede ingresar una cantidad mayor a la cantidad de moviles")
    document.getElementById('txtcantmovil').value=" ";
  }else{
  suma=(moviles*monto);
  document.getElementById('txttotaltransportes').value=suma;
}
sumartotal();
}
function calcularmovilychofer(){
  var formmov = new FormData();
      $.ajax({
          type: "POST",
          url: "api/Mdlavar_conductor_movil",
          contentType: false,
          processData: false,
          data: formmov,
          success: function (data) {
              if (data.success == 1) {
                $('#divmovil').html(" ");
                $('#divmovil').html(data.html);
              }
          },
          error: function (xhr, status) {
              msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
          }
      });
    calcularmovil();
}



function calcularhospedaje(){
  try {
    var dias=document.getElementById('txtcantidad').value;
    var monto=document.getElementById('txtcostopordia').value;
    var totaltodo=document.getElementById('txttotalcontrol').value;
    suma=(dias*monto);
    document.getElementById('txttotalhospedaje').value=suma;
    var viatico=document.getElementById('txtrest').value;
    var transporte=document.getElementById('txttotaltransportes').value;
    total=parseInt(suma)+parseInt(viatico)+parseInt(transporte);
    document.getElementById('txttotalcontrol').value=total;
  } catch (e) {

  } finally {

  }



}

function consultarorden(id){
  $('#modal_orden').modal('show');
  var forms = new FormData();
  forms.append('id', id);
      $.ajax({
          type: "POST",
          url: "api/Mdlavar_consultar_orden",
          contentType: false,
          processData: false,
          data: forms,
          success: function (data) {
              if (data.success == 1) {
                $('#modalordenes').html(" ");
                $('#modalordenes').html(data.html);
              }
          },
          error: function (xhr, status) {
              msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
          }
      });
}
function tipohospedaje(num){
  document.getElementById('texteleccion').value=num;
}
function prevalidar(id){
  $('#modal_aprobacion').modal('show');
  var forml = new FormData();
  forml.append('id', id);
      $.ajax({
          type: "POST",
          url: "api/Mdlavar_aprobar_orden",
          contentType: false,
          processData: false,
          data: forml,
          success: function (data) {
              if (data.success == 1) {
                $('#modalaprobacion').html(" ");
                $('#modalaprobacion').html(data.html);
              }
          },
          error: function (xhr, status) {
              msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
          }
      });
}
function aprobar_control(id){
  $.confirm({
            icon: 'glyphicon glyphicon-ok',
            title: 'Aprobacion',
            content: '<h4>¿Desea aprobar el control?</h4>',
            type: 'blue',
            buttons: {
                confirmar:{
                    text: '<h5>APROBAR</h5>',
                    btnClass: 'btn-default',
                    action: function () {
                      var forma = new FormData();
                      forma.append('id', id);
                          $.ajax({
                              type: "POST",
                              url: "api/Mdlavar_aprobar",
                              contentType: false,
                              processData: false,
                              data: forma,
                              success: function (data) {
                                  if (data.success == 1) {
                                      $('#modal_aprobacion').modal('hide');
                                      location.href = 'home/home';
                                  }
                              },
                              error: function (xhr, status) {
                                  msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
                              }
                          });

                    }
                },
                cancel: {
                    text: '<h5>CANCELAR</h5>',
                    btnClass: 'btn-default',
                    action: function () {


                    }
                }
            }
        })
    }

    function rechazar_control(id){
      $.confirm({
                icon: 'glyphicon glyphicon-remove',
                title: 'RECHAZAR',
                content: '<h4>¿Desea rechazar el control?</h4>',
                type: 'red',
                buttons: {
                    confirmar:{
                        text: '<h5>RECHAZAR</h5>',
                        btnClass: 'btn-default',
                        action: function () {
                          var forma = new FormData();
                          forma.append('id', id);
                              $.ajax({
                                  type: "POST",
                                  url: "api/Mdlavar_obserrechazar",
                                  contentType: false,
                                  processData: false,
                                  data: forma,
                                  success: function (data) {
                                    $.confirm({
                                        escapeKey: 'formSubmit',
                                        icon: 'glyphicon glyphicon-edit',
                                        columnClass: 'col-md-10 col-md-offset-3',
                                        title: 'RECHAZAR',
                                        content: data.html,
                                        type: 'red',
                                        buttons: {
                                            formSubmit: {
                                                text: 'Aceptar',
                                                btnClass: 'btn-default',
                                                action: function () {
                                                    var texto=document.getElementById('textobservacion').value;
                                                    var formap = new FormData();
                                                    formap.append('id', id);
                                                    formap.append('texto', texto);
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "api/Mdlavar_rechazar",
                                                            contentType: false,
                                                            processData: false,
                                                            data: formap,
                                                            success: function (data) {
                                                                if (data.success == 1) {
                                                                    $('#modal_aprobacion').modal('hide');
                                                                    location.href = 'home/home';
                                                                }
                                                            },
                                                            error: function (xhr, status) {
                                                                msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
                                                            }
                                                        });

                                                  }

                                                }
                                            },
                                    });
                                  },
                                  error: function (xhr, status) {
                                      msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
                                  }
                              });

                        }
                    },
                    cancel: {
                        text: '<h5>CANCELAR</h5>',
                        btnClass: 'btn-default',
                        action: function () {


                        }
                    }
                }
            })
        }

function filtrar_por_fecha(){
  var fechadesde=document.getElementById('fechadesde').value;
  var fechahasta=document.getElementById('fechahasta').value;
  document.getElementById('cmbestado').value='4';

  if(fechadesde>fechahasta){
    $.alert('Fechas mal ingresadas');
  }else{

  var formfe=new FormData();
  formfe.append('fechadesde', fechadesde);
  formfe.append('fechahasta', fechahasta);
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_filtrar_fecha',
      contentType:false,
      processData:false,
      data : formfe,
      success : function(json) {
        var table= $('#tablorden').DataTable();
        table.clear().draw();
          if(json.success == 1 ){
            var ruta="views/app/temp/" + json.message;
            var request = $.ajax( ruta , {dataType:'json'} );
            request.done(function (resultado) {
                table.rows.add(resultado.aaData).draw();
            });
          }else{

          }
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}
}

function filtrar_estado(){
   var estado = document.getElementById('cmbestado').value;
   var fechadesde=document.getElementById('fechadesde').value;
   var fechahasta=document.getElementById('fechahasta').value;


   var formes=new FormData();
   formes.append('fechadesde', fechadesde);
   formes.append('fechahasta', fechahasta);
   formes.append('estado', estado);
   $.ajax({
       type : "POST",
       url : 'api/Mdlavar_filtrar_estado',
       contentType:false,
       processData:false,
       data : formes,
       success : function(json) {
         var table= $('#tablorden').DataTable();
         table.clear().draw();
           if(json.success == 1 ){
             var ruta="views/app/temp/" + json.message;
             var request = $.ajax( ruta , {dataType:'json'} );
             request.done(function (resultado) {
                 table.rows.add(resultado.aaData).draw();
             });
           }else{

           }
       },error : function(xhr, status) {
           msg_box_alert(99,'error',xhr.responseText);
       }
   });
 }

 function validarcodigo(){
 var codigo=document.getElementById('txtidproyecto').value;
 if(codigo.length>10){
   alert("No se pueden ingresar mas de 10 caracteres");
   codigo=document.getElementById('txtidproyecto').value="";
 }else{
 var formc=new FormData();
   formc.append('codigo',codigo);
   $.ajax({
       type : 'POST',
       url : 'api/Mdlavar_validarcodigo',
       contentType: false,
       processData: false,
       data: formc,
       success : function(json) {
           if(json.success==1){
                $.alert(json.message);
                document.getElementById('txtidproyecto').value=" ";
           }
       },
       error : function(xhr, status) {
           msg_box_alert(99,'Error',xhr.responseText);
       }
   });
 }
}
function validarpasajes(){
  var localidad=document.getElementById('cmblocalidades').value;
  var area=document.getElementById('cmbtipotrabajo').value;
  var pasaje=document.getElementById('txtcostopasaje').value;
  var opcion=document.getElementById('txtopcion').value;
  var formva=new FormData();
    formva.append('localidad',localidad);
    formva.append('area',area);
    formva.append('pasaje',pasaje);
    formva.append('opcion',opcion);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_validarpasaje',
        contentType: false,
        processData: false,
        data: formva,
        success : function(json) {
            if(json.success==0){
                 msg_box_alert(json.success,"Valor Maximo",json.message);
                 document.getElementById('txtcostopasaje').value=" ";
            }else{
              recalcular();
            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
    calculopasajes();
    sumartotal();
}
function recalcular(){


    calculopasajes()
    // var viatico=document.getElementById('txtrest').value;
    // var transporte=document.getElementById('txttotaltransportes').value;
    // var hospedaje=document.getElementById('txttotalhospedaje').value;
    //
    // total=parseInt(viatico)+parseInt(transporte)+parseInt(hospedaje);
    // document.getElementById('txttotalcontrol').value=total;
}

function cambiardatos(){
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_cambiardatos',
      data : $('#formtest').serialize(),
      success : function(json) {
        if(json.success==1){
          $('#divviatico').html(" ");
          $('#divviatico').html(json.html);
          $('#divtransporte').html(" ");
          $('#divtransporte').html(json.html2);
          document.getElementById('checkhospedaje').disabled=false;
          document.getElementById('checkviatico').disabled=false;
          document.getElementById('checktransporte').disabled=false;
        }else{
          msg_box_alert(json.success,"Valores",json.message);
          document.getElementById('cmbtipotrabajo').value='--'
        }
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

function modificar_control(){
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_modificarproyecto',
      data : $('#formmodif').serialize(),
      success : function(json) {
        msg_box_alert(json.success,"Modificacion",json.message,"redirect","home/home");
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

function guardar_vista(){
  $('#modalcontenido').empty();
  $('#modal_visualizar').modal('show');
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_guardar_vista',
      data : $('#formtest').serialize(),
      success: function (data) {
          if (data.success == 1) {
            $('#modalcontenido').html(" ");
            $('#modalcontenido').html(data.html);
          }else{
            msg_box_alert(data.success,"ERROR",data.message)
          }
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

function marcar(id){
  var opcion='checkchof'+id;
  var check=document.getElementById(opcion);
  if(check.checked == true){
    var numchof=document.getElementById('txtnummovil').value;
    var cantmoviles=document.getElementById('txtcantmovil').value;
    var numsum=parseInt(numchof)+parseInt('1');
    document.getElementById('txtnummovil').value=numsum;
    var formch=new FormData();
      formch.append('choferes',numsum);
      formch.append('cantmoviles',cantmoviles);
      formch.append('id',id);
      $.ajax({
          type : 'POST',
          url : 'api/Mdlavar_selec_chofersum',
          contentType: false,
          processData: false,
          data: formch,
          success : function(json) {
              if(json.success==1){
                $('#divmovil').html(" ");
                $('#divmovil').html(json.html);
              }
          },
          error : function(xhr, status) {
              msg_box_alert(99,'Error',xhr.responseText);
          }
      });

}else{
  var numchof=document.getElementById('txtnummovil').value;
  var numsum=parseInt(numchof)-parseInt('1');
  document.getElementById('txtnummovil').value=numsum;
  var formch=new FormData();
    formch.append('id',id);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_selec_choferres',
        contentType: false,
        processData: false,
        data: formch,
        success : function(json) {
            if(json.success==1){
              $('#divmovil').html(" ");
              $('#divmovil').html(json.html);
            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
}
}

function opcion(num){
var opcion='check'+num;
var seleccion='opcion'+num;
check=document.getElementById(opcion);
if(check.checked==true){
  document.getElementById(seleccion).value='SI';
  document.getElementById('txttipo').value=num;
}
else {
  $('#costohospedaje').html(" ");
  document.getElementById(seleccion).value='NO';
    document.getElementById('txttipo').value=" ";
  var formti=new FormData();
  formti.append('tipo',num);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_descartar_tipo',
        contentType: false,
        processData: false,
        data: formti,
        success : function(json) {
            if(json.success==1){
              $('#tipohospedaje').html(" ");
              $('#tipohospedaje').html(json.html);
              var personas=document.getElementById('txtpersonal').value;
              document.getElementById('cantpersonas').value=personas;
            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });


}
}

// function marcar_usuario_hospedaje(id){
//
//   var tipo=document.getElementById('txttipo').value;
//   var opcion='check'+id;
//   var check=document.getElementById(opcion);
//   if(check.checked==true){
//     if (tipo==true){
//     var cantidadper=document.getElementById('contadorpersonas').value;
//     var contaper=parseInt(cantidadper)+parseInt('1');
//     document.getElementById('contadorpersonas').value=contaper;
//     }
//     var formma=new FormData();
//   formma.append('tipo',tipo);
//   formma.append('id',id);
//     $.ajax({
//         type : 'POST',
//         url : 'api/Mdlavar_select_hospedaje',
//         contentType: false,
//         processData: false,
//         data: formma,
//         success : function(json) {
//             if(json.success==1){
//               $('#tipohospedaje').html(" ");
//               $('#tipohospedaje').html(json.html);
//               var personas=document.getElementById('txtpersonal').value;
//               document.getElementById('cantpersonas').value=personas;
//             }
//         },
//         error : function(xhr, status) {
//             msg_box_alert(99,'Error',xhr.responseText);
//         }
//     });
// }else{
//   var cantidadper=document.getElementById('contadorpersonas').value;
//   var contaper=parseInt(cantidadper)-parseInt('1');
//   document.getElementById('contadorpersonas').value=contaper;
//   var formma=new FormData();
//   formma.append('id',id);
//     $.ajax({
//         type : 'POST',
//         url : 'api/Mdlavar_descartar_hospedaje',
//         contentType: false,
//         processData: false,
//         data: formma,
//         success : function(json) {
//             if(json.success==1){
//               $('#tipohospedaje').html(" ");
//               $('#tipohospedaje').html(json.html);
//               var personas=document.getElementById('txtpersonal').value;
//               document.getElementById('cantpersonas').value=personas;
//             }
//         },
//         error : function(xhr, status) {
//             msg_box_alert(99,'Error',xhr.responseText);
//         }
//     });
// }
// }
function marcar_tipo_hospedaje(id){
var tipo='checktipo'+id;
var check=document.getElementById(tipo);
var habitaciones='txthabitaciones'+id;
var personal='txtperp'+id;
var costoxdia='txtcostoxdia'+id;
var dia='txtdia'+id;
var costototal='txtcostototal'+id;
if(check.checked==true){
  document.getElementById(habitaciones).disabled=false;
  document.getElementById(personal).disabled=false;
  document.getElementById(costoxdia).disabled=false;
  document.getElementById(dia).disabled=false;
  document.getElementById(costototal).disabled=false;
  var formhos=new FormData();
  formhos.append('id',id);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_marcar_hos',
        contentType: false,
        processData: false,
        data: formhos,
        success : function(json) {
            if(json.success==1){

            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });

}else{
  var formhos=new FormData();
  formhos.append('id',id);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_descartar_hos',
        contentType: false,
        processData: false,
        data: formhos,
        success : function(json) {
            if(json.success==1){

            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
  var habitaciones='txthabitaciones'+id;
  var contenido=document.getElementById(costototal).value;
  var res=document.getElementById('txtvalortotal').value;
  total=parseInt(res)-parseInt(contenido);
  document.getElementById('txtvalortotal').value=total;
  document.getElementById(costototal).value='0';
  document.getElementById(habitaciones).value='0';
  document.getElementById(personal).value='0';
  document.getElementById(costoxdia).value='0';
  document.getElementById(dia).value='0';
  document.getElementById(costototal).value='0';

  document.getElementById(habitaciones).disabled=true;
  document.getElementById(personal).disabled=true;
  document.getElementById(costoxdia).disabled=true;
  document.getElementById(dia).disabled=true;
  document.getElementById(costototal).disabled=true;
  sumatotalhospedajes();
}
sumartotal();
}


function calcular_total(id) {
  var habitaciones='txthabitaciones'+id;
  var costoxdia='txtcostoxdia'+id;
  var dia='txtdia'+id;
  var costototal='txtcostototal'+id;
  var hab=document.getElementById(habitaciones).value;
  var costodia=document.getElementById(costoxdia).value;
  var dias=document.getElementById(dia).value;
  total=parseInt(hab)*parseInt(costodia)*parseInt(dias);
  document.getElementById(costototal).value=total;

  var contenido=document.getElementById(costototal).value;
  var res=document.getElementById('txtvalortotal').value;
  var total=parseInt(res)+parseInt(contenido);
  sumatotalhospedajes();
  sumartotal();
}
function validarhospedaje(id){
  var habitaciones='txthabitaciones'+id;
  var costoxdia='txtcostoxdia'+id;
  var dia='txtdia'+id;
  var costototal='txtcostototal'+id;
  var hab=document.getElementById(habitaciones).value;
  var costodia=document.getElementById(costoxdia).value;
  var dias=document.getElementById(dia).value;
  var localidad=document.getElementById('cmblocalidades').value;
  var area=document.getElementById('cmbtipotrabajo').value;
  var formvalidar=new FormData();
  formvalidar.append('id',id);
  formvalidar.append('localidades',localidad);
  formvalidar.append('area',area);
  formvalidar.append('costodia',costodia);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_validar_precio',
        contentType: false,
        processData: false,
        data: formvalidar,
        success : function(json) {
            if(json.success==0){
              msg_box_alert(json.success,"Valor Maximo",json.message);
              document.getElementById(costoxdia).value="0";
            }else{
              total=parseInt(hab)*parseInt(costodia)*parseInt(dias);
              document.getElementById(costototal).value=total;

              var contenido=document.getElementById(costototal).value;
              var res=document.getElementById('txtvalortotal').value;
              var total=parseInt(res)+parseInt(contenido);
              sumatotalhospedajes();
              sumartotal();
            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
}

function sumatotalhospedajes() {
      var add = 0;
      $('.cl').each(function() {
          if (!isNaN($(this).val())) {
              add += Number($(this).val());
          }
      });
      $('#txtvalortotal').val(add);
      var pago=document.getElementById('checkpago');
      if(pago.checked==true){
        $('#txtsubtotal').val(add);
        var res=document.getElementById('txtpago').value;
        var subtotal=document.getElementById('txtsubtotal').value;
        if(res==100){
          var totalpago=parseInt(subtotal)*parseFloat('1');
          document.getElementById('texttotalhos').value=totalpago;
        }else{
        var totalpago=(parseInt(subtotal)*parseFloat(res)/100);
        document.getElementById('texttotalhos').value=Math.round(totalpago);
      }
      }
  };

function validar_cant_personas(id){
  cantidadpersonas=document.getElementById('cantpersonas').value;
  perso='txtperp'+id;
  cant='txthabitaciones'+id;
  var cantidad_personas=document.getElementById(perso).value;
  var cantidad_habitaciones=document.getElementById(cant).value;
  resultado=parseInt(cantidad_personas)*parseInt(cantidad_habitaciones);
  validar=parseInt(resultado)+parseInt(cantidadpersonas);

  personal=document.getElementById('txtpersonal').value;
  if(validar>personal){
    alert("No se puede ingresar más que el personal seleccionado");
    document.getElementById(perso).value=" ";
    document.getElementById(cant).value=" ";
  }else{
    sumapersonas(id);
    document.getElementById('cantpersonas').value=validar;
  }
}
  function sumapersonas(id) {
        perso='txtperp'+id;
        var add = 0;
        $('.pr').each(function() {
            if (!isNaN($(this).val())) {
                add += Number($(this).val());
            }
        });
        $('#per').val(add);
        personal=document.getElementById('txtpersonal').value;
        per=document.getElementById('per').value;
        if(personal<per){
          alert("No puede ingresar mas que el personal ingresado");
          document.getElementById(perso).value="";
        }
    };

    function sumartotal() {

          var add = 0;
          $('.total').each(function() {
              if (!isNaN($(this).val())) {
                  add += Number($(this).val());
              }
          });
          $('#txttotalcontrol').val(add);
      };


function listo_cargar(){
  var dias=document.getElementById('txtdias').value;
  var formcarga=new FormData();
  formcarga.append('dias',dias);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlavar_costo_hospedaje',
        contentType: false,
        processData: false,
        data: formcarga,
        success : function(json) {
            if(json.success==1){
              $('#costohospedaje').html(" ");
              $('#costohospedaje').html(json.html);
            }else{
              $('#costohospedaje').html(" ");
              msg_box_alert(99,'Error',json.message);

            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
}

function calcularxdia(id){
 var tipocosto="txtcostoxdia"+id;
 var resultadoxdia="txtcostototal"+id;
 var cantidadhab="txthabitaciones"+id;
 var habitaciones=document.getElementById(cantidadhab).value;
 var costo=document.getElementById(tipocosto).value;
 var dias=document.getElementById('txtdias').value;
 var totaldias=parseInt(costo)*parseInt(dias)*parseInt(habitaciones);
 document.getElementById(resultadoxdia).value=totaldias;
 var suma='0';
 var calcosto="";
 var valorcosto="";
 var cantidad="";
 var formcant=new FormData();
 formcant.append('id',id);
 formcant.append('habitaciones',habitaciones);
 formcant.append('costohab',costo);
   $.ajax({
       type : 'POST',
       url : 'api/Mdlavar_cantidad_hospedaje',
       contentType: false,
       processData: false,
       data: formcant,
       success : function(json) {
           if(json.success==1){
             var cantidad=json.num;
             for (var i = 1; i <= cantidad; i++) {
                 calcosto="txtcostototal"+i;
                 try {
                    valorcosto=document.getElementById(calcosto).value;
                    if(valorcosto==false){

                    }else{
                    suma=parseInt(suma)+parseInt(valorcosto);
                  }
                 } catch (e) {

                 } finally {
                   valorcosto='0';
                 }


             }
            // document.getElementById('txttotalhospedaje').value=suma;
            // recalcular();

           }
       },
       error : function(xhr, status) {
           msg_box_alert(99,'Error',xhr.responseText);
       }
   });
   }

   function eliminar(id){
     $.confirm({
               icon: 'glyphicon glyphicon-danger',
               title: 'Eliminar',
               content: '<h4>¿Desea eliminar control?</h4>',
               type: 'red',
               buttons: {
                   confirmar:{
                       text: '<h5>Eliminar</h5>',
                       btnClass: 'btn-default',
                       action: function () {
                         var forme = new FormData();
                         forme.append('id', id);
                             $.ajax({
                                 type: "POST",
                                 url: "api/Mdlavar_eliminar",
                                 contentType: false,
                                 processData: false,
                                 data: forme,
                                 success: function (data) {
                                     if (data.success == 1) {
                                        msg_box_alert(data.success,"Control",data.message,"reload")
                                     }
                                 },
                                 error: function (xhr, status) {
                                     msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
                                 }
                             });

                       }
                   },
                   cancel: {
                       text: '<h5>CANCELAR</h5>',
                       btnClass: 'btn-default',
                       action: function () {
                       }
                   }
               }
           })


   }
   function pagar(id){
     var formpa=new FormData();
     formpa.append('id',id);
       $.ajax({
           type : 'POST',
           url : 'api/Mdlavar_pagar_control',
           contentType: false,
           processData: false,
           data: formpa,
           success : function(json) {
               if(json.success==1){
                   location.href = 'home/home';
               }
           },
           error : function(xhr, status) {
               msg_box_alert(99,'Error',xhr.responseText);
           }
       });
   }

   function subirdoc(id){
     $('#modal_subirdocumento').modal('show');
     document.getElementById('idarch').value=id;
   }
   function cargararchivo(){
     var id=document.getElementById('idarch').value;
     var documento=document.getElementById('imagefile').files[0];
     var formpcar=new FormData();
     formpcar.append('id',id);
     formpcar.append('documento',documento)
       $.ajax({
           type : 'POST',
           url : 'api/Mdlavar_cargararchivo',
           contentType: false,
           processData: false,
           data: formpcar,
           success : function(json) {
               if(json.success==1){
                 $('#modal_subirdocumento').modal('hide');
                 $('#archivo').val(null);
                 $('#modalverfactura').empty();
                 msg_box_alert(json.success,"Factura",json.message,'redirect','home/home')


               }
           },
           error : function(xhr, status) {
               msg_box_alert(99,'Error',xhr.responseText);
           }
       });

    }

    function verfactura(id){
      $('#modal_factura').modal('show');
      var formve=new FormData();
      formve.append('id',id);
        $.ajax({
            type : 'POST',
            url : 'api/Mdlavar_verfactura',
            contentType: false,
            processData: false,
            data: formve,
            success : function(json) {
                if(json.success==1){
                    $('#modalverfactura').html(" ");
                    $('#modalverfactura').html(json.html);
                  }else{
                    $('#modalverfactura').empty();
                    msg_box_alert(json.success,"FACTURA",json.message,)

                  }
            },
            error : function(xhr, status) {
                msg_box_alert(99,'Error',xhr.responseText);
            }
        });
    }

    function marcar_pago(){
      var pago=document.getElementById('checkpago');
      if(pago.checked==true){
        document.getElementById('txtpago').disabled=false;
        document.getElementById('txtsubtotal').disabled=false;
        document.getElementById('texttotalhos').disabled=false;
        var total=document.getElementById('txtvalortotal').value;
        document.getElementById('txtvalortotal').className='form-control';
              if(total==null){
                document.getElementById('txtpago').value='0';
                document.getElementById('txtsubtotal').value='0';
                document.getElementById('texttotalhos').value='0';
              }else{
                document.getElementById('txtpago').value='100';
                document.getElementById('txtsubtotal').value=total;
                document.getElementById('texttotalhos').value=total;
                }
          sumartotal();
        }else{
          document.getElementById('txtpago').value='0';
          document.getElementById('txtsubtotal').value='0';
          document.getElementById('texttotalhos').value='0';
          document.getElementById('txtpago').disabled=true;
          document.getElementById('txtsubtotal').disabled=true;
          document.getElementById('texttotalhos').disabled=true;
          document.getElementById('txtvalortotal').className='form-control total';
          sumartotal();
        }
      }
function validarporcentaje(){
  var res=document.getElementById('txtpago').value;
  var subtotal=document.getElementById('txtsubtotal').value;
  var valortotal=document.getElementById('txtvalortotal').value;

  if(res>=100){
    document.getElementById('txtpago').value='100';
    document.getElementById('txtsubtotal').value=valortotal;
    document.getElementById('texttotalhos').value=valortotal;
  }else if(res<=0){
    document.getElementById('txtpago').value='0';
    document.getElementById('txtsubtotal').className='form-control';
    document.getElementById('txtsubtotal').value='0';
    document.getElementById('texttotalhos').value='0';
  }else{

    if(subtotal!=0){
    var totalpago=(parseInt(subtotal)*parseFloat(res))/100;
    document.getElementById('texttotalhos').value=Math.round(totalpago);
    }else{
    document.getElementById('txtsubtotal').value=valortotal;
    var totalpago=(parseInt(valortotal)*parseFloat(res))/100;
    document.getElementById('texttotalhos').value=round(totalpago);
    }
  }
  sumartotal();
}

function modificarporcentaje(){
  var checkmodificar=document.getElementById('checkpago');
  if (checkmodificar.checked==true){
    sumatotalhospedajes();
    document.getElementById('txtestado').value='1';
    document.getElementById('txtpago').disabled=false;
    document.getElementById('txtsubtotal').disabled=false;
    document.getElementById('texttotalhos').disabled=false;
    document.getElementById('texttotalhos').className='form-control total';
    document.getElementById('txtvalortotal').className='form-control';
    sumartotal();
  }else{
    document.getElementById('txtestado').value='0';
    document.getElementById('txtpago').disabled=true;
    document.getElementById('txtsubtotal').disabled=true;
    document.getElementById('texttotalhos').disabled=true;
    document.getElementById('texttotalhos').className='form-control';
    document.getElementById('txtvalortotal').className='form-control total';
    sumartotal();
  }
}

function quitar_filtro(){
  $.ajax({
    type : "POST",
    url : 'api/Mdlavar_quitar_filtro',
    data : $('#formordenesandes').serialize(),
    success : function(json) {
      var table= $('#tblordenes').DataTable();
        table.clear().draw();
          if(json.success == 1 ){
            $('#divfiltros').html(" ");
            $('#divfiltros').html(json.html);
            filtrar_por_fecha()
        }else{
            $.alert(json.message);
        }

      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
        }

    });
}

function cargar_inicio(){
  $.ajax({
    type : "POST",
    url : 'api/Mdlavar_cargar_inicio',
    data : $('#formordenesandes').serialize(),
    success : function(json) {
          if(json.success == 1 ){
            var table= $('#tablorden').DataTable();
            table.clear().draw();
              if(json.success == 1 ){
                var ruta="views/app/temp/" + json.message;
                var request = $.ajax( ruta , {dataType:'json'} );
                request.done(function (resultado) {
                    table.rows.add(resultado.aaData).draw();
                });
                $('#divfiltros').html(" ");
                $('#divfiltros').html(json.html5);
              }else{

              }
        }else{

        }

      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
        }

    });
}
