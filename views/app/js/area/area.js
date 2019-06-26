function guardararea(){
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_guardararea',
      data : $('#formarea').serialize(),
      success : function(json) {
        msg_box_alert(json.success,"Ingreso",json.message,'redirect','avar/areas');

      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

function eliminararea(id){
 var formarea=new FormData();
 formarea.append('id',id);
 $.ajax({
   type:"POST",
   url: "api/Mdlavar_eliminararea",
   contentType: false,
   processData: false,
   data: formarea,
   success: function (data){
     msg_box_alert(data.success,"Eliminar",data.message,'redirect','avar/areas');
   },
   error: function (xhr, status){
     msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
   }
 });
}

function modificararea(){
  $.ajax({
      type : "POST",
      url : 'api/Mdlavar_modificararea',
      data : $('#formeditararea').serialize(),
      success : function(json) {
        if(json.success==1){
          msg_box_alert(json.success,"Modificacion",json.message,'redirect','avar/areas');

        }
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
}

function reactivar(id){
  var formare=new FormData();
  formare.append('id',id);
  $.ajax({
    type:"POST",
    url: "api/Mdlavar_reactivararea",
    contentType: false,
    processData: false,
    data: formare,
    success: function (data){
      msg_box_alert(data.success,"Area",data.message,'redirect','avar/areas');
    },
    error: function (xhr, status){
      msg_box_alert(99,'Filtar Ordenes', xhr.responseText);
    }
  });

}
