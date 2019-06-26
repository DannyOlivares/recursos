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
 * Controlador portal/
 *
 * @author Jorge Jara H. <jjara@wys.cl>
*/

class portalController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        global $config;
        $op = '0';
        parent::__construct($router,array(
            'users_logged' => true
        ));
        $u = new Model\Users($router);
        switch($this->method){
            case 'perfil_usuario':
                echo $this->template->render('portal/perfil_usuario',array(
                    'menu_op' => $op
                ));
            break;
            default:
                echo $this->template->render('portal/home',array(
                    'menu_op' => $op,
                    'db_proyecto'=>(new Model\Avar)->listar_proyecto(date('Y-m-d'),date('Y-m-d')),
                    'db_perfil'=>(new Model\Users)->getOwnerUser()
                ));
            break;
          }
    }

}
