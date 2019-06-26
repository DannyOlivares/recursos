function subirarchivoexcel(){
    var area=document.getElementById('cmbareas').value;
    $("#div_cargando").html($("#cargador").html());
    var formper = new FormData();
    formper.append('excel',document.getElementById('imagefile').files[0]);
    formper.append('areas',area);
    $.ajax({
        type : 'POST',
        url : 'api/Mdlpersonal_cargar_personal',
        contentType:false,
        processData:false,
        data : formper,
        success : function(json) {
            if ( json.success == 1 ){
                msg_box_alert(json.success,"Registro Guardado",json.message,'redirect','usuarios/listar_personal');
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

function guardarpersonal(){
  $.ajax({
      type : "POST",
      url : 'api/Mdlpersonal_guardarpersonal',
      data : $('#formperso').serialize(),
      success : function(json) {
        if(json.success==1){
          msg_box_alert(json.success,"Ingreso",json.message,'redirect','usuarios/listar_personal');

        }else{
          msg_box_alert(json.success,"Ingreso",json.message);
        }
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

  function eliminarpersonal(id){
   var formperso=new FormData();
   formperso.append('id',id);
   $.ajax({
     type:"POST",
     url: "api/Mdlpersonal_eliminarpersonal",
     contentType: false,
     processData: false,
     data: formperso,
     success: function (data){
       msg_box_alert(data.success,"Eliminar",data.message,'redirect','usuarios/listar_personal');
     },
     error: function (xhr, status){
       msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
     }
   });
  }



  function modificarpersonal(){
    $.ajax({
        type : "POST",
        url : 'api/Mdlpersonal_modificarpersonal',
        data : $('#formeditarperso').serialize(),
        success : function(json) {
          if(json.success==1){
            msg_box_alert(json.success,"Modificacion",json.message,'redirect','usuarios/listar_personal');

          }
        },error : function(xhr, status) {
            msg_box_alert(99,'error',xhr.responseText);
        }
    });
  }

  function guardar_usuario(){
    $.ajax({
        type : "POST",
        url : 'api/Mdlpersonal_guardar_usuario',
        data : $('#formingreso').serialize(),
        success : function(json) {
          if(json.success==1){
            msg_box_alert(json.success,"Ingreso",json.message,'redirect','usuarios/listar_personal_sistema');

          }else{
            msg_box_alert(json.success,"Ingreso",json.message);
          }
        },error : function(xhr, status) {
            msg_box_alert(99,'error',xhr.responseText);
        }
    });
  }
  function modificar_usuario(){
    $.ajax({
        type : "POST",
        url : 'api/Mdlpersonal_modificarusuario',
        data : $('#formeditar').serialize(),
        success : function(json) {
          if(json.success==1){
            msg_box_alert(json.success,"Modificacion",json.message,'redirect','usuarios/listar_personal_sistema');

          }
        },error : function(xhr, status) {
            msg_box_alert(99,'error',xhr.responseText);
        }
    });
  }

function eliminarpersonal_sistema(id){
  var formeli=new FormData();
  formeli.append('id',id);
  $.ajax({
    type:"POST",
    url: "api/Mdlpersonal_eliminarpersonalsistema",
    contentType: false,
    processData: false,
    data: formeli,
    success: function (data){
      msg_box_alert(data.success,"Eliminar",data.message,'redirect','usuarios/listar_personal_sistema');
    },
    error: function (xhr, status){
      msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
    }
  });
}

function reactivarpersonal_sistema(id){
  var formre=new FormData();
  formre.append('id',id);
  $.ajax({
    type:"POST",
    url: "api/Mdlpersonal_reactivarpersonalsistema",
    contentType: false,
    processData: false,
    data: formre,
    success: function (data){
      msg_box_alert(data.success,"Activacion",data.message,'redirect','usuarios/listar_personal_sistema');
    },
    error: function (xhr, status){
      msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
    }
  });
}
