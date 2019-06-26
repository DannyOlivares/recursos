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


class andesController extends Controllers implements IControllers {

  public function __construct(IRouter $router) {
      global $config;
      $op = '6';
      parent::__construct($router,array(
          'users_logged' => true,
          'access_menu' => ['id_menu' => $op, 'access' => true]
      ));
      switch($this->method){
          case 'listar_ordenes':
              echo $this->template->render('andes/listar_ordenes', array(
                  'menu_op' => $op,
                  'db_ordenesandes'=>(new model\Mdlandes)->listar_ordenes(date('Y-m-d'),date('Y-m-d'))

              ));
          break;
          case 'nueva_orden':
              echo $this->template->render('andes/nueva_orden', array(
                  'menu_op' => $op,
                  'db_zonas'=>(new model\Mdlandes)->cargar_zonas(),
              ));
          break;
          case "editar_orden":
            if($this->isset_id and false !== ($orden=(new Model\Mdlandes)->get_orden_byId($router->getId(true)))){
                echo $this->template->render('andes/editar_orden', array(
                  'menu_op' => $op,
                  'db_ordenandes'=>$orden[0],
                   $zona=(new model\Mdlandes)->carga_zona($orden[0][0]),
                   'db_zonas'=>(new model\Mdlandes)->cargar_zonas(),
                   'db_zonaeditada'=>(new model\Mdlandes)->carga_comuna_zona($zona[0][0]),
                   'db_tecnicos'=>(new model\Mdlandes)->carga_tecnicos($zona[0][0])
                ));
            } else {

            }
          break;
          case 'importar_ordenes':
              echo $this->template->render('andes/importar_ordenes', array(
                  'menu_op' => $op
              ));
          break;
          case 'listar_tecnicos':
              echo $this->template->render('andes/listar_tecnicos', array(
                'db_tecnicos'=>(new model\Mdlandes)->listar_tecnicos(),
                'menu_op' => $op
              ));
          break;
          case 'nuevo_tecnico':
              echo $this->template->render('andes/nuevo_tecnico', array(
                'db_zonas'=>(new model\Mdlandes)->cargar_zonas(),
                'db_eps'=>(new model\Mdlandes)->listar_eps(),
                'menu_op' => $op
              ));
          break;
          default:

          break;
        }
      }
    }
    ?>
