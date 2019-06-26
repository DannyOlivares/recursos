function execute_accion_confirmacion(method,api_rest,formulario,accion,accion_redirect){
    switch(api_rest) {
        case "master_register_agenda":
            title='Registra Nuevo Contacto';
        break;
        case "master_editar_agenda":
            title='Modificar Comuna';
        break;
        case "master_registra_nueva_comuna":
            title='Registro de Comuna';
        break;
        case "master_editar_comuna":
            title='Modificar Comuna';
        break;
        case "master_register_motivo":
            title='Registra Motivo';
        break;
        case "master_editar_motivo":
            title='Modificar Motivo';
        break;
    }
    $.ajax({
        type : method,
        url : 'api/'+api_rest,
        data : $('#'+ formulario).serialize(),
        success : function(json) {
            msg_box_alert(json.success,title,json.message,accion,accion_redirect);
        },
        error : function(xhr, status) {
            msg_box_alert(99,title,xhr.responseText);
        }
    });
}
$('#register_agenda').click(function(e) {
    e.defaultPrevented;
    execute_accion_confirmacion("POST","master_register_agenda",'register_agenda_form','redirect','plataforma/listar_agenda');
});
$('#update_agenda').click(function(e) {
    e.defaultPrevented;
    execute_accion_confirmacion("POST","master_editar_agenda",'editar_estado_form','redirect','plataforma/listar_agenda');
});
$('#register_comuna').click(function(e) {
    e.defaultPrevented;
    execute_accion_confirmacion("POST","master_registra_nueva_comuna",'register_comuna_form','redirect','plataforma/listar_comunas');
});
$('#update_comuna').click(function(e) {
    e.defaultPrevented;
    execute_accion_confirmacion("POST","master_editar_comuna",'editar_comuna_form','redirect','plataforma/listar_comunas');
});
$('#register_motivo').click(function(e) {
    e.defaultPrevented;
    execute_accion_confirmacion("POST","master_register_motivo",'register_motivo_form','redirect','plataforma/listar_motivos');
});
$('#update_motivo').click(function(e) {
    e.defaultPrevented;
    execute_accion_confirmacion("POST","master_editar_motivo",'editar_motivo_form','redirect','plataforma/listar_motivos');
});
