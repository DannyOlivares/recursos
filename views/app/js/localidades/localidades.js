function checktransporte(){
  var check2=document.getElementById("check2");
  if(check2.checked == true){
    var formz=new FormData();
      $.ajax({
          type : 'POST',
          url : 'api/Mdlavar_opciones_transporte',
          contentType: false,
          processData: false,
          data: formz,
          success : function(json) {
              if(json.success==1){
                  $('#divtransporte').html(json.html);
              }
          },
          error : function(xhr, status) {
              msg_box_alert(99,'Error',xhr.responseText);
          }
      });

}else{
  $('#divtransporte').html(" ");
}
}

function checkviatico(){
  var localidad=document.getElementById("txtcod").value;
  var viatico=document.getElementById("txtocultoviatico").value;
  if (viatico=="0"){
    var formc=new FormData();
    formc.append('localidad',localidad);
      $.ajax({
          type : 'POST',
          url : 'api/Mdlavar_opciones_viatico',
          contentType: false,
          processData: false,
          data: formc,
          success : function(json) {
              if(json.success==1){
                $.confirm({
                    escapeKey: 'formSubmit',
                    icon: 'glyphicon glyphicon-edit',
                    columnClass: 'col-md-4 col-md-offset-3',
                    title: 'Ingrese monto de VIATICO',
                    content: json.html,
                    type: 'blue',
                    buttons: {
                        formSubmit: {
                            text: 'Aceptar',
                            btnClass: 'btn-default',
                            action: function () {
                              var monto=document.getElementById("txtmontoviatico").value;
                              document.getElementById("txtocultoviatico").value=monto;

                            }
                        },
                    },
                });
            } else {
                $.confirm({
                    escapeKey: 'formSubmit',
                    icon: 'glyphicon glyphicon-remove',
                    title: 'Actividad',
                    content: '<h4>No se pudo editar la actividad</h4>',
                    type: 'red',
                    buttons: {
                        formSubmit: {
                            text: 'Aceptar',
                            btnClass: 'btn-green',
                            action: function () {}
                        },
                    },
                });
            }
          },
          error : function(xhr, status) {
              msg_box_alert(99,'Error',xhr.responseText);
          }
      });
    }else{

    }
}
function checkhospedaje(){
    var check3=document.getElementById("check3");
    var localidad=document.getElementById("txtcod").value;
    if(check3.checked == true){
      var form3=new FormData();
      form3.append('localidad',localidad);
        $.ajax({
            type : 'POST',
            url : 'api/Mdlavar_opciones_hospedaje',
            contentType: false,
            processData: false,
            data: form3,
            success : function(json) {
                if(json.success==1){
                  $.confirm({
                      escapeKey: 'formSubmit',
                      icon: 'glyphicon glyphicon-edit',
                      columnClass: 'col-md-4 col-md-offset-3',
                      title: 'Ingrese monto maximo de hospedaje',
                      content: json.html,
                      type: 'blue',
                      buttons: {
                          formSubmit: {
                              text: 'Aceptar',
                              btnClass: 'btn-default',
                              action: function () {
                                var monto=document.getElementById("txtmontohospedaje").value;
                                document.getElementById("txtocultohospedaje").value=monto;

                              }
                          },
                      },
                  });
              } else {
                  $.confirm({
                      escapeKey: 'formSubmit',
                      icon: 'glyphicon glyphicon-remove',
                      title: 'Actividad',
                      content: '<h4>No se pudo editar la actividad</h4>',
                      type: 'red',
                      buttons: {
                          formSubmit: {
                              text: 'Aceptar',
                              btnClass: 'btn-green',
                              action: function () {}
                          },
                      },
                  });
              }
            },
            error : function(xhr, status) {
                msg_box_alert(99,'Error',xhr.responseText);
            }
        });

  }else{
    $('#divtransporte').html(" ");
  }



}

