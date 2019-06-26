<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;

/**
 * Controlador plataforma/
 *
 * @author Jorge Jara H. <jjara@wys.cl>
*/

class plataformaController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        global $config;
        $op = '10';
        parent::__construct($router,array(
            'users_logged' => true,
            'access_menu' => ['id_menu' => $op, 'access' => true]
        ));
        $accion = ['Anulacion','Escalamiento EPS','Falta de Protocolo','Finalizacion','Incidencia','Reagendamiento'];
        switch($this->method){
            case 'mantenedores_crud_masters':
                echo $this->template->render('plataforma/mantenedores_crud_masters/mantenedores_crud_masters', array(
                    'menu_op' => $op
                ));
            break;
            case 'listar_motivos':
                 echo $this->template->render('plataforma/mantenedores_crud_masters/motivos_casilleros/listar_motivo', array(
                    'menu_op' => $op,
                    'motivos_db' => (new Model\MdlPlataformaMaestros)->getMotivosCasilleros(0)
                 ));
            break;
            case 'nuevo_motivo':
                 echo $this->template->render('plataforma/mantenedores_crud_masters/motivos_casilleros/nuevo_motivo', array(
                     'menu_op' => $op,
                     'db_ubicacion' => $accion
                 ));
            break;
            case 'editar_motivo':
                 if($this->isset_id and false !== ($data = (new Model\MdlPlataformaMaestros)->getMotivosCasilleros($router->getId()))) {
                     echo $this->template->render('plataforma/mantenedores_crud_masters/motivos_casilleros/editar_motivo', array(
                        'menu_op' => $op,
                        'db_ubicacion' => $accion,
                        'db_motivo' => $data[0]
                     ));
                 } else {
                     $this->functions->redir($config['site']['url'] . 'plataforma/&error=true');
                 }
            break;
            case 'estado_motivo':
                 (new Model\MdlPlataformaMaestros)->update_estado_motivo($router->getId(true));
            break;
            // ------------------------------------------------------------------------------------------------------------------------------------------
            case 'listar_agenda':
                 echo $this->template->render('plataforma/mantenedores_crud_masters/agendaeps/listar_agenda', array(
                    'menu_op' => $op,
                    'getAllAgendaEPS' => (new Model\MdlPlataformaMaestros)->getAllAgendaEPS()
                 ));
            break;
            case 'nuevo_agenda':
                 echo $this->template->render('plataforma/mantenedores_crud_masters/agendaeps/nuevo_agenda', array(
                     'menu_op' => $op
                 ));
            break;
            case 'editar_agenda':
                 if($this->isset_id and false !== ($data = (new Model\MdlPlataformaMaestros)->getAgendaEPSById($router->getId()))) {
                     echo $this->template->render('plataforma/mantenedores_crud_masters/agendaeps/editar_agenda', array(
                        'menu_op' => $op,
                        'db_agendaeps' => $data[0]
                     ));
                 } else {
                     $this->functions->redir($config['site']['url'] . 'plataforma/&error=true');
                 }
            break;
            case 'estado_agenda':
                 (new Model\MdlPlataformaMaestros)->DeleteAgendaEPSByID($router->getId(true));
            break;
            // ------------------------------------------------------------------------------------------------------------------------------------------
            case 'listar_comunas':
                echo $this->template->render('plataforma/mantenedores_crud_masters/comuna/listar_comuna', array(
                    'menu_op' => $op,
                    'comunas_db' => (new Model\MdlPlataformaMaestros)->verComunas()
                ));
            break;
            case 'nueva_comuna':
                echo $this->template->render('plataforma/mantenedores_crud_masters/comuna/nueva_comuna', array(
                    'menu_op' => $op
                ));
            break;
            case 'editar_comuna':
                if($this->isset_id and false !== ($data = (new Model\MdlPlataformaMaestros)->getComunasById($router->getId()))) {
                echo $this->template->render('plataforma/mantenedores_crud_masters/comuna/editar_comuna', array(
                'menu_op' => $op,
                'db_comuna' => $data[0]
                ));
                } else {
                $this->functions->redir($config['site']['url'] . 'plataforma/mantenedores_crud_masters/&error=true');
                }
            break;
            case 'estado_comuna':
                (new Model\MdlPlataformaMaestros)->update_estado_comuna($router->getId(true));
            break;
            // ------------------------------------------------------------------------------------------------------------------------------------------
            default:
                echo $this->template->render('plataforma/plataforma', array(
                    'menu_op' => $op
                ));
            break;
        }

    }

}
