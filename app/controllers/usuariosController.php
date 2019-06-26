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


class usuariosController extends Controllers implements IControllers {

  public function __construct(IRouter $router) {
      global $config;
      $op = '5';
      parent::__construct($router,array(
          'users_logged' => true,
          'access_menu' => ['id_menu' => $op, 'access' => true]
      ));
      switch($this->method){
          case 'listar_personal':
              echo $this->template->render('personal/listar_personal', array(
                'menu_op' => $op,
                'db_personal'=> (new Model\Mdlpersonal)->listar_personal()
              ));
          break;
          case 'cargar_personal':
              echo $this->template->render('personal/cargar_personal', array(
                'menu_op' => $op,
                'db_area'=> (new Model\Avar)->listar_areas_activas()
              ));
          break;
          case 'ingresar_personal':
              echo $this->template->render('personal/ingresar_personal', array(
                'menu_op' => $op,
                'db_area'=> (new Model\Avar)->listar_areas_activas()
              ));
          break;
          case 'editar_personal':
          if($this->isset_id and false !== ($personal=(new Model\Mdlpersonal)->getpersonalcod($router->getId(true)))){
              echo $this->template->render('personal/editar_personal', array(
                'menu_op' => $op,
                'db_detalle'=>$personal[0],
                'db_area'=> (new Model\Avar)->listar_areas_activas()
              ));
            } else {

            }
          break;
          case 'listar_personal_sistema':
              echo $this->template->render('personal_sistema/listar_personal_sistema', array(
                'menu_op' => $op,
                'db_usuarios'=>(new Model\Avar)->listar_usuarios_sistema()
              ));
          break;
          case 'personal_sistema':
              echo $this->template->render('personal_sistema/ingresar_personal_sistema', array(
                'menu_op' => $op,
                'db_perfiles'=>(new Model\Avar)->getPerfiles()

              ));
          break;
          case 'editar_personal_sistema':
          if($this->isset_id and false !== ($usuario=(new Model\Mdlpersonal)->getusuariocod($router->getId(true)))){
            echo $this->template->render('personal_sistema/editar_personal_sistema', array(
              'menu_op' => $op,
                'db_usuario'=>$usuario[0],
                'db_perfiles'=>(new Model\Avar)->getPerfiles()
              ));
            } else {

            }
          break;
          default:

          break;
        }
      }
    }
    ?>
