<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

use app\models as Model;

/**
    * Inicio de sesión
    *
    * @return json
*/
$app->post('/login', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->login());
});

/**
    * Modifica password usuario
    *
    * @return json
*/
$app->post('/resetpass', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->resetpass());
});

/**
    * Inicio de sesión
    *
    * @return json
*/
$app->post('/logout', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->logout());
});

/**
    * Registro de un usuario
    *
    * @return json
*/
$app->post('/registra_nuevo_usuario', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->registra_nuevo_usuario());
});
/**
    * Registro de un usuario
    *
    * @return json
*/
$app->post('/update_usuario', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->update_usuario());
});
/**
    * Recuperar contraseña perdida
    *
    * @return json
*/
$app->post('/lostpass', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->lostpass());
});

/**
    * Recuperar contraseña perdida
    *
    * @return json
*/
$app->post('/registra_nuevo_perfil', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->registra_nuevo_perfil());
});
/**
    * Elimina perfil seleccionado
    *
    * @return json
*/
$app->post('/delete_perfil', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->delete_perfil());
});
/**
    * Elimina perfil seleccionado
    *
    * @return json
*/
$app->post('/reset_pass_user', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->resetpass());
});
/**
    * Actualiza perfil de usuario modificado directamente
    *
    * @return json
*/
$app->post('/update_peril_usuario', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->update_peril_usuario());
});
/**
    * Actualiza perfil de usuario modificado directamente
    *
    * @return json
*/
$app->post('/mostar_datos_perfil', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->mostar_datos_perfil());
});
/**
    * Actualiza perfil de usuario modificado directamente
    *
    * @return json
*/
$app->post('/update_perfil', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->update_perfil());
});
/**
    * Actualiza perfil datos de empresa
    *
    * @return json
*/
$app->post('/update_empresa', function() use($app) {
    $e = new Model\Empresa;

    return $app->json($e->update_empresa());
});

//////// CONTROLER RRHH ////////////////
/// HORAS EXTRAS
$app->post('/buscar_coincidencia', function() use($app) {
    $e = new Model\Horasextra;

    return $app->json($e->buscar_coincidencia());
});
$app->post('/hora_extra', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->hora_extra());
});
$app->post('/tmp_hora_extra', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->tmp_hora_extra());
});
$app->post('/revisar', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->revisar());
});
$app->post('/modificar', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->modificar());
});
$app->post('/agregar_usuario_he', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->agregar_usuario());
});
$app->post('/aprobar', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->aprobar());
});
$app->post('/rechazar', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->rechazar());
});
$app->post('/eliminar', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->eliminar());
});
$app->post('/eliminar_solicitud_mod', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->eliminar_solicitud_mod());
});
$app->post('/eliminar_peticiones', function() use($app) {
    $u = new Model\Horasextra;

    return $app->json($u->eliminar_peticiones());
});

