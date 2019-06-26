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
 * Controlador avar/
 *

*/

class avarController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        global $config;
        $op = '2';
        parent::__construct($router,array(
            'users_logged' => true,
            'access_menu' => ['id_menu' => $op, 'access' => true]
        ));

        switch($this->method){
            case 'carga_pendientes':
                echo $this->template->render('avar/cargaordenes/carga_pendientes', array(
                    'menu_op' => $op,
                    'fecha' => date('Y-m-d'),
                    'db_archivos' => (new Model\Varios)->listar_archivos_cargados('Carga de Blindaje',10)
                ));
            break;
            case 'test':
                echo $this->template->render('avar/nuevo_control', array(
                    'menu_op' => $op,
                    'db_localidades' => (new Model\Avar)->listar_localidades(),
                    'db_areas' => (new Model\Avar)->ver_areas(),
                    'fecha' => date('Y-m-d'),
                ));
            break;
            case 'localidades':
                echo $this->template->render('avar/localidades', array(
                    'menu_op' => $op,
                    'db_localidades' => (new Model\Avar)->listar_localidades()

                ));
            break;
            case 'nueva_localidad':
                echo $this->template->render('avar/nueva_localidad', array(
                    'menu_op' => $op
                ));
            break;
            case "editar_localidades":
              if($this->isset_id and false !== ($orden=(new Model\Avar)->get_orden_byId($router->getId(true)))){
                  echo $this->template->render('avar/editar_localidades', array(
                    'menu_op' => $op,
                    'db_localidades'=>$orden[0],
                    'db_areas' => (new Model\Avar)->listar_areas_activas(),
                    'db_viatico'=>(new Model\Avar)->datos_viatico($orden[0][0]),
                    'db_bus'=>(new Model\Avar)->datos_bus($orden[0][0]),
                    'db_vuelo'=>(new Model\Avar)->datos_vuelo($orden[0][0]),
                    'db_movil'=>(new Model\Avar)->datos_peaje($orden[0][0]),
                    'db_hospedaje'=>(new Model\Avar)->datos_hospedaje($orden[0][0]),
                    'db_transporte'=>(new Model\Avar)->datos_transporte($orden[0][0]),
                  ));
              } else {

              }
            break;
            case "editar_control":
              if($this->isset_id and false !== ($orden=(new Model\Avar)->get_orden_byId2($router->getId(true)))){
                  echo $this->template->render('avar/editar_control', array(
                    'menu_op' => $op,
                    'db_modificar'=>$orden[0],
                    'db_localidades' => (new Model\Avar)->listar_localidades(),
                    'db_usuviatico'=>(new Model\Avar)->selec_usuarios_viatico($orden[0][1]),
                    'db_tipo_hospedaje'=>(new Model\Avar)->select_tipo_hospedaje(),
                    'db_detalleviatico'=>(new Model\Avar)->ver_detalleviatico($orden[0][1]),
                    'db_cant_usuarios'=>(new Model\Avar)->cantusuarios($orden[0][1]),
                    'db_tipo_transporte'=>(new Model\Avar)->tipo_transporte($orden[0][1]),
                    'db_precio_transporte'=>(new Model\Avar)->precio_transporte($orden[0][1]),
                    'db_cantidad_movil'=>(new Model\Avar)->cantidad_movil($orden[0][1]),
                    'db_cantidad_peaje'=>(new Model\Avar)->cantidad_peaje($orden[0][1]),
                    'db_cantidad_monto'=>(new Model\Avar)->cantidad_monto($orden[0][1]),
                    'db_detalle_hospedaje'=>(new Model\Avar)->ver_detalle_hospedaje($orden[0][1]),
                    $montodetalle=(new Model\Avar)->ver_detalle_hospedaje($orden[0][1]),
                    'db_monto'=>$montodetalle[0],
                    'db_mod_chof'=>(new Model\Avar)->mod_chofer($orden[0][1]),
                    'total_viatico'=>(new Model\Avar)->total_viatico($orden[0][1]),
                  ));

              } else {

              }
            break;
            case 'areas':
                echo $this->template->render('avar/Areas/listar_areas', array(
                    'menu_op' => $op,
                    'db_areas' => (new Model\Avar)->listar_areas()

                ));
            break;
            case 'nueva_area':
                echo $this->template->render('avar/Areas/nueva_area', array(
                    'menu_op' => $op


                ));
            break;
            case 'descargar_pdf':
                  (new Model\Avar)->generar_pdf($router->getId(true));
            break;
            case 'editar_area':
                if($this->isset_id and false !== ($area=(new Model\Avar)->get_orden_byId3($router->getId(true)))){
                    echo $this->template->render('avar/Areas/editar_area', array(
                        'menu_op' => $op,
                        'db_modificar_area'=>$area[0],

                ));
              }else{
              }
            break;

            default:
                echo $this->template->render('avar/avar',array(
                    'menu_op' => $op,
                ));
            break;
        }

    }
}
