<?php

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Style_NumberFormat;

/**
 * Modelo Ausencias
 *
 * @author Jorge Jara H. <jjara@wys.cl>
 */

class Mdlandes extends Models implements IModels {

    protected $user = array();

    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;


  public function listar_ordenes($desde,$hasta){

     return $this->db->query_select("select tblcomuna.descripcion,(select nombre from tbltecnicos tbltec inner join tblordenes_andes tbla on tbltec.id_tecnicos=tbla.tecnico where tbla.tecnico=tblordenes_andes.tecnico) as tecnombre, tblordenes_andes.id_orden,tblordenes_andes.rut_cliente,tblordenes_andes.nombre_cliente,tblordenes_andes.telefono,tblordenes_andes.direccion,tblordenes_andes.comuna,tblordenes_andes.zona,case tblordenes_andes.tipo_actividad when 0 then '--' when 1 then 'Alta' when 2 then 'Reparacion' when 3 then 'Modificacion' end as tipo_actividad,case tblordenes_andes.franja when 0 then '--' when 1 then '09-13' when 2 then '13-16' when 3 then '16-19' when 4 then '19-21' end as franja,tblordenes_andes.fecha, tblordenes_andes.numero_orden, tblordenes_andes.id_actividad,case tblordenes_andes.estado when 0 then 'Pendiente' when 1 then 'Iniciado' when 2 then 'Completado' when 3 then 'Derivado' when 4 then 'Cancelada' end as estado, tblordenes_andes.observacion, tblordenes_andes.tecnico, tblordenes_andes.eps from tblordenes_andes inner join tblcomuna on tblordenes_andes.comuna=tblcomuna.id_comuna where fecha between '$desde' and '$hasta'");
  }
  public function cargar_zonas(){
     return $this->db->query_select("select DISTINCT zona from tblcomuna");
  }
  public function listar_eps(){
     return $this->db->query_select("select DISTINCT codigo_eps from tbltecnicos");
  }