//ausencias---------------------------------------------------------------------
$app->post('/registrar_ausencia', function() use($app) {
    $u = new Model\Ausencias;
    return $app->json($u->registrar_ausencia());
});
$app->post('/modificar_ausencia', function() use($app) {
    $u = new Model\Ausencias;

    return $app->json($u->modificar_ausencia());
});
$app->post('/verdatos', function() use($app) {

    $u = new Model\Ausencias;

    return $app->json($u->ver_observacion_ausencias());

});
$app->post('/validacion_eliminar', function() use($app) {

    $u = new Model\Ausencias;

    return $app->json($u->validacion_eliminar());

});
$app->post('/buscar_rut', function() use($app) {

    $u = new Model\Ausencias;

    return $app->json($u->buscar_rut());

});
$app->post('/revisar_por_fecha', function() use($app) {

    $u = new Model\Ausencias;

    return $app->json($u->revisar_por_fecha());

});
//ausencias---------------------------------------------------------------------
//ASIGNAR SUPERVISOR------------------------------------------------------------
$app->post('/Asignaejecutivo_select_perfil', function() use($app) {
    $u = new Model\Asignaejecutivo;
    return $app->json($u->select_perfil());
});
$app->post('/Asignaejecutivo_traer_usuarios', function() use($app) {
    $u = new Model\Asignaejecutivo;
    return $app->json($u->traer_usuarios());
});
$app->post('/Asignaejecutivo_asignar_supervision', function() use($app) {
    $u = new Model\Asignaejecutivo;
    return $app->json($u->asignar_supervision());
});
$app->post('/Asignaejecutivo_quitar_supervision', function() use($app) {
    $u = new Model\Asignaejecutivo;
    return $app->json($u->quitar_supervision());
});
//ASIGNAR SUPERVISOR------------------------------------------------------------
//Turnos------------------------------------------------------------------------
$app->post('/cargar_excel_turnos', function() use($app) {
    $u = new Model\Turnos;
    return $app->json($u->cargar_excel());
});
$app->post('/revisar_turno_por_fecha', function() use($app) {
    $u = new Model\Turnos;
    return $app->json($u->revisar_turno_por_fecha());
});
$app->post('/mensaje', function() use($app) {
    $u = new Model\Turnos;
    return $app->json($u->mensaje());
});
$app->post('/verturnomes', function() use($app) {
    $u = new Model\Turnos;
    return $app->json($u->verturnomes());
});
$app->post('/updateDatosEquipoAsignado', function() use($app) {
    $u = new Model\Turnos;
    return $app->json($u->updateDatosEquipoAsignado());
});
$app->post('/getTurnoSemanaCompleta', function() use($app) {
    $u = new Model\Turnos;
    return $app->json($u->getTurnoSemanaCompleta());
});
//Turnos------------------------------------------------------------------------
//CRUD MASTER PLATAFORMA--------------------------------------------------------
$app->post('/master_register_agenda', function() use($app) {
    $u = new Model\MdlPlataformaMaestros;
    return $app->json($u->master_register_agenda());
});
$app->post('/master_editar_agenda', function() use($app) {
    $u = new Model\MdlPlataformaMaestros;
    return $app->json($u->master_editar_agenda());
});
$app->post('/master_registra_nueva_comuna', function() use($app) {
    $e = new Model\MdlPlataformaMaestros;
    return $app->json($e->registra_nueva_comuna());
});
$app->post('/master_editar_comuna', function() use($app) {
    $e = new Model\MdlPlataformaMaestros;
    return $app->json($e->editar_comuna());
});
$app->post('/master_register_motivo', function() use($app) {
    $e = new Model\MdlPlataformaMaestros;
    return $app->json($e->registra_nuevo_motivo());
});
$app->post('/master_editar_motivo', function() use($app) {
    $e = new Model\MdlPlataformaMaestros;
    return $app->json($e->editar_motivo());
});
//CRUD MASTER PLATAFORMA--------------------------------------------------------
//AVAR--------------------------------------------------------------------------
$app->post('/cargar_excel_blindaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargar_excel());
});
$app->post('/avar_traer_users', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->avar_reactivos());
});
$app->post('/avar_des_marcar_ejecutivo', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->avar_des_marcar_ejecutivo());
});
//AVAR--------------------------------------------------------------------------
//CASILLEROS--------------------------------------------------------------------
//andes-------------------------------------------------------------------------
$app->post('/Mdlandes_filtrarcomunas', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->filtrarcomunas());
});
$app->post('/Mdlandes_editarfiltrarcomunas', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->editarfiltrarcomunas());
});
$app->post('/Mdlandes_cargaeps', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->carga_eps());
});
$app->post('/Mdlandes_guardarorden', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->guardarorden());
});
$app->post('/Mdlandes_modificarorden', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->modificarorden());
});

$app->post('/Mdlandes_editarcargaeps', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->editarcargaeps());
});
$app->post('/Mdlandes_cambiarestado', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->cambiarestado());
});
$app->post('/Mdlandes_cargar_ordenes_excel', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->cargar_ordenes_excel());
});
$app->post('/Mdlandes_guardartecnico', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->guardartecnico());
});
$app->post('/Mdlandes_actualiza_datos', function() use($app) {
    $u = new Model\Mdlandes;
    return $app->json($u->actualiza_datos());
});

