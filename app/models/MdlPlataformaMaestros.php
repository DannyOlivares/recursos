<?php


namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Helpers\Strings;

/**
 * Modelo Areas
 *
 * @author Jorge Jara H. <jjara@wys.cl>
 */

class MdlPlataformaMaestros extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;

    public function getMotivosCasilleros(int $id=0){
        $filtro='';
        if ($id != 0){
            $filtro = ' where id = '.$id;
        }
        return $this->db->query_select('select id,accion,descripcion,estado from tbl_plataforma_motivos_casilleros '.$filtro.' Order by Id');
    }
    public function update_estado_motivo($id) {
        global $config;
        # Actualiza Estado
        $this->db->query("UPDATE tbl_plataforma_motivos_casilleros SET estado=if(estado=0,1,0) WHERE id=$id LIMIT 1;");
        # Redireccionar a la página principal del controlador
        $this->functions->redir($config['site']['url'] . 'plataforma/listar_motivos');
    }
    public function registra_nuevo_motivo() : array {
        try {
            global $http;

            # Obtener los datos $_POST
            $ubicacion = $http->request->get('ubicacion');
            $descripcion = $http->request->get('descripcion');

            # Verificar que no están vacíos
            if ($this->functions->e($ubicacion,$descripcion)) {
                throw new ModelsException('Ingresar datos donde campos se especifica como Requerido');
            }
            # Registrar el bloque
            $this->db->insert('tbl_plataforma_motivos_casilleros', array(
                'accion' => strtoupper($ubicacion),
                'descripcion'=>strtoupper($descripcion)
            ));

            return array('success' => 1, 'message' => 'Registrado con éxito.');
        } catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }
    public function editar_motivo(): array {
        try {
            global $http;

            #Obtener los datos $_POST
            $id = $http->request->get('id_motivo');
            $ubicacion = $http->request->get('ubicacion');
            $descripcion = $http->request->get('descripcion');

            # Verificar que no están vacíos
            if ($this->functions->e($ubicacion,$descripcion)) {
                throw new ModelsException('Ingresar datos donde campos se especifica como Requerido');
            }

            $this->db->update('tbl_plataforma_motivos_casilleros',array(
                'accion' => strtoupper($ubicacion),
                'descripcion'=>strtoupper($descripcion)
            ),"id='$id'");
            //
            return array('success' => 1, 'message' => 'Modificacion exitosa');
        }catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }

    public function getAllAgendaEPS(){
        return $this->db->query_select('select id,contacto,nombre_eps,correo,telefono,anexo,tipo_contacto,comuna from tblagendaeps Order by Id');
    }
    public function getAgendaEPSById(int $id, string $select = '*') {
        return $this->db->select($select,'tblagendaeps',"id='$id'",'LIMIT 1');
    }
    public function master_register_agenda(){
        try
        {
            global $http;
            # Obtener los datos $_POST
            $nombre_eps= $http->request->get('nombre_eps');
            $contacto= $http->request->get('contacto');
            $correo= $http->request->get('correo');
            $telefono= $http->request->get('telefono');
            $anexo= $http->request->get('anexo');
            $tipo_contacto= $http->request->get('tipo_contacto');

            if ($this->functions->e($nombre_eps,$contacto,$correo,$telefono,$tipo_contacto)) {
                throw new ModelsException('Todos los datos son necesarios');
            }
            if (!Strings::is_email($correo)) {
                throw new ModelsException('El email no tiene un formato válido.');
            }

            $this->db->insert('tblagendaeps', array(
                'nombre_eps'=> $nombre_eps,
                'contacto'=> $contacto,
                'correo'=> $correo,
                'telefono'=> $telefono,
                'anexo'=> $anexo,
                'tipo_contacto'=> $tipo_contacto
            ));


            return array('success' => 1, 'message' => 'Guardado con exito');

        }catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }
    public function master_editar_agenda(){
        try
        {
            global $http;
            # Obtener los datos $_POST
            $id= $http->request->get('id');
            $nombre_eps= $http->request->get('nombre_eps');
            $contacto= $http->request->get('contacto');
            $correo= $http->request->get('correo');
            $telefono= $http->request->get('telefono');
            $anexo= $http->request->get('anexo');
            $tipo_contacto= $http->request->get('tipo_contacto');

            if ($this->functions->e($nombre_eps,$contacto,$correo,$telefono,$tipo_contacto)) {
                throw new ModelsException('Todos los datos son necesarios...');
            }

            if (!Strings::is_email($correo)) {
                throw new ModelsException('El email no tiene un formato válido.');
            }

            $this->db->update('tblagendaeps', array(
                'nombre_eps'=> $nombre_eps,
                'contacto'=> $contacto,
                'correo'=> $correo,
                'telefono'=> $telefono,
                'anexo'=> $anexo,
                'tipo_contacto'=> $tipo_contacto
            ),"id='$id'");


            return array('success' => 1, 'message' => 'Guardado con exito');

        }catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }
    public function DeleteAgendaEPSByID($id) {
        global $config;
        # Actualiza Estado
        $this->db->query("delete from tblagendaeps WHERE id=$id LIMIT 1;");
        # Redireccionar a la página principal del controlador
        $this->functions->redir($config['site']['url'] . 'plataforma/listar_agenda');
    }

    public function verComunas(string $select = '*'){
        return $this->db->select($select,'tblcomuna');
    }
    public function getComunasById(int $id, string $select = '*') {
        return $this->db->select($select,'tblcomuna',"id_comuna='$id'",'LIMIT 1');
    }
    public function registra_nueva_comuna() : array {
        try {
            global $http;

            # Obtener los datos $_POST
            $comuna = $http->request->get('comuna');
            $descripcion = $http->request->get('descripcion');
            $zona = $http->request->get('zona');
            // $subzona = $http->request->get('cod_sub_zona');
            // $territorio = $http->request->get('territorio');

            $avar = $http->request->get('avar');
            if ($avar == 'si') {
                $avar = 1;
            }else {
                $avar = 0;
            }
            # Verificar que no están vacíos
            if ($this->functions->e($comuna,$zona,$descripcion)) {
                throw new ModelsException('Ingresar datos donde campos se especifica como Requerido');
            }
            # Registrar el bloque
            $this->db->insert('tblcomuna', array(
                'nombre' => strtoupper($comuna),
                'zona'=>strtoupper($zona),
                'descripcion'=>strtoupper($descripcion),
                'avar'=>strtoupper($avar)
            ));

            return array('success' => 1, 'message' => 'Registrado con éxito.');
        } catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }
    public function editar_comuna(): array {
        try {
            global $http;

            #Obtener los datos $_POST
            $comuna = $http->request->get('comuna');
            $descripcion = $http->request->get('descripcion');
            $id_comuna = $http->request->get('id_comuna');
            $zona = $http->request->get('zona');
            // $subzona = $http->request->get('cod_sub_zona');
            // $territorio = $http->request->get('territorio');
            $avar = $http->request->get('avar');
            if ($avar == 'si') {
                $avar = 1;
            }else {
                $avar = 0;
            }
            if ($this->functions->e($comuna,$zona,$descripcion)) {
                throw new ModelsException('Todos los datos son necesarios');
            }
            $this->db->update('tblcomuna',array(
            'nombre' => $comuna,
            'zona'=>strtoupper($zona),
            'descripcion'=>strtoupper($descripcion),
            'avar'=>strtoupper($avar)
            ),"id_comuna='$id_comuna'");
            //
            return array('success' => 1, 'message' => 'Modificacion de Comuna exitosa');
        }catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }
    public function update_estado_comuna($id) {
        global $config;
        # Actualiza Estado
        $this->db->query("UPDATE tblcomuna SET estado=if(estado=0,1,0) WHERE id_comuna=$id LIMIT 1;");
        # Redireccionar a la página principal del controlador
        $this->functions->redir($config['site']['url'] . 'plataforma/listar_comunas');
    }


    public function __construct(IRouter $router = null) {
        parent::__construct($router);
        $this->startDBConexion();
    }
    /**
      * __destruct()
    */
    public function __destruct() {
        parent::__destruct();
        $this->endDBConexion();
    }
}
