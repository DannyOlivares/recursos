function selectzona(){
var zona=document.getElementById('cmbzona').value;
var formz=new FormData();
  formz.append('zona',zona);
  $.ajax({
      type : 'POST',
      url : 'api/Mdlandes_filtrarcomunas',
      contentType: false,
      processData: false,
      data: formz,
      success : function(json) {
          if(json.success==1){
              $('#divcomuna').html(json.html);
              $('#divtecnico').html(json.html2);
              $('#diveps').html(json.html3);
          }
      },
      error : function(xhr, status) {
          msg_box_alert(99,'Error',xhr.responseText);
      }
  });
}

function seleceditartzona(){
  var editarzona=document.getElementById('cmbeditarzona').value;
  var formez=new FormData();
    formez.append('editarzona',editarzona);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlandes_editarfiltrarcomunas',
        contentType: false,
        processData: false,
        data: formez,
        success : function(json) {
            if(json.success==1){
                $('#diveditarcomuna').html(json.html);
                $('#diveditartecnico').html(json.html2);
                $('#diveditareps').html(json.html3);
            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
  }



function cargaeps(){
  var tecnico=document.getElementById('cmbtecnicos').value;
  var forme=new FormData();
    forme.append('tecnico',tecnico);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlandes_cargaeps',
        contentType: false,
        processData: false,
        data: forme,
        success : function(json) {
            if(json.success==1){
                $('#diveps').html(json.html);

            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
}

function cargaeditareps(){
  var editartecnico=document.getElementById('cmbeditartecnico').value;
  var formet=new FormData();
    formet.append('editartecnico',editartecnico);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlandes_editarcargaeps',
        contentType: false,
        processData: false,
        data: formet,
        success : function(json) {
            if(json.success==1){
                $('#diveditareps').html(json.html);

            }
        },
        error : function(xhr, status) {
            msg_box_alert(99,'Error',xhr.responseText);
        }
    });
}

$('#btnguardar').click(function(e) {
  $.ajax({
      type : "POST",
      url : 'api/Mdlandes_guardarorden',
      data : $('#formandes').serialize(),
      success : function(json) {
        msg_box_alert(json.success,"Ingreso",json.message,"reload");
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
});

$('#btnmodificar').click(function(e) {
  $.ajax({
      type : "POST",
      url : 'api/Mdlandes_modificarorden',
      data : $('#formeditarandes').serialize(),
      success : function(json) {
        msg_box_alert(json.success,"Ingreso",json.message,"redirect",'andes/listar_ordenes');
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
});

function cambiarestado(id) {
    var forme = new FormData();
    forme.append('id', id);
    $.ajax({
        type: "POST",
        url: "api/Mdlandes_cambiarestado",
        contentType: false,
        processData: false,
        data: forme,
        success: function (data) {
            if (data.success == 1) {
                $.confirm({
                    escapeKey: 'formSubmit',
                    icon: 'glyphicon glyphicon-list-alt',
                    columnClass: 'col-lg-12',
                    title: 'Registro',
                    content: data.html,
                    type: 'blue',
                    buttons: {
                        formSubmit: {
                            text: 'Aceptar',
                            btnClass: 'btn-default',
                            action: function () {
//-------------------------------------------------------
                  $.ajax({
                      type : "POST",
                      url : 'api/Mdlandes_actualiza_datos',
                      data : $('#formconfirm').serialize(),
                      success : function(json) {
                        msg_box_alert(json.success,"Orden",json.message);
                      },error : function(xhr, status) {
                          msg_box_alert(99,'error',xhr.responseText);
                      }
                  });
//------------------------------------------------------
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
        error: function (xhr, status) {
            msg_box_alert(99, 'Filtrar Ordenes', xhr.responseText);
        }
    });
}


function cargaordenes(){
  $("#div_cargando").html($("#cargador").html());
  var formData = new FormData();
  formData.append('excel',document.getElementById('imagefile').files[0]);
  $.ajax({
      type : 'POST',
      url : 'api/Mdlandes_cargar_ordenes_excel',
      contentType:false,
      processData:false,
      data : formData,
      success : function(json) {
          if ( json.success == 1 ){
              msg_box_alert(json.success,"Registro Guardado",json.message);
          }else{
              msg_box_alert(json.success,"Error",json.message);
          }
          $("#div_cargando").html('<a class="btn btn-success btn-social" title="Exportar a Excel" data-toggle="tooltip" onclick="subirarchivoexcel()"><i class="fa fa-arrow-up"></i> Cargar Turnos</a>');
      },
      error : function(xhr, status) {
          $("#div_cargando").html('<a class="btn btn-success btn-social" title="Exportar a Excel" data-toggle="tooltip" onclick="subirarchivoexcel()"><i class="fa fa-arrow-up"></i> Cargar Turnos</a>');
        msg_box_alert(99,"Error",xhr.responseText);
      }
  });
}
