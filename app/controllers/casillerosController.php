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

class casillerosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        global $config;
        $op = '3';
        parent::__construct($router,array(
            'users_logged' => true,
            'access_menu' => ['id_menu' => $op, 'access' => true]
        ));

        $accion = ['Anulacion','Escalamiento EPS','Falta de Protocolo','Finalizacion','Incidencia','Reagendamiento'];
        $actividad = ['Altas','SSTT','Pet Varias','Traslados'];

        switch($this->method){
            case 'listar_casilleros':
                echo $this->template->render('casilleros/listar_casilleros',array(
                    'menu_op' => $op,
                    'casilleros' => (new Model\Casilleros)->verOrdenesCasilleros(date('Y-m-d'))
                ));
            break;
            case 'agregar':
                echo $this->template->render('casilleros/nuevo_casillero',array(
                    'menu_op' => $op,
                    'casillero' => (new Model\Casilleros)->getUltimoCasillero($this->user['id_user']),
                    'accion' => $accion,
                    'actividad' => $actividad
                ));
            break;
            case 'editar':
                if($this->isset_id and false !== ($data = (new Model\Casilleros)->verOrdenesCasillerosById($router->getId(true)))) {
                    echo $this->template->render('casilleros/editar_casillero',array(
                        'menu_op' => $op,
                        'casilleros' => $data[0],
                        'actividad' => $actividad,
                        'accion' => $accion,
                        'motivo_accion' => (new Model\Casilleros)->getMotivoAccionCasilleros($data[0]['accion'])
                    ));
                    } else {
                    $this->functions->redir($config['site']['url'] . 'administracion/&error=true');
                }
            break;
            case 'excel':
                echo $this->template->render('casilleros/excell',array(
                    'menu_op' => $op,
                    'casilleros' => (new Model\Casilleros)->verOrdenesCasillerosAll(date('Y-m-d'),date('Y-m-d'))
                ));
            break;
            case 'exportar':
               (new Model\Casilleros)->exporta_excel_casilleros();
            break;
            case 'producciondia':
                echo $this->template->render('casilleros/report_produccion',array(
                    'menu_op' => $op
                ));
            break;
            default:
                echo $this->template->render('casilleros/casilleros',array(
                    'menu_op' => $op,
                    'accion' => $accion,
                    'getResumenGestionEjecutivos' => (new Model\Casilleros)->getResumenGestionEjecutivos(date('Y-m-d'),date('Y-m-d')),
                    'getEjecutivosCasilleros' => (new Model\Casilleros)->getEjecutivosCasilleros(date('Y-m-d'),date('Y-m-d')),
                    'getTotalesGestionEjecutivos' => (new Model\Casilleros)->getTotalesGestionEjecutivos(date('Y-m-d'),date('Y-m-d'))
                ));
            break;
        }

    }

}