//-------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------
$app->post('/Mdlavar_opciones_transporte', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->opciones_transporte());
});
$app->post('/Mdlavar_guardarlocalidad', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->guardarlocalidad());
});
$app->post('/avar_cargaropciones', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargaropciones());
});
$app->post('/Mdlavar_seleccionar', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->seleccionar());
});
$app->post('/Mdlavar_opciones_viatico', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->opciones_viatico());
});
$app->post('/Mdlavar_enviarproyecto', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->enviarproyecto());
});
$app->post('/Mdlavar_usuariotemporalsum', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->usuariotemporalsum());
});
$app->post('/Mdlavar_usuariotemporalres', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->usuariotemporalres());
});
$app->post('/Mdlavar_transporte_vuelo', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->transporte_vuelo());
});
$app->post('/Mdlavar_transporte_bus', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->transporte_bus());
});
$app->post('/Mdlavar_transporte_movil', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->transporte_movil());
});
$app->post('/Mdlavar_cargarresultado', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargarresultado());
});
$app->post('/Mdlavar_opciones_hospedaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->opciones_hospedaje());
});
$app->post('/Mdlavar_consultar_orden', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->consultar_orden());
});
$app->post('/Mdlavar_aprobar_orden', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->aprobar_orden());
});
$app->post('/Mdlavar_aprobar', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->aprobar());
});
$app->post('/Mdlavar_obserrechazar', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->obserrechazar());
});
$app->post('/Mdlavar_rechazar', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->rechazar());
});
$app->post('/Mdlavar_filtrar_fecha', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->filtrar_fecha());
});
$app->post('/Mdlavar_filtrar_estado', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->filtrar_estado());
});
$app->post('/Mdlavar_validarcodigo', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->validarcodigo());
});
$app->post('/Mdlavar_borrar_tabla', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->borrar_tabla());
});
$app->post('/Mdlavar_eliminar_localidad', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->eliminar_localidad());
});
$app->post('/Mdlavar_eleccion', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->eleccion());
});
$app->post('/Mdlavar_editar_localidad', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->editar_localidad());
});
$app->post('/Mdlavar_modificarproyecto', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->modificarproyecto());
});
$app->post('/Mdlavar_guardar_vista', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->guardar_vista());
});
$app->post('/Mdlavar_conductor_movil', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->conductor_movil());
});
$app->post('/Mdlavar_selec_chofersum', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->selec_chofersum());
});
$app->post('/Mdlavar_selec_choferres', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->selec_choferres());
});
$app->post('/Mdlavar_cargar_tipo', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargar_tipo());
});
$app->post('/Mdlavar_descartar_tipo', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->descartar_tipo());
});
$app->post('/Mdlavar_select_hospedaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->select_hospedaje());
});
$app->post('/Mdlavar_descartar_hospedaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->descartar_hospedaje());
});
$app->post('/Mdlavar_costo_hospedaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->costo_hospedaje());
});
$app->post('/Mdlavar_cantidad_hospedaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cantidad_hospedaje());
});
$app->post('/Mdlavar_validarpasaje', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->validarpasaje());
});
$app->post('/Mdlavar_mostrar_personal', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->mostrar_personal());
});
$app->post('/Mdlavar_marcar_hos', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->marcar_hos());
});
$app->post('/Mdlavar_descartar_hos', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->descartar_hos());
});
$app->post('/Mdlavar_validar_precio', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->validar_precio());
});
$app->post('/Mdlavar_eliminar', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->eliminar());
});
$app->post('/Mdlavar_marcar_chofersum', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->marcar_chofersum());
});
$app->post('/Mdlavar_marcar_choferres', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->marcar_choferres());
});
$app->post('/Mdlavar_pagar_control', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->pagar_control());
});
$app->post('/Mdlavar_cargararchivo', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargararchivo());
});
$app->post('/Mdlavar_verfactura', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->verfactura());
});
$app->post('/Mdlavar_guardararea', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->guardararea());
});
$app->post('/Mdlavar_eliminararea', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->eliminararea());
});
$app->post('/Mdlavar_modificararea', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->modificararea());
});
$app->post('/Mdlavar_reactivararea', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->reactivararea());
});
$app->post('/Mdlpersonal_cargar_personal', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->cargar_personal());
});
$app->post('/Mdlpersonal_guardarpersonal', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->guardarpersonal());
});
$app->post('/Mdlpersonal_eliminarpersonal', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->eliminarpersonal());
});
$app->post('/Mdlpersonal_modificarpersonal', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->modificarpersonal());
});
$app->post('/avar_eliminardatos', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->eliminardatos());
});
$app->post('/Mdlavar_cambiardatos', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cambiardatos());
});
$app->post('/Mdlavar_editaropciones', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->editaropciones());
});
$app->post('/avar_eliminaropciones', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->eliminaropciones());
});
$app->post('/Mdlavar_cargar_areas', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargarareas());
});
$app->post('/Mdlpersonal_guardar_usuario', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->guardar_usuario());
});
$app->post('/Mdlpersonal_modificarusuario', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->modificarusuario());
});
$app->post('/Mdlpersonal_eliminarpersonalsistema', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->eliminarpersonalsistema());
});
$app->post('/Mdlpersonal_reactivarpersonalsistema', function() use($app) {
    $u = new Model\Mdlpersonal;
    return $app->json($u->reactivarpersonalsistema());
});
$app->post('/Mdlavar_revisarpersonal', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->revisarpersonal());
});
$app->post('/Mdlavar_modificardatos', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->modificardatos());
});
$app->post('/Mdlavar_quitar_filtro', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->quitar_filtro());
});
$app->post('/Mdlavar_cargar_inicio', function() use($app) {
    $u = new Model\Avar;
    return $app->json($u->cargar_inicio());
});

