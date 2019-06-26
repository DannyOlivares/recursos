$('#btnguardartecnico').click(function(e) {
  $.ajax({
      type : "POST",
      url : 'api/Mdlandes_guardartecnico',
      data : $('#formnuevotecnico').serialize(),
      success : function(json) {
        msg_box_alert(json.success,"Ingreso",json.message,"reload");
      },error : function(xhr, status) {
          msg_box_alert(99,'error',xhr.responseText);
      }
  });
});
