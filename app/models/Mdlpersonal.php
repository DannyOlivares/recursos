<?php

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Helpers\Strings;
use Ocrend\Kernel\Helpers\Emails;
use Ocrend\Kernel\Helpers\Files;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Style_NumberFormat;

/**
 *
 */

class Mdlpersonal extends Models implements IModels {



    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;
      protected $user = array();

    public function listar_personal(){
      return $this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,tblpersonal.area_personal,tblpersonal.email,tblpersonal.cargo_personal,tblpersonal.estado,tblpersonal.id_user,tblareas.descripcion from tblpersonal inner join tblareas on tblpersonal.area_personal=tblareas.cod_area");
    }

    public function cargar_personal(){
      global $http;

      $file = $http->files->get('excel');
      $area= $http->request->get('areas');
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];

      $docname="";
      if (null !== $file ){
          $ext_doc = $file->getClientOriginalExtension();

          if ($ext_doc<>'xls' and $ext_doc<>'xlsx') return array('success' => 0, 'message' => "Debe seleccionar un archivo valido...");

          $docname = 'cargapersonal.'.$ext_doc;

          $file->move(API_INTERFACE . 'views/app/temp/', $docname);

          $archivo = API_INTERFACE . 'views/app/temp/'. $docname;
          //carga del excelname
          $objReader = new PHPExcel_Reader_Excel2007();
          $objPHPExcel = $objReader->load($archivo);

          $i=2;
          $param=0;
          $id_tec="";
          $cont=0;
          while($param==0){
              try {
                 if ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue()!=NULL)
                 {
                     $rut = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue();
                     $nombre=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
                     $email= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getvalue();
                     $cargo= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getvalue();


           $result= $this->db->query_select("Select rut_personal from tblpersonal Where rut_personal='$rut'");
                     if (false == $result){
                         $this->db->Insert('tblpersonal', array(
                            'rut_personal'=>$rut,
                            'nombre_personal'=>$nombre,
                            'area_personal'=>$area,
                            'email'=>$email,
                            'cargo_personal'=>$cargo,
                            'id_user'=>$datousuario
                         ));
                     }else{
                         $this->db->Update('tblpersonal', array(
                            'nombre_personal'=>$nombre,
                            'area_personal'=>$area,
                            'cargo_personal'=>$cargo,
                            'estado'=> '1'
                        ),"rut_personal ='$rut'");
                     }
                     $cont=0;
                 }else{
                     $cont++;
                 }
                 if ($cont>10){$param=1;}
                 $i++;
              } catch (\Exception $e) {
                 return array('success' => 0, 'message' => $e->getMessage() );
              }
          }
          if($i>2){
             return array('success' => 1, 'message' => "Datos cargados exitosamente");
          }else{
             return array('success' => 0, 'message' => "Valla!!! algo salio mal!");
          }
      }else{
          return array('success' => 0, 'message' => "Debe seleccionar un archivo valido...");
      }
    }

    public function guardarpersonal(){
      global $http;
      $rut=$http->request->get('txtrutpersonal');
      $nombre=$http->request->get('txtnombrepersonal');
      $email=$http->request->get('txtemailpersonal');
      $area=$http->request->get('cmbarea');
      $cargo=$http->request->get('txtcargopersonal');

      $personal=$this->db->query_select("select * from tblpersonal where rut_personal='$rut'");
      if($personal==false){
        $this->db->insert('tblpersonal', array(
          'rut_personal'=>$rut,
          'nombre_personal'=>$nombre,
          'email'=>$email,
          'area_personal'=>$area,
          'cargo_personal'=>$cargo
        ));

        return array('success'=>1,'message'=>'Datos Ingresados correctamente');
      }else{
        return array('success'=>0,'message'=>'El rut ya existe');
      }
    }

      public function modificarpersonal(){
        global $http;
        $id=$http->request->get('txteditarpersonalid');
        $rut=$http->request->get('txtedirutpersonal');
        $nombre=$http->request->get('txteditarnombrepersonal');
        $email=$http->request->get('txteditaremailpersonal');
        $area=$http->request->get('cmbeditararea');
        $cargo=$http->request->get('txteditarcargopersonal');


          $this->db->update('tblpersonal', array(
            'rut_personal'=>$rut,
            'nombre_personal'=>$nombre,
            'email'=>$email,
            'area_personal'=>$area,
            'cargo_personal'=>$cargo
          ),"cod_personal=$id");

          return array('success'=>1,'message'=>'Datos modificados correctamente');
        }

        public function getpersonalcod(int $id){
          return $this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,tblpersonal.area_personal,tblpersonal.email,tblpersonal.cargo_personal,tblpersonal.estado,tblpersonal.id_user,tblareas.descripcion from tblpersonal inner join tblareas on tblpersonal.area_personal=tblareas.cod_area where cod_personal='$id'");
        }
        public function getusuariocod(int $id){
          return $this->db->query_select("select users.id_user,users.name,users.email,users.fono,users.rut_personal,users.cargo,users.perfil from users where id_user='$id'");
        }

        public function eliminarpersonal(){
          global $http;
          $id=$http->request->get('id');

          $this->db->query_select("update tblpersonal set estado='0' where cod_personal='$id'");

          return array('success'=>1,'message'=>'Usuario Desactivado');
        }

        public function guardar_usuario(){
          try {
              global $http;

              # Obtener los datos $_POST
              $nombre = $http->request->get('txtnombre');
              $email = strtolower($http->request->get('txtemail'));
              $fono = $http->request->get('txtfono');
              $cargo = $http->request->get('txtcargo');
              $rut_trabajador=$http->request->get('rut_usuario');
              $pass = $http->request->get('txtpass');
              $pass_repeat = $http->request->get('txtpassrepeat');
              $perfil = $http->request->get('cmdperfil');

              # Verificar que no están vacíos
              if ($this->functions->e($nombre, $email, $fono, $cargo, $rut_trabajador,$pass,$pass_repeat)) {
                  throw new ModelsException('Todos los datos son necesarios');
              }
              elseif ($perfil == '--'){
                  throw new ModelsException('Debe seleccionar un perfil');
              }

              # Verificar email
              (new Model\Varios)->checkEmailUser($email);

              # Verificar Router
              $this->checkRut($rut_trabajador);

              # Veriricar contraseñas
              $this->checkPassMatch($pass, $pass_repeat);

              # Registrar al usuario
              $this->db->insert('users', array(
                  'name' => $nombre,
                  'email' => $email,
                  'fono' => $fono,
                  'rut_personal' => $rut_trabajador,
                  'cargo' => $cargo,
                  'perfil' => $perfil,
                  'pagina_inicio'=>'portal',
                  'pass' => Strings::hash($pass)
              ));
              $id_user=$this->db->lastInsertId();

              $this->db->query("Insert Into tblperfilesuser(id_user,id_menu,id_submenu)
              select '$id_user',id_menu,id_submenu from tblperfiles where nombre='$perfil';");


              return array('success' => 1, 'message' => 'Registrado con éxito.');
          } catch (ModelsException $e) {
              return array('success' => 0, 'message' => $e->getMessage());
          }
  }
  private function checkRut(string $rut,string $id_user='0') {
      # Existencia de email
      if ($rut != '0' ){
        $rut = $this->db->scape($rut);
        $query = $this->db->select('rut_personal', 'users', "rut_personal='$rut' and id_user<>$id_user", 'LIMIT 1');
        if (false !== $query) {
            throw new ModelsException('El Rut introducido ya se encuentra asignado.');
        }
      }
  }

  private function checkPassMatch(string $pass, string $pass_repeat) {
      if ($pass != $pass_repeat) {
          throw new ModelsException('Las contraseñas no coinciden.');
      }
  }

  public function modificarusuario(){
    try {
        global $http;

        # Obtener los datos $_POST
        $id_user = $http->request->get('editid_user');
        $name = $http->request->get('txtnombre');
        $email = $http->request->get('txtemail');
        $cargo = $http->request->get('txtcargo');
        $fono = $http->request->get('txtfono');
        $rut_personal = $http->request->get('rut_usuario');
        $perfil = $http->request->get('cmbperfil');

        # Verificar que no están vacíos
        if ($this->functions->e($name, $cargo, $email,$fono)) {
            throw new ModelsException('Todos los datos son necesarios');
        }


        # Verificar email
        if (!Strings::is_email($email)) {
            throw new ModelsException('El email no tiene un formato válido.');
        }

        # Verificar Router
        $this->checkRut($rut_personal,$id_user);


        # Actualiza usuario
        $this->db->update('users',array(
          'name' => $name,
          'email' => $email,
          'fono' => $fono,
          'cargo' => $cargo,
          'perfil' => $perfil,
          'rut_personal' => $rut_personal
        ),"id_user='$id_user'",'LIMIT 1');
        // Carga nueva imagen de usuario

        // Asigna menu a usuario
        if ('DEFINIDO' != $perfil ){
          $this->db->query("Delete from tblperfilesuser
          WHERE id_user='$id_user';");

          $this->db->query("Insert Into tblperfilesuser(id_user,id_menu,id_submenu)
          select '$id_user',id_menu,id_submenu from tblperfiles where nombre='$perfil'");
        }
        //

        return array('success' => 1, 'message' => 'Registrado con éxito.');
    } catch (ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
    }

  }

  public function eliminarpersonalsistema(){
    global $http;
    $id=$http->request->get('id');
    $this->db->query_select("update users set estado='0' where id_user='$id'");
    return array('success'=>1, 'message'=>'Usuario desactivado');
  }
  public function reactivarpersonalsistema(){
    global $http;
    $id=$http->request->get('id');
    $this->db->query_select("update users set estado='1' where id_user='$id'");
    return array('success'=>1, 'message'=>'Usuario Reactivado');
  }

      public function __construct(IRouter $router = null) {
          parent::__construct($router);
          $this->startDBConexion();
          $this->user=(new Model\Users)->getOwnerUser();
      }

      /**
        * __destruct()
      */
      public function __destruct() {
          parent::__destruct();
          $this->endDBConexion();
      }
    }