function selectransporte(num){
  var localidad=document.getElementById("txtcod").value;
  if(num=='1'){
    var formv=new FormData();
    formv.append('localidad',localidad);
      $.ajax({
          type : 'POST',
          url : 'api/Mdlavar_transporte_vuelo',
          contentType: false,
          processData: false,
          data: formv,
          success : function(json) {
              if(json.success==1){
                $.confirm({
                    escapeKey: 'formSubmit',
                    icon: 'glyphicon glyphicon-edit',
                    columnClass: 'col-md-4 col-md-offset-3',
                    title: ' Ingrese valor maximo de vuelo',
                    content: json.html,
                    type: 'blue',
                    buttons: {
                        formSubmit: {
                            text: 'Aceptar',
                            btnClass: 'btn-default',
                            action: function () {
                              var montoavion=document.getElementById("txtvalorpasaje").value;
                              document.getElementById("txtocultoavion").value=montoavion;
                            }
                        },
                    },
                });
            } else {
                $.confirm({
                    escapeKey: 'formSubmit',
                    icon: 'glyphicon glyphicon-remove',
                    title: 'Actividad',
                    content: '<h4>No se pudo editar la actividad</h4>',
                    type: 'red',
                    buttons: {
                        formSubmit: {
                            text: 'Aceptar',
                            btnClass: 'btn-green',
                            action: function () {}
                        },
                    },
                });
            }
          },
          error : function(xhr, status) {
              msg_box_alert(99,'Error',xhr.responseText);
          }
      });
    }else if(num=='2'){
      var formv=new FormData();
      formv.append('localidad',localidad);
        $.ajax({
            type : 'POST',
            url : 'api/Mdlavar_transporte_bus',
            contentType: false,
            processData: false,
            data: formv,
            success : function(json) {
                if(json.success==1){
                  $.confirm({
                      escapeKey: 'formSubmit',
                      icon: 'glyphicon glyphicon-edit',
                      columnClass: 'col-md-4 col-md-offset-3',
                      title: ' Ingrese valor maximo pasaje de bus',
                      content: json.html,
                      type: 'blue',
                      buttons: {
                          formSubmit: {
                              text: 'Aceptar',
                              btnClass: 'btn-default',
                              action: function () {
                                var montobus=document.getElementById("txtvalorpasajebus").value;
                                document.getElementById("txtocultobus").value=montobus;

                              }
                          },
                      },
                  });
              } else {
                  $.confirm({
                      escapeKey: 'formSubmit',
                      icon: 'glyphicon glyphicon-remove',
                      title: 'Actividad',
                      content: '<h4>No se pudo editar la actividad</h4>',
                      type: 'red',
                      buttons: {
                          formSubmit: {
                              text: 'Aceptar',
                              btnClass: 'btn-green',
                              action: function () {}
                          },
                      },
                  });
              }
            },
            error : function(xhr, status) {
                msg_box_alert(99,'Error',xhr.responseText);
            }
        });
    }else{
      var formv=new FormData();
      formv.append('localidad',localidad);
        $.ajax({
            type : 'POST',
            url : 'api/Mdlavar_transporte_movil',
            contentType: false,
            processData: false,
            data: formv,
            success : function(json) {
                if(json.success==1){
                  $.confirm({
                      escapeKey: 'formSubmit',
                      icon: 'glyphicon glyphicon-edit',
                      columnClass: 'col-md-4 col-md-offset-3',
                      title: ' Transporte Movil',
                      content: json.html,
                      type: 'blue',
                      buttons: {
                          formSubmit: {
                              text: 'Aceptar',
                              btnClass: 'btn-default',
                              action: function () {
                                var montopeajes=document.getElementById("txtpeajes").value;
                                document.getElementById("txtocultopeajes").value=montopeajes;
                                var montocostopeajes=document.getElementById("txtcostopeajes").value;
                                document.getElementById("txtocultocostopeajes").value=montocostopeajes;

                              }
                          },
                      },
                  });
              } else {
                  $.confirm({
                      escapeKey: 'formSubmit',
                      icon: 'glyphicon glyphicon-remove',
                      title: 'Actividad',
                      content: '<h4>No se pudo editar la actividad</h4>',
                      type: 'red',
                      buttons: {
                          formSubmit: {
                              text: 'Aceptar',
                              btnClass: 'btn-green',
                              action: function () {}
                          },
                      },
                  });
              }
            },
            error : function(xhr, status) {
                msg_box_alert(99,'Error',xhr.responseText);
            }
        });
    }
}

function guardarlocalidad(){
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_guardarlocalidad',
      data : $('#formlocalidad').serialize(),
      success : function(json) {
        msg_box_alert(json.success,"Ingreso",json.message,"reload");
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}


 function eliminarlocalidad(id){
   $.confirm({
           escapeKey: 'formSubmit',
           icon: 'glyphicon glyphicon-remove',
           title: 'Localidad',
           content: '<h4>¿Desea eliminar la actividad?</h4>',
           type: 'red',
           buttons: {
                 confirmar:{
                     text: '<h5>APROBAR</h5>',
                     btnClass: 'btn-default',
                     action: function () {
                         var formeli=new FormData();
                         formeli.append('id',id);
                           $.ajax({
                               type : 'POST',
                               url : 'api/Mdlavar_eliminar_localidad',
                               contentType: false,
                               processData: false,
                               data: formeli,
                               success : function(json) {
                                   if(json.success==1){
                                      msg_box_alert(json.success,"Eliminar",json.message,"reload");
                                   }
                               },
                               error : function(xhr, status) {
                                   msg_box_alert(99,'Error',xhr.responseText);
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

     function modificarlocalidad(){
       $.ajax({
           type : "POST",
           url : 'api/Mdlavar_editar_localidad',
           data : $('#editar_localidad').serialize(),
           success : function(json) {
             msg_box_alert(json.success,"Modificacion",json.message,"redirect","avar/localidades");
           },error : function(xhr, status) {
               msg_box_alert(99,'error',xhr.responseText);
           }
       });

     }
  function seleccionatrans(id){
    if(id=='1'){
      $('#txtmontobus').attr('readonly', false);
      $('#txtmontoavion').attr('readonly', true);
      $('#txtmontomovil').attr('readonly', true);
    }else if(id=='2'){
      $('#txtmontobus').attr('readonly', true);
      $('#txtmontoavion').attr('readonly', false);
      $('#txtmontomovil').attr('readonly', true);
    }else{
        $('#txtmontobus').attr('readonly', true);
        $('#txtmontoavion').attr('readonly', true);
        $('#txtmontomovil').attr('readonly', false);
      }
    }

    function cargadeareas(){
      var area=document.getElementById("cmbareas").value;
      var localidades=document.getElementById("id_localidad").value;
      var formcarga = new FormData();
      formcarga.append('area',area);
      formcarga.append('localidades',localidades);
          $.ajax({
              type: "POST",
              url: "api/Mdlavar_cargar_areas",
              contentType: false,
              processData: false,
              data: formcarga,
              success: function (data) {
                if(data.success==1){
                  $("#divopciones").html(" ");
                  $("#divopciones").html(data.html);
                }
              },
              error: function (xhr, status) {
                  msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
              }
          });
      }

function alerta(){
  alert("daros");
}