  public function filtrarcomunas(){
    global $http;

    $zona=$http->request->get('zona');


    $zonaseleccionada=$this->db->query_select("select id_comuna,descripcion from tblcomuna where zona='$zona'");
    if($zonaseleccionada===false){
      $html="<label for='cmbcomunas'>Comuna</label>
            <select class='form-control' id='cmbcomunas' name='cmbcomunas'>
            <option value='0'>--</option>
            </select>";

      $html2="<label for='cmbtecnicos'>Tecnico</label>
                  <select class='form-control' id='cmbtecnicos' name='cmbtecnicos'>
                  <option value='0'>--</option>
                  </select>";

      $html3="<label>EPS</label><input type='text' name='txteps' id='txteps' class='form-control' value=''>";

      return array('success' => 1, 'html' => $html, 'html2' => $html2, 'html3' => $html3 );

    }else{
    $html="<label for='cmbcomunas'>Comuna</label>
          <select class='form-control' id='cmbcomunas' name='cmbcomunas'>
          <option value='0'>--</option>";
          foreach ($zonaseleccionada as $key => $value) {
            $html.='<option value="'.$value['id_comuna'].'">'.$value['descripcion'].'</option>';
          }
    $html.='</select>';
  }

    $tecnicozona=$this->db->query_select("select id_tecnicos,nombre from tbltecnicos where zona='$zona'");
    if($tecnicozona===false){
      $html2="<label for='cmbtecnicos'>Tecnico</label>
            <select class='form-control' id='cmbtecnicos' name='cmbtecnicos'>
            <option value='0'>--</option>
            </select>";

      return array('success' => 1, 'html2' => $html2);
    }else {
      $html2="<label for='cmbtecnicos'>Tecnico</label>
            <select class='form-control' id='cmbtecnicos' name='cmbtecnicos' onchange='cargaeps();'>
            <option value='0'>--</option>";
            foreach ($tecnicozona as $key => $value2) {
              $html2.='<option value="'.$value2['id_tecnicos'].'">'.$value2['nombre'].'</option>';
            }
      $html2.='</select>';

        $html3="<label>EPS</label><input type='text' name='txteps' id='txteps' class='form-control' value=''>";
    }
      return array('success' => 1, 'html' => $html, 'html2' => $html2, 'html3' => $html3 );
}

public function editarfiltrarcomunas(){
  global $http;

  $zona=$http->request->get('editarzona');


  $zonaseleccionada=$this->db->query_select("select id_comuna,descripcion from tblcomuna where zona='$zona'");
  if($zonaseleccionada===false){
    $html="<label for='cmbeditarcomunas'>Comuna</label>
          <select class='form-control' id='cmbeditarcomunas' name='cmbeditarcomunas'>
          <option value='0'>--</option>
          </select>";

    $html2="<label for='cmbeditartecnico'>Tecnico</label>
                <select class='form-control' id='cmbeditartecnico' name='cmbeditartecnico'>
                <option value='0'>--</option>
                </select>";

    $html3="<label>EPS</label><input type='text' name='txteditareps' id='txteditareps' class='form-control' value=''>";

    return array('success' => 1, 'html' => $html, 'html2' => $html2, 'html3' => $html3 );

  }else{
  $html="<label for='cmbeditarcomunas'>Comuna</label>
        <select class='form-control' id='cmbeditarcomunas' name='cmbeditarcomunas'>
        <option value='0'>--</option>";
        foreach ($zonaseleccionada as $key => $value) {
          $html.='<option value="'.$value['id_comuna'].'">'.$value['descripcion'].'</option>';
        }
  $html.='</select>';
}

  $tecnicozona=$this->db->query_select("select id_tecnicos,nombre from tbltecnicos where zona='$zona'");
  if($tecnicozona===false){
    $html2="<label for='cmbeditartecnico'>Tecnico</label>
          <select class='form-control' id='cmbtecmbeditartecnicocnicos' name='cmbeditartecnico'>
          <option value='0'>--</option>
          </select>";

    return array('success' => 1, 'html2' => $html2);
  }else {
    $html2="<label for='cmbeditartecnico'>Tecnico</label>
          <select class='form-control' id='cmbeditartecnico' name='cmbeditartecnico' onchange='cargaeditareps();'>
          <option value='0'>--</option>";
          foreach ($tecnicozona as $key => $value2) {
            $html2.='<option value="'.$value2['id_tecnicos'].'">'.$value2['nombre'].'</option>';
          }
    $html2.='</select>';

    $html3="<label>EPS</label><input type='text' name='txteditareps' id='txteditareps' class='form-control' value=''>";

  }
    return array('success' => 1, 'html' => $html, 'html2' => $html2, 'html3' => $html3);
}


public function carga_eps(){
  global $http;

  $tecnico=$http->request->get("tecnico");

  $cargaeps=$this->db->query_select("select codigo_eps from tbltecnicos where id_tecnicos='$tecnico'");
  $dato=$cargaeps[0][0];
  if ($cargaeps===false){
    $html="<label>EPS</label><input type='text' name='txteps' id='txteps' class='form-control' value=''>";
    return array('success' => 1, 'html' => $html);

  }else {
      $html="<label>EPS</label><input type='text' name='txteps' id='txteps' class='form-control' value='$dato'>";
      return array('success' => 1, 'html' => $html);
  }
}

public function editarcargaeps(){
  global $http;

  $tecnico=$http->request->get("editartecnico");

  $cargaeps=$this->db->query_select("select codigo_eps from tbltecnicos where id_tecnicos='$tecnico'");
  $dato=$cargaeps[0][0];
  if ($cargaeps===false){
    $html="<label>EPS</label><input type='text' name='txteditareps' id='txteditareps' class='form-control' value=''>";
    return array('success' => 1, 'html' => $html);

  }else {
      $html="<label>EPS</label><input type='text' name='txteditareps' id='txteditareps' class='form-control' value='$dato'>";
      return array('success' => 1, 'html' => $html);
  }
}




public function guardarorden(){
  global $http;
  $rut=$http->request->get('txtrut');
  $nombrecliente=$http->request->get('txtcliente');
  $direccion=$http->request->get('txtdireccion');
  $telefono=$http->request->get('txttelefono');
  $numactividad=$http->request->get('txtnum');
  $idorden=$http->request->get('txtid');
  $zona=$http->request->get('cmbzona');
  $comuna=$http->request->get('cmbcomunas');
  $tipoactividad=$http->request->get('cmbactividad');
  $franja=$http->request->get('cmbfranja');
  $fecha=$http->request->get('txtfecha');
  $estado=$http->request->get('cmbestado');
  $observacion=$http->request->get('txtobservacion');
  $tecnico=$http->request->get('cmbtecnicos');
  $eps=$http->request->get('txteps');


  if ($this->functions->e($rut,$nombrecliente,$direccion,$telefono,$numactividad,$idorden,$fecha,$observacion)) {
     return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }

  if ($zona=='--'){
    return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }else{

  }
  if ($comuna=='--'){
    return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }else{

  }
  if ($tipoactividad=='--'){
    return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }else{

  }
  if ($franja=='--'){
    return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }else{

  }
  if ($tipoactividad=='--'){
    return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }else{

  }
  $this->db->insert('tblordenes_andes', array(
    'rut_cliente'=>$rut,
    'nombre_cliente'=>$nombrecliente,
    'telefono'=>$telefono,
    'direccion'=>$direccion,
    'comuna'=>$comuna,
    'zona'=>$zona,
    'tipo_actividad'=>$tipoactividad,
    'franja'=>$franja,
    'fecha'=>$fecha,
    'numero_orden'=>$numactividad,
    'id_actividad'=>$idorden,
    'estado'=>$estado,
    'observacion'=>$observacion,
    'tecnico'=>$tecnico,
    'eps'=>$eps
  ));

  return array('success' => 1, 'message' => "Datos Ingresados correctamente");
}

public function modificarorden(){
  global $http;
  $id=$http->request->get('textid');
  $rut=$http->request->get('txteditarrut');
  $nombrecliente=$http->request->get('txteditarcliente');
  $direccion=$http->request->get('txteditardireccion');
  $telefono=$http->request->get('txteditartelefono');
  $numactividad=$http->request->get('txteditarnum');
  $idorden=$http->request->get('txteditarid');
  $zona=$http->request->get('cmbeditarzona');
  $tipoactividad=$http->request->get('cmbaeditarctividad');
  $franja=$http->request->get('cmbeditarfranja');
  $fecha=$http->request->get('txteditarfecha');
  $estado=$http->request->get('cmbeditarestado');
  $observacion=$http->request->get('txteditarobservacion');
  $tecnico=$http->request->get('cmbeditartecnico');
  $eps=$http->request->get('txteditareps');
  $comuna=$http->request->get('cmbcomunas');
  if ($this->functions->e($rut,$nombrecliente,$direccion,$telefono,$numactividad,$idorden,$fecha,$observacion)) {
     return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }

  $this->db->update('tblordenes_andes', array(
    'rut_cliente'=>$rut,
    'nombre_cliente'=>$nombrecliente,
    'telefono'=>$telefono,
    'direccion'=>$direccion,
    'zona'=>$zona,
    'tipo_actividad'=>$tipoactividad,
    'franja'=>$franja,
    'fecha'=>$fecha,
    'numero_orden'=>$numactividad,
    'id_actividad'=>$idorden,
    'estado'=>$estado,
    'observacion'=>$observacion,
    'tecnico'=>$tecnico,
    'eps'=>$eps
  ),"id_orden='$id'");

  return array('success' => 1, 'message' => "Datos Modificados correctamente");
}

public function get_orden_byId(int $id){
    return $this->db->query_select("select tblordenes_andes.*, tblcomuna.descripcion,(select nombre from tbltecnicos tbltec inner join tblordenes_andes tbla on tbltec.id_tecnicos=tbla.tecnico where tbla.tecnico=tblordenes_andes.tecnico) as tecnombre, (select eps from tbltecnicos tbltec inner join tblordenes_andes tbla on tbltec.id_tecnicos=tbla.tecnico where tbla.tecnico=tblordenes_andes.tecnico) as teceps from tblordenes_andes inner join tblcomuna on tblordenes_andes.comuna=tblcomuna.id_comuna where id_orden ='$id' limit 1");
}

public function carga_zona($id){
  return $this->db->query_select("select zona from tblordenes_andes where id_orden='$id'");
}
public function carga_comuna_zona($zona){
    return $this->db->query_select("select id_comuna, descripcion from tblcomuna where zona='$zona'");
}

public function cambiarestado(){
global $http;

$id=$http->request->get('id');

$orden=$this->db->query_select("select tblordenes_andes.id_orden, tblcomuna.descripcion,(select nombre from tbltecnicos tbltec inner join tblordenes_andes tbla on tbltec.id_tecnicos=tbla.tecnico where tbla.tecnico=tblordenes_andes.tecnico) as tecnombre,tblordenes_andes.rut_cliente,tblordenes_andes.nombre_cliente,tblordenes_andes.telefono,tblordenes_andes.direccion,tblordenes_andes.comuna,tblordenes_andes.zona,case tblordenes_andes.tipo_actividad when 0 then '--' when 1 then 'Alta' when 2 then 'Reparacion' when 3 then 'Modificacion' end as tipo_actividad,case tblordenes_andes.franja when 0 then '--' when 1 then '09-13' when 2 then '13-16' when 3 then '16-19' when 4 then '19-21' end as franja,tblordenes_andes.fecha, tblordenes_andes.numero_orden, tblordenes_andes.id_actividad,case tblordenes_andes.estado when 0 then 'Pendiente' when 1 then 'Iniciado' when 2 then 'Completado' when 3 then 'Derivado' when 4 then 'Cancelada' end as estado, tblordenes_andes.observacion, tblordenes_andes.tecnico, tblordenes_andes.eps from tblordenes_andes inner join tblcomuna on tblordenes_andes.comuna=tblcomuna.id_comuna where tblordenes_andes.id_orden='$id'");

$html="<div class='col-md-12'>
      <form id='formconfirm' name='formconfirm'>
      <input id='textid' type='text' name='textid' value=".$orden[0][0].">
      <table id='tblandes' name='tblandes' class='table table-bordered table-responsive'>
      <thead>
          <tr>

              <th>NOMBRE_CLIENTE</th>
              <th>TELEFONO</th>
              <th>DIRECCION_CLIENTE</th>
              <th>COMUNA</th>
              <th>ZONA</th>
              <th>TIPO_ACTIVIDAD</th>
              <th>FRANJA</th>
              <th>FECHA</th>
              <th>ORDEN_DE_SERVICIO</th>
              <th>ID_ACTIVIDAD</th>
              <th>ESTADO_ORDEN</th>
              <th>NOMBRE_TECNICO</th>

          </tr>
      </thead>
      <tbody>";
      foreach ($orden as $key => $value) {
      $html.="<tr>
                <td>".$value['rut_cliente']."</td>
                <td>".$value['telefono']."</td>
                <td>".$value['direccion']."</td>
                <td>".$value['descripcion']."</td>
                <td>".$value['zona']."</td>
                  <td>".$value['tipo_actividad']."</td>
                <td>".$value['franja']."</td>
                <td>".$value['fecha']."</td>
                <td>".$value['numero_orden']."</td>
                <td>".$value['id_actividad']."</td>
                <td>";
                if($value['estado']=='Pendiente'){
                $html.="<select id='cmbestado' name='cmbestado' class='form-control'>
                    <option value='0'>Pendiente</option>
                    <option value='1'>Iniciado</option>
                    <option value='2'>Completado</option>
                    <option value='3'>Derivado</option>
                    <option value='4'>Cancelada</option>
                    </select>";
                  }
                elseif($value['estado']=='Iniciado'){
                $html.="<select id='cmbestado' name='cmbestado' class='form-control'>
                    <option value='1'>Iniciado</option>
                    <option value='0'>Pendiente</option>
                    <option value='2'>Completado</option>
                    <option value='3'>Derivado</option>
                    <option value='4'>Cancelada</option>
                    </select>";
                  }

                  elseif($value['estado']=='Completado'){
                $html.="<select id='cmbestado' name='cmbestado' class='form-control'>
                    <option value='2'>Completado</option>
                    <option value='0'>Pendiente</option>
                    <option value='1'>Iniciado</option>
                    <option value='3'>Derivado</option>
                    <option value='4'>Cancelada</option>
                    </select>";
                }
                elseif($value['estado']=='Derivada'){
                $html.="<select id='cmbestado' name='cmbestado' class='form-control'>
                    <option value='3'>Derivado</option>
                    <option value='0'>Pendiente</option>
                    <option value='1'>Iniciado</option>
                    <option value='2'>Completado</option>
                    <option value='4'>Cancelada</option>
                    </select>";
                }
                elseif($value['estado']=='Cancelada'){
                $html.="<select id='cmbestado' name='cmbestado' class='form-control'>
                    <option value='4'>Cancelada</option>
                    <option value='0'>Pendiente</option>
                    <option value='1'>Iniciado</option>
                    <option value='2'>Completado</option>
                     <option value='3'>Derivado</option>
                     </select>";
                }
                $html.="</td>
                <td>";
                if($value['tecnico']==false){
                  $zona=$value['zona'];
                  $tecnicozona=$this->db->query_select("select id_tecnicos,nombre from tbltecnicos where zona='$zona'");
                  $html.="<select id='cmbtecnicos' name='cmbtecnicos' class='form-control'>";
                  foreach ($tecnicozona as $key => $value2) {
                  $html.="<option value=".$value2['id_tecnicos'].">".$value2['nombre']."</option>";
                  }
                }else{
                  $zona=$value['zona'];
                  $tecnicozona=$this->db->query_select("select id_tecnicos,nombre from tbltecnicos where zona='$zona'");
                  $html.="<select id='cmbtecnicos' name='cmbtecnicos' class='form-control'>";
                  $html.="<option value=".$value['tecnico'].">".$value['tecnombre']."</option>";
                  foreach ($tecnicozona as $key => $value2) {
                    if($value['tecnico']==$value2['id_tecnicos']){
                    }else{
                  $html.="<option value=".$value2['id_tecnicos'].">".$value2['nombre']."</option>";
                }
                  }
                }
                $html.="</select>";
}
        $html.="</td>
        </tr>
      </tbody>
  </table>
  </form>
      </div>";

      return array('success' => 1, 'html' => $html);

}

public function cargar_ordenes_excel(){
      global $http;

      $file = $http->files->get('excel');

      $docname="";
      if (null !== $file ){
          $ext_doc = $file->getClientOriginalExtension();

          if ($ext_doc<>'xls' and $ext_doc<>'xlsx') return array('success' => 0, 'message' => "Debe seleccionar un archivo valido...");

          $docname = 'test1.'.$ext_doc;

          $file->move(API_INTERFACE . 'views/app/temp/', $docname);

          $archivo = API_INTERFACE . 'views/app/temp/'. $docname;
          //carga del excelname
          $objReader = new PHPExcel_Reader_Excel2007();
          $objPHPExcel = $objReader->load($archivo);

          $i=2;
          $param=0;
          $id_orden="";
          $cont=0;
          $this->db->Update('tblordenes_andes', array('numero_orden' => '0'),"1=1");
          while($param==0){
              try {
                 if ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue()!=NULL)
                 {
                     $id_actividad = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue();
                     $tipoactividad=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
                     $franja= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getvalue();
                     $nombre_cliente= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getvalue();
                     $direccion= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getvalue();
                     $ciudad= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getvalue();
                     $rut_cliente= $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getvalue();
                     $telefono= $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getvalue();
                     $fecha= $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getvalue();
                     $numero_orden= $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getvalue();
                     $estado= $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getvalue();
                     $territorio= $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getvalue();
                     $comuna= $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getvalue();
                     $fecha_carga = strtoupper($fecha);

                     if($franja=='--'){
                       $franja='0';
                     }elseif($franja=='09-13'){
                       $franja='1';
                     }elseif($franja=='13-16'){
                       $franja='2';
                     }elseif($franja=='16-19'){
                       $franja='3';
                     }elseif($franja=='19-21'){
                       $franja='4';
                     }else{
                       $franja='Mal ingresado';
                     }

                     if($estado=='--'){
                       $tipoactividad='0';
                     }elseif($tipoactividad=='Alta'){
                       $tipoactividad='1';
                     }elseif($tipoactividad=='Reparación'){
                       $tipoactividad='2';
                     }elseif($tipoactividad=='Modificación de Servicio'){
                       $tipoactividad='3';
                     }else{
                       $tipoactividad='Mal ingresado';
                     }

                     if($estado=='Pendiente'){
                       $estado='0';
                     }elseif($estado=='Iniciado'){
                       $estado='1';
                     }elseif($estado=='Completado'){
                       $estado='2';
                     }elseif($estado=='Derivado'){
                       $estado='3';
                     }elseif($estado=='Cancelado'){
                       $estado='4';
                     }else{
                       $estado='Mal ingresado';
                     }

          $registrocomunas= $this->db->query_select("Select id_comuna from tblcomuna Where descripcion='$comuna'");
          $comuna=$registrocomunas[0][0];

           $result= $this->db->query_select("Select id_orden from tblordenes_andes Where id_actividad='$id_actividad'");
                     if (false == $result){
                         $this->db->Insert('tblordenes_andes', array(
                            'rut_cliente'=>$rut_cliente,
                            'nombre_cliente'=>$nombre_cliente,
                            'telefono'=>$telefono,
                            'direccion'=>$direccion,
                            'comuna'=>$comuna,
                            'zona'=>$territorio,
                            'tipo_actividad'=>$tipoactividad,
                            'franja'=>$franja,
                            'fecha'=>$fecha_carga,
                            'numero_orden'=>$numero_orden,
                            'id_actividad'=>$id_actividad,
                            'estado'=>$estado
                         ));
                     }else{
                         $this->db->Update('tblordenes_andes', array(
                           'rut_cliente'=>$rut_cliente,
                           'nombre_cliente'=>$nombre_cliente,
                           'telefono'=>$telefono,
                           'direccion'=>$direccion,
                           'comuna'=>$comuna,
                           'zona'=>$territorio,
                           'tipo_actividad'=>$tipoactividad,
                           'franja'=>$franja,
                           'fecha'=>$fecha,
                           'numero_orden'=>$numero_orden,
                           'id_actividad'=>$id_actividad,
                           'estado'=>$estado
                        ),"id_actividad ='$id_actividad'");
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

//Tecnicos----------------------------------------------------------------------------------------------------------
public function guardartecnico(){
  global $http;

  $rut_tecnico=$http->request->get('');
  $nombre_tecnico=$http->request->get('');
  $telefono_tecnico=$http->request->get('');
  $zona_tecnico=$http->request->get('');
  $eps_tecnico=$http->request->get('');


  if ($this->functions->e($rut_tecnico,$nombre_tecnico,$telefono_tecnico)) {
     return array('success' => 0, 'message' => 'Debe ingresar o seleccionar todas las opciones');
  }
  if($zona_tecnico=='--'){
     return array('success' => 0, 'message' => 'Debe seleccionar la zona');
  }
  if($eps_tecnico=='--'){
       return array('success' => 0, 'message' => 'Debe seleccionar una EPS');
  }

  $this->db->Insert('tbltecnicos', array(
     'rut'=>$rut_cliente,
     'nombre'=>$nombre_cliente,
     'telefono'=>$telefono,
     'zona'=>$direccion,
     'codigo_eps'=>$comuna,
  ));

  return array('success' => 1, 'message' => 'Datos registrados correctamente');
}

public function carga_tecnicos($zona){
  return $this->db->query_select("select id_tecnicos,nombre from tbltecnicos where zona='$zona'");
}
public function listar_tecnicos(){
  return $this->db->query_select("select * from tbltecnicos order by zona desc");
}
public function actualiza_datos(){
  global $http;

  $id=$http->request->get('textid');
  $estado=$http->request->get('cmbestado');
  $tecnico=$http->request->get('cmbtecnicos');

  $this->db->update('tblordenes_andes', array(
    'estado'=>$estado,
    'tecnico'=>$tecnico
  ),"id_orden='$id'");

  return array('success' => 1, 'message' => "Datos Modificados correctamente");


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
