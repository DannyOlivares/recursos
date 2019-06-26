<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Helpers\Files;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Style_NumberFormat;
use mPDF;
/**
 * Modelo Avar
 *
 * @author Jorge Jara H. <jjara@wys.cl>
 */

class Avar extends Models implements IModels {

    // Contenido del modelo...
    use DBModel;
    protected $user = array();

    /**
      * Devuelve un arreglo para la api
      *
      * @return array
    */
    public function cargar_excel(){
        global $http;

        $file = $http->files->get('excel');

        $docname="";
        if (null !== $file ){
            $ext_doc = strtolower($file->getClientOriginalExtension());

            if ($ext_doc<>'xlsx') return array('success' => 0, 'message' => "Debe seleccionar un archivo XLSX valido...");

            $docname = 'cargaturno.'.$ext_doc;

            $file->move(API_INTERFACE . 'views/app/temp/', $docname);

            $archivo = API_INTERFACE . 'views/app/temp/'. $docname;
            //carga del excelname
            $objReader = new PHPExcel_Reader_Excel2007();
            $objPHPExcel = $objReader->load($archivo);

            $i=2;
            $param=0;
            $celdablanco = 0;
            $this->db->query_select('truncate tbl_pendiente_blindaje_temp');

            $count=0;$max_insert=50;$sql_value="";
            $sql_insert="Insert into tbl_pendiente_blindaje_temp values";
            while($param==0){
                try {
                    if ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue()!=NULL){

                        if ($count!=0){$sql_value.=",";}

                        $RUT = substr($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue(),0,12);
                        $DESC_ACTIV = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getvalue();
                        $LOCALIDAD = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getvalue();
                        $NMRO_ORDEN = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getvalue();

                        $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
                        $ano=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getFormattedValue();
                        $krr = explode('-',$ano);
                        $FECHA_COMPROMISO = implode("",$krr);

                        $CODI_HORARIO = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getvalue();
                        $CONTEXTO = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getvalue();
                        $ESTD_ACTIV = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getvalue();
                        $DESC_AREAFUN = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getvalue();

                        $objPHPExcel->getActiveSheet()->getStyle('AD'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
                        $ano=$objPHPExcel->getActiveSheet()->getCell('AD'.$i)->getFormattedValue();
                        $krr = explode('-',$ano);
                        $FECHA_OT = implode("",$krr);

                        $COMUNA = $objPHPExcel->getActiveSheet()->getCell('AI'.$i)->getvalue();

                        $ACTIVIDAD = $objPHPExcel->getActiveSheet()->getCell('AL'.$i)->getvalue();

                        $NODO = $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getvalue();
                        $SUBNODO = $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getvalue();

                        $TIPO = $objPHPExcel->getActiveSheet()->getCell('AV'.$i)->getvalue();

                        $count++;
                        $sql="Select Fecha_Compromiso,Codi_Horario from tbl_pendiente_blindaje where NMRO_ORDEN='$NMRO_ORDEN'";
                        $result= $this->db->query_select($sql);
                        $REAGENDA='N';
                        if (false != $result ){
                            $fecha = explode('-',$result['Fecha_Compromiso']);
    					    $fecha = implode("",$fecha);
                            if ($fecha != $FECHA_COMPROMISO || $r_orden->Codi_Horario != $CODI_HORARIO ){
                                $REAGENDA='Fecha Anterior: '.$result['Fecha_Compromiso'].' - Bloque: '.$result['Codi_Horario'].'  A  Fecha Nueva: '.$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getFormattedValue().' - Bloque: '.$CODI_HORARIO;
                            }else{
                                $REAGENDA='N';
                            }
                        }

                        $sql_value=$sql_value."('$RUT','$DESC_ACTIV','$LOCALIDAD','$NMRO_ORDEN',$FECHA_COMPROMISO,'$CODI_HORARIO','$CONTEXTO','$ESTD_ACTIV','$DESC_AREAFUN',$FECHA_OT,'$COMUNA','$ACTIVIDAD','Nivel 1','$NODO','$SUBNODO','N','$TIPO','$REAGENDA')";
                        if ($max_insert==$count)
                        {
                            $this->db->query_select($sql_insert.$sql_value);

                            $count=0;$sql_value="";
                        }

                        $celdablanco = 0;
                    }else {
                        $celdablanco++;
                    }
                    if ($celdablanco == 5) {
                        $param=1;
                    }
                    $i++;
                } catch (\Exception $e) {
                    if (Files::delete_file(API_INTERFACE . 'views/app/temp/'.$docname)){
                        return array('success' => 0, 'message' => $e->getMessage() );
                    }
                }
            }
            $result = $this->db->query_select("select count(rut) cuenta from tbl_pendiente_blindaje_temp");
            if (false != $result){

                if ( $result[0]['cuenta'] > '0' ){
                    //guardo en registro de carga de archivos
                    $this->db->Insert('tbl_historialarchivoscargados', array(
                        'app'=>'Carga de Blindaje',
                        'nombre_archivo'=> $file->getClientOriginalName(),
                        'id_user' => $this->user['id_user'],
                        'q_registros' => $result[0]['cuenta']
                    ));

                    // //actualizo nuevas fechas de compromiso, bloque horario y estado flujo => ademas de la ubicacion y ejecutivo para ordenes reagendadas
                    $this->db->query_select("update tbl_pendiente_blindaje pb inner join tbl_pendiente_blindaje_temp pbt on pb.NMRO_ORDEN=pbt.NMRO_ORDEN Set pb.FECHA_COMPROMISO=pbt.FECHA_COMPROMISO,pb.ESTD_ACTIV=pbt.ESTD_ACTIV,pb.CODI_HORARIO=pbt.CODI_HORARIO ");
                    $this->db->query_select("Insert into tbl_blindaje_hist_gestion_hd(ID_ORDEN,NMRO_ORDEN,FECHA,GESTION_HD,ACCION,OBSERVACION,IDUSUARIO,HORA) Select 0,NMRO_ORDEN,DATE(now()) Fecha,'S/GESTION','REAGENDAMIENTO',REAGENDA,'".$this->user['id_user']."',time(now()) from tbl_pendiente_blindaje_temp Where REAGENDA<>'N'");
                    $this->db->query_select("update tbl_pendiente_blindaje Set Ubicacion='Nivel 10',Ejecutivo='' where FINAL<>'FINALIZADA' and fecha_compromiso>date(now()) and (ubicacion='Nivel 1' or Ubicacion='Nivel 2')");
                    $this->db->query_select("update tbl_pendiente_blindaje Set Ubicacion='Nivel 10',Ejecutivo='' where FINAL<>'FINALIZADA' and fecha_compromiso>=date(now()) and (Ubicacion='Nivel 2')");
                    $this->db->query_select("update tbl_pendiente_blindaje Set Ubicacion='Nivel 1',Ejecutivo='' where FINAL<>'FINALIZADA' and fecha_compromiso=date(now()) and ubicacion='Nivel 10'");

                    //Actualizo Nivel a ordenes cargadas para equipo elite
                    $nuevafecha = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;
                    $fecha_48 = date ( 'Ymd' , $nuevafecha );
                    $this->db->query_select("Update tbl_pendiente_blindaje_temp Set ubicacion='Nivel 2' where TIPO='NORMAL' AND Fecha_Compromiso<$fecha_48");

                    //envio todas las ordenes que tengan mayor cantidad de en nodo y sub nodo a redes
                    $res1 = $this->db->query_select("Select comuna,nodo,subnodo,count(*) q from tbl_pendiente_blindaje_temp where Actividad='Servicio Tecnico'  group by comuna,nodo,subnodo Order by q Desc");
                    $count=0;
                    foreach ($res1 as $r => $value){
                        if ($value['q'] >= 3){
                            $sql_2 ="Update tbl_pendiente_blindaje_temp Set marca='R' Where Actividad='Servicio Tecnico' And comuna='".$value['comuna']."' and nodo='".$value['nodo']."' and subnodo='".$value['subnodo']."' ";
                            $this->db->query_select($sql_2);
                        }else{
                            $count++;
                        }
                        if ($count >5) break;
                    }

                    //Actualizo Nivel a ordenes cargadas para futuro
                    $this->db->query_select("Update tbl_pendiente_blindaje_temp Set ubicacion='Nivel 10' where Fecha_Compromiso>date(now())");

                    //CAMBIO DE EQUIPOS PROACTIVOS
                    $this->db->query_select("Update tbl_pendiente_blindaje_temp Set ubicacion='Nivel 4',marca='N' where TIPO='PROACTIVA'");


                    //finalizo estado flujo para ordenes que no estan en nuevo archivo y sean menor a la fecha de hoy
                    $this->db->query_select("Update tbl_pendiente_blindaje Set ESTD_ACTIV='F1'  where FECHA_COMPROMISO<=date(now()) And NMRO_ORDEN not in (Select NMRO_ORDEN from tbl_pendiente_blindaje_temp)");
                    $this->db->query_select("Update tbl_pendiente_blindaje Set ESTD_ACTIV='F1'  where Ubicacion='Nivel 4' And NMRO_ORDEN not in (Select NMRO_ORDEN from tbl_pendiente_blindaje_temp)");

                    //borro todas las ordenes del archivo que ya tenemos cargadas
                    $this->db->query_select("Delete from tbl_pendiente_blindaje_temp where NMRO_ORDEN in (Select NMRO_ORDEN from tbl_pendiente_blindaje) ");

                    if (Files::delete_file(API_INTERFACE . 'views/app/temp/'.$docname)){
                        return array('success' => 1, 'message' => $result[0]['cuenta']." Registros validos cargados Exitosamente..." );
                    }

                }else{
                    if (Files::delete_file(API_INTERFACE . 'views/app/temp/'.$docname)){
                        return array('success' => 0, 'message' => 'No se ha cargado ningun registro, es posible que ya se encuentren en la base de datos...');
                    }
                }
            }



            //
            // $i=$i-2;
            //
            // if (Files::delete_file(API_INTERFACE . 'views/app/temp/'.$docname)){
            // return array('success' => 1, 'message' => "Datos cargados Exitosamente..." );
            // }
            //
            // }
        }else{
            return array('success' => 0, 'message' => "Debe seleccionar un archivo XLSX valido...");
        }
    }


    public function verComunasAvar(string $select = '*'){
        return $this->db->select($select,'tblcomuna','avar =1');
    }
    public function verBloque(string $select = '*'){
        return $this->db->select($select,'tblbloque');
    }
    public function getEjecutivosxServicio($servicio,$bloque,$nivel){
        return $this->db->query_select("SELECT u.name,u.id_user,t.hora_ingreso,t.hora_salida,e.id_user checked,(select count(*) from tbl_pendiente_blindaje pb where pb.ejecutivo=u.id_user and ubicacion='".$nivel."' and codi_horario='".$bloque."' and FINAL<>'FINALIZADA') q_ordenes FROM (users u inner join tblturnos t on t.rut=u.rut_personal) left join tblejecutivosdistribucion e on u.id_user=e.id_user and e.nivel='".$nivel."' and bloque='".$bloque."' Where rol<>1 And t.fecha=date(now()) and upper(servicio)='$servicio' And u.estado=1 order by hora_ingreso,name");
    }
    public function avar_reactivos(){
        try {
            global $http;
            $bloque = $http->request->get('bloque');

            $avarReac= $this->getEjecutivosxServicio('BLINDAJE',$bloque,'Nivel 1');
            $tabla = '<table class="table table-bordered table-striped" id="tblN1">'.
                        '<thead>'.
                            '<tr>'.
                                '<th>Ejecutivos</th>'.
                                '<th>Turno</th>'.
                                '<th>Asignadas</th>
                                <th></th>
                            </tr>'.
                        '</thead>
                        <tbody>';
                        if(false != $avarReac){
                            foreach ($avarReac as $a => $value) {
                                $tabla.='<tr>
                                            <td><label>
                                            <input type="checkbox" id="check-'.$value['id_user'].'" onchange=\'des_marcar_ejecutivo("'.$value['id_user'].'","Nivel 1","'.$bloque.'");\' ';
                                            if($value['checked'] != ""){
                                                $tabla.=' checked ';
                                            }
                                    $tabla.='>&nbsp;'.$value['name'].'</label></td>
                                            <td><label>'.$value['hora_ingreso'].' | '.$value['hora_salida'].'</label></td>
                                            <td><div id="div-'.$value['id_user'].'">'.$value['q_ordenes'].'</div></td>
                                            <td>';
                                            if($value['q_ordenes'] > 0){
                                            $tabla.='
                                                    <a class="btn btn-warning btn-social" title="Quitar Ordenes" data-toggle="tooltip" onclick="quitar_Ordenes_ejecutivos('.$value['id_user'].');">
                                                    <i class="fa fa-angle-double-right"></i>
                                                    Quitar Ordenes
                                                    </a>
                                                ';
                                            }
                                $tabla.='</td>
                                        </tr>';
                            }
                        }
               $tabla.= '</tbody>
                    <table>';

            $tabla_pendiente='<table class="table table-bordered">
                                <thead>
                                    <th>Origen</th>
                                    <th>Cantidad</th>
                                    <th>Operacion</th>
                                </thead>
                                <tbody>';
                                //Ordenes pendientes archivo AYER
                                $nuevafecha = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;
                                $fecha_24 = date ( 'Ymd' , $nuevafecha );
                                $sql="select count(*) q from tbl_pendiente_blindaje_temp where  fecha_compromiso='$fecha_24' and codi_Horario='$bloque' and ubicacion='Nivel 1'";
                                $result = $this->db->query_select($sql);
                $tabla_pendiente.='<tr>
                                    <td>Archivo Temporal --> AYER</td>
                                    <td>'.$result[0]['q'].'</td>
                                    <td>';
                                    if($result[0]['q'] > 0 ){
                                        $tabla_pendiente.='
                                        <a class="btn btn-success btn-social" title="Archivo Cargado Temporal" data-toggle="tooltip" onclick=\"Distribuir_Ordenes("TMP")\">
                                            <i class="fa fa-angle-double-left"></i>
                                            Distribuir
                                        </a>
                                        <a class="btn btn-success btn-social" title="Movel a Nivel 2" data-toggle="tooltip" onclick=\"Distribuir_Ordenes("TMP")\">
                                            <i class="fa fa-angle-double-right"></i>
                                            Movel a Nivel 2
                                        </a>
                                        ';
                                    }
                $tabla_pendiente.='</td>
                                </tr>';

                                //Ordenes pendientes archivo HOY
                                $sql="select count(*) q from tbl_pendiente_blindaje_temp where  fecha_compromiso=date(now()) and codi_Horario='$bloque' and ubicacion='Nivel 1'";
                                $result = $this->db->query_select($sql);
                $tabla_pendiente.='<tr>
                                    <td>Archivo Temporal --> HOY</td>
                                    <td>'.$result[0]['q'].'</td>
                                    <td>';
                                    if($result[0]['q'] > 0 ){
                                        $tabla_pendiente.='
                                        <a class="btn btn-success btn-social" title="Archivo Cargado Temporal" data-toggle="tooltip" onclick=\"Distribuir_Ordenes("TMP")\">
                                            <i class="fa fa-angle-double-left"></i>
                                            Distribuir
                                        </a>
                                        ';
                                    }
                $tabla_pendiente.='</td>
                                </tr>';

            $tabla_pendiente.='</tbody>
                            </table>';

            return array('success' => 1,'tabla' => $tabla, 'tabla_pendiente' => $tabla_pendiente);
        } catch(ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
    }



    public function seleccionar(){
      global $http;
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
      $tipo=$http->request->get('tipo');
      $opcion=$http->request->get('opcion');
      $this->db->query_select("delete from tbldetalleviatico_temporal where user_registra='$datousuario'");

      $usuarios=$this->db->query_select("select * from tblpersonal where area_personal='$tipo' and estado='1'");
      if ($usuarios!=false){
      $html="
      <div class='box'>
        <div id='divtable' name='divtable'>
        <table id='tblusuarios' name='tblusuarios' class='table table-bordered table-responsive'>
        <thead>
            <tr>
                <th>SELECCIONAR</th>
                <th>RUT</th>
                <th>NOMRE</th>
                <th>CARGO</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($usuarios as $key => $value) {
        $html.="<tr>
                  <td><input type='checkbox' id='check".$value['cod_personal']."' name='check".$value['cod_personal']."' onclick='sumar(".$value['cod_personal'].")'></td>
                  <td>".$value['rut_personal']."</td>
                  <td>".$value['nombre_personal']."</td>
                  <td>".$value['cargo_personal']."</td>
                </tr>";
              }
        $html.="</tbody>
        </table>
        </div>";
        if($opcion==1){
          $html.="<button type='button' class='btn btn-default' onclick='aceptarusuarios()' data-dismiss='modal'>ACEPTAR</button>";
        }elseif($opcion==2){
          $html.="<button type='button' class='btn btn-default' onclick='aceptarusuariostransporte()' data-dismiss='modal'>ACEPTAR</button>";
        }else{
          $html.="<button type='button' class='btn btn-default' onclick='aceptarusuarioshospedaje()' data-dismiss='modal'>ACEPTAR</button>";
        }
        $html.="<input type='hidden' id='contador' name='contador' value='0'>
          <div class='col-md-6'>
          </div>
        </div>";


        return array('success' => '1','html' => $html);
      }else{
        return array('success'=>0,'message'=>'No existe personal asociado al Area');
      }
      }
    public function mostrar_personal(){
     $datusu=$this->user;
     $datousuario=$datusu['id_user'];
     $personal=$this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico_temporal.id_user, tblpersonal.cargo_personal from tbldetalleviatico_temporal inner join tblpersonal on tbldetalleviatico_temporal.id_user=tblpersonal.cod_personal where user_registra='$datousuario' ");
     $html="
     <div class='box'>
       <table id='tblpersonal' name='tblpersonal' class='table table-bordered table-responsive'>
       <thead>
           <tr>
               <th>RUT</th>
               <th>NOMRE</th>
               <th>CARGO</th>
           </tr>
       </thead>
       <tbody>";
       if($personal!=false){
       foreach ($personal as $key => $value) {
       $html.="<tr>
                 <td>".$value['rut_personal']."</td>
                 <td>".$value['nombre_personal']."</td>
                 <td>".$value['cargo_personal']."</td>
               </tr>";
             }
           }
       $html.="</tbody>
       </table>
       <div class='col-md-6'>
       </div>
       </div>";


       return array('success' => '1','html' => $html);
    }

    public function opciones_transporte(){

     $html="<div class='col-md-12'>
            <br>
             TRANSPORTE
            </div>
            <div class='col-md-4'>
               <br>
               <label><input type='radio' name='rbtransporte' id='rbtransportevuelo' onchange=\"selectransporte('1')\">VUELO</label>
            </div>
            <div class='col-md-4'>
               <br>
               <label><input type='radio' name='rbtransporte' id='rbtransportebus' onchange=\"selectransporte('2')\">BUS</label>
             </div>
             <div class='col-md-4'>
                   <br>
                <label><input type='radio' name='rbtransporte' id='rbtransportemovil' onchange=\"selectransporte('3')\">MOVIL</label>
              </div>
              <div class='col-md-4'>
                    <br>

              </div>";

              return array('success' => '1','html' => $html);
    }

    public function transporte_vuelo(){
      global $http;

      $localidad=$http->request->get('localidad');
      $html="<div id='vuelo' name='vuelo'>
              <div class='col-md-12'>
              <label for='txtlocalidad'>Codigo Localidad</label>
              &nbsp
              <input type='text' id='txtcod' class='form-control' name='txtcod' value='$localidad' readonly>
              </div>
              <div class='col-md-12'>
              <br>
              <label for='txtvalorpasaje'>Pasaje Avion Monto Maximo</label>
              &nbsp
              &nbsp
              &nbsp
              &nbsp
              <input type='text' id='txtvalorpasaje' class='form-control' name='txtvalorpasaje'>
              </div>
            </div>";

        return array('success' => '1', 'html'=> $html);

    }
    public function transporte_bus(){
      global $http;

      $localidad=$http->request->get('localidad');
      $html="<div id='bus' name='bus'>
              <div class='col-md-12'>
              <label for='txtlocalidad'>Codigo Localidad</label>
              &nbsp
              <input type='text' id='txtcod' class='form-control' name='txtcod' value='$localidad' readonly>
              </div>
              <div class='col-md-12'>
              <br>
              <label for='txtvalorpasajebus'>Pasaje Bus Monto Maximo</label>
              &nbsp
              &nbsp
              &nbsp
              &nbsp
              <input type='text' id='txtvalorpasajebus' class='form-control' name='txtvalorpasajebus'>
              </div>
            </div>";

        return array('success' => '1', 'html'=> $html);

    }

    public function transporte_movil(){
      global $http;

      $localidad=$http->request->get('localidad');
      $html="<div id='movil' name='movil'>
              <div class='col-md-12'>
              <label for='txtlocalidad'>Codigo Localidad</label>
              &nbsp
              <input type='text' id='txtcod' class='form-control' name='txtcod' value='$localidad' readonly>
              </div>
              <div class='col-md-12'>
              <br>
              <label for='txtpeajes'>Ingrese cantidad de peajes</label>
              &nbsp
              &nbsp
              &nbsp
              &nbsp
              <input type='Number' id='txtpeajes' class='form-control' name='txtpeajes'>
              </div>
              <div class='col-md-12'>
              <br>
              <label for='txtcosto'>Ingrese el costo total de peajes</label>
              &nbsp
              &nbsp
              &nbsp
              &nbsp
              <input type='Number' id='txtcostopeajes' class='form-control' name='txtcostopeajes'>
              </div>
            </div>";

        return array('success' => '1', 'html'=> $html);

    }

    public function opciones_viatico(){
      global $http;

      $localidad=$http->request->get('localidad');
      $html="<div id='viatico' name='viatico'>
              <div class='col-md-12'>
              <label for='txtlocalidad'>Codigo Localidad</label>
              &nbsp
              <input type='text' id='txtcod' class='form-control' name='txtcod' value='$localidad' readonly>
              </div>
              <div class='col-md-12'>
              <br>
              <label for='txtmontoviatico'>Monto Maximo</label>
              &nbsp
              &nbsp
              &nbsp
              &nbsp
              <input type='text' id='txtmontoviatico' class='form-control' name='txtmontoviatico'>
              </div>
            </div>";

        return array('success' => '1', 'html'=> $html);
    }


        public function opciones_hospedaje(){
          global $http;

          $localidad=$http->request->get('localidad');
          $html="<div id='hospedaje' name='hospedaje'>
                  <div class='col-md-12'>
                  <label for='txtlocalidad'>Codigo Localidad</label>
                  &nbsp
                  <input type='text' id='txtcod' class='form-control' name='txtcod' value='$localidad' readonly>
                  </div>
                  <div class='col-md-12'>
                  <br>
                  <label for='txtmontohospedaje'>Monto Maximo</label>
                  &nbsp
                  &nbsp
                  &nbsp
                  &nbsp
                  <input type='text' id='txtmontohospedaje' class='form-control' name='txtmontohospedaje'>
                  </div>
                </div>";

            return array('success' => '1', 'html'=> $html);
        }

    public function guardarlocalidad(){
       global $http;
       $num='1';
       $cod_localidad=$http->request->get('txtcod');
       $descripcion_localidad=$http->request->get('txtdescripcion');
       $hub_localidad=$http->request->get('txthub');
       $check_transporte=$http->request->get('check2');
       $check_hospedaje=$http->request->get('check3');
       $viatico=$http->request->get('txtocultoviatico');
       $avion=$http->request->get('txtocultoavion');
       $bus=$http->request->get('txtocultobus');
       $peaje=$http->request->get('txtocultopeajes');
       $costopeaje=$http->request->get('txtocultocostopeajes');
       $costohospedaje=$http->request->get('txtocultohospedaje');
       $check_viatico='1';

       if($check_transporte=='on'){
         $check_transporte='1';
       }
       if($check_hospedaje=='on'){
         $check_hospedaje='1';
       }
       $this->db->insert('tbllocalidades', array(
         'cod_localidad'=>$cod_localidad,
         'descripcion'=>$descripcion_localidad,
         'hub'=>$hub_localidad,
         'viatico'=>$check_viatico,
         'transporte'=>$check_transporte,
         'hospedaje'=>$check_hospedaje
       ));


       $cons=$this->db->query_select("select id_localidad from tbllocalidades where cod_localidad='$cod_localidad'");
       if($cons!=false){
         $id=$cons[0][0];
         if($viatico!=" "){
         $this->db->insert('tblviatico', array(
           'id_localidad'=>$id,
           'valor_maximo'=>$viatico
         ));
          }
        $this->db->insert('tbltransporte', array(
          'id_localidad'=>$id,
          ));
        }
        if($avion!=false){
          $this->db->insert('tblvuelo', array(
            'id_localidad'=>$id,
            'valor_maximo_vuelo'=>$avion
            ));
          $this->db->update('tbltransporte', array(
            'vuelo'=>'1'
          ),"id_localidad='$id'");
        }
        if($bus!=false){
          $this->db->insert('tblbus', array(
            'id_localidad'=>$id,
            'valor_maximo_bus'=>$bus
          ));
          $this->db->update('tbltransporte', array(
            'bus'=>'1'
          ),"id_localidad='$id'");
        }
        if($peaje!=false){
          $this->db->insert('tblpeaje', array(
            'id_localidad'=>$id,
            'cantidad_peajes'=>$peaje,
            'costo_peajes'=>$costopeaje
          ));
          $this->db->update('tbltransporte', array(
            'movil'=>'1'
          ),"id_localidad='$id'");
        }
        if($costohospedaje!=false){
          $this->db->insert('tblhospedaje', array(
            'id_localidad'=>$id,
            'monto_maximo'=>$costohospedaje
          ));
        }


       return array('success' => 1, 'message' => "Datos Ingresados correctamente");
    }

    public function listar_localidades(){
      return $this->db->query_select("select * from tbllocalidades where estado='1'");
    }
    public function datos_viatico($id){
      $result = $this->db->query_select("select valor_maximo from tblviatico where id_localidad='$id'");
      return $result[0][0];
    }
    public function datos_vuelo($id){
      $result = $this->db->query_select("select valor_maximo_vuelo from tblvuelo where id_localidad='$id'");
      return $result[0][0];
    }
    public function datos_transporte($id){
      $result = $this->db->query_select("select * from tbltransporte where id_localidad='$id'");
      return $result[0];
    }
    public function datos_peaje($id){
      $result = $this->db->query_select("select costo_peajes from tblpeaje where id_localidad='$id'");
      return $result[0][0];
    }
    public function datos_bus($id){
      $result=$this->db->query_select("select valor_maximo_bus from tblbus where id_localidad='$id'");
      return $result[0][0];
    }
    public function datos_hospedaje($id){
      $result= $this->db->query_select("select monto_maximo from tblhospedaje where id_localidad='$id'");
      return $result[0][0];
    }

    public function ver_detalleviatico($id){
      $result= $this->db->query_select("select montoviaticopp from tbldetalleviatico where id_detalleproyecto='$id'");
      return $result[0][0];
    }

    public function cantusuarios($id){
      $result= $this->db->query_select("select count(id_usuarios) from tbldetalleviatico where id_detalleproyecto='$id'");
      return $result[0][0];
    }

    public function precio_transporte($id){
      $result= $this->db->query_select("select precio_pasaje from tbldetalletransporte where id_detalletransporte='$id'");
      return $result[0][0];
    }
    public function tipo_transporte($id){
      $result= $this->db->query_select("select tipo_transporte from tbldetalletransporte where id_detalletransporte='$id'");
      return $result[0][0];
    }
    public function cantidad_movil($id){
      $result= $this->db->query_select("select cant_movil from tbldetallemovil where id_detallemovil='$id'");
      return $result[0][0];
    }
    public function cantidad_peaje($id){
      $result= $this->db->query_select("select cantidad_peajes from tbldetallemovil where id_detallemovil='$id'");
      return $result[0][0];
    }
    public function cantidad_monto($id){
      $result= $this->db->query_select("select costo_movil from tbldetallemovil where id_detallemovil='$id'");
      return $result[0][0];
    }
    public function total_viatico($id){
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
      $this->db->query_select("delete from tblcalculotemporal where usuario_registra='$datousuario'");
      $viatico=$this->db->query_select("select cant_dias, montoviaticopp from tbldetalleviatico where id_detalleproyecto='$id'");
      $totalviatico=0;
      $monto=0;
      foreach ($viatico as $key => $value) {
         $monto=$value['cant_dias']*$value['montoviaticopp'];
         $totalviatico=$totalviatico+$monto;
      }
      return $totalviatico;
    }

    public function cargaropciones(){
      global $http;
      $opcion=$http->request->get('opcion');
      $area=$http->request->get('area');
      $localidades=$http->request->get('localidades');
      $contador=$http->request->get('contador');
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
      $fecha=date('Y-m-d');
      $consulta=$this->db->query_select("select * from tbldetalleviatico_temporal where user_registra='$datousuario'");
      $datos=$this->db->query_select("select * from tblvaloresmaximos where id_localidad='$localidades' and id_area='$area'");
      if ($contador==0){
           if($opcion==1){
                  $html="<div class='box'>
                     <div class='box-header'>
                     <h3 class='box-title'>Viatico</h3>
                     </div>
                   <div class='box-body'>
                     <div class='col-md-4'>
                       <label>INICIO:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='$fecha'>
                     </div>
                     <div class='col-md-4'>
                       <label>TERMINO:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='calc_dias(1)' class='form-control'  VALUE='$fecha'>
                     </div>
                     <div class='col-md-4'>
                       <label>DIAS VIATICO:</label><input type='number' name='txtdias' id='txtdias' class='form-control'>
                     </div>
                     <div class='col-md-2'>
                     <br>
                     <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(1)' title='Seleccionar' data-toggle='tooltip'>
                      Seleccionar Personal
                     </a>
                     </div>
                     <div class='col-md-3'>
                     <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
                     </div>
                     <div class='col-md-3'>
                         <label>MONTO VIATICO P/P</label><input type='text' name='txtviatico' id='txtviatico' value='".$datos[0]['valor_viatico']."' class='form-control' readonly='readonly'>
                     </div>
                     <div class='col-md-4'>
                         <label>TOTAL VIATICO</label><input type='number' name='txtrest' id='txtrest' class='form-control total'>
                         <br>
                     </div>
                       <input type='hidden' id='textprincipal' name='textprincipal' value='1'>
                       <div class='col-md-12' id='divpersonal' name='divpersonal'></div>
                 </div>
               </div>";

               return array('success'=>1, 'html'=>$html, 'estado'=>0);
           }elseif($opcion==2){
             $html2="<div class='box'>
                     <div class='box-header'>
                    <h3 class='box-title'>Transporte</h3>
                     &nbsp
                     &nbsp
                    <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(1)' checked='checked'>BUS</label>
                    &nbsp
                    <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(2)'>AVION</label>
                    &nbsp
                    <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(3)'>MOVIL</label>
                    </div>
                    <div class='box-body'>
                    <div class='col-md-4'>
                      <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio' class='form-control' VALUE='$fecha'>
                    </div>
                    <div class='col-md-4'>
                      <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='calc_dias(2)' class='form-control'  VALUE='$fecha'>
                    </div>
                    <div class='col-md-4'>
                     <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' value='' class='form-control'>
                     </div>
                    <div class='col-md-4'>
                    <br>
                    <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                     Seleccionar Personal
                    </a>
                    </div>
                    <div class='col-md-4'>
                    <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
                     </div>

                    <div class='col-md-4'>
                    <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                    <br>
                    </div>
                    <input type='hidden' id='textprincipal' name='textprincipal' value='2'>
                    <div class='col-md-12' id='divpersonaltransporte' name='divpersonaltransporte'></div>
                    <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
                    </div>
                    </div>";

                    return array('success'=>2, 'html2'=>$html2);
           }elseif($opcion==3){
             $html3="<div class='box'>
                     <div class='box-header'>
                     <h3 class='box-title'>Hospedaje</h3>
                     </div>
                   <div class='box-body'>
                     <div class='col-md-4'>
                       <label>INICIO:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='$fecha'>
                     </div>
                     <div class='col-md-4'>
                       <label>TERMINO:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='calc_dias_hospedaje()' class='form-control'  VALUE='$fecha'>
                     </div>
                     <div class='col-md-4'>
                       <label>CANTIDAD DE DIAS:</label><input type='number' name='txtdiashospedaje' id='txtdiashospedaje' class='form-control'>
                     </div>
                     <div class='col-md-4'>
                       <label>Rut comercial</label><input type='text' name='txtrut' id='txtrut' class='form-control'>
                     </div>
                     <div class='col-md-4'>
                       <label>Nombre Residencial / Hotel </label><input type='text' name='txtcliente' id='txtcliente' class='form-control'>
                     </div>
                     <div class='col-md-4'>
                       <label>Direccion:</label><input type='text' name='txtdireccion' id='txtdireccion'  class='form-control'>
                     </div>
                     <div class='col-md-4'>
                     <br>
                     <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(3)' title='Seleccionar' data-toggle='tooltip'>
                      Seleccionar Personal
                     </a>
                     </div>
                     <div class='col-md-4'>
                     <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
                     <br>
                     </div>
                     <div class='col-md-12'>
                     <br>
                     </div>
                     <div class='col-md-12'>
                      ";
                     $html3.="</div>
                     <input type='hidden' id='textprincipal' name='textprincipal' value='3'>
                     <div id='tipohospedaje' name='tipohospedaje' class='col-md-12'>
                     <div id='divpersonalhospedaje' name='divpersonalhospedaje' class='col-md-12'></div>";
                       $datusu=$this->user;
                       $datousuario=$datusu['id_user'];
                       $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario' ");

                       $hospedaje=$this->db->query_select("select * from tbltipohospedaje");
                       $html3.="";

                       foreach ($hospedaje as $key => $value) {
                       $html3.="

                       <div class='col-md-2'>
                       <br>
                       <br>
                         <label><input type='checkbox' name='checktipo".$value['cod_tipo']."' id='checktipo".$value['cod_tipo']."' onclick='marcar_tipo_hospedaje(".$value['cod_tipo'].")'>&nbsp&nbsp".$value['tipo_habitacion']."</label>
                       </div>
                       <div class='col-md-2'>
                       <br>
                         <label>N° Habitaciones</label><input type='number' name='txthabitaciones".$value['cod_tipo']."' id='txthabitaciones".$value['cod_tipo']."' value='0' onfocusout='calcular_total(".$value['cod_tipo'].")' class='form-control ' disabled='true'>
                       </div>
                       <div class='col-md-2'>
                       <br>
                         <label>Personas por habitacion</label><input type='number' name='txtperp".$value['cod_tipo']."' id='txtperp".$value['cod_tipo']."' value='0'  class='form-control pr' disabled='true'>

                       </div>
                       <div class='col-md-2'>
                       <br>
                         <label>Costo por dia:</label><input type='number' name='txtcostoxdia".$value['cod_tipo']."' id='txtcostoxdia".$value['cod_tipo']."' onfocusout='validarhospedaje(".$value['cod_tipo'].")' value='0' class='form-control ' disabled='true'>
                       </div>
                       <div class='col-md-2'>
                       <br>
                         <label>Dias</label><input type='number' name='txtdia".$value['cod_tipo']."' id='txtdia".$value['cod_tipo']."' value='0'  class='form-control' onfocusout='calcular_total(".$value['cod_tipo'].")' disabled='true'>
                       </div>
                       <div class='col-md-2'>
                       <br>
                         <label>Total:</label><input type='text'  name='txtcostototal".$value['cod_tipo']."' id='txtcostototal".$value['cod_tipo']."'  class='form-control cl' value='0' disabled='true'>";
                           $html3.="</div>";

                 }
                 $html3.="<input type='hidden' id='per' name='per'>";
                 $html3.="<div class='col-md-8'></div>
                         <div class='col-md-2'>
                         <br>
                         <p>
                         <center>
                         <label>TOTAL</label>
                         </center></div>
                    <div class='col-md-2'>
                 <br>
                 <input type='number' name='txtvalortotal' id='txtvalortotal' value='0'  class='form-control total'>
                 </div>
                     </div>
                     <div class='col-md-12'>
                     <br>
                     <br>
                     <div id='costohospedaje' name='costohospedaje'>
                     <div class='col-md-3'>
                     <br>
                       <label><input type='checkbox' name='checkpago' id='checkpago' onclick='marcar_pago()'>APLICAR PORCENTAJE DE PAGO</label>
                     </div>
                     <div class='col-md-3'>
                       <label>PORCENTAJE DE PAGO %</label><input type='number' name='txtpago' step='0.01' id='txtpago' onfocusout='validarporcentaje();' class='form-control' disabled='true'>

                     </div>
                     <div class='col-md-3'>
                       <label>SUB TOTAL</label><input type='number' name='txtsubtotal' id='txtsubtotal' class='form-control' disabled='true'>
                     </div>
                     <div class='col-md-3'>
                       <label>MONTO TOTAL A PAGAR</label><input type='number' name='texttotalhos' id='texttotalhos' class='form-control total' disabled='true'>
                     </div>
                     </div>
                     </div>

                 </div>
               </div>";

               return array('success'=>3, 'html3'=>$html3);
             }


      }else{
        if($opcion==1){
          $html="<div class='box'>
                  <div class='box-header'>
                  <h3 class='box-title'>Viatico</h3>
                  </div>
                <div class='box-body'>
                  <div class='col-md-4'>
                    <label>DIAS VIATICO:</label><input type='number' name='txtdias' id='txtdias' class='form-control'>
                  </div>
                  <div class='col-md-4'>
                      <label>MONTO VIATICO P/P</label><input type='text' name='txtviatico' id='txtviatico' value='".$datos[0]['valor_viatico']."' class='form-control' readonly='readonly'>
                  </div>
                  <div class='col-md-4'>
                      <label>TOTAL VIATICO</label><input type='number' name='txtrest' id='txtrest' class='form-control total'>
                      <br>
                  </div>
                    <div class='col-md-12' id='divpersonal' name='divpersonal'></div>
              </div>
            </div>";

            return array('success'=>1, 'html'=>$html);
        }elseif($opcion==2){
          $html2="<div class='box'>
                  <div class='box-header'>
                 <h3 class='box-title'>Transporte</h3>
                  &nbsp
                  &nbsp
                 <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(4)' checked='checked'>BUS</label>
                 &nbsp
                 <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(5)'>AVION</label>
                 &nbsp
                 <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(6)'>MOVIL</label>
                 </div>
                 <div class='box-body'>
                 <div class='col-md-4'>
                  <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
                  </div>
                 <div class='col-md-4'>
                 <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                 </div>
                 <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
                 </div>
                 </div>";

                 return array('success'=>2, 'html2'=>$html2);
        }elseif($opcion==3){
          $html3="<div class='box'>
                  <div class='box-header'>
                  <h3 class='box-title'>Hospedaje</h3>
                  </div>
                <div class='box-body'>
                  <div class='col-md-4'>
                    <label>Rut comercial</label><input type='text' name='txtrut' id='txtrut' class='form-control'>
                  </div>
                  <div class='col-md-4'>
                    <label>Nombre Residencial / Hotel </label><input type='text' name='txtcliente' id='txtcliente' class='form-control'>
                  </div>
                  <div class='col-md-4'>
                    <label>Direccion:</label><input type='text' name='txtdireccion' id='txtdireccion'  class='form-control'>
                  </div>
                  <div class='col-md-12'>
                  <br>
                  </div>
                  <div class='col-md-12'>
                   ";
                  $html3.="</div>
                  <div id='tipohospedaje' name='tipohospedaje' class='col-md-12'>";
                    $datusu=$this->user;
                    $datousuario=$datusu['id_user'];
                    $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario' ");

                    $hospedaje=$this->db->query_select("select * from tbltipohospedaje");
                    $html3.="";

                    foreach ($hospedaje as $key => $value) {
                    $html3.="

                    <div class='col-md-2'>
                    <br>
                    <br>
                      <label><input type='checkbox' name='checktipo".$value['cod_tipo']."' id='checktipo".$value['cod_tipo']."' onclick='marcar_tipo_hospedaje(".$value['cod_tipo'].")'>&nbsp&nbsp".$value['tipo_habitacion']."</label>
                    </div>
                    <div class='col-md-2'>
                    <br>
                      <label>N° Habitaciones</label><input type='number' name='txthabitaciones".$value['cod_tipo']."' id='txthabitaciones".$value['cod_tipo']."' value='0' onfocusout='calcular_total(".$value['cod_tipo'].")' class='form-control ' disabled='true'>
                    </div>
                    <div class='col-md-2'>
                    <br>
                      <label>Personas por habitacion</label><input type='number' name='txtperp".$value['cod_tipo']."' id='txtperp".$value['cod_tipo']."' value='0'  class='form-control pr' disabled='true'>

                    </div>
                    <div class='col-md-2'>
                    <br>
                      <label>Costo por dia:</label><input type='number' name='txtcostoxdia".$value['cod_tipo']."' id='txtcostoxdia".$value['cod_tipo']."' onfocusout='validarhospedaje(".$value['cod_tipo'].")' value='0' class='form-control ' disabled='true'>
                    </div>
                    <div class='col-md-2'>
                    <br>
                      <label>Dias</label><input type='number' name='txtdia".$value['cod_tipo']."' id='txtdia".$value['cod_tipo']."' value='0'  class='form-control' onfocusout='calcular_total(".$value['cod_tipo'].")' disabled='true'>
                    </div>
                    <div class='col-md-2'>
                    <br>
                      <label>Total:</label><input type='text'  name='txtcostototal".$value['cod_tipo']."' id='txtcostototal".$value['cod_tipo']."'  class='form-control cl' value='0' disabled='true'>";
                        $html3.="</div>";

              }
              $html3.="<input type='hidden' id='per' name='per'>";
              $html3.="<div class='col-md-8'></div>
                      <div class='col-md-2'>
                      <br>
                      <p>
                      <center>
                      <label>TOTAL</label>
                      </center></div>
                 <div class='col-md-2'>
                 <br>
              <input type='number' name='txtvalortotal' id='txtvalortotal' value='0'  class='form-control total'>
              </div>
                  </div>
                  <div class='col-md-12'>
                  <br>
                  <br>
                  <div id='costohospedaje' name='costohospedaje'>
                  <div class='col-md-3'>
                  <br>
                    <label><input type='checkbox' name='checkpago' id='checkpago' onclick='marcar_pago()'>APLICAR PORCENTAJE DE PAGO</label>
                  </div>
                  <div class='col-md-3'>
                    <label>PORCENTAJE DE PAGO %</label><input type='number' name='txtpago' step='0.01' id='txtpago' onfocusout='validarporcentaje();' class='form-control' disabled='true'>

                  </div>
                  <div class='col-md-3'>
                    <label>SUB TOTAL</label><input type='number' name='txtsubtotal' id='txtsubtotal' class='form-control' disabled='true'>
                  </div>
                  <div class='col-md-3'>
                    <label>MONTO TOTAL A PAGAR</label><input type='number' name='texttotalhos' id='texttotalhos' class='form-control total' disabled='true'>
                  </div>
                  </div>
                  </div>

              </div>
            </div>";

            return array('success'=>3, 'html3'=>$html3);
          }
      }
    }

 public function editaropciones(){
  global $http;
  $opcion=$http->request->get('opcion');
  $localidades=$http->request->get('localidades');
  $area=$http->request->get('area');
  $datos=$this->db->query_select("select * from tblvaloresmaximos where id_localidad='$localidades' and id_area='$area'");
  if($opcion==1){
    $html="<div class='box'>
            <div class='box-header'>
            <h3 class='box-title'>Viatico</h3>
            </div>
          <div class='box-body'>
            <div class='col-md-4'>
              <label>DIAS VIATICO:</label><input type='number' name='txtdias' id='txtdias' class='form-control'>
            </div>
            <div class='col-md-4'>
                <label>MONTO VIATICO P/P</label><input type='text' name='txtviatico' id='txtviatico' value='".$datos[0]['valor_viatico']."' class='form-control' readonly='readonly'>
            </div>
            <div class='col-md-4'>
                <label>TOTAL VIATICO</label><input type='number' name='txtrest' id='txtrest' class='form-control total'>
                <br>
            </div>
              <div class='col-md-12' id='divpersonal' name='divpersonal'></div>
        </div>
      </div>";

      return array('success'=>1, 'html'=>$html);
  }elseif($opcion==2){
    $html2="<div class='box'>
            <div class='box-header'>
           <h3 class='box-title'>Transporte BUS</h3>
            &nbsp
            &nbsp
           <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(7)' checked='checked'>BUS</label>
           &nbsp
           <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(8)'>AVION</label>
           &nbsp
           <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(9)'>MOVIL</label>
           </div>
           <div class='box-body'>
           <div class='col-md-4'>
            <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
            </div>
           <div class='col-md-4'>
           <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
           </div>
           <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
           </div>
           </div>";

           return array('success'=>2, 'html2'=>$html2);
  }elseif($opcion==3){
    $html3="<div class='box'>
            <div class='box-header'>
            <h3 class='box-title'>Hospedaje</h3>
            </div>
          <div class='box-body'>
            <div class='col-md-4'>
              <label>Rut comercial</label><input type='text' name='txtrut' id='txtrut' class='form-control'>
            </div>
            <div class='col-md-4'>
              <label>Nombre Residencial / Hotel </label><input type='text' name='txtcliente' id='txtcliente' class='form-control'>
            </div>
            <div class='col-md-4'>
              <label>Direccion:</label><input type='text' name='txtdireccion' id='txtdireccion'  class='form-control'>
            </div>
            <div class='col-md-12'>
            <br>
            </div>
            <div class='col-md-12'>
             ";
            $html3.="</div>
            <div id='tipohospedaje' name='tipohospedaje' class='col-md-12'>";
              $datusu=$this->user;
              $datousuario=$datusu['id_user'];
              $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario' ");

              $hospedaje=$this->db->query_select("select * from tbltipohospedaje");
              $html3.="";

              foreach ($hospedaje as $key => $value) {
              $html3.="

              <div class='col-md-2'>
              <br>
              <br>
                <label><input type='checkbox' name='checktipo".$value['cod_tipo']."' id='checktipo".$value['cod_tipo']."' onclick='marcar_tipo_hospedaje(".$value['cod_tipo'].")'>&nbsp&nbsp".$value['tipo_habitacion']."</label>
              </div>
              <div class='col-md-2'>
              <br>
                <label>N° Habitaciones</label><input type='number' name='txthabitaciones".$value['cod_tipo']."' id='txthabitaciones".$value['cod_tipo']."' value='0' onfocusout='calcular_total(".$value['cod_tipo'].")' class='form-control ' disabled='true'>
              </div>
              <div class='col-md-2'>
              <br>
                <label>Personas por habitacion</label><input type='number' name='txtperp".$value['cod_tipo']."' id='txtperp".$value['cod_tipo']."' value='0'  class='form-control pr' disabled='true'>

              </div>
              <div class='col-md-2'>
              <br>
                <label>Costo por dia:</label><input type='number' name='txtcostoxdia".$value['cod_tipo']."' id='txtcostoxdia".$value['cod_tipo']."' onfocusout='validarhospedaje(".$value['cod_tipo'].")' value='0' class='form-control ' disabled='true'>
              </div>
              <div class='col-md-2'>
              <br>
                <label>Dias</label><input type='number' name='txtdia".$value['cod_tipo']."' id='txtdia".$value['cod_tipo']."' value='0'  class='form-control' onfocusout='calcular_total(".$value['cod_tipo'].")' disabled='true'>
              </div>
              <div class='col-md-2'>
              <br>
                <label>Total:</label><input type='text'  name='txtcostototal".$value['cod_tipo']."' id='txtcostototal".$value['cod_tipo']."'  class='form-control cl' value='0' disabled='true'>";
                  $html3.="</div>";

        }
        $html3.="<input type='hidden' id='per' name='per'>";
        $html3.="<div class='col-md-8'></div>
                <div class='col-md-2'>
                <br>
                <p>
                <center>
                <label>TOTAL</label>
                </center></div>
           <div class='col-md-2'>
        <br>
        <input type='number' name='txtvalortotal' id='txtvalortotal' value='0'  class='form-control total'>
        </div>
            </div>
            <div class='col-md-12'>
               <br>
               <br>
            </div>
            <div id='costohospedaje' name='costohospedaje'>
                  <div class='col-md-3'>
                  <br>
                    <label><input type='checkbox' name='checkpago' id='checkpago' onclick='modificarporcentaje()'>Modificar porcentaje de pago </label>
                  </div>
                  <div class='col-md-3'>
                    <label>PORCENTAJE DE PAGO %</label><input type='number' name='txtpago' step='0.01' id='txtpago' onfocusout='validarporcentaje();' class='form-control' value='{{db_monto.porcentaje}}' disabled='true'>

                  </div>
                  <div class='col-md-3'>
                    <label>SUB TOTAL</label><input type='number' name='txtsubtotal' id='txtsubtotal' value='{{db_monto.total_hospedaje}}' class='form-control' disabled='true'>
                  </div>
                  <div class='col-md-3'>
                    <label>MONTO TOTAL A PAGAR</label><input type='number' name='texttotalhos' id='texttotalhos' class='form-control' value='{{(db_monto.total_hospedaje * db_monto.porcentaje)/'100'}}' disabled='true'>
                  </div>
                  <input type='text' id='txtestado' name='txtestado' value='0'>
            </div>

        </div>
      </div>";

      return array('success'=>3, 'html3'=>$html3);
    }


  }



  public function enviarproyecto(){
    global $http;
    $datusu=$this->user;
    $datousuario=$datusu['id_user'];
//  ingreso tblcontrol_proyectos
    $numproyecto=$http->request->get('txtidproyecto');
    if($numproyecto==false){
        return array('success' => '0', 'message'=> 'Debe ingresar un codigo de orden');
    }

    $cod_localidad=$http->request->get('cmblocalidades');
    $descripcionproyecto=$http->request->get('txtdetalle');
    $area=$http->request->get('cmbtipotrabajo');
    $nodocuadrante=$http->request->get('txtnodo');
    $monto_total=$http->request->get('txttotal');
    $fechainicio=$http->request->get('txtinicio');
    $fechafinal=$http->request->get('txtfinal');
    $cantdias=$http->request->get('txtdias');
    $principal=$http->request->get('textprincipal');
    if($cantdias=='0'){
      $cantidad_dias_hospedaje='0';
    }else{
      $cantidad_dias_hospedaje=$cantdias-1;
    }
    if($cantdias==false){
        $diahospedaje=$this->db->query_select("select dia from detalle_hospedaje_temporal where usuario_registra='$datousuario' limit 1");
        $cantidad_dias_hospedaje=$diahospedaje[0]['dia'];
    }
    $cantpersonas=$http->request->get('txtpersonal');
    if($cantpersonas==false){
      return array('success' => '0', 'message'=> 'Debe seleccionar personal');
    }
    $costototal=$http->request->get('txttotalcontrol');
    $monto_por_persona=$http->request->get('txtviatico');
    $pasaje_por_persona=$http->request->get('txtcostopasaje');
    $cantmovil=$http->request->get('txtcantmovil');
    $cantidad_peaje=$http->request->get('txtpeajes');
    $montopeaje=$http->request->get('txtmontopeaje');
    $ruthospedaje=$http->request->get('txtrut');
    $viatico=$http->request->get('txtrest');
    if($pasaje_por_persona==false){
      if($cantmovil==false){
        if($ruthospedaje==false){
          if($viatico==true){

          }else{
          return array('success' => '0', 'message'=> 'Debe ingresar un tipo de transporte');
        }
        }
      }
    }
    $clientehospedaje=$http->request->get('txtcliente');
    $direccionhospedaje=$http->request->get('txtdireccion');
    $eleccion=$http->request->get('texteleccion');
    $costoxdia=$http->request->get('txtcostopordia');
    $tipotransporte=$http->request->get('txtopcion');
    $totalhospedaje=$http->request->get('txtvalortotal');
    $usuario=$this->user;

    $fecha_ingreso=date('Y-m-d');

// ingreso detalle viatico
    $this->db->insert('tblcontrol_proyectos', array(
      'num_proyecto'=>$numproyecto,
      'cod_localidad'=>$cod_localidad,
      'descrip_proyecto'=>$descripcionproyecto,
      'area'=>$area,
      'nodocuadrante'=>$nodocuadrante,
      'fecha_inicio'=>$fechainicio,
      'fecha_final'=>$fechafinal,
      'id_detalleviatico'=>$numproyecto,
      'id_detalletransporte'=>$numproyecto,
      'id_detallehospedaje'=>$numproyecto,
      'cant_dias'=>$cantdias,
      'cant_dias_hospedaje'=>$cantidad_dias_hospedaje,
      'cant_personas'=>$cantpersonas,
      'costo_total'=>$costototal,
      'fecha_ingreso'=>$fecha_ingreso,
      'principal'=>$principal,
      'id_user'=>$usuario['id_user']
    ));

    $consultarid=$this->db->query_select("select num_proyecto from tblcontrol_proyectos order by id_proyecto desc limit 1");
    $idviatico=$consultarid[0][0];

    $usuarios=$this->db->query_select("select tbldetalleviatico_temporal.id_user,tbldetalleviatico_temporal.chofer,(select DISTINCT cantidad_dias from tblcalculotemporal inner join tbldetalleviatico_temporal tbltemporal2 on tblcalculotemporal.id_usuario=tbltemporal2.id_user where tbltemporal2.id_user=tbldetalleviatico_temporal.id_user limit 1 ) as dias,(select DISTINCT idasociada from tblcalculotemporal inner join tbldetalleviatico_temporal tbltemporal2 on tblcalculotemporal.id_usuario=tbltemporal2.id_user where tbltemporal2.id_user=tbldetalleviatico_temporal.id_user ) as idasociada  from tbldetalleviatico_temporal where user_registra='$datousuario'");
    foreach ($usuarios as $key => $value) {
      $this->db->insert('tbldetalleviatico', array(
      'id_detalleproyecto'=>$idviatico,
      'fecha_inicio'=>$fechainicio,
      'fecha_termino'=>$fechafinal,
      'cant_dias'=>$value['dias'],
      'idasociada'=>$value['idasociada'],
      'id_usuarios'=>$value['id_user'],
      'montoviaticopp'=>$monto_por_persona,
      'chofer'=>$value['chofer'],
      ));
    }
    if($pasaje_por_persona!=false){
    $this->db->insert('tbldetalletransporte', array(
      'id_detalletransporte'=>$idviatico,
      'fecha_inicio'=>$fechainicio,
      'fecha_termino'=>$fechafinal,
      'cant_persona'=>$cantpersonas,
      'precio_pasaje'=>$pasaje_por_persona,
      'tipo_transporte'=>$tipotransporte
    ));
  }else{
    $this->db->insert('tbldetallemovil', array(
      'id_detallemovil'=>$idviatico,
      'cod_localidad'=>$cod_localidad,
      'fecha_inicio'=>$fechainicio,
      'fecha_final'=>$fechafinal,
      'cant_movil'=>$cantmovil,
      'costo_movil'=>$montopeaje,
      'cantidad_peajes'=>$cantidad_peaje
    ));
  }
  if($ruthospedaje!=false){
    $hospedaje=$this->db->query_select("select * from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
    foreach ($hospedaje as $key => $value) {
      $this->db->insert('tbldetallehospedaje', array(
        'id_detallehospedaje'=>$idviatico,
        'rut_hospedaje'=>$ruthospedaje,
        'nombre_hospedaje'=>$clientehospedaje,
        'direccion_hospedaje'=>$direccionhospedaje,
        'tipo_hospedaje'=>$value['id_tipohospedaje'],
        'cant_habitaciones'=>$value['habitaciones'],
        'persoxhabi'=>$value['personas'],
        'costo_dia'=>$value['costo'],
        'dias'=>$value['dia'],
        'porcentaje'=>$value['porcentaje'],
        'total_hospedaje'=>$totalhospedaje
      ));
    }

  }

  $datusu=$this->user;
  $datousuario=$datusu['id_user'];
  $this->db->query_select("delete from tblvistatemporal where user_reg='$datousuario'");
  $this->db->query_select("delete from tbldetalleviatico_temporal where user_registra='$datousuario'");
  $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario'");

    return array('success' => '1', 'message'=> 'Datos Guardados');
  }

  public function guardar_vista(){
    global $http;
    $datusu=$this->user;
    $datousuario=$datusu['id_user'];
    $this->db->query_select("delete from tblvistatemporal where user_reg='$datousuario'");
    $numproyecto=$http->request->get('txtidproyecto');
    if($numproyecto==false){
      return array("success"=>'0',"message"=>'Debe ingresar un nuevo ID PROYECTO');
    }
    $cod_localidad=$http->request->get('cmblocalidades');
    if($cod_localidad=='0'){
        return array("success"=>'0',"message"=>'Debe ingresar una LOCALIDAD');
    }
    $area=$http->request->get('cmbtipotrabajo');
    if($area==false){
      return array("success"=>'0',"message"=>'Debe seleccionar un AREA');
    }
    $descripcionproyecto=$http->request->get('txtdetalle');
    $nodocuadrante=$http->request->get('txtnodo');
    $viatico=$http->request->get('txtviatico');
    $montototalviatico=$http->request->get('txtrest');
    $fechainicio=$http->request->get('txtinicio');
    $fechafinal=$http->request->get('txtfinal');
    $cantdias=$http->request->get('txtdias');
    $cantpersonas=$http->request->get('txtpersonal');
    $cantpersonas=$http->request->get('txtpersonal');
    if($cantpersonas==false){
      return array("success"=>'0',"message"=>'Debe ingresar personal');
    }
    $costototal=$http->request->get('txttotalcontrol');
    $tipotransporte=$http->request->get('txtopcion');
    $choferes=$http->request->get('txtnummovil');
    $cantmovil=$http->request->get('txtcantmovil');
    $cantidad_peaje=$http->request->get('txtpeajes');
    $montopeaje=$http->request->get('txtmontopeaje');
    $pasaje_por_persona=$http->request->get('txtcostopasaje');
    $total_transporte=$http->request->get('txttotaltransportes');



    $ruthospedaje=$http->request->get('txtrut');
    $clientehospedaje=$http->request->get('txtcliente');
    $direccionhospedaje=$http->request->get('txtdireccion');
    $eleccion=$http->request->get('texteleccion');
    $costoxdia=$http->request->get('txtcostopordia');
    $totalhospedaje=$http->request->get('txttotalhospedaje');
    $porcentaje=$http->request->get('txtpago');
    if($porcentaje==0){
      $porcentaje='100';
    }
    $tipotransporte=$http->request->get('txtopcion');
    $totaltodo=$http->request->get('txttotalcontrol');
    $usuario=$this->user;
    $fecha_ingreso=date('Y-m-d');
    $registros=$this->db->query_select("select * from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
    if($registros!=false){
    foreach ($registros as $key => $value) {
       $id=$value['id_tipohospedaje'];
       $habitaciones=$http->request->get('txthabitaciones'.$id);
       $personas=$http->request->get('txtperp'.$id);
       $costoxdia=$http->request->get('txtcostoxdia'.$id);
       $dia=$http->request->get('txtdia'.$id);

       $this->db->update('detalle_hospedaje_temporal', array(
         'habitaciones'=>$habitaciones,
         'personas'=>$personas,
         'costo'=>$costoxdia,
         'dia'=>$dia,
         'porcentaje'=>$porcentaje
       ),"id_tipohospedaje='$id' and usuario_registra='$datousuario'");

    }
  }

    $this->db->insert('tblvistatemporal', array(
      'id_codigo'=>$numproyecto,
      'cod_localidad'=>$cod_localidad,
      'area'=>$area,
      'descripcion'=>$descripcionproyecto,
      'nodo'=>$nodocuadrante,
      'fecha_inicio'=>$fechainicio,
      'fecha_final'=>$fechafinal,
      'cantidad_perso'=>$cantpersonas,
      'viatico'=>$viatico,
      'total_viatico'=>$montototalviatico,
      'cantidad_dias'=>$cantdias,
      'tipo_transporte'=>$tipotransporte,
      'valor_pasaje'=>$pasaje_por_persona,
      'total_pasajes'=>$total_transporte,
      'cantidad_moviles'=>$cantmovil,
      'cantidad_peaje'=>$montopeaje,
      'num_peajes'=>$cantidad_peaje,
      'rut_hospedaje'=>$ruthospedaje,
      'nombre_hospedaje'=>$clientehospedaje,
      'direccion_hospedaje'=>$direccionhospedaje,
      'costo_hospedaje'=>$costoxdia,
      'total_hospedaje'=>$totalhospedaje,
      'costo_total'=>$totaltodo,
      'user_reg'=>$datousuario
    ));

    $temporal=$this->db->query_select("select tblvistatemporal.id_codigo,tblvistatemporal.cod_localidad,tblvistatemporal.area,tblvistatemporal.descripcion,tblvistatemporal.nodo,tblvistatemporal.fecha_inicio,tblvistatemporal.fecha_final,tblvistatemporal.cantidad_perso,tblvistatemporal.viatico,tblvistatemporal.total_viatico,tblvistatemporal.cantidad_dias,tblvistatemporal.tipo_transporte,tblvistatemporal.valor_pasaje,tblvistatemporal.total_pasajes,tblvistatemporal.cantidad_moviles,tblvistatemporal.cantidad_peaje,tblvistatemporal.num_peajes,tblvistatemporal.rut_hospedaje,tblvistatemporal.nombre_hospedaje,tblvistatemporal.direccion_hospedaje,tblvistatemporal.costo_hospedaje,tblvistatemporal.total_hospedaje,tblvistatemporal.costo_total,tblvistatemporal.user_reg,(select tbllocalidades.descripcion from tbllocalidades inner join tblvistatemporal tblvis on tbllocalidades.id_localidad=tblvis.cod_localidad where tblvis.id_codigo=tblvistatemporal.id_codigo) as localidad,(select email from users inner join tblvistatemporal tblvist2 on users.id_user=tblvist2.user_reg where tblvist2.id_codigo=tblvistatemporal.id_codigo) as correo from tblvistatemporal where user_reg='$datousuario'");
    if($temporal!=false){
    foreach ($temporal as $key => $value) {
    $html="<div class='box'>
            <div class='col-md-10'>
              <div class='box'>
                <div class='box-body'>
                  <div class='box-header'>
                    <h3 class='box-title'>DATOS</h3>
                  </div>
                  <br>
                  <div class='col-md-6'>
                    <label>CODIGO PROYECTO</label><input type='text' name='textocodigo' id='textocodigo' value='".$value['id_codigo']."' class='form-control'>
                  </div>
                  <div class='col-md-6'>
                     <label>CODIGO LOCALIDAD</label><input type='text' name='textocodigolocalidad' id='textocodigolocalidad' value='".$value['localidad']."'  class='form-control'>
                  </div>
                  <div class='col-md-12'>
                   <br>
                  </div>
                  <div class='col-md-4'>
                     <label>SOLICITANTE</label><input type='text' name='textsolicitante' id='textsolicitante' value='".$value['correo']."'  class='form-control'>
                  </div>
                  <div class='col-md-4'>
                     <label>AREA</label><input type='text' name='textarea' id='textarea' value='".$value['area']."'  class='form-control'>
                  </div>
                  <div class='col-md-4'>
                    <label>DESCRIPCION PROYECTO</label><input type='text' name='textdescripcion' id='textdescripcion' value='".$value['descripcion']."' class='form-control'>
                  </div>
                  <div class='col-md-12'>
                   <br>
                  </div>
                  <div class='col-md-3'>
                    <label>FECHA INICIO</label><input type='text' name='textofechainicio' id='textofechainicio' value='".$value['fecha_inicio']."'  class='form-control'>
                  </div>
                  <div class='col-md-3'>
                    <label>FECHA FINAL</label><input type='text' name='textofechafinal' id='textofechafinal' value='".$value['fecha_final']."'  class='form-control'>
                  </div>
                  <div class='col-md-3'>
                    <label>CANTIDAD PERSONAS</label><input type='text' name='textocantidadpersonas' id='textocantidadpersonas' value='".$value['cantidad_perso']."'  class='form-control'>
                  </div>";
                  if($value['cantidad_dias']==false){
                      $dias_hospedaje=$this->db->query_select("select dia from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
                      $cantidaddias=$dias_hospedaje[0]['dia']+'1';
                  }else{
                    $cantidaddias=$value['cantidad_dias'];
                  }
                  $html.="<div class='col-md-3'>
                      <label>CANTIDAD DE DIAS</label><input type='text' name='textocantidaddias' id='textocantidaddias' value='$cantidaddias'  class='form-control'>
                  </div>
                  <div class='col-md-12'>
                    <br>
                  </div>
                </div>";
//InicioTransporteyviatico------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if($value['tipo_transporte']==false){
        if($value['viatico']==false){
        }else{
          $html.="<div class='box-body'>
                  <div class='box-header'>
                    <h3 class='box-title'>DETALLE DE VIATICO POR PERSONA</h3>
                    <br>
                    <br>
                  </div>
                  <div class=' col-md-12'>
                  <table class='table table-bordered table-responsive' style='width:100%'>
                       <thead>
                         <th>RUT</th>
                         <th>USUARIO</th>
                         <th>VIATICO</th>
                         <th>TOTAL_VIATICO</th>
                         <th>ORDEN ASOCIADA</th>
                       </thead>
                       <tbody>
                          <tr>";
                          $suma_viatico='0';
                          $totaltodo='0';
                          $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,(select cantidad_dias from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal limit 1 ) as dias, (select DISTINCT idasociada from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal) as idasociada from tblpersonal inner join tbldetalleviatico_temporal on tblpersonal.cod_personal=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
                          if($usuarios==false){
                            return array("success"=>"0","message"=>"Debe seleccionar PERSONAL");
                          }


                          foreach ($usuarios as $key2 => $value2) {
                                $gasto_viatico=$value['viatico']*$value2['dias'];
                                $html.="<td style='width:20%'>".$value2['rut_personal']."</td>
                                        <td style='width:20%'>".$value2['nombre_personal']."</td>
                                        <td style='width:20%'>".$value['viatico']."</td>
                                        <td style='width:20%'>".$gasto_viatico."</td>";
                                        if($value2['idasociada']==false){
                                        $html.="<td style='width:20%'>NO APLICA</td>";
                                        }else{
                                        $html.="<td style='width:20%'>".$value2['idasociada']."</td>";
                                        }
                                        $html.="</tr>";
                                        $suma_viatico=$suma_viatico+$gasto_viatico;
                          }
                          $html.=
                          "<tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td></td>
                            <td>".$suma_viatico."</td>
                      </table>
                      </div>
                      </div>";
        }
    }else{
          if($value['viatico']!=false){
                  if($value['tipo_transporte']=='1'){
                    $trans='BUS';
                  }elseif($value['tipo_transporte']=='2'){
                    $trans='AVION';
                  }else{
                    $trans='MOVIL';
                  }
                  if($value['tipo_transporte']!='3'){
                  $html.="
                  <div class='box-body'>
                        <div class='box-header'>
                          <h3 class='box-title'>TRANSPORTE</h3>
                        </div>
                        <br>
                        <div class='col-md-3'>
                          <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='$trans' class='form-control'>
                        </div>
                        <div class='col-md-3'>
                          <label>VALOR PASAJES IDA/VUELTA</label><input type='text' name='textoprepeaje' id='textoprepeaje' value='".$value['valor_pasaje']."'  class='form-control'>
                        </div>
                        <div class='col-md-3'>
                          <label>MONTO TOTAL</label><input type='text' name='textoprecantidad' id='textoprecantidad' value='".$value['total_pasajes']."'  class='form-control'>
                        <br>
                        </div>
                  </div>
                  <div class='box-body'>
                  <div class='box-header'>
                    <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                    <br>
                    <br>
                  </div>
                  <div class=' col-md-12'>
                  <table class='table table-bordered table-responsive'>
                       <thead>
                         <th>RUT</th>
                         <th>USUARIO</th>
                         <th>VIATICO</th>
                         <th>PASAJES</th>
                         <th>TOTAL_POR_PERSONA</th>
                         <th>ORDEN ASOCIADA</th>
                       </thead>
                       <tbody>
                          <tr>";
                          $suma_viatico='0';
                          $suma_pasaje='0';
                          $suma_x_persona='0';
                          $totaltodo='0';
                          $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,(select cantidad_dias from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal limit 1 ) as dias, (select DISTINCT idasociada from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal limit 1 ) as idasociada from tblpersonal inner join tbldetalleviatico_temporal on tblpersonal.cod_personal=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
                          if($usuarios==false){
                            return array("success"=>"0","message"=>"Debe seleccionar PERSONAL");
                          }
                          foreach ($usuarios as $key2 => $value2) {
                                $gasto_viatico=$value['viatico']*$value2['dias'];
                                $gasto_pasaje=$value['valor_pasaje'];
                                $suma_x_persona=$gasto_viatico+$value['valor_pasaje'];
                                $html.="<td>".$value2['rut_personal']."</td>
                                        <td>".$value2['nombre_personal']."</td>
                                        <td>".$gasto_viatico."</td>
                                        <td>".$value['valor_pasaje']."</td>
                                        <td>".$suma_x_persona."</td>";
                                        if($value2['idasociada']==false){
                                        $html.="<td style='width:20%'>NO APLICA</td>";
                                        }else{
                                        $html.="<td style='width:20%'>".$value2['idasociada']."</td>";
                                        }
                                        $html.="</tr>";
                                        $suma_viatico=$suma_viatico+$gasto_viatico;
                                        $suma_pasaje=$suma_pasaje+$gasto_pasaje;
                                        $totaltodo=$totaltodo+$suma_x_persona;
                          }
                          $html.=
                          "<tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td>".$suma_viatico."</td>
                            <td>".$suma_pasaje."</td>
                            <td>".$totaltodo."</td>
                      </table>
                      </div>
                      </div>";

                    }else{
                      $html.="
                      <div class='box-body'>
                            <div class='box-header'>
                              <h3 class='box-title'>TRANSPORTE</h3>
                            </div>
                            <br>
                            <div class='col-md-3'>
                              <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='$trans' class='form-control'>
                            </div>
                            <div class='col-md-2'>
                              <label>CANTIDAD PEAJES</label><input type='text' name='textoprepeaje' id='textoprepeaje' value='".$value['num_peajes']."'  class='form-control'>
                            </div>
                            <div class='col-md-2'>
                              <label>CANTIDAD DE MOVILES</label><input type='text' name='textoprecantidad' id='textoprecantidad' value='".$value['cantidad_moviles']."'  class='form-control'>
                            <br>
                            </div>
                            <div class='col-md-2'>
                              <label>MONTO POR MOVIL</label><input type='text' name='textoprecosto' id='textoprecosto' value='".$value['cantidad_peaje']."'  class='form-control'>
                            <br>
                            </div>
                            <div class='col-md-2'>
                              <label>TOTAL</label><input type='text' name='textopretotal' id='textopretotal' value='".$value['total_pasajes']."'  class='form-control'>
                            <br>
                            </div>
                          </div>";
                      $html.="
                      <div class='box-header'>
                        <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                        <br>
                        <br>
                      </div>
                      <div class='col-md-12'>
                      <table class='table table-bordered table-responsive'>
                           <thead>
                             <th>RUT</th>
                             <th>USUARIO</th>
                             <th>VIATICO</th>
                             <th>PEAJES(CHOFER)</th>
                             <th>TOTAL_POR_PERSONA</th>
                             <th>ORDEN ASOCIADA</th>
                           </thead>
                           <tbody>
                              <tr>";
                              $suma_viatico='0';
                              $suma_peaje='0';
                              $suma_x_persona='0';
                              $totaltodo='0';
                              $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tbldetalleviatico_temporal.chofer,tblpersonal.nombre_personal,(select cantidad_dias from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal ) as dias,(select idasociada from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal ) as idasociada from tblpersonal inner join tbldetalleviatico_temporal on tblpersonal.cod_personal=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
                              foreach ($usuarios as $key2 => $value2) {
                                    $gasto_viatico=$value['viatico']*$value2['dias'];
                                    $html.="<td>".$value2['rut_personal']."</td>
                                            <td>".$value2['nombre_personal']."</td>
                                            <td>".$gasto_viatico."</td>";
                                            if($value2['chofer']=='1'){
                                    $html.="<td>".$value['cantidad_peaje']."</td>";
                                    $gasto_peaje=$value['cantidad_peaje'];
                                            }else{
                                    $html.="<td>0</td>";
                                    $gasto_peaje='0';
                                            }
                                    $suma_x_persona=$gasto_viatico+$gasto_peaje;
                                    $html.="<td>".$suma_x_persona."</td>";
                                            if($value2['idasociada']==false){
                                            $html.="<td style='width:20%'>NO APLICA</td>";
                                            }else{
                                            $html.="<td style='width:20%'>".$value2['idasociada']."</td>";
                                            }
                                            $html.="</tr>";
                                            $suma_viatico=$suma_viatico+$gasto_viatico;
                                            $suma_peaje=$suma_peaje+$gasto_peaje;
                                            $total=$suma_viatico+$suma_peaje;
                              }
                              $html.=
                              "<tr>
                                <td>TOTAL</td>
                                <td></td>
                                <td>".$suma_viatico."</td>
                                <td>".$suma_peaje."</td>
                                <td>".$total."</td>
                            </tbody>
                          </table>
                          </div>";
                    }
                  }else{
                    if($value['tipo_transporte']=='1'){
                      $trans='BUS';
                    }elseif($value['tipo_transporte']=='2'){
                      $trans='AVION';
                    }else{
                      $trans='MOVIL';
                    }
                    if($value['tipo_transporte']!='3'){
                    $html.="
                    <div class='box-body'>
                          <div class='box-header'>
                            <h3 class='box-title'>TRANSPORTE</h3>
                          </div>
                          <br>
                          <div class='col-md-3'>
                            <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='$trans' class='form-control'>
                          </div>
                          <div class='col-md-3'>
                            <label>VALOR PASAJES IDA/VUELTA</label><input type='text' name='textoprepeaje' id='textoprepeaje' value='".$value['valor_pasaje']."'  class='form-control'>
                          </div>
                          <div class='col-md-3'>
                            <label>MONTO TOTAL</label><input type='text' name='textoprecantidad' id='textoprecantidad' value='".$value['total_pasajes']."'  class='form-control'>
                          <br>
                          </div>
                    </div>
                    <div class='box-body'>
                    <div class='box-header'>
                      <h3 class='box-title'>DETALLE DE TRANSPORTE POR PERSONA</h3>
                      <br>
                      <br>
                    </div>
                    <div class=' col-md-12'>
                    <table class='table table-bordered table-responsive' style='width:100%'>
                         <thead>
                           <th>RUT</th>
                           <th>USUARIO</th>
                           <th>PASAJES</th>
                         </thead>
                         <tbody>
                            <tr>";
                            $suma_pasaje='0';
                            $suma_x_persona='0';
                            $usuarios=$this->db->query_select("select tblpersonal.rut_personal,tblpersonal.nombre_personal from tblpersonal inner join tbldetalleviatico_temporal on tblpersonal.cod_personal=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
                            if($usuarios==false){
                              return array("success"=>"0","message"=>"Debe seleccionar PERSONAL");
                            }
                            foreach ($usuarios as $key2 => $value2) {
                                  $gasto_pasaje=$value['valor_pasaje'];
                                  $html.="<td style='width:10%'>".$value2['rut_personal']."</td>
                                          <td style='width:45%'>".$value2['nombre_personal']."</td>
                                          <td style='width:45%'>".$value['valor_pasaje']."</td>
                                          </tr>";
                                          $suma_pasaje=$suma_pasaje+$gasto_pasaje;
                            }
                            $html.=
                            "
                              <td>TOTAL</td>
                              <td></td>
                              <td>".$suma_pasaje."</td>
                              </tr>

                        </table>
                        </div>
                        </div>";

                      }else{
                        $html.="
                        <div class='box-body'>
                              <div class='box-header'>
                                <h3 class='box-title'>TRANSPORTE</h3>
                              </div>
                              <br>
                              <div class='col-md-3'>
                                <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='$trans' class='form-control'>
                              </div>
                              <div class='col-md-2'>
                                <label>CANTIDAD PEAJES</label><input type='text' name='textoprepeaje' id='textoprepeaje' value='".$value['num_peajes']."'  class='form-control'>
                              </div>
                              <div class='col-md-2'>
                                <label>CANTIDAD DE MOVILES</label><input type='text' name='textoprecantidad' id='textoprecantidad' value='".$value['cantidad_moviles']."'  class='form-control'>
                              <br>
                              </div>
                              <div class='col-md-2'>
                                <label>MONTO POR MOVIL</label><input type='text' name='textoprecosto' id='textoprecosto' value='".$value['cantidad_peaje']."'  class='form-control'>
                              <br>
                              </div>
                              <div class='col-md-2'>
                                <label>TOTAL</label><input type='text' name='textopretotal' id='textopretotal' value='".$value['total_pasajes']."'  class='form-control'>
                              <br>
                              </div>
                            </div>";
                        $html.="
                        <div class='box-header'>
                          <h3 class='box-title'>DETALLE DE TRANSPORTE</h3>
                          <br>
                          <br>
                        </div>
                        <div class='col-md-12'>
                        <table class='table table-bordered table-responsive' style='width:100%'>
                             <thead>
                               <th>RUT</th>
                               <th>USUARIO</th>
                               <th>PEAJES(CHOFER)</th>
                             </thead>
                             <tbody>
                                <tr>";
                                $suma_peaje='0';
                                $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,tbldetalleviatico_temporal.chofer,(select cantidad_dias from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal ) as dias from tblpersonal inner join tbldetalleviatico_temporal on tblpersonal.cod_personal=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
                                foreach ($usuarios as $key2 => $value2) {
                                      $html.="<td style='width:10%'>".$value2['rut_personal']."</td>
                                              <td style='width:30%'>".$value2['nombre_personal']."</td>";
                                              if($value2['chofer']=='1'){
                                      $html.="<td style='width:50%'>".$value['cantidad_peaje']."</td>
                                      </tr>";
                                      $gasto_peaje=$value['cantidad_peaje'];
                                              }else{
                                      $html.="<td style='width:30%'>0</td>
                                      </tr>";
                                      $gasto_peaje='0';
                                    }
                                              $suma_peaje=$suma_peaje+$gasto_peaje;

                                }
                                $html.=
                                "
                                  <td>TOTAL</td>
                                  <td></td>
                                  <td>".$suma_peaje."</td>
                              </tbody>
                            </table>
                            </div>";
                      }
                  }
                }
//FINTrasnporte---------------------------------------------------------------------------------------------------------------------------------------------------------------
                        if($value['rut_hospedaje']!=false){
                          $html.="
                          <div class='box-body'>
                                <div class='col-md-12'>
                                </div>
                                <div class='box-header'>
                                  <h3 class='box-title'>HOSPEDAJE</h3>
                                </div>
                                <br>
                                <div class='col-md-3'>
                                    <label>RUT HOSPEDAJE</label><input type='text' name='textoruthospedaje' id='textoruthospedaje' value='".$value['rut_hospedaje']."' class='form-control'>
                                </div>
                                <div class='col-md-3'>
                                    <label>NOMBRE HOSPEDAJE</label><input type='text' name='textonombrehospedaje' id='textonombrehospedaje' value='".$value['nombre_hospedaje']."'  class='form-control'>
                                </div>
                                <div class='col-md-3'>
                                    <label>DIRECCION HOSPEDAJE</label><input type='text' name='textodireccionhospedaje' id='textodireccionhospedaje' value='".$value['direccion_hospedaje']."'   class='form-control'>
                                </div>
                                <div class='col-md-12'>
                                <br>
                                <br>
                                </div>
                                <div class='col-md-12'>
                                <table class='table table-bordered table-responsive'>
                                     <thead>
                                       <th>TIPO_HABITACION</th>
                                       <th>N°_DE_HABITACIONES</th>
                                       <th>PERSONAS_POR_HABITACION</th>
                                       <th>COSTO_POR_DIA</th>
                                       <th>DIAS</th>
                                       <th>TOTAL_HABITACION</th>
                                     </thead>
                                     <tbody>
                                        <tr>";
                                        $total='0';
                                        $totaltodo='0';
                                        $dato_hospedaje=$this->db->query_select("select * from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
                                        if($dato_hospedaje==false){
                                        }else{


                                        foreach ($dato_hospedaje as $key => $value) {
                                          if($value['id_tipohospedaje']=='1'){
                                            $html.="<td>Habitacion Simple</td>";
                                          }elseif($value['id_tipohospedaje']=='2'){
                                            $html.="<td>Habitacion Doble</td>";
                                          }elseif($value['id_tipohospedaje']=='3'){
                                            $html.="<td>Habitacion Triple</td>";
                                          }else{
                                            $html.="<td>Cabaña o Depto</td>";
                                          }
                                          $total=$value['habitaciones']*$value['costo']*$value['dia'];
                                          $html.="<td>".$value['habitaciones']."</td>
                                                  <td>".$value['personas']."</td>
                                                  <td>".$value['costo']."</td>
                                                  <td>".$value['dia']."</td>
                                                  <td>".$total."</td>
                                                  <tr>";
                                                  $totaltodo=$totaltodo+$total;
                                        }
                                          }
                                        $html.="
                                        <tr>
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>".$totaltodo."</td>
                                      </tbody>
                                 </table>
                                 </div>
                                 <div class='col-md-3'>
                                   <label>PORCENTAJE DE PAGO %</label><input type='text' name='txtpago' id='txtpago' class='form-control' value=".$dato_hospedaje[0]['porcentaje'].">
                                 </div>
                                 <div class='col-md-3'>
                                   <label>SUB TOTAL</label><input type='text' name='txtsubtotal' id='txtsubtotal' class='form-control' value=".$totaltodo.">
                                 </div>";
                                   $finalresultado=($totaltodo*$dato_hospedaje[0]['porcentaje'])/100;

                                 $html.="<div class='col-md-3'>
                                   <label>TOTAL HOSPEDAJE A PAGAR</label><input type='text' name='texttotalhos' id='texttotalhos' class='form-control' value=".$finalresultado.">
                                 </div>
                                 <div class='col-md-12'>
                                 <br>
                                 <br>
                                 </div>";

                               }
                               $html.="

                             <div class='box-body'>


                                <CENTER>
                                <div class='col-md-4'>

                                </div>

                                <button id='aprobar' name='aprobar' class='btn btn-success btn-sm col-md-1' onclick='enviar()'>APROBAR</button>
                                <div class='col-sm-1'>
                                </div>
                                <button id='btnrechazar' name='btnrechazar' class='btn btn-danger btn-sm col-md-1' data-dismiss='modal' >RECHAZAR</button>
                                </CENTER>
                                 </div>";
                    $html.="</div>
                  </div>
                </div>";
                  }
              }

  return array('success' => '1', 'html'=> $html);


  }

  public function listar_proyecto($fechadesde,$fechahasta){
    $usuario=$this->user;
    $datusuario=$usuario['id_user'];
    $perfil=$this->db->query_select("select perfil from users where id_user='$datusuario'");

    if($perfil[0][0]=='CONTROL_INGRESO'){
      return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion,(select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where id_user='$datusuario' and tblcontrol_proyectos.estado='0' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
    }elseif($perfil[0][0]=='CONTROL_PREVALIDADOR'){
          return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion,(select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='0' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
        }elseif($perfil[0][0]=='CONTROL_VALIDADOR'){
              return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion,(select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='1' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
        }elseif($perfil[0][0]=='CONTROL_CONTADOR'){
          return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion,(select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='4' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
        }elseif($perfil[0][0]=='CONTROL_ADMIN'){
              return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion,(select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where fecha_ingreso between '$fechadesde' and '$fechahasta'");
      }else{
      return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion,(select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where fecha_ingreso between '2018-08-01' and '$fechahasta' ORDER BY fecha_ingreso desc limit 10");
    }
    }

  public function usuariotemporalsum(){
     global $http;
     $datusu=$this->user;
     $datousuario=$datusu['id_user'];
     $id=$http->request->get('id');
     $this->db->insert('tbldetalleviatico_temporal', array(
       'id_user'=>$id,
       'user_registra'=>$datousuario
     ));
  }

  public function usuariotemporalres(){
     global $http;
     $datusu=$this->user;
     $datousuario=$datusu['id_user'];
     $id=$http->request->get('id');
     $this->db->query_select("delete from tbldetalleviatico_temporal where id_user='$id' and user_registra='$datousuario'");
  }

  public function cargarresultado(){
      global $http;
      $localidades=$http->request->get('localidades');
      $area=$http->request->get('area');
      $opcion=$http->request->get('res');
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
      $fecha=date('Y-m-d');
      $this->db->query_select("delete from tblvistatemporal where user_reg='$datousuario'");

      if($opcion=='1'){
        $datos=$this->db->query_select("select * from tblvaloresmaximos where id_localidad='$localidades' and id_area='$area'");
        $html="<div class='box'>
                <div class='box-header'>
               <h3 class='box-title'>Transporte</h3>
                &nbsp
                &nbsp
               <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(1)' checked='checked'>BUS</label>
               &nbsp
               <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(2)'>AVION</label>
               &nbsp
               <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(3)'>MOVIL</label>
               </div>
               <div class='box-body'>
               <div class='col-md-4'>
                 <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='$fecha'>
               </div>
               <div class='col-md-4'>
                 <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='calc_dias(2)' class='form-control'  VALUE='$fecha'>
               </div>
               <div class='col-md-4'>
                <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' value='' class='form-control'>
                </div>
               <div class='col-md-4'>
               <br>
               <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                Seleccionar Personal
               </a>
               </div>
               <div class='col-md-4'>
               <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
                </div>
               <div class='col-md-4'>
               <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
               <br>
               </div>
               <input type='hidden' id='textprincipal' name='textprincipal' value='2'>
               <div class='col-md-12' id='divpersonaltransporte' name='divpersonaltransporte'></div>
               <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
               </div>
               </div>";

               return array('success'=>1, 'html'=>$html);
      }elseif($opcion=='2'){
        $html="<div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Transporte</h3>
                &nbsp
                &nbsp
                <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(1)'>BUS</label>
                &nbsp
                <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(2)'  checked='checked'>AVION</label>
                &nbsp
                <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(3)'>MOVIL</label>
                </div>
                <div class='box-body'>
                <div class='col-md-4'>
                  <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='$fecha'>
                </div>
                <div class='col-md-4'>
                  <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='calc_dias(2)' class='form-control'  VALUE='$fecha'>
                </div>
                <div class='col-md-4'>
                    <label>Valor Pasaje Avion</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
                </div>
                <div class='col-md-4'>
                <br>
                <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                 Seleccionar Personal
                </a>
                </div>
                <div class='col-md-4'>
                    <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
                </div>
                <div class='col-md-4'>
                    <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                   <br>
                </div>
                <input type='hidden' id='textprincipal' name='textprincipal' value='2'>
                <div class='col-md-12' id='divpersonaltransporte' name='divpersonaltransporte'></div>

                    <input type='hidden' id='txtopcion' name='txtopcion' value='2'>
              </div>
          </div>";
          return array('success'=>1, 'html'=>$html);
        }elseif($opcion=='3'){
          $html="<div class='box'>
                  <div class='box-header'>
                  <h3 class='box-title'>Transporte</h3>
                  &nbsp
                  &nbsp
                  <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(1)'>BUS</label>
                  &nbsp
                  <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(2)'>AVION</label>
                  &nbsp
                  <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(3)' checked='checked'>MOVIL</label>
                  </div>
                  <div class='box-body'>
                  <div class='col-md-4'>
                    <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='$fecha'>
                  </div>
                  <div class='col-md-4'>
                    <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='calc_dias(2)' class='form-control'  VALUE='$fecha'>
                  </div>
                  <div class='col-md-4'>
                      <label>Monto para peajes</label><input type='Number' name='txtmontopeaje' id='txtmontopeaje' value='' onfocusout=calcularmovil() class='form-control'>
                  </div>
                  <div class='col-md-4'>
                  <br>
                  <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                   Seleccionar Personal
                  </a>
                  </div>
                  <div class='col-md-4'>
                      <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
                  </div>
                  <div class='col-md-4'>
                      <label>Numero de Moviles</label><input type='Number' name='txtcantmovil' id='txtcantmovil' onfocusout='calcularmovilychofer()' class='form-control'>
                  </div>
                  <div class='col-md-4'>
                  </div>
                  <div class='col-md-4'>
                      <label>Cantidad peaje</label><input type='Number' name='txtpeajes' id='txtpeajes' value='' class='form-control'>
                  </div>
                  <div class='col-md-4'>
                      <label>Total transporte</label><input type='Number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                      <br>
                  </div>
                      <input type='hidden' id='txtopcion' name='txtopcion' value='3'>
                      <input type='hidden' id='textprincipal' name='textprincipal' value='2'>
                      <div class='col-md-12' id='divmovil' name='divmovil'>
                      </div>
                </div>
            </div>";
            return array('success'=>1, 'html'=>$html);
      }elseif($opcion=='4'){
        $html2="<div class='box'>
                <div class='box-header'>
               <h3 class='box-title'>Transporte</h3>
                &nbsp
                &nbsp
               <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(4)' checked='checked'>BUS</label>
               &nbsp
               <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(5)'>AVION</label>
               &nbsp
               <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(6)'>MOVIL</label>
               </div>
               <div class='box-body'>
               <div class='col-md-4'>
                <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
                </div>
               <div class='col-md-4'>
               <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
               </div>
               <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
               </div>
               </div>";
               return array('success'=>2, 'html2'=>$html2);
           }elseif($opcion=='5'){
             $html2="<div class='box'>
                     <div class='box-header'>
                    <h3 class='box-title'>Transporte</h3>
                     &nbsp
                     &nbsp
                    <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(4)'>BUS</label>
                    &nbsp
                    <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(5)'  checked='checked'>AVION</label>
                    &nbsp
                    <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(6)'>MOVIL</label>
                    </div>
                    <div class='box-body'>
                    <div class='col-md-4'>
                     <label>Valor Pasaje Avion ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
                     </div>
                    <div class='col-md-4'>
                    <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                    </div>
                    <input type='hidden' id='txtopcion' name='txtopcion' value='2'>
                    </div>
                    </div>";
                    return array('success'=>2, 'html2'=>$html2);
               }elseif($opcion=='6'){
                    $html2="<div class='box'>
                            <div class='box-header'>
                            <h3 class='box-title'>Transporte</h3>
                            &nbsp
                            &nbsp
                            <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(4)'>BUS</label>
                            &nbsp
                            <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(5)'>AVION</label>
                            &nbsp
                            <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(6)' checked='checked'>MOVIL</label>
                            </div>
                            <div class='box-body'>
                              <div class='col-md-4'>
                                  <label>Monto para peajes</label><input type='Number' name='txtmontopeaje' id='txtmontopeaje' value='' onfocusout=calcularmovilychofer() class='form-control'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Cantidad peaje</label><input type='Number' name='txtpeajes' id='txtpeajes' value='' class='form-control'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Numero de Moviles</label><input type='Number' name='txtcantmovil' id='txtcantmovil' onfocusout='calcularmovilychofer()' class='form-control'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Total transporte</label><input type='Number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                  <br>
                              </div>
                                <input type='hidden' id='txtopcion' name='txtopcion' value='3'>
                                <input type='hidden' id='txtnummovil' name='txtnummovil' value='3'>
                                <div class='col-md-12' id='divmovil' name='divmovil'>
                                </div>
                          </div>
                      </div>";
                      return array('success'=>2, 'html2'=>$html2);

                    }elseif($opcion=='7'){
                              $html2="<div class='box'>
                                      <div class='box-header'>
                                      <h3 class='box-title'>Transporte BUS</h3>
                                      &nbsp
                                      &nbsp
                                     <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(7)' checked='checked'>BUS</label>
                                     &nbsp
                                     <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(8)'>AVION</label>
                                     &nbsp
                                     <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(9)'>MOVIL</label>
                                     </div>
                                     <div class='box-body'>
                                     <div class='col-md-4'>
                                      <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
                                      </div>
                                     <div class='col-md-4'>
                                     <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                     </div>
                                     <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
                                     </div>
                                     </div>";
                                     return array('success'=>2, 'html2'=>$html2);
                        }elseif($opcion=='8'){
                          $html2="<div class='box'>
                                  <div class='box-header'>
                                 <h3 class='box-title'>Transporte AVION</h3>
                                  &nbsp
                                  &nbsp
                                 <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(7)'>BUS</label>
                                 &nbsp
                                 <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(8)'  checked='checked'>AVION</label>
                                 &nbsp
                                 <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(9)'>MOVIL</label>
                                 </div>
                                 <div class='box-body'>
                                 <div class='col-md-4'>
                                  <label>Valor Pasaje Avion ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
                                  </div>
                                 <div class='col-md-4'>
                                 <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                 </div>
                                 <input type='hidden' id='txtopcion' name='txtopcion' value='2'>
                                 </div>
                                 </div>";
                                 return array('success'=>2, 'html2'=>$html2);
                  }elseif($opcion=='9'){
                       $html2="<div class='box'>
                               <div class='box-header'>
                               <h3 class='box-title'>Transporte MOVIL</h3>
                               &nbsp
                               &nbsp
                               <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(7)'>BUS</label>
                               &nbsp
                               <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(8)'>AVION</label>
                               &nbsp
                               <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(9)' checked='checked'>MOVIL</label>
                               </div>
                               <div class='box-body'>
                                 <div class='col-md-4'>
                                     <label>Monto para peajes</label><input type='Number' name='txtmontopeaje' id='txtmontopeaje' value='' onfocusout=calcularmovilychofer() class='form-control'>
                                 </div>
                                 <div class='col-md-4'>
                                     <label>Cantidad peaje</label><input type='Number' name='txtpeajes' id='txtpeajes' value='' class='form-control'>
                                 </div>
                                 <div class='col-md-4'>
                                     <label>Numero de Moviles</label><input type='Number' name='txtcantmovil' id='txtcantmovil' onfocusout='calcularmovilychofer()' class='form-control'>
                                 </div>
                                 <div class='col-md-4'>
                                     <label>Total transporte</label><input type='Number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                     <br>
                                 </div>
                                   <input type='hidden' id='txtopcion' name='txtopcion' value='3'>
                                   <input type='hidden' id='txtnummovil' name='txtnummovil' value='0'>
                                   <div class='col-md-12' id='divmovil' name='divmovil'>
                                   </div>
                             </div>
                         </div>";
                         return array('success'=>2, 'html2'=>$html2);
                       }

}



public function selec_usuarios_viatico($num_proyecto){
  return $this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico.id_usuarios, tblpersonal.cargo_personal from tbldetalleviatico inner join tblpersonal on tbldetalleviatico.id_usuarios=tblpersonal.cod_personal where id_detalleproyecto='$num_proyecto'");
}


public function consultar_orden(){
  global $http;
  $id=$http->request->get('id');
  $orden=$this->db->query_select("select tbllocalidades.descripcion,tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,tblcontrol_proyectos.descrip_proyecto,tblcontrol_proyectos.nodocuadrante,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.cant_personas,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.fecha_ingreso,tblcontrol_proyectos.id_user,(select email from users inner join tblcontrol_proyectos tblcon2 on users.id_user=tblcon2.id_user where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto) as correo, tblcontrol_proyectos.observacion,tblcontrol_proyectos.usuario_aprueba from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where id_proyecto='$id'");
  foreach ($orden as $key => $value) {
  $html="<div class='box'>
          <div class='col-md-10'>
            <div class='box'>
              <div class='box-body'>
                <div class='box-header'>
                  <h3 class='box-title'>DATOS</h3>
                </div>
                <br>
                <div class='col-md-6'>
                  <label>CODIGO PROYECTO</label><input type='text' name='textocodigo' id='textocodigo' value='".$value['num_proyecto']."' class='form-control'>
                </div>
                <div class='col-md-6'>
                   <label>CODIGO LOCALIDAD</label><input type='text' name='textocodigolocalidad' id='textocodigolocalidad' value='".$value['descripcion']."'  class='form-control'>
                </div>
                <div class='col-md-12'>
                 <br>
                </div>
                <div class='col-md-4'>
                  <label>Solicitante</label><input type='text' name='textsolicitante' id='textsolicitante' value='".$value['correo']."' class='form-control'>
                </div>
                <div class='col-md-4'>
                   <label>AREA</label><input type='text' name='textarea' id='textarea' value='".$value['area']."'  class='form-control'>
                </div>
                <div class='col-md-4'>
                  <label>DESCRIPCION PROYECTO</label><input type='text' name='textdescripcion' id='textdescripcion' value='".$value['descrip_proyecto']."' class='form-control'>
                </div>
                <div class='col-md-12'>
                 <br>
                </div>
                <div class='col-md-3'>
                  <label>FECHA INICIO</label><input type='text' name='textofechainicio' id='textofechainicio' value='".$value['fecha_inicio']."'  class='form-control'>
                </div>
                <div class='col-md-3'>
                  <label>FECHA FINAL</label><input type='text' name='textofechafinal' id='textofechafinal' value='".$value['fecha_final']."'  class='form-control'>
                </div>
                <div class='col-md-3'>
                  <label>CANTIDAD PERSONAS</label><input type='text' name='textocantidadpersonas' id='textocantidadpersonas' value='".$value['cant_personas']."'  class='form-control'>
                </div>";
                if($value['cant_dias']==0){
                  $html.="<div class='col-md-3'>
                        <label>CANTIDAD DE DIAS</label><input type='text' name='textocantidaddias' id='textocantidaddias' value='".$value['cant_dias_hospedaje']."'  class='form-control'>
                    </div>";
                }else{
                $html.="<div class='col-md-3'>
                    <label>CANTIDAD DE DIAS</label><input type='text' name='textocantidaddias' id='textocantidaddias' value='".$value['cant_dias']."'  class='form-control'>
                </div>";
                }
                $html.="<div class='col-md-12'>
                  <br>
                </div>
                <div class='col-md-12'>
                </div>";
                $transporte=$this->db->query_select("select precio_pasaje,tipo_transporte from tbldetalletransporte where id_detalletransporte='".$value['num_proyecto']."'");
                if($transporte==false){
                    $peaje=$this->db->query_select("select tbldetallemovil.cant_movil,tbldetallemovil.cantidad_peajes,tbldetallemovil.costo_movil from tbldetallemovil where id_detallemovil='".$value['num_proyecto']."'");
                    $viatico=$this->db->query_select("select DISTINCT tbldetalleviatico.montoviaticopp from tbldetalleviatico where id_detalleproyecto='".$value['num_proyecto']."'");
                    if($peaje[0]['cant_movil']!=0){
                    foreach ($peaje as $key3 => $value3) {
                    $total=$value3['costo_movil']*$value3['cant_movil'];
                    if($total==false){
                      $html.="<div class='box-header'>
                        <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                        <br>
                        <br>
                      </div>
                      <div class='col-md-12'>
                      <table class='table table-bordered table-responsive'>
                           <thead>
                             <th>RUT</th>
                             <th>USUARIO</th>
                             <th>VIATICO</th>
                             <th>ORDEN ASOCIADA</th>
                           </thead>
                           <tbody>
                              <tr>";
                              $valorviatico='0';
                              $viaticopp='0';
                              $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.cant_dias,tbldetalleviatico.idasociada from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                              foreach ($usuarios as $key2 => $value2) {
                                    $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                    $html.="<td>".$value2['rut_personal']."</td>
                                            <td>".$value2['nombre_personal']."</td>
                                            <td>".$viaticopp."</td>";
                                            if($value2['idasociada']==false){
                                            $html.="<td>NO APLICA</td>";
                                            }else{
                                            $html.="<td>".$value2['idasociada']."</td>";
                                            }
                                            $html.="</tr>";
                                            $valorviatico=$valorviatico+$viaticopp;
                              }
                              $html.=
                              "<tr>
                                <td>TOTAL</td>
                                <td></td>
                                <td>".$valorviatico."</td>
                            </tbody>
                          </table>
                          </div>";


                    }else{
                    $html.="
                          <div class='box-header'>
                            <h3 class='box-title'>TRANSPORTE</h3>
                          </div>
                            <br>
                          <div class='col-md-2'>
                              <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='MOVIL' class='form-control'>
                          </div>
                          <div class='col-md-2'>
                              <label>CANTIDAD MOVILES</label><input type='text' name='textocantidadmovil' id='textocantidadmovil' value='".$value3['cant_movil']."'  class='form-control'>
                          </div>
                          <div class='col-md-2'>
                              <label>VALOR PEAJES</label><input type='text' name='textovalorpeaje' id='textovalorpeaje' value='".$value3['costo_movil']."'  class='form-control'>
                          </div>
                          <div class='col-md-2'>
                              <label>CANTIDAD DE PEAJES</label><input type='text' name='textocantidadpeaje' id='textocantidadpeaje' value='".$value3['cantidad_peajes']."'  class='form-control'>
                          </div>
                          <div class='col-md-2'>
                              <label>TOTAL TRANSPORTE</label><input type='text' name='textototaltrans' id='textototaltrans' value='$total'  class='form-control'>
                              <br>
                          </div>
                          <div class='box-header'>
                            <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                            <br>
                            <br>
                          </div>
                          <div class='col-md-12'>
                          <table class='table table-bordered table-responsive'>
                               <thead>
                                 <th>RUT</th>
                                 <th>USUARIO</th>
                                 <th>VIATICO</th>
                                 <th>PEAJES(CHOFER)</th>
                                 <th>TOTAL_POR_PERSONA</th>
                                 <th>ORDEN ASOCIADA</th>
                               </thead>
                               <tbody>
                                  <tr>";
                                  $valorviatico='0';
                                  $viaticopp='0';
                                  $valormovil='0';
                                  $suma_peaje='0';
                                  $suma_x_persona='0';
                                  $totaltodo='0';
                                  $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.chofer, tbldetallemovil.costo_movil,tbldetalleviatico.cant_dias, (select idasociada from tblcalculotemporal inner join tblpersonal tblpers2 on tblcalculotemporal.id_usuario=tblpers2.cod_personal where tblpers2.cod_personal=tblpersonal.cod_personal and idasociada!='".$value['num_proyecto']."') as idasociada from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                  if($usuarios[0]['montoviaticopp']!=0){
                                  foreach ($usuarios as $key2 => $value2) {
                                        $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                        $html.="<td>".$value2['rut_personal']."</td>
                                                <td>".$value2['nombre_personal']."</td>
                                                <td>".$viaticopp."</td>";
                                                if($value2['chofer']=='1'){
                                        $html.="<td>".$value2['costo_movil']."</td>";
                                                $valormovil=$value2['costo_movil'];
                                                }else{
                                        $html.="<td>0</td>";
                                               $valormovil='0';
                                                }
                                                $suma_x_persona=$viaticopp+$valormovil;
                                        $html.="<td>".$suma_x_persona."</td>";
                                                if($value2['idasociada']==false){
                                                $html.="<td style='width:20%'>NO APLICA</td>";
                                                }else{
                                                $html.="<td style='width:20%'>".$value2['idasociada']."</td>";
                                                }
                                                $html.="</tr>";
                                                $valorviatico=$valorviatico+$viaticopp;
                                                $suma_peaje=$suma_peaje+$valormovil;
                                        $totaltodo=$totaltodo+$suma_x_persona;
                                  }
                                  $html.=
                                  "<tr>
                                    <td>TOTAL</td>
                                    <td></td>
                                    <td>".$valorviatico."</td>
                                    <td>".$suma_peaje."</td>
                                    <td>".$totaltodo."</td>
                                </tbody>
                              </table>
                              </div>";
                                }else{
                                  foreach ($usuarios as $key2 => $value2) {
                                        $html.="<td>".$value2['rut_personal']."</td>
                                                <td>".$value2['nombre_personal']."</td>
                                                <td>0</td>";
                                                if($value2['chofer']=='1'){
                                        $html.="<td>".$value2['costo_movil']."</td>";
                                                $valormovil=$valormovil+$value2['costo_movil'];
                                                }else{
                                        $html.="<td>0</td>";
                                               $valormovil='0';
                                                }

                                        $html.="<td>".$valormovil."</td>
                                          <td>".$value2['idasociada']."</td>
                                          <td>".$value2['idasociada']."</td>
                                                </tr>";
                                  $totaltodo=$totaltodo+$valormovil;
                                }


                                  $html.=
                                  "<tr>
                                    <td>TOTAL</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>".$totaltodo."</td>
                                    <td>".$totaltodo."</td>
                                </tbody>
                              </table>
                              </div>";
                            }
                        }
                      }
                    }elseif($viatico[0]['montoviaticopp']!=false){
                      foreach ($peaje as $key3 => $value3) {
                      $total=$value3['costo_movil']*$value3['cant_movil'];
                      if($total==false){
                        $html.="<div class='box-header'>
                          <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                          <br>
                          <br>
                        </div>
                        <div class='col-md-12'>
                        <table class='table table-bordered table-responsive'>
                             <thead>
                               <th>RUT</th>
                               <th>USUARIO</th>
                               <th>VIATICO</th>
                               <th>ORDEN ASOCIADA</th>
                             </thead>
                             <tbody>
                                <tr>";
                                $valorviatico='0';
                                $viaticopp='0';
                                $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.cant_dias,tbldetalleviatico.idasociada from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                foreach ($usuarios as $key2 => $value2) {
                                      $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                      $html.="<td>".$value2['rut_personal']."</td>
                                              <td>".$value2['nombre_personal']."</td>
                                              <td>".$viaticopp."</td>";
                                              if($value2['idasociada']==false){
                                              $html.="<td>NO APLICA</td>";
                                              }else{
                                              $html.="<td>".$value2['idasociada']."</td>";
                                              }
                                              $html.="</tr>";
                                              $valorviatico=$valorviatico+$viaticopp;
                                }
                                $html.=
                                "<tr>
                                  <td>TOTAL</td>
                                  <td></td>
                                  <td>".$valorviatico."</td>
                              </tbody>
                            </table>
                            </div>";


                      }else{
                      $html.="
                            <div class='box-header'>
                              <h3 class='box-title'>TRANSPORTE</h3>
                            </div>
                              <br>
                            <div class='col-md-2'>
                                <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='MOVIL' class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>CANTIDAD MOVILES</label><input type='text' name='textocantidadmovil' id='textocantidadmovil' value='".$value3['cant_movil']."'  class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>VALOR PEAJES</label><input type='text' name='textovalorpeaje' id='textovalorpeaje' value='".$value3['costo_movil']."'  class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>CANTIDAD DE PEAJES</label><input type='text' name='textocantidadpeaje' id='textocantidadpeaje' value='".$value3['cantidad_peajes']."'  class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>TOTAL TRANSPORTE</label><input type='text' name='textototaltrans' id='textototaltrans' value='$total'  class='form-control'>
                                <br>
                            </div>
                            <div class='box-header'>
                              <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                              <br>
                              <br>
                            </div>
                            <div class='col-md-12'>
                            <table class='table table-bordered table-responsive'>
                                 <thead>
                                   <th>RUT</th>
                                   <th>USUARIO</th>
                                   <th>VIATICO</th>
                                   <th>PEAJES(CHOFER)</th>
                                   <th>TOTAL_POR_PERSONA</th>
                                   <th>ORDEN ASOCIADA</th>
                                 </thead>
                                 <tbody>
                                    <tr>";
                                    $valorviatico='0';
                                    $viaticopp='0';
                                    $valormovil='0';
                                    $suma_peaje='0';
                                    $suma_x_persona='0';
                                    $totaltodo='0';
                                    $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.cant_dias,tbldetalleviatico.chofer, tbldetallemovil.costo_movil from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                    if($usuarios[0]['montoviaticopp']!=0){
                                    foreach ($usuarios as $key2 => $value2) {
                                          $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                          $html.="<td>".$value2['rut_personal']."</td>
                                                  <td>".$value2['nombre_personal']."</td>
                                                  <td>".$viaticopp."</td>";
                                                  if($value2['chofer']=='1'){
                                          $html.="<td>".$value2['costo_movil']."</td>";
                                                  $valormovil=$value2['costo_movil'];
                                                  }else{
                                          $html.="<td>0</td>";
                                                 $valormovil='0';
                                                  }
                                                  $suma_x_persona=$viaticopp+$valormovil;
                                          $html.="<td>".$suma_x_persona."</td>
                                                  </tr>";
                                                  $valorviatico=$valorviatico+$viaticopp;
                                                  $suma_peaje=$suma_peaje+$valormovil;
                                          $totaltodo=$totaltodo+$suma_x_persona;
                                    }
                                    $html.=
                                    "<tr>
                                      <td>TOTAL</td>
                                      <td></td>
                                      <td>".$valorviatico."</td>
                                      <td>".$suma_peaje."</td>
                                      <td>".$totaltodo."</td>
                                  </tbody>
                                </table>
                                </div>";
                                  }else{
                                    foreach ($usuarios as $key2 => $value2) {
                                          $html.="<td>".$value2['rut_personal']."</td>
                                                  <td>".$value2['nombre_personal']."</td>
                                                  <td>0</td>";
                                                  if($value2['chofer']=='1'){
                                          $html.="<td>".$value2['costo_movil']."</td>";
                                                  $valormovil=$valormovil+$value2['costo_movil'];
                                                  }else{
                                          $html.="<td>0</td>";
                                                 $valormovil='0';
                                                  }

                                          $html.="<td>".$valormovil."</td>
                                                  </tr>";
                                    $totaltodo=$totaltodo+$valormovil;
                                  }


                                    $html.=
                                    "<tr>
                                      <td>TOTAL</td>
                                      <td></td>
                                      <td>0</td>
                                      <td>".$totaltodo."</td>
                                      <td>".$totaltodo."</td>
                                  </tbody>
                                </table>
                                </div>";
                              }
                          }
                        }
                    }else{

                    }
                 }else{
                    foreach ($transporte as $key3 => $value3) {
                    if($value3['tipo_transporte']=='1'){
                      $trans='BUS';
                    }elseif($value3['tipo_transporte']=='2'){
                      $trans='AVION';
                    }else{
                      $trans='MOVIL';
                    }
                    $totalpasaje=$value3['precio_pasaje']*$value['cant_personas'];
                    $html.="
                    </div>
                      <div class='box-body'>
                        <div class='box-header'>
                          <h3 class='box-title'>TRANSPORTE</h3>
                        </div>
                        <br>
                        <div class='col-md-3'>
                          <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='$trans' class='form-control'>
                        </div>
                        <div class='col-md-3'>
                          <label>VALOR PASAJES P/P</label><input type='text' name='textoprepasaje' id='textoprepasaje' value='".$value3['precio_pasaje']."'  class='form-control'>
                        </div>
                        <div class='col-md-3'>
                          <label>TOTAL PASAJES</label><input type='text' name='textototalpasaje' id='textototalpasaje' value='$totalpasaje'  class='form-control'>
                          <br>
                          <br>
                        </div>
                        <div class='box-header'>
                          <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                          <br>
                          <br>
                        </div>
                        <div class='col-md-12'>
                           <table class='table table-bordered table-responsive' >
                             <thead>
                             <th>RUT</th>
                             <th>USUARIO</th>
                             <th>VIATICO</th>
                             <th>PASAJES</th>
                             <th>TOTAL_POR_PERSONA</th>
                             <th>ORDEN ASOCIADA</th>
                             </thead>
                             <tbody>
                                <tr>";
                                $suma='0';
                                $total_x_pp='0';
                                $totalpasa='0';
                                $totalpp='0';
                                $cantusuarios=$this->db->query_select("select tbldetalleviatico.id_usuarios,tbldetalleviatico.cant_dias,(select tbldetalletransporte.precio_pasaje from tbldetalletransporte inner join tblcontrol_proyectos tblpro2 on tbldetalletransporte.id_detalletransporte=tblpro2.num_proyecto where tblcontrol_proyectos.id_proyecto=tblpro2.id_proyecto) as pasaje,tbldetalleviatico.montoviaticopp,tbldetalleviatico.idasociada from tbldetalleviatico inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.num_proyecto where id_detalleviatico='".$value['num_proyecto']."'");
                                foreach ($cantusuarios as $key2 => $value2) {
                                      $nomusuarios=$this->db->query_select("select rut_personal,nombre_personal from tblpersonal where cod_personal='".$value2['id_usuarios']."'");
                                      $gasto=$value2['montoviaticopp']*$value2['cant_dias'];
                                      $total_x_pp=$gasto+$value2['pasaje'];
                                      $html.="<td>".$nomusuarios[0][0]."</td>
                                              <td>".$nomusuarios[0][1]."</td>
                                              <td>".$gasto."</td>
                                              <td>".$value2['pasaje']."</td>
                                              <td>".$total_x_pp."</td>";
                                              if($value2['idasociada']==false){
                                              $html.="<td>NO APLICA</td>";
                                              }else{
                                              $html.="<td>".$value2['idasociada']."</td>";
                                              }
                                              $html.="</tr>";
                                              $totalpasa=$totalpasa+$value2['pasaje'];
                                              $suma=$suma+$gasto;
                                              $totalpp=$totalpp+$total_x_pp;
                                }
                                $html.=
                                "<tr>
                                  <td>TOTAL</td>
                                  <td></td>
                                  <td>".$suma."</td>
                                  <td>".$totalpasa."</td>
                                  <td>".$totalpp."</td>
                              </tbody>
                            </table>
                        </div>";

                    }
                  }

                     $hospedaje=$this->db->query_select("select * from tbldetallehospedaje where id_detallehospedaje='".$value['num_proyecto']."' limit 1");
                     if($hospedaje!=false){
                       foreach ($hospedaje as $key4 => $value4) {
                         $totalhospedaje=$value4['costo_dia']*$value['cant_dias'];
                     $html.="
                     </div>
                     <div class='box-body'>
                           <div class='col-md-12'>
                           </div>
                           <div class='box-header'>
                             <h3 class='box-title'>HOSPEDAJE</h3>
                           </div>
                           <br>
                           <div class='col-md-3'>
                               <label>RUT HOSPEDAJE</label><input type='text' name='textoruthospedaje' id='textoruthospedaje' value='".$value4['rut_hospedaje']."' class='form-control'>
                           </div>
                           <div class='col-md-3'>
                               <label>NOMBRE HOSPEDAJE</label><input type='text' name='textonombrehospedaje' id='textonombrehospedaje' value='".$value4['nombre_hospedaje']."'  class='form-control'>
                           </div>
                           <div class='col-md-3'>
                               <label>DIRECCION HOSPEDAJE</label><input type='text' name='textodireccionhospedaje' id='textodireccionhospedaje' value='".$value4['direccion_hospedaje']."'   class='form-control'>
                           </div>
                           <div class='col-md-12'>
                           <br>
                           </div>
                           <div class='col-md-12'>
                           <br>
                           </div>
                           <div class='col-md-12'>
                           <table class='table table-bordered table-responsive'>
                                <thead>
                                  <th>TIPO_HABITACION</th>
                                  <th>N°_DE_HABITACIONES</th>
                                  <th>COSTO_HABITACION</th>
                                  <th>CANTIDAD_DIAS</th>
                                  <th>TOTAL</th>
                                </thead>
                                <tbody>
                                   <tr>";
                                   $costop='0';
                                   $totalp='0';
                                   $hospedaje=$this->db->query_select("select DISTINCT tipo_hospedaje,cant_habitaciones,costo_dia,dias,porcentaje from tbldetallehospedaje where id_detallehospedaje='".$value['num_proyecto']."' order by tipo_hospedaje asc");
                                   foreach ($hospedaje as $key => $value4) {
                                     if($value4['tipo_hospedaje']=='1'){
                                        $html.="<td>Habitacion simple</td>";
                                     }elseif($value4['tipo_hospedaje']=='2'){
                                           $html.="<td>Habitacion doble</td>";
                                     }elseif($value4['tipo_hospedaje']=='3'){
                                            $html.="<td>Habitacion triple</td>";
                                     }else{
                                            $html.="<td>Cabaña o Depto </td>";
                                     }
                                     $costop=$value4['cant_habitaciones']*$value4['costo_dia']*$value4['dias'];
                                   $html.="<td>".$value4['cant_habitaciones']."</td>
                                           <td>".$value4['costo_dia']."</td>
                                           <td>".$value4['dias']."</td>
                                           <td>".$costop."</td>
                                   </tr>";
                                   $totalp=$totalp+$costop;

                                   }
                                   $html.="
                                   <tr>
                                   <td>TOTAL</td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td>$totalp</td>
                                 </tbody>
                            </table>
                            </div>
                            <div class='col-md-3'>
                              <label>PORCENTAJE DE PAGO %</label><input type='text' name='txtpago' id='txtpago' class='form-control' value=".$hospedaje[0]['porcentaje'].">
                            </div>
                            <div class='col-md-3'>
                              <label>SUB TOTAL</label><input type='text' name='txtsubtotal' id='txtsubtotal' class='form-control' value=".$totalp.">
                            </div>";
                              $finalresultado=($totalp*$hospedaje[0]['porcentaje'])/100;

                            $html.="<div class='col-md-3'>
                              <label>TOTAL HOSPEDAJE A PAGAR</label><input type='text' name='texttotalhos' id='texttotalhos' class='form-control' value=".$finalresultado.">
                            </div>
                            <div class='col-md-12'>
                            <br>
                            </div>";


                         }
                       }
                       $html.="
                       <div class='col-md-12'>
                       <br>
                       <br>
                       </div>";
                      $html.="</div>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                </div>
            </div>
          </div>
        </div>";
  }
  return array('success'=>'1', 'html'=> $html);
}

public function aprobar_orden(){
  global $http;
  $id=$http->request->get('id');
  $orden=$this->db->query_select("select *,tbllocalidades.descripcion from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where id_proyecto='$id'");
  foreach ($orden as $key => $value) {
  $html="<div class='box'>
          <div class='col-md-10'>
            <div class='box'>
              <div class='box-body'>
                <div class='box-header'>
                  <h3 class='box-title'>DATOS</h3>
                </div>
                <br>
                <div class='col-md-6'>
                  <label>CODIGO PROYECTO</label><input type='text' name='textocodigo' id='textocodigo' value='".$value['num_proyecto']."' class='form-control'>
                </div>
                <div class='col-md-6'>
                   <label>CODIGO LOCALIDAD</label><input type='text' name='textocodigolocalidad' id='textocodigolocalidad' value='".$value['descripcion']."'  class='form-control'>
                </div>
                <div class='col-md-12'>
                 <br>
                </div>
                <div class='col-md-6'>
                   <label>AREA</label><input type='text' name='textarea' id='textarea' value='".$value['area']."'  class='form-control'>
                </div>
                <div class='col-md-6'>
                  <label>DESCRIPCION PROYECTO</label><input type='text' name='textdescripcion' id='textdescripcion' value='".$value['descrip_proyecto']."' class='form-control'>
                </div>
                <div class='col-md-12'>
                 <br>
                </div>
                <div class='col-md-3'>
                  <label>FECHA INICIO</label><input type='text' name='textofechainicio' id='textofechainicio' value='".$value['fecha_inicio']."'  class='form-control'>
                </div>
                <div class='col-md-3'>
                  <label>FECHA FINAL</label><input type='text' name='textofechafinal' id='textofechafinal' value='".$value['fecha_final']."'  class='form-control'>
                </div>
                <div class='col-md-3'>
                  <label>CANTIDAD PERSONAS</label><input type='text' name='textocantidadpersonas' id='textocantidadpersonas' value='".$value['cant_personas']."'  class='form-control'>
                </div>";
                if($value['cant_dias']==0){
                  $html.="<div class='col-md-3'>
                        <label>CANTIDAD DE DIAS</label><input type='text' name='textocantidaddias' id='textocantidaddias' value='".$value['cant_dias_hospedaje']."'  class='form-control'>
                    </div>";
                }else{
                $html.="<div class='col-md-3'>
                    <label>CANTIDAD DE DIAS</label><input type='text' name='textocantidaddias' id='textocantidaddias' value='".$value['cant_dias']."'  class='form-control'>
                </div>";
                }
                $html.="<div class='col-md-12'>
                  <br>
                </div>
                <div class='col-md-12'>
                </div>";
                        $transporte=$this->db->query_select("select precio_pasaje,tipo_transporte from tbldetalletransporte where id_detalletransporte='".$value['num_proyecto']."'");
                        if($transporte==false){
                            $peaje=$this->db->query_select("select tbldetallemovil.cant_movil,tbldetallemovil.cantidad_peajes,tbldetallemovil.costo_movil from tbldetallemovil where id_detallemovil='".$value['num_proyecto']."'");
                            $viatico=$this->db->query_select("select DISTINCT tbldetalleviatico.montoviaticopp from tbldetalleviatico where id_detalleproyecto='".$value['num_proyecto']."'");
                            if($peaje[0]['cant_movil']!=0){
                            foreach ($peaje as $key3 => $value3) {
                            $total=$value3['costo_movil']*$value3['cant_movil'];
                            if($total==false){
                              $html.="<div class='box-header'>
                                <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                                <br>
                                <br>
                              </div>
                              <div class='col-md-12'>
                              <table class='table table-bordered table-responsive'>
                                   <thead>
                                     <th>RUT</th>
                                     <th>USUARIO</th>
                                     <th>VIATICO</th>
                                     <th>ORDEN ASOCIADA</th>
                                   </thead>
                                   <tbody>
                                      <tr>";
                                      $valorviatico='0';
                                      $viaticopp='0';
                                      $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.cant_dias from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                      foreach ($usuarios as $key2 => $value2) {
                                            $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                            $html.="<td>".$value2['rut_personal']."</td>
                                                    <td>".$value2['nombre_personal']."</td>
                                                    <td>".$viaticopp."</td>
                                                    </tr>";
                                                    $valorviatico=$valorviatico+$viaticopp;
                                      }
                                      $html.=
                                      "<tr>
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td>".$valorviatico."</td>
                                    </tbody>
                                  </table>
                                  </div>";


                            }else{
                            $html.="
                                  <div class='box-header'>
                                    <h3 class='box-title'>TRANSPORTE</h3>
                                  </div>
                                    <br>
                                  <div class='col-md-2'>
                                      <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='MOVIL' class='form-control'>
                                  </div>
                                  <div class='col-md-2'>
                                      <label>CANTIDAD MOVILES</label><input type='text' name='textocantidadmovil' id='textocantidadmovil' value='".$value3['cant_movil']."'  class='form-control'>
                                  </div>
                                  <div class='col-md-2'>
                                      <label>VALOR PEAJES</label><input type='text' name='textovalorpeaje' id='textovalorpeaje' value='".$value3['costo_movil']."'  class='form-control'>
                                  </div>
                                  <div class='col-md-2'>
                                      <label>CANTIDAD DE PEAJES</label><input type='text' name='textocantidadpeaje' id='textocantidadpeaje' value='".$value3['cantidad_peajes']."'  class='form-control'>
                                  </div>
                                  <div class='col-md-2'>
                                      <label>TOTAL TRANSPORTE</label><input type='text' name='textototaltrans' id='textototaltrans' value='$total'  class='form-control'>
                                      <br>
                                  </div>
                                  <div class='box-header'>
                                    <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                                    <br>
                                    <br>
                                  </div>
                                  <div class='col-md-12'>
                                  <table class='table table-bordered table-responsive'>
                                       <thead>
                                         <th>RUT</th>
                                         <th>USUARIO</th>
                                         <th>VIATICO</th>
                                         <th>PEAJES(CHOFER)</th>
                                         <th>TOTAL_POR_PERSONA</th>
                                         <th>ORDEN ASOCIADA</th>
                                       </thead>
                                       <tbody>
                                          <tr>";
                                          $valorviatico='0';
                                          $viaticopp='0';
                                          $valormovil='0';
                                          $suma_peaje='0';
                                          $suma_x_persona='0';
                                          $totaltodo='0';
                                          $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.cant_dias,tbldetalleviatico.chofer, tbldetallemovil.costo_movil from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                          if($usuarios[0]['montoviaticopp']!=0){
                                          foreach ($usuarios as $key2 => $value2) {
                                                $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                                $html.="<td>".$value2['rut_personal']."</td>
                                                        <td>".$value2['nombre_personal']."</td>
                                                        <td>".$viaticopp."</td>";
                                                        if($value2['chofer']=='1'){
                                                $html.="<td>".$value2['costo_movil']."</td>";
                                                        $valormovil=$value2['costo_movil'];
                                                        }else{
                                                $html.="<td>0</td>";
                                                       $valormovil='0';
                                                        }
                                                        $suma_x_persona=$viaticopp+$valormovil;
                                                $html.="<td>".$suma_x_persona."</td>
                                                        </tr>";
                                                        $valorviatico=$valorviatico+$viaticopp;
                                                        $suma_peaje=$suma_peaje+$valormovil;
                                                $totaltodo=$totaltodo+$suma_x_persona;
                                          }
                                          $html.=
                                          "<tr>
                                            <td>TOTAL</td>
                                            <td></td>
                                            <td>".$valorviatico."</td>
                                            <td>".$suma_peaje."</td>
                                            <td>".$totaltodo."</td>
                                        </tbody>
                                      </table>
                                      </div>";
                                        }else{
                                          foreach ($usuarios as $key2 => $value2) {
                                                $html.="<td>".$value2['rut_personal']."</td>
                                                        <td>".$value2['nombre_personal']."</td>
                                                        <td>0</td>";
                                                        if($value2['chofer']=='1'){
                                                $html.="<td>".$value2['costo_movil']."</td>";
                                                        $valormovil=$valormovil+$value2['costo_movil'];
                                                        }else{
                                                $html.="<td>0</td>";
                                                       $valormovil='0';
                                                        }

                                                $html.="<td>".$valormovil."</td>
                                                        </tr>";
                                          $totaltodo=$totaltodo+$valormovil;
                                        }


                                          $html.=
                                          "<tr>
                                            <td>TOTAL</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>".$totaltodo."</td>
                                            <td>".$totaltodo."</td>
                                        </tbody>
                                      </table>
                                      </div>";
                                    }
                                }
                              }
                            }elseif($viatico[0]['montoviaticopp']!=false){
                              foreach ($peaje as $key3 => $value3) {
                              $total=$value3['costo_movil']*$value3['cant_movil'];
                              if($total==false){
                                $html.="<div class='box-header'>
                                  <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                                  <br>
                                  <br>
                                </div>
                                <div class='col-md-12'>
                                <table class='table table-bordered table-responsive'>
                                     <thead>
                                       <th>RUT</th>
                                       <th>USUARIO</th>
                                       <th>VIATICO</th>
                                       <th>ORDEN ASOCIADA</th>
                                     </thead>
                                     <tbody>
                                        <tr>";
                                        $valorviatico='0';
                                        $viaticopp='0';
                                        $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp, tbldetalleviatico.cant_dias from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                        foreach ($usuarios as $key2 => $value2) {
                                              $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                              $html.="<td>".$value2['rut_personal']."</td>
                                                      <td>".$value2['nombre_personal']."</td>
                                                      <td>".$viaticopp."</td>
                                                      </tr>";
                                                      $valorviatico=$valorviatico+$viaticopp;
                                        }
                                        $html.=
                                        "<tr>
                                          <td>TOTAL</td>
                                          <td></td>
                                          <td>".$valorviatico."</td>
                                      </tbody>
                                    </table>
                                    </div>";


                              }else{
                              $html.="
                                    <div class='box-header'>
                                      <h3 class='box-title'>TRANSPORTE</h3>
                                    </div>
                                      <br>
                                    <div class='col-md-2'>
                                        <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='MOVIL' class='form-control'>
                                    </div>
                                    <div class='col-md-2'>
                                        <label>CANTIDAD MOVILES</label><input type='text' name='textocantidadmovil' id='textocantidadmovil' value='".$value3['cant_movil']."'  class='form-control'>
                                    </div>
                                    <div class='col-md-2'>
                                        <label>VALOR PEAJES</label><input type='text' name='textovalorpeaje' id='textovalorpeaje' value='".$value3['costo_movil']."'  class='form-control'>
                                    </div>
                                    <div class='col-md-2'>
                                        <label>CANTIDAD DE PEAJES</label><input type='text' name='textocantidadpeaje' id='textocantidadpeaje' value='".$value3['cantidad_peajes']."'  class='form-control'>
                                    </div>
                                    <div class='col-md-2'>
                                        <label>TOTAL TRANSPORTE</label><input type='text' name='textototaltrans' id='textototaltrans' value='$total'  class='form-control'>
                                        <br>
                                    </div>
                                    <div class='box-header'>
                                      <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                                      <br>
                                      <br>
                                    </div>
                                    <div class='col-md-12'>
                                    <table class='table table-bordered table-responsive'>
                                         <thead>
                                           <th>RUT</th>
                                           <th>USUARIO</th>
                                           <th>VIATICO</th>
                                           <th>PEAJES(CHOFER)</th>
                                           <th>TOTAL_POR_PERSONA</th>
                                           <th>ORDEN ASOCIADA</th>
                                         </thead>
                                         <tbody>
                                            <tr>";
                                            $valorviatico='0';
                                            $viaticopp='0';
                                            $valormovil='0';
                                            $suma_peaje='0';
                                            $suma_x_persona='0';
                                            $totaltodo='0';
                                            $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.cant_dias,tbldetalleviatico.chofer, tbldetallemovil.costo_movil from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                            if($usuarios[0]['montoviaticopp']!=0){
                                            foreach ($usuarios as $key2 => $value2) {
                                                  $viaticopp=$value2['montoviaticopp']*$value2['cant_dias'];
                                                  $html.="<td>".$value2['rut_personal']."</td>
                                                          <td>".$value2['nombre_personal']."</td>
                                                          <td>".$viaticopp."</td>";
                                                          if($value2['chofer']=='1'){
                                                  $html.="<td>".$value2['costo_movil']."</td>";
                                                          $valormovil=$value2['costo_movil'];
                                                          }else{
                                                  $html.="<td>0</td>";
                                                         $valormovil='0';
                                                          }
                                                          $suma_x_persona=$viaticopp+$valormovil;
                                                  $html.="<td>".$suma_x_persona."</td>
                                                          </tr>";
                                                          $valorviatico=$valorviatico+$viaticopp;
                                                          $suma_peaje=$suma_peaje+$valormovil;
                                                  $totaltodo=$totaltodo+$suma_x_persona;
                                            }
                                            $html.=
                                            "<tr>
                                              <td>TOTAL</td>
                                              <td></td>
                                              <td>".$valorviatico."</td>
                                              <td>".$suma_peaje."</td>
                                              <td>".$totaltodo."</td>
                                          </tbody>
                                        </table>
                                        </div>";
                                          }else{
                                            foreach ($usuarios as $key2 => $value2) {
                                                  $html.="<td>".$value2['rut_personal']."</td>
                                                          <td>".$value2['nombre_personal']."</td>
                                                          <td>0</td>";
                                                          if($value2['chofer']=='1'){
                                                  $html.="<td>".$value2['costo_movil']."</td>";
                                                          $valormovil=$valormovil+$value2['costo_movil'];
                                                          }else{
                                                  $html.="<td>0</td>";
                                                         $valormovil='0';
                                                          }

                                                  $html.="<td>".$valormovil."</td>
                                                          </tr>";
                                            $totaltodo=$totaltodo+$valormovil;
                                          }


                                            $html.=
                                            "<tr>
                                              <td>TOTAL</td>
                                              <td></td>
                                              <td>0</td>
                                              <td>".$totaltodo."</td>
                                              <td>".$totaltodo."</td>
                                          </tbody>
                                        </table>
                                        </div>";
                                      }
                                  }
                                }
                            }else{

                            }
                         }else{
                            foreach ($transporte as $key3 => $value3) {
                            if($value3['tipo_transporte']=='1'){
                              $trans='BUS';
                            }elseif($value3['tipo_transporte']=='2'){
                              $trans='AVION';
                            }else{
                              $trans='MOVIL';
                            }
                            $totalpasaje=$value3['precio_pasaje']*$value['cant_personas'];
                            $html.="
                            </div>
                              <div class='box-body'>
                                <div class='box-header'>
                                  <h3 class='box-title'>TRANSPORTE</h3>
                                </div>
                                <br>
                                <div class='col-md-3'>
                                  <label>TIPO DE TRANSPORTE</label><input type='text' name='textotipo' id='textotipo' value='$trans' class='form-control'>
                                </div>
                                <div class='col-md-3'>
                                  <label>VALOR PASAJES P/P</label><input type='text' name='textoprepasaje' id='textoprepasaje' value='".$value3['precio_pasaje']."'  class='form-control'>
                                </div>
                                <div class='col-md-3'>
                                  <label>TOTAL PASAJES</label><input type='text' name='textototalpasaje' id='textototalpasaje' value='$totalpasaje'  class='form-control'>
                                  <br>
                                  <br>
                                </div>
                                <div class='box-header'>
                                  <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                                  <br>
                                  <br>
                                </div>
                                <div class='col-md-12'>
                                   <table class='table table-bordered table-responsive' >
                                     <thead>
                                     <th>RUT</th>
                                     <th>USUARIO</th>
                                     <th>VIATICO</th>
                                     <th>PASAJES</th>
                                     <th>TOTAL_POR_PERSONA</th>
                                     <th>ORDEN ASOCIADA</th>
                                     </thead>
                                     <tbody>
                                        <tr>";
                                        $suma='0';
                                        $total_x_pp='0';
                                        $totalpasa='0';
                                        $totalpp='0';
                                        $cantusuarios=$this->db->query_select("select tbldetalleviatico.id_usuarios,tbldetalleviatico.cant_dias,(select tbldetalletransporte.precio_pasaje from tbldetalletransporte inner join tblcontrol_proyectos tblpro2 on tbldetalletransporte.id_detalletransporte=tblpro2.num_proyecto where tblcontrol_proyectos.id_proyecto=tblpro2.id_proyecto) as pasaje,tbldetalleviatico.montoviaticopp from tbldetalleviatico inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.num_proyecto where id_detalleviatico='".$value['num_proyecto']."'");
                                        foreach ($cantusuarios as $key2 => $value2) {
                                              $nomusuarios=$this->db->query_select("select rut_personal,nombre_personal from tblpersonal where cod_personal='".$value2['id_usuarios']."'");
                                              $gasto=$value2['montoviaticopp']*$value2['cant_dias'];
                                              $total_x_pp=$gasto+$value2['pasaje'];
                                              $html.="<td>".$nomusuarios[0][0]."</td>
                                                      <td>".$nomusuarios[0][1]."</td>
                                                      <td>".$gasto."</td>
                                                      <td>".$value2['pasaje']."</td>
                                                      <td>".$total_x_pp."</td>
                                                      </tr>";
                                                      $totalpasa=$totalpasa+$value2['pasaje'];
                                                      $suma=$suma+$gasto;
                                                      $totalpp=$totalpp+$total_x_pp;
                                        }
                                        $html.=
                                        "<tr>
                                          <td>TOTAL</td>
                                          <td></td>
                                          <td>".$suma."</td>
                                          <td>".$totalpasa."</td>
                                          <td>".$totalpp."</td>
                                      </tbody>
                                    </table>
                                </div>";

                            }
                          }

                     $hospedaje=$this->db->query_select("select * from tbldetallehospedaje where id_detallehospedaje='".$value['num_proyecto']."' limit 1");
                     if($hospedaje!=false){
                       foreach ($hospedaje as $key4 => $value4) {
                         $totalhospedaje=$value4['costo_dia']*$value['cant_dias'];
                     $html.="
                     <div class='box-body'>
                           <div class='col-md-12'>
                           </div>
                           <div class='box-header'>
                             <h3 class='box-title'>HOSPEDAJE</h3>
                           </div>
                           <br>
                           <div class='col-md-3'>
                               <label>RUT HOSPEDAJE</label><input type='text' name='textoruthospedaje' id='textoruthospedaje' value='".$value4['rut_hospedaje']."' class='form-control'>
                           </div>
                           <div class='col-md-3'>
                               <label>NOMBRE HOSPEDAJE</label><input type='text' name='textonombrehospedaje' id='textonombrehospedaje' value='".$value4['nombre_hospedaje']."'  class='form-control'>
                           </div>
                           <div class='col-md-3'>
                               <label>DIRECCION HOSPEDAJE</label><input type='text' name='textodireccionhospedaje' id='textodireccionhospedaje' value='".$value4['direccion_hospedaje']."'   class='form-control'>
                           </div>
                           <div class='col-md-12'>
                           <br>
                           <br>
                           </div>

                           <div class='col-md-12'>
                           </div>
                           <div class='col-md-12'>
                           <table class='table table-bordered table-responsive'>
                                <thead>
                                  <th>TIPO_HABITACION</th>
                                  <th>N°_DE_HABITACIONES</th>
                                  <th>COSTO_HABITACION</th>
                                  <th>CANTIDAD_DIAS</th>
                                  <th>TOTAL</th>
                                </thead>
                                <tbody>
                                   <tr>";
                                   $costop='0';
                                   $totalp='0';
                                   $hospedaje=$this->db->query_select("select DISTINCT tipo_hospedaje,cant_habitaciones,costo_dia,dias,porcentaje from tbldetallehospedaje where id_detallehospedaje='".$value['num_proyecto']."' order by tipo_hospedaje asc");
                                   foreach ($hospedaje as $key => $value4) {
                                     if($value4['tipo_hospedaje']=='1'){
                                        $html.="<td>Habitacion simple</td>";
                                     }elseif($value4['tipo_hospedaje']=='2'){
                                           $html.="<td>Habitacion doble</td>";
                                     }elseif($value4['tipo_hospedaje']=='3'){
                                            $html.="<td>Habitacion triple</td>";
                                     }else{
                                            $html.="<td>Cabaña o Depto </td>";
                                     }
                                     $costop=$value4['cant_habitaciones']*$value4['costo_dia']*$value4['dias'];
                                   $html.="<td>".$value4['cant_habitaciones']."</td>
                                           <td>".$value4['costo_dia']."</td>
                                           <td>".$value4['dias']."</td>
                                           <td>".$costop."</td>
                                   </tr>";
                                   $totalp=$totalp+$costop;

                                   }
                                   $html.="
                                   <tr>
                                   <td>TOTAL</td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td>$totalp</td>
                                 </tbody>
                                </table>
                                </div>
                                <div class='col-md-3'>
                                  <label>PORCENTAJE DE PAGO %</label><input type='number' name='txtpago' step='0.01' id='txtpago' class='form-control' value=".$hospedaje[0]['porcentaje'].">
                                </div>
                                <div class='col-md-3'>
                                  <label>SUB TOTAL</label><input type='number' name='txtsubtotal' id='txtsubtotal' class='form-control' value=".$totalp.">
                                </div>";
                                    $finalresultado=($totalp*$hospedaje[0]['porcentaje'])/100;

                                $html.="<div class='col-md-3'>
                                  <label>TOTAL HOSPEDAJE A PAGAR</label><input type='number' name='texttotalhos' id='texttotalhos' class='form-control' value=".$finalresultado.">
                                </div>";


                         }
                       }
                       $html.="
                               <div class='col-md-12'>
                               <br>
                               <br>
                               </div>
                               <CENTER>
                               <div class='col-md-4'>
                               </div>
                               <button id='aprobar' name='aprobar' class='btn btn-success btn-sm col-md-1' onclick='aprobar_control(".$value['id_proyecto'].");'>APROBAR</button>
                               <div class='col-sm-1'>
                               </div>
                               <button id='btnrechazar' name='btnrechazar' class='btn btn-danger btn-sm col-md-1' onclick='rechazar_control(".$value['id_proyecto'].");'>RECHAZAR</button>
                               </CENTER>";
                      $html.="</div>

                </div>
            </div>
          </div>
        </div>";
  }
  return array('success'=>'1', 'html'=> $html);


}

public function consultar_perfil(){
  $usuario=$this->user;
  $datusuario=$usuario['id_user'];
  return $this->db->query_select("select perfil from users where id_user='$datusuario'");

}

public function aprobar(){
  global $http;
  $usuario=$this->user;
  $idusuario=$usuario['id_user'];
  $id=$http->request->get('id');
  $aprobacion=$this->db->query_select("select estado from tblcontrol_proyectos where id_proyecto='$id'");
  if($aprobacion[0][0]=='0'){
  $this->db->update('tblcontrol_proyectos', array(
      'estado'=> '1',
      'usuario_aprueba'=>$usuario['id_user']
    ),"id_proyecto='$id'");

  return array('success'=>'1');
}elseif($aprobacion[0][0]=='1'){
    $this->db->update('tblcontrol_proyectos', array(
        'estado'=> '2',
        'usuario_aprueba'=>$usuario['id_user']
      ),"id_proyecto='$id'");

    return array('success'=>'1');
}else{
  $perfil=$this->db->query_select("select perfil from users where id_user='$idusuario' and perfil='CONTROL_ADMIN'");
  if($perfil!=false){
    $this->db->update('tblcontrol_proyectos', array(
        'estado'=> '4',
        'usuario_aprueba'=>$usuario['id_user']
      ),"id_proyecto='$id'");
      return array('success'=>'1');
    }else{

    }
  }

}




public function obserrechazar(){
  global $http;
  $html="<div class='col-md-4'>
         <label>OBSERVACION</label>
         <br>
         </div>
         <div class='col-md-10'>
         <textarea class='form-control' type='text' id='textobservacion' name='textobservacion'></textarea>
         </div>";

  return array('success'=>'1', 'html'=> $html);
}

public function rechazar(){
  global $http;
  $usuario=$this->user;
  $id=$http->request->get('id');
  $observacion=$http->request->get('texto');
  $aprobacion=$this->db->query_select("select estado from tblcontrol_proyectos where id_proyecto='$id'");
  if($aprobacion[0][0]=='1'){
  $this->db->update('tblcontrol_proyectos', array(
      'estado'=> '0',
      'observacion'=>$observacion,
      'usuario_aprueba'=>$usuario['id_user']
    ),"id_proyecto='$id'");

  return array('success'=>'1');
}else{
  $this->db->update('tblcontrol_proyectos', array(
      'estado'=> '3',
      'observacion'=>$observacion,
      'usuario_aprueba'=>$usuario['id_user']
    ),"id_proyecto='$id'");

  return array('success'=>'1');
}
}

public function filtrar_fecha(){
  global $http;
  $usuario=$this->user;
  $fechadesde=$http->request->get('fechadesde');
  $fechahasta=$http->request->get('fechahasta');
  $resultado= $this->listar_proyecto($fechadesde,$fechahasta);

  $registro=$this->db->query_select("select * from tblfechatemporal where id_user=".$usuario['id_user']."");
  if($registro==false){
      $this->db->insert("tblfechatemporal", array(
        "id_user"=>$usuario['id_user'],
        "fecha_inicio"=>$fechadesde,
        "fecha_final"=>$fechahasta
      ));
  }else{
    $this->db->update("tblfechatemporal", array(
      "fecha_inicio"=>$fechadesde,
      "fecha_final"=>$fechahasta
    ),"id_user=".$usuario['id_user']."");
  }


  $usucompa=(new Model\Users)->getOwnerUser();

  $perfil=$usucompa['perfil'];
  if ($resultado === false){
      return array('success' => 0, 'message' => 'Para la fecha seleccionada no existen datos');
  }else{
      $json = array(
      "aaData"=>array(
      )
      );
      foreach ($resultado as $key => $value) {
           if($perfil=='CONTROL_INGRESO'){
           $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                 <i class='glyphicon glyphicon-edit'></i></a>
                 <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                 <i class='glyphicon glyphicon-remove'></i>
                 </a></td>";
           }elseif($perfil=='CONTROL_PREVALIDADOR'){
           $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                 <i class='glyphicon glyphicon-edit'></i></a>
                 <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                 <i class='glyphicon glyphicon-edit'></i></a>
                 <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")'  title='Eliminar' class='btn btn-danger btn-sm'>
                 <i class='glyphicon glyphicon-remove'></i>
                 </a></td>";
           }else{
          if($value['estado']!='2'){
            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnaprobar' name='btnaprobar' title='Completar' onclick='prevalidar(".$value['id_proyecto'].")'  class='btn btn-primary btn-sm'>
                  <i class='glyphicon glyphicon-edit'></i></a>
                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                  <i class='glyphicon glyphicon-edit'></i></a>
                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                  <i class='glyphicon glyphicon-remove'></i>
                  </a></td>";
          }else{
            $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a><td>";
            }
          }
           $html.="</tr>";

           if($value['estado']=='0'){
             $estado='PENDIENTE';
           }elseif($value['estado']=='1'){
             $estado='PREVALIDADO';
           }elseif($value['estado']=='2'){
             $estado='APROBADO';
           }elseif($value['estado']=='4'){
             $estado='PAGADO';
           }else{
             $estado='RECHAZADO';
           }
           if($value['hospedaje']==false){
             $diashospedaje='NO APLICA';
           }else{
             $diashospedaje=$value['cant_dias_hospedaje'];
           }
           $btn='<class="text-center" onclick="consultarorden('.$value['id_proyecto'].')"><a class="btn">'.$value['num_proyecto'].'</a>';

           $json['aaData'][] = array($btn,$value['descripcion'],$value['areas'],$value['fecha_inicio'],$value['fecha_final'],$value['cant_dias'],$value['cant_dias_hospedaje'],$value['costo_total'],$estado,$html );
         }
       }
       $jsonencoded = json_encode($json,JSON_UNESCAPED_UNICODE);
       $fh = fopen(API_INTERFACE . "views/app/temp/result_cons_".$usucompa['id_user'].".dbj", 'w');
       fwrite($fh, $jsonencoded);
       fclose($fh);
       return array('success' => 1, 'message' => "result_cons_".$usucompa['id_user'].".dbj" );
     }

    public function filtrar_estado(){
      global $http;
      $fechadesde=$http->request->get('fechadesde');
      $fechahasta=$http->request->get('fechahasta');
      $estado=$http->request->get('estado');
      $usucompa=(new Model\Users)->getOwnerUser();
      $perfil=$usucompa['perfil'];
      $datusuario=$usucompa['id_user'];

      if($perfil=='CONTROL_INGRESO'){
        $resultado=$this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion, (select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where id_user='$datusuario' and tblcontrol_proyectos.estado='$estado' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
      }elseif($perfil=='CONTROL_PREVALIDADOR'){
        $resultado=$this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion, (select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='$estado' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
      }elseif($perfil=='CONTROL_VALIDADOR'){
        $resultado=$this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion, (select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='$estado' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
      }elseif($perfil=='CONTROL_CONTADOR'){
          $resultado=$this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion, (select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='$estado' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
      }elseif($perfil=='CONTROL_ADMIN'){
            $resultado=$this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion, (select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='$estado'");

      }else{
        $resultado=$this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.factura,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,tbllocalidades.descripcion, (select tbldetallehospedaje.rut_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcon2 on tbldetallehospedaje.id_detallehospedaje=tblcon2.id_detallehospedaje where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto limit 1) as hospedaje from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where tblcontrol_proyectos.estado='$estado' and fecha_ingreso between '$fechadesde' and '$fechahasta'");
      }



      if ($resultado === false){
          return array('success' => 0, 'message' => 'Para la fecha seleccionada no existen datos');
      }else{
          $json = array(
          "aaData"=>array(
          )
          );
          $html=" ";
          foreach ($resultado as $key => $value) {
               if($perfil=='CONTROL_INGRESO'){
               if($value['estado']=='0'){
                             if($value['factura']== 0){
                               $html="<td> <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                     <i class='glyphicon glyphicon-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                     <i class='glyphicon glyphicon-remove'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")'' class='btn btn-success btn-sm'>
                                     <i class='glyphicon glyphicon-open'></i></a></td>";
                             }else{
                               $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                      <i class='glyphicon glyphicon-edit'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                      <i class='glyphicon glyphicon-remove'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                      <i class='glyphicon glyphicon-file'></i></a></td>";
                                  }
                       }elseif($value['estado']=='1'){
                            if($value['factura']== 0){
                              $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                    <i class='glyphicon glyphicon-refresh'></i></a>
                                    <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                    <i class='glyphicon glyphicon-open'></i></a></td>";
                               }else{
                              $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                     <i class='glyphicon glyphicon-refresh'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                     <i class='glyphicon glyphicon-file'></i></a></td>";
                                    }
                       }elseif($value['estado']=='2'){
                             if($value['factura']== 0){
                              $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                     <i class='glyphicon glyphicon-open'></i></a></td>";
                              }else{
                              $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                    <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                    <i class='glyphicon glyphicon-file'></i></a></td>";
                                  }
                        }elseif($value['estado']=='4'){
                              if($value['factura']== 0){
                                $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                        <i class='glyphicon glyphicon-open'></i></a>";

                              }else{
                                $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                      <i class='glyphicon glyphicon-file'></i></a>";
                                    }
                          }else{
                               if($value['factura']== 0){
                                 $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                      <i class='glyphicon glyphicon-edit'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                      <i class='glyphicon glyphicon-remove'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                      <i class='glyphicon glyphicon-open'></i></a></td>";
                               }else{
                                 $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                      <i class='glyphicon glyphicon-edit'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                      <i class='glyphicon glyphicon-remove'></i></a>
                                      <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                      <i class='glyphicon glyphicon-file'></i></a></td>";
                                      }
                                    }
               }elseif($perfil=='CONTROL_PREVALIDADOR'){
                       if($value['estado']=='0'){
                             if($value['factura']== 0){
                               $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                     <i class='glyphicon glyphicon-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                     <i class='glyphicon glyphicon-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                     <i class='glyphicon glyphicon-remove'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                     <i class='glyphicon glyphicon-open'></i></a></td>";
                             }else{
                               $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                     <i class='glyphicon glyphicon-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                     <i class='glyphicon glyphicon-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                     <i class='glyphicon glyphicon-remove'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                     <i class='glyphicon glyphicon-file'></i></a></td>";
                                    }
                        }elseif($value['estado']=='1'){
                                if($value['factura']== 0){
                                  $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                        <i class='glyphicon glyphicon-refresh'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                        <i class='glyphicon glyphicon-open'></i></a></td>";
                                }else{
                                  $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                        <i class='glyphicon glyphicon-refresh'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                        <i class='glyphicon glyphicon-file'></i></a></td>";
                                       }
                        }elseif($value['estado']=='2'){
                           if($value['factura']== 0){
                                $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                <i class='glyphicon glyphicon-open'></i></a></td>";
                           }else{
                                 $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                 <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                 <i class='glyphicon glyphicon-file'></i></a></td>";
                                  }
                        }elseif($value['estado']=='4'){
                               if($value['factura']== 0){
                                 $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                 <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                 <i class='glyphicon glyphicon-open'></i></a>";
                               }else{
                                 $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                 <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                 <i class='glyphicon glyphicon-file'></i></a>";
                                }
                        }else{
                                if($value['factura']== 0){
                                  $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                        <i class='glyphicon glyphicon-edit'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                        <i class='glyphicon glyphicon-remove'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                        <i class='glyphicon glyphicon-open'></i></a></td>";
                                }else{
                                  $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                        <i class='glyphicon glyphicon-edit'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                        <i class='glyphicon glyphicon-remove'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                        <i class='glyphicon glyphicon-file'></i></a></td>";
                                       }
                              }
                        }elseif($perfil=='CONTROL_VALIDADOR'){
                                    if($value['estado']=='0'){
                                          if($value['factura']== 0){
                                            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                  <i class='glyphicon glyphicon-remove'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>";
                                          }else{
                                            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                  <i class='glyphicon glyphicon-remove'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>";
                                                 }
                                     }elseif($value['estado']=='1'){
                                             if($value['factura']== 0){
                                               $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                                     <i class='glyphicon glyphicon-refresh'></i></a>
                                                     <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                     <i class='glyphicon glyphicon-open'></i></a></td>";
                                             }else{
                                               $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                                     <i class='glyphicon glyphicon-refresh'></i></a>
                                                     <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                     <i class='glyphicon glyphicon-file'></i></a></td>";
                                                    }
                                     }elseif($value['estado']=='2'){
                                        if($value['factura']== 0){
                                             $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                             <i class='glyphicon glyphicon-open'></i></a></td>";
                                        }else{
                                              $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a></td>";
                                               }
                                     }elseif($value['estado']=='4'){
                                            if($value['factura']== 0){
                                              $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' id='btnimprimir' name='btnimprimir' title='Descargar PDF' href='avar/descargar_pdf/".$value['id_proyecto']."' target='_blank' class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-save'></i></a></td>";
                                            }else{
                                              $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' id='btnimprimir' name='btnimprimir' title='Descargar PDF' href='avar/descargar_pdf/".$value['id_proyecto']."' target='_blank' href='avar/descargar_pdf/".$value['id_proyecto']."'  class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-save'></i></a></td>";
                                             }
                                     }else{
                                             if($value['factura']== 0){
                                               $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                     <i class='glyphicon glyphicon-edit'></i></a>
                                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                     <i class='glyphicon glyphicon-remove'></i></a>
                                                     <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                     <i class='glyphicon glyphicon-open'></i></a></td>";
                                             }else{
                                               $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                     <i class='glyphicon glyphicon-edit'></i></a>
                                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                     <i class='glyphicon glyphicon-remove'></i></a>
                                                     <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                     <i class='glyphicon glyphicon-file'></i></a></td>";
                                                    }
                                           }
                          }elseif($perfil=='CONTROL_CONTADOR'){
                                if($value['estado']=='0'){
                                      if($value['factura']== 0){
                                        $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-edit'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                              <i class='glyphicon glyphicon-edit'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                              <i class='glyphicon glyphicon-remove'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a></td>";
                                      }else{
                                        $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-edit'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                              <i class='glyphicon glyphicon-edit'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                              <i class='glyphicon glyphicon-remove'></i></a>
                                              <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a></td>";
                                             }
                                 }elseif($value['estado']=='1'){
                                         if($value['factura']== 0){
                                           $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                                 <i class='glyphicon glyphicon-refresh'></i></a>
                                                 <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                 <i class='glyphicon glyphicon-open'></i></a></td>";
                                         }else{
                                           $html="<td><a data-toggle='tooltip' data-placement='top' name='btnprevalidado' id='btnprevalidado' title='Esperando Validacion' class='btn btn-info'>
                                                 <i class='glyphicon glyphicon-refresh'></i></a>
                                                 <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                 <i class='glyphicon glyphicon-file'></i></a></td>";
                                                }
                                 }elseif($value['estado']=='2'){
                                  if($value['factura']== 0){
                                    $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar(".$value['id_proyecto'].")' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-open'></i></a></td>";
                                    }else{
                                      $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar(".$value['id_proyecto'].")' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a></td>";
                                           }
                                 }elseif($value['estado']=='4'){
                                     if($value['factura']== 0){
                                       $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                       <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                       <i class='glyphicon glyphicon-open'></i></a>
                                       <a data-toggle='tooltip' data-placement='top' id='btnimprimir' name='btnimprimir' title='Descargar PDF' href='avar/descargar_pdf/".$value['id_proyecto']."' target='_blank' href='avar/descargar_pdf/".$value['id_proyecto']."'  class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-save'></i></a></td>";
                                     }else{
                                       $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                       <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                       <i class='glyphicon glyphicon-file'></i></a>
                                       <a data-toggle='tooltip' data-placement='top' id='btnimprimir' name='btnimprimir' title='Descargar PDF' href='avar/descargar_pdf/".$value['id_proyecto']."' target='_blank' href='avar/descargar_pdf/".$value['id_proyecto']."'  class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-save'></i></a></td>";
                                       }

                                 }else{

                                         if($value['factura']== 0){
                                           $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                 <i class='glyphicon glyphicon-edit'></i></a>
                                                 <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                 <i class='glyphicon glyphicon-remove'></i></a>
                                                 <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                 <i class='glyphicon glyphicon-open'></i></a></td>";
                                         }else{
                                           $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                 <i class='glyphicon glyphicon-edit'></i></a>
                                                 <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                 <i class='glyphicon glyphicon-remove'></i></a>
                                                 <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                 <i class='glyphicon glyphicon-file'></i></a></td>";
                                                }
                                   }
                      }elseif($perfil=='CONTROL_ADMIN'){
                                 if($value['estado']=='0'){
                                       if($value['factura']== 0){
                                         $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                               <i class='glyphicon glyphicon-edit'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                               <i class='glyphicon glyphicon-edit'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                               <i class='glyphicon glyphicon-remove'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                               <i class='glyphicon glyphicon-open'></i></a></td>";
                                       }else{
                                         $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                               <i class='glyphicon glyphicon-edit'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                               <i class='glyphicon glyphicon-edit'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                               <i class='glyphicon glyphicon-remove'></i></a>
                                               <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                               <i class='glyphicon glyphicon-file'></i></a></td>";
                                              }
                                  }elseif($value['estado']=='1'){
                                          if($value['factura']== 0){
                                            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                  <i class='glyphicon glyphicon-remove'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>";
                                          }else{
                                            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                  <i class='glyphicon glyphicon-remove'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>";
                                                 }

                                  }elseif($value['estado']=='2'){
                                    if($value['factura']== 0){
                                      $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar(".$value['id_proyecto'].")' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                             <i class='glyphicon glyphicon-open'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                             <i class='glyphicon glyphicon-remove'></i></a></td>";
                                    }else{
                                      $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar(".$value['id_proyecto'].")' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                             <i class='glyphicon glyphicon-file'></i></a>
                                             <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                             <i class='glyphicon glyphicon-remove'></i></a></td>";
                                           }
                                  }elseif($value['estado']=='4'){

                                    if($value['factura']== 0){
                                      $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                            <i class='glyphicon glyphicon-edit'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                            <i class='glyphicon glyphicon-remove'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnimprimir' name='btnimprimir' title='Descargar PDF' href='avar/descargar_pdf/".$value['id_proyecto']."' target='_blank' href='avar/descargar_pdf/".$value['id_proyecto']."'  class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-save'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                            <i class='glyphicon glyphicon-remove'></i></a></td>";
                                    }else{
                                      $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Pagado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnimprimir' name='btnimprimir' title='Descargar PDF' href='avar/descargar_pdf/".$value['id_proyecto']."' target='_blank' href='avar/descargar_pdf/".$value['id_proyecto']."'  class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-save'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                            <i class='glyphicon glyphicon-remove'></i></a></td>";
                                           }
                                  }else{

                                          if($value['factura']== 0){
                                            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto'].">
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                  <i class='glyphicon glyphicon-remove'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>";
                                          }else{
                                            $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto'].">
                                                  <i class='glyphicon glyphicon-edit'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                                  <i class='glyphicon glyphicon-remove'></i></a>
                                                  <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>";
                                                 }
                                    }
                }else{
                 if($value['estado']=='0'){
                       if($value['factura']== 0){
                         $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                               <i class='glyphicon glyphicon-edit'></i></a>
                               <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                               <i class='glyphicon glyphicon-edit'></i></a>
                               <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                               <i class='glyphicon glyphicon-remove'></i></a>
                               <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                               <i class='glyphicon glyphicon-open'></i></a></td>";
                       }else{
                         $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                               <i class='glyphicon glyphicon-edit'></i></a>
                               <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                               <i class='glyphicon glyphicon-edit'></i></a>
                               <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                               <i class='glyphicon glyphicon-remove'></i></a>
                               <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                               <i class='glyphicon glyphicon-file'></i></a></td>";
                              }
                  }elseif($value['estado']=='1'){
                        if($value['factura']== 0){
                          $html="<td><a data-toggle='tooltip' data-placement='top' id='btnaprobar' name='btnaprobar' title='Completar' onclick='prevalidar(".$value['id_proyecto'].")'  class='btn btn-primary btn-sm'>
                                <i class='glyphicon glyphicon-edit'></i></a>
                                <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                <i class='glyphicon glyphicon-edit'></i></a>
                                <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                <i class='glyphicon glyphicon-remove'></i></a>
                                <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                <i class='glyphicon glyphicon-open'></i></a></td>";
                        }else{
                          $html="<td><a data-toggle='tooltip' data-placement='top' id='btnaprobar' name='btnaprobar' title='Completar' onclick='prevalidar(".$value['id_proyecto'].")'  class='btn btn-primary btn-sm'>
                                <i class='glyphicon glyphicon-edit'></i></a>
                                <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                                <i class='glyphicon glyphicon-edit'></i></a>
                                <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                <i class='glyphicon glyphicon-remove'></i></a>
                                <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                <i class='glyphicon glyphicon-file'></i></a></td>";
                               }
                      }elseif($value['estado']=='2'){
                         if($value['factura']== 0){
                                  $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                  <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                  <i class='glyphicon glyphicon-open'></i></a></td>";

                                  $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a>
                                  <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                  <i class='glyphicon glyphicon-file'></i></a></td>";
                                }
                       }elseif($value['estado']=='4'){
                         if($value['factura']== 0){
                          $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                          <a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                          <i class='glyphicon glyphicon-open'></i></a>";
                         }else{
                           $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-primary btn-sm'><i class='fa fa-check-square-o'></i></a>
                           <a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                           <i class='glyphicon glyphicon-file'></i></a>";
                         }
                        }else{
                         $html="<a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                               <i class='glyphicon glyphicon-remove'></i>
                               </a>";
                               if($value['factura']== 0){
                                     $html="<a data-toggle='tooltip' data-placement='top' name='btnsubir' id='btnsubir' title='Subir Archivo' onclick='subirdoc(".$value['id_proyecto'].")' class='btn btn-success btn-sm'>
                                     <i class='glyphicon glyphicon-open'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                     <i class='glyphicon glyphicon-remove'></i></a>";
                               }else{
                                     $html.="<a data-toggle='tooltip' data-placement='top' name='btnverfactura' id='btnverfactura' title='Ver Factura' onclick='verfactura(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                                     <i class='glyphicon glyphicon-file'></i></a>
                                     <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                                     <i class='glyphicon glyphicon-remove'></i></a>";
                                    }
                         }
              }
               $html.="</tr>";

               if($value['estado']=='0'){
                 $estado='PENDIENTE';
               }elseif($value['estado']=='1'){
                 $estado='PREVALIDADO';
               }elseif($value['estado']=='2'){
                 $estado='APROBADO';
               }elseif($value['estado']=='4'){
                 $estado='PAGADO';
               }else{
                 $estado='RECHAZADO';
               }
               if($value['hospedaje']==false){
                 $diashospedaje='NO APLICA';
               }else{
                 $diashospedaje=$value['cant_dias_hospedaje'];
               }
               $btn='<class="text-center" onclick="consultarorden('.$value['id_proyecto'].')"><a class="btn">'.$value['num_proyecto'].'</a>';

               $json['aaData'][] = array($btn,$value['descripcion'],$value['areas'],$value['fecha_inicio'],$value['fecha_final'],$value['cant_dias'],$diashospedaje,$value['costo_total'],$estado,$html );
             }
           }
           $jsonencoded = json_encode($json,JSON_UNESCAPED_UNICODE);
           $fh = fopen(API_INTERFACE . "views/app/temp/result_cons_".$usucompa['id_user'].".dbj", 'w');
           fwrite($fh, $jsonencoded);
           fclose($fh);
           return array('success' => 1, 'message' => "result_cons_".$usucompa['id_user'].".dbj" );
         }

    public function validarcodigo(){
      global $http;
      $codigo=$http->request->get('codigo');

      $validarcodigo=$this->db->query_select("select id_proyecto from tblcontrol_proyectos where num_proyecto='$codigo'");
      if($validarcodigo!=false){
        return array('success' => '1', 'message' => "El numero de orden ya existe" );
      }
      else{

      }
    }

    public function validarpasaje(){
        global $http;
        $localidad=$http->request->get('localidad');
        $area=$http->request->get('area');
        $pasaje=$http->request->get('pasaje');
        $opcion=$http->request->get('opcion');
        $consultarloc=$this->db->query_select("select * from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
        if($consultarloc==false){
          $codlocalidad=$this->db->query_select("select id_localidad from tbllocalidades where descripcion='$localidad'");
          $localidad=$codlocalidad[0][0];

        }
        if($opcion=='2'){
          $valorpasaje=$this->db->query_select("select valor_avion from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
        if($valorpasaje[0][0]>=$pasaje){

           }else{
             $boleto=$valorpasaje[0][0];
             return array('success' => '0', 'message' => "El valor del pasaje en avion no puede exceder $boleto");
          }
        }elseif($opcion=='1'){
        $valorpasaje=$this->db->query_select("select valor_bus from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
        if($valorpasaje[0][0]>=$pasaje){

           }else{
             $boleto=$valorpasaje[0][0];
             return array('success' => '0', 'message' => "El valor del pasaje en bus no puede exceder $boleto");
          }

        }else{

        }
      }
   public function borrar_tabla(){
     global $http;
     $datusu=$this->user;
     $datousuario=$datusu['id_user'];
     $this->db->query_select("delete from tbldetalleviatico_temporal where user_registra='$datousuario'");

     return array('success' => '1', 'message' => "datos eliminados" );
   }

   public function eliminar_localidad(){
     global $http;

     $id=$http->request->get('id');
     $this->db->query_select("update tbllocalidades set estado='0' where id_localidad='$id'");

     return array('success' => '1', 'message' => "Registro eliminado" );

   }

   public function get_orden_byId(int $id){
       return $this->db->query_select("select tbllocalidades.* from tbllocalidades where id_localidad='$id' limit 1");
   }
   public function get_orden_byId2(int $id){
       return $this->db->query_select("select tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.descrip_proyecto,tblcontrol_proyectos.nodocuadrante,tblcontrol_proyectos.cod_localidad,(select descripcion from tblareas inner join tblcontrol_proyectos tblcontrol2 on tblareas.cod_area=tblcontrol2.area where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as areas, tblcontrol_proyectos.area,tblcontrol_proyectos.fecha_inicio,
      tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.principal,(select precio_pasaje from tbldetalletransporte inner join tblcontrol_proyectos tblcontrol2 on tbldetalletransporte.id_detalletransporte=tblcontrol2.id_detalletransporte where tblcontrol_proyectos.id_proyecto=tblcontrol2.id_proyecto) as pasaje, (select costo_movil from tbldetallemovil inner join tblcontrol_proyectos tblcontrol2 on tbldetallemovil.id_detallemovil=tblcontrol2.id_detalletransporte where tblcontrol_proyectos.id_proyecto=tblcontrol2.id_proyecto) as movil,(select DISTINCT montoviaticopp from tbldetalleviatico inner join tblcontrol_proyectos tblcontrol2 on tbldetalleviatico.id_detalleproyecto=tblcontrol2.id_detalleviatico where tblcontrol2.id_proyecto=tblcontrol_proyectos.id_proyecto) as viatico,(select DISTINCT total_hospedaje from tbldetallehospedaje inner join tblcontrol_proyectos tblcontrol2 on tbldetallehospedaje.id_detallehospedaje=tblcontrol2.id_detallehospedaje where tblcontrol_proyectos.id_proyecto=tblcontrol2.id_proyecto) as hospedaje,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.id_user,
      tbllocalidades.descripcion from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where id_proyecto='$id' limit 1");
         }
   public function ver_detalle_hospedaje($id){
     return $this->db->query_select("select id_detallehospedaje,rut_hospedaje,porcentaje,nombre_hospedaje,direccion_hospedaje,id_usuario,tipo_hospedaje,cant_habitaciones,costo_dia,dias,persoxhabi,(select cant_habitaciones*costo_dia*dias) as monto,total_hospedaje from tbldetallehospedaje where id_detallehospedaje='$id'");
   }

public function editar_localidad(){
  global $http;
  $id=$http->request->get('id_localidad');
  $id_area=$http->request->get('cmbareas');
  $numlocalidad=$http->request->get('numlocalidad');
  $descripcionlocalidad=$http->request->get('descripcionlocalidad');
  $hublocalidad=$http->request->get('hublocalidad');
  $valorviatico=$http->request->get('txtcheckviatico');
  $valorbus=$http->request->get('txtmontobus');
  $valoravion=$http->request->get('txtmontoavion');
  $valorhab1=$http->request->get('txthabitacion1');
  $valorhab2=$http->request->get('txthabitacion2');
  $valorhab3=$http->request->get('txthabitacion3');
  $valorhabdepto=$http->request->get('txthabitacion4');



  $valores=$this->db->query_select("select * from tblvaloresmaximos where id_localidad='$id' and id_area='$id_area'");

  $this->db->update('tbllocalidades', array(
      'cod_localidad'=> $numlocalidad,
      'descripcion'=>$descripcionlocalidad,
      'hub'=>$hublocalidad,
    ),"id_localidad='$id'");

    if($valores==false){
      $this->db->insert('tblvaloresmaximos', array(
          'id_localidad'=> $id,
          'id_area'=>$id_area,
          'valor_viatico'=>$valorviatico,
          'valor_bus'=>$valorbus,
          'valor_avion'=>$valoravion,
          'valor_habsimple'=>$valorhab1,
          'valor_habdoble'=>$valorhab2,
          'valor_habtriple'=>$valorhab3,
          'valor_habdepto'=>$valorhabdepto,
        ));
    }else{
      $this->db->update('tblvaloresmaximos', array(
        'valor_viatico'=>$valorviatico,
        'valor_bus'=>$valorbus,
        'valor_avion'=>$valoravion,
        'valor_habsimple'=>$valorhab1,
        'valor_habdoble'=>$valorhab2,
        'valor_habtriple'=>$valorhab3,
        'valor_habdepto'=>$valorhabdepto,
      ),"id_localidad='$id' and id_area='$id_area'");
    }

     return array('success' => '1','message'=>'Datos modificados correctamente');
}

public function modificarproyecto(){
   global $http;
   $datusu=$this->user;
   $datousuario=$datusu['id_user'];
   $valorhospedaje=$http->request->get('txtvalortotal');
   $idproyecto=$http->request->get('id_proyecto');
   $numproyecto=$http->request->get('txtidproyecto');
   $descripcion=$http->request->get('txtdetalle');
   $nodo=$http->request->get('txtnodo');
   $cod_localidad=$http->request->get('textlocalidades');
   $monto_total=$http->request->get('txttotal');
   $fechainicio=$http->request->get('txtinicio');
   $fechafinal=$http->request->get('txtfinal');
   $cantdias=$http->request->get('txtdias');
   if($cantdias=='0'){
     $cantidad_dias_hospedaje='0';
   }else{
     $cantidad_dias_hospedaje=$cantdias-1;
   }
   $cantpersonas=$http->request->get('txtpersonal');
   if($cantpersonas==false){
     return array('success' => '0', 'message'=> 'Debe seleccionar personal');
   }
   $costototal=$http->request->get('txttotalcontrol');
   $monto_por_persona=$http->request->get('txtviatico');
   $pasaje_por_persona=$http->request->get('txtcostopasaje');
   $cantmovil=$http->request->get('txtcantmovil');
   $cantidad_peaje=$http->request->get('txtpeajes');
   $montopeaje=$http->request->get('txtmontopeaje');
   $ruthospedaje=$http->request->get('txtrut');
   $clientehospedaje=$http->request->get('txtcliente');
   $direccionhospedaje=$http->request->get('txtdireccion');
   $tipotransporte=$http->request->get('txtopcion');
   $totalhospedaje=$http->request->get('txtvalortotal');
   $porcentaje=$http->request->get('txtpago');
   $estado=$http->request->get('txtestado');
   if($estado=='0'){
     $porcentaje='100';
    }
   $usuario=$this->user;



   $this->db->update('tblcontrol_proyectos', array(
     'descrip_proyecto'=>$descripcion,
     'nodocuadrante'=>$nodo,
     'fecha_inicio'=>$fechainicio,
     'fecha_final'=>$fechafinal,
     'cant_dias'=>$cantdias,
     'cant_personas'=>$cantpersonas,
     'costo_total'=>$costototal,
   ),"id_proyecto='$idproyecto'");

    $usuarios=$this->db->query_select("select tblcalculotemporal.id_usuario,tblcalculotemporal.cantidad_dias,tblcalculotemporal.idasociada,tblcalculotemporal.usuario_registra,(SELECT tbldetalleviatico_temporal.chofer from tbldetalleviatico_temporal inner join tblcalculotemporal tbltemporal on tbldetalleviatico_temporal.id_user=tbltemporal.id_usuario where tbltemporal.id_usuario=tblcalculotemporal.id_usuario order by tbldetalleviatico_temporal.chofer desc limit 1) as chofer from tblcalculotemporal where usuario_registra='$datousuario'");
    if($usuarios!=false){
     $this->db->query_select("delete from tbldetalleviatico where id_detalleproyecto='$numproyecto'");
     foreach ($usuarios as $key => $value) {
       $this->db->insert('tbldetalleviatico', array(
       'id_detalleproyecto'=>$numproyecto,
       'fecha_inicio'=>$fechainicio,
       'fecha_termino'=>$fechafinal,
       'cant_dias'=>$value['cantidad_dias'],
       'idasociada'=>$value['idasociada'],
       'id_usuarios'=>$value['id_usuario'],
       'montoviaticopp'=>$monto_por_persona,
       'chofer'=>$value['chofer']
       ));
      }
    }
   if($pasaje_por_persona!=false){
         $revisarpasaje=$this->db->query_select("select precio_pasaje from tbldetalletransporte where id_detalletransporte='$numproyecto'");
         if($revisarpasaje!=false){
         $this->db->update('tbldetalletransporte', array(
           'fecha_inicio'=>$fechainicio,
           'fecha_termino'=>$fechafinal,
           'cant_persona'=>$cantpersonas,
           'precio_pasaje'=>$pasaje_por_persona,
           'tipo_transporte'=>$tipotransporte
         ),"id_detalletransporte='$numproyecto'");
       }else{
         $this->db->insert('tbldetalletransporte', array(
           'id_detalletransporte'=>$numproyecto,
           'fecha_inicio'=>$fechainicio,
           'fecha_termino'=>$fechafinal,
           'cant_persona'=>$cantpersonas,
           'precio_pasaje'=>$pasaje_por_persona,
           'tipo_transporte'=>$tipotransporte
         ));

       }
   }else{
     $revisarmovil=$this->db->query_select("select cant_movil from tbldetallemovil where id_detallemovil='$numproyecto'");
     if($revisarmovil==true){
       $this->db->update('tbldetallemovil', array(
         'cod_localidad'=>$cod_localidad,
         'fecha_inicio'=>$fechainicio,
         'fecha_final'=>$fechafinal,
         'cant_movil'=>$cantmovil,
         'costo_movil'=>$montopeaje,
         'cantidad_peajes'=>$cantidad_peaje
       ),"id_detallemovil='$numproyecto'");
     }else{
       $this->db->insert('tbldetallemovil', array(
         'id_detallemovil'=>$numproyecto,
         'cod_localidad'=>$cod_localidad,
         'fecha_inicio'=>$fechainicio,
         'fecha_final'=>$fechafinal,
         'cant_movil'=>$cantmovil,
         'costo_movil'=>$montopeaje,
         'cantidad_peajes'=>$cantidad_peaje
       ));


     }
      $this->db->query_select("delete from tbldetalletransporte where id_detalletransporte='$numproyecto'");


 }
 if($valorhospedaje!=false){
 $registros=$this->db->query_select("select * from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
 if($registros!=false){
 foreach ($registros as $key => $value) {
    $id=$value['id_tipohospedaje'];
    $habitaciones=$http->request->get('txthabitaciones'.$id);
    $personas=$http->request->get('txtperp'.$id);
    $costoxdia=$http->request->get('txtcostoxdia'.$id);
    $dia=$http->request->get('txtdia'.$id);

    }

    $this->db->update('detalle_hospedaje_temporal', array(
      'habitaciones'=>$habitaciones,
      'personas'=>$personas,
      'costo'=>$costoxdia,
      'dia'=>$dia,
    ),"id_tipohospedaje='$id' and usuario_registra='$datousuario'");

 }
}
 if($ruthospedaje!=false){
   if($estado!='0'){
   $this->db->update('tbldetallehospedaje', array(
     'rut_hospedaje'=>$ruthospedaje,
     'nombre_hospedaje'=>$clientehospedaje,
     'direccion_hospedaje'=>$direccionhospedaje,
     'total_hospedaje'=>$totalhospedaje,
     'porcentaje'=>$porcentaje
     ),"id_detallehospedaje='$numproyecto'");
      }else{
     $this->db->update('tbldetallehospedaje', array(
       'rut_hospedaje'=>$ruthospedaje,
       'nombre_hospedaje'=>$clientehospedaje,
       'direccion_hospedaje'=>$direccionhospedaje,
       'total_hospedaje'=>$totalhospedaje,
       ),"id_detallehospedaje='$numproyecto'");

      }

     $detallehos=$this->db->query_select("select * from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
     if($detallehos!=false){
     foreach ($detallehos as $key => $value) {
     $tipohos=$value['id_tipohospedaje'];
     $opciontipo=$this->db->query_select("select * from tbldetallehospedaje where id_detallehospedaje='$numproyecto' and tipo_hospedaje='$tipohos'");
     if($opciontipo!=false){

      $this->db->update('tbldetallehospedaje', array(
        'cant_habitaciones'=>$value['habitaciones'],
        'persoxhabi'=>$value['personas'],
        'costo_dia'=>$value['costo'],
        'dias'=>$value['dia'],
        ),"id_detallehospedaje='$numproyecto' and tipo_hospedaje='$tipohos'");

     }else{
       $this->db->insert('tbldetallehospedaje', array(
       'id_detallehospedaje'=>$numproyecto,
       'rut_hospedaje'=>$ruthospedaje,
       'nombre_hospedaje'=>$clientehospedaje,
       'direccion_hospedaje'=>$direccionhospedaje,
       'total_hospedaje'=>$totalhospedaje,
       'cant_habitaciones'=>$value['habitaciones'],
       'persoxhabi'=>$value['personas'],
       'costo_dia'=>$value['costo'],
       'dias'=>$value['dia'],
       'tipo_hospedaje'=>$value['id_tipohospedaje']
       ));
     }
     $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario'");

   }
  }
}else{
  $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario'");
  $this->db->query_select("delete from tbldetallehospedaje where id_detallehospedaje='$numproyecto'");

}
 return array('success' => '1','message'=>'Datos modificados correctamente');
}


public function conductor_movil(){
  $datusu=$this->user;
  $datousuario=$datusu['id_user'];
  $this->db->query_select("update tbldetalleviatico_temporal set chofer='0' where user_registra='$datousuario'");
  $html="
    <div class='box'>
       <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
       <thead>
         <th>CHOFER</th>
         <th>RUT</th>
         <th>NOMBRE</th>
         <th>CARGO</th>
       </thead>
       <tbody>
          <tr>";
          $seleccion=$this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico_temporal.id_user, tblpersonal.cargo_personal from tbldetalleviatico_temporal inner join tblpersonal on tbldetalleviatico_temporal.id_user=tblpersonal.cod_personal where user_registra='$datousuario'");
          if($seleccion!=false){
          foreach ($seleccion as $key2 => $value2) {
                $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")'></td>
                        <td>".$value2['rut_personal']."</td>
                        <td>".$value2['nombre_personal']."</td>
                        <td>".$value2['cargo_personal']."</td>
                        </tr>";
                      }
          }
          $html.="
        </tbody>
      </table>
      </div>";

      return array('success' => '1','html'=>$html);
    }

    public function mod_chofer($id){
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
       $usuario=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,tblpersonal.cargo_personal,tbldetalleviatico.chofer from tblpersonal INNER join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios where tbldetalleviatico.id_detalleproyecto='$id'");
       $this->db->query_select("delete from tbldetalleviatico_temporal where user_registra='$datousuario'");
       foreach ($usuario as $key => $value) {
          $this->db->insert('tbldetalleviatico_temporal', array(
              'id_user'=>$value['cod_personal'],
              'chofer'=>$value['chofer'],
              'user_registra'=>$datousuario
          ));
       }
       return $this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.nombre_personal,tblpersonal.cargo_personal,tbldetalleviatico.chofer from tblpersonal INNER join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios where tbldetalleviatico.id_detalleproyecto='$id'");
    }
    public function selec_chofersum(){
      global $http;
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
      $cantmoviles=$http->request->get('cantmoviles');
      $choferes=$http->request->get('choferes');
      $id_user=$http->request->get('id');
      $this->db->update('tbldetalleviatico_temporal', array(
        'chofer'=>'1'
      ),"id_user='$id_user' and user_registra='$datousuario'");
    if($cantmoviles==$choferes){
      $html="
        <div class='box'>
           <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
           <thead>
             <th>CHOFER</th>
             <th>RUT</th>
             <th>NOMBRE</th>
             <th>CARGO</th>
           </thead>
           <tbody>
              <tr>";
        $seleccion=$this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico_temporal.id_user, tblpersonal.cargo_personal,tbldetalleviatico_temporal.chofer from tbldetalleviatico_temporal inner join tblpersonal on tbldetalleviatico_temporal.id_user=tblpersonal.cod_personal where user_registra='$datousuario'");
              foreach ($seleccion as $key2 => $value2) {
                    if($value2['chofer']=='1'){
                          $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")' checked='checked'></td>";
                    }else{
                          $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")' disabled='true'></td>";
                    }
                    $html.="
                            <td>".$value2['rut_personal']."</td>
                            <td>".$value2['nombre_personal']."</td>
                            <td>".$value2['cargo_personal']."</td>
                            </tr>";
              }
              $html.="
            </tbody>
          </table>
          </div>";

          return array('success' => '1','html'=>$html);
    }
  }


    public function selec_choferres(){
      global $http;
      $datusu=$this->user;
      $datousuario=$datusu['id_user'];
      $id_user=$http->request->get('id');

      $this->db->update('tbldetalleviatico_temporal', array(
        'chofer'=>'0'
      ),"id_user='$id_user' and  user_registra='$datousuario'");
      $html="
          <div class='box'>
             <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
             <thead>
               <th>CHOFER</th>
                <th>RUT</th>
               <th>NOMBRE</th>
               <th>CARGO</th>
             </thead>
             <tbody>
                <tr>";
                      $seleccion=$this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico_temporal.id_user, tblpersonal.cargo_personal,tbldetalleviatico_temporal.chofer from tbldetalleviatico_temporal inner join tblpersonal on tbldetalleviatico_temporal.id_user=tblpersonal.cod_personal where user_registra='$datousuario'");
                foreach ($seleccion as $key2 => $value2) {
                      if($value2['chofer']=='1'){
                            $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")' checked='checked'></td>";
                      }else{
                            $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")'></td>";
                      }
                      $html.="
                              <td>".$value2['rut_personal']."</td>
                              <td>".$value2['nombre_personal']."</td>
                              <td>".$value2['cargo_personal']."</td>
                              </tr>";
                }
                $html.="
              </tbody>
            </table>
            </div>";

            return array('success' => '1','html'=>$html);
    }
    public function marcar_chofersum(){
      global $http;
      $cantmoviles=$http->request->get('cantmoviles');
      $choferes=$http->request->get('choferes');
      $id_user=$http->request->get('id');
      $this->db->update('tbldetalleviatico_temporal', array(
        'chofer'=>'1'
      ),"id_user='$id_user' and user_registra='$datousuario'");
    if($cantmoviles==$choferes){
      $html="
        <div class='box'>
           <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
           <thead>
             <th>CHOFER</th>
             <th>RUT</th>
             <th>NOMBRE</th>
             <th>CARGO</th>
           </thead>
           <tbody>
              <tr>";
              $seleccion=$this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico_temporal.id_user, tblpersonal.cargo_personal from tbldetalleviatico_temporal inner join tblpersonal on tbldetalleviatico_temporal.id_user=tblpersonal.cod_personal where user_registra='$datousuario'");
              foreach ($seleccion as $key2 => $value2) {
                    if($value2['chofer']=='1'){
                          $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")' checked='checked'></td>";
                    }else{
                          $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")' disabled='true'></td>";
                    }
                    $html.="
                            <td>".$value2['rut_personal']."</td>
                            <td>".$value2['nombre_personal']."</td>
                            <td>".$value2['cargo_personal']."</td>
                            </tr>";
              }
              $html.="
            </tbody>
          </table>
          </div>";

          return array('success' => '1','html'=>$html);
    }
  }
    public function marcar_choferres(){
      global $http;
      $id_user=$http->request->get('id');

      $this->db->update('tbldetalleviatico_temporal', array(
        'chofer'=>'0'
      ),"id_user='$id_user' and user_registra='$datousuario'");
      $html="
          <div class='box'>
             <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
             <thead>
               <th>CHOFER</th>
               <th>NOMBRE</th>
               <th>CARGO</th>
             </thead>
             <tbody>
                <tr>";
                $seleccion=$this->db->query_select("select tblpersonal.rut_personal, tblpersonal.nombre_personal, tbldetalleviatico_temporal.id_user, tblpersonal.cargo_personal from tbldetalleviatico_temporal inner join tblpersonal on tbldetalleviatico_temporal.id_user=tblpersonal.cod_personal where user_registra='$datousuario'");
                foreach ($seleccion as $key2 => $value2) {
                      if($value2['chofer']=='1'){
                            $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")' checked='checked'></td>";
                      }else{
                            $html.="<td><input type='checkbox' name='checkchof".$value2['id_user']."' id='checkchof".$value2['id_user']."' onclick='marcar(".$value2['id_user'].")'></td>";
                      }
                      $html.="
                              <td>".$value2['nombre_personal']."</td>
                              <td>".$value2['cargo_personal']."</td>
                              </tr>";
                }
                $html.="
              </tbody>
            </table>
            </div>";

            return array('success' => '1','html'=>$html);
    }

     public function select_tipo_hospedaje(){
       return $this->db->query_select("select * from tbltipohospedaje");
     }

    public function cargar_tipo(){
      $this->db->query_select("delete from detalle_hospedaje_temporal where usuario_registra='$datousuario'");

      $hospedaje=$this->db->query_select("select * from tbltipohospedaje");
      $html="";

      foreach ($hospedaje as $key => $value) {
      $html.="

      <div class='col-md-2'>
      <br>
      <br>
        <label><input type='checkbox' name='checktipo".$value['cod_tipo']."' id='checktipo".$value['cod_tipo']."' onclick='marcar_tipo_hospedaje(".$value['cod_tipo'].")'>&nbsp&nbsp".$value['tipo_habitacion']."</label>
      </div>
      <div class='col-md-2'>
      <br>
        <label>N° Habitaciones</label><input type='number' name='txthabitaciones".$value['cod_tipo']."' id='txthabitaciones".$value['cod_tipo']."' value='0' onfocusout='calcular_total(".$value['cod_tipo'].")' class='form-control ' disabled='true'>
      </div>
      <div class='col-md-2'>
      <br>
        <label>Personas por habitacion</label><input type='number' name='txtperp".$value['cod_tipo']."' id='txtperp".$value['cod_tipo']."' value='0'  class='form-control pr' disabled='true'>

      </div>
      <div class='col-md-2'>
      <br>
        <label>Costo por dia:</label><input type='number' name='txtcostoxdia".$value['cod_tipo']."' id='txtcostoxdia".$value['cod_tipo']."' onfocusout='validarhospedaje(".$value['cod_tipo'].")' value='0' class='form-control ' disabled='true'>
      </div>
      <div class='col-md-2'>
      <br>
        <label>Dias</label><input type='number' name='txtdia".$value['cod_tipo']."' id='txtdia".$value['cod_tipo']."' value='0'  class='form-control' onfocusout='calcular_total(".$value['cod_tipo'].")' disabled='true'>
      </div>
      <div class='col-md-2'>
      <br>
        <label>Total:</label><input type='text'  name='txtcostototal".$value['cod_tipo']."' id='txtcostototal".$value['cod_tipo']."'  class='form-control cl' value='0' disabled='true'>";
          $html.="</div>";

}
$html.="<input type='hidden' id='per' name='per'>";
$html.="<div class='col-md-8'></div>
        <div class='col-md-2'>
        <br>
        <p>
        <center>
        <label>TOTAL</label>
        </center></div>
   <div class='col-md-2'>
<br>
<input type='number' name='txtvalortotal' id='txtvalortotal' value='0'  class='form-control total'>
</div>";
      return array('success' => '1', 'html'=>$html);
    }

// public function select_hospedaje(){
//     global $http;
//     $id=$http->request->get('id');
//     $tipo=$http->request->get('tipo');
//
//     $this->db->update('tbldetalleviatico_temporal', array(
//       'codigo_hospedaje'=>$tipo
//     ),"id_user='$id' and user_registra='$datousuario'");
//
//     $html="<div class='box'>
//          <table class='table table-bordered table-responsive'>
//          <thead>
//            <th>SELECCIONAR</th>
//            <th>RUT</th>
//            <th>USUARIO</th>
//            <th>HOSPEDAJE</th>
//          </thead>
//          <tbody>
//             <tr>";
//             $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.rut_personal,tblpersonal.rut_personal,codigo_hospedaje from tblpersonal inner join tbldetalleviatico_temporal on tblpersonal.cod_personal=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
//             foreach ($usuarios as $key2 => $value2) {
//                if($value2['codigo_hospedaje']!='0'){
//                     $html.="<td><input type='checkbox' name='check".$value2['cod_personal']."' id='check".$value2['cod_personal']."' checked='checked' onclick='marcar_usuario_hospedaje(".$value2['cod_personal'].")'></td>";
//                     }else{
//                     $html.="<td><input type='checkbox' name='check".$value2['cod_personal']."' id='check".$value2['cod_personal']."' onclick='marcar_usuario_hospedaje(".$value2['cod_personal'].")'></td>";
//                     }
//
//                     $html.="<td>".$value2['rut_personal']."</td>
//                       <td>".$value2['name']."</td>";
//                       if($value2['codigo_hospedaje']=='0'){
//                         $html.="<td>SIN ASIGNAR</td>";
//                       }elseif($value2['codigo_hospedaje']=='1'){
//                           $html.="<td>Habitacion Simple</td>";
//                       }elseif($value2['codigo_hospedaje']=='2'){
//                           $html.="<td>Habitacion Doble</td>";
//                       }elseif($value2['codigo_hospedaje']=='3'){
//                           $html.="<td>Habitacion Triple</td>";
//                       }else{
//                           $html.="<td>Cabaña o Depto</td>";
//                       }
//                       $html.="</tr>";
//             }
//             $html.=
//             "<tr>
//           </tbody>
//         </table>
//
//         </div>";
//
//   return array('success' => '1', 'html'=>$html);
//
// }

// public function descartar_hospedaje(){
//   global $http;
//   $id=$http->request->get('id');
//
//   $this->db->update('tbldetalleviatico_temporal', array(
//     'codigo_hospedaje'=>'0'
//   ),"id_user='$id' and user_registra='$datousuario'");
//
//   $html="<div class='box'>
//        <table class='table table-bordered table-responsive'>
//        <thead>
//          <th>SELECCIONAR</th>
//          <th>RUT</th>
//          <th>USUARIO</th>
//          <th>HOSPEDAJE</th>
//        </thead>
//        <tbody>
//           <tr>";
//           $usuarios=$this->db->query_select("select users.id_user,rut_personal,name,codigo_hospedaje from users inner join tbldetalleviatico_temporal on users.id_user=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
//           foreach ($usuarios as $key2 => $value2) {
//              if($value2['codigo_hospedaje']!='0'){
//                   $html.="<td><input type='checkbox' name='check".$value2['id_user']."' id='check".$value2['id_user']."' checked='checked' onclick='marcar_usuario_hospedaje(".$value2['id_user'].")'></td>";
//                   }else{
//                   $html.="<td><input type='checkbox' name='check".$value2['id_user']."' id='check".$value2['id_user']."' onclick='marcar_usuario_hospedaje(".$value2['id_user'].")'></td>";
//                   }
//
//                   $html.="<td>".$value2['rut_personal']."</td>
//                     <td>".$value2['name']."</td>";
//                     if($value2['codigo_hospedaje']=='0'){
//                       $html.="<td>SIN ASIGNAR</td>";
//                     }elseif($value2['codigo_hospedaje']=='1'){
//                         $html.="<td>Habitacion Simple</td>";
//                     }elseif($value2['codigo_hospedaje']=='2'){
//                         $html.="<td>Habitacion Doble</td>";
//                     }elseif($value2['codigo_hospedaje']=='3'){
//                         $html.="<td>Habitacion Triple</td>";
//                     }else{
//                         $html.="<td>Cabaña o Depto</td>";
//                     }
//
//                     $html.="</tr>";
//           }
//           $html.=
//           "<tr>
//         </tbody>
//       </table>
//
//       </div>";
//
// return array('success' => '1', 'html'=>$html);
// }

public function descartar_tipo(){
  global $http;
  $tipo=$http->request->get('tipo');

  $this->db->update('tbldetalleviatico_temporal', array(
    'codigo_hospedaje'=>'0'
  ),"codigo_hospedaje='$tipo' and user_registra='$datousuario'");

  $html="<div class='box'>
       <table class='table table-bordered table-responsive'>
       <thead>
         <th>SELECCIONAR</th>
         <th>RUT</th>
         <th>USUARIO</th>
         <th>HOSPEDAJE</th>
       </thead>
       <tbody>
          <tr>";
          $usuarios=$this->db->query_select("select users.id_user,rut_personal,name,codigo_hospedaje from users inner join tbldetalleviatico_temporal on users.id_user=tbldetalleviatico_temporal.id_user where user_registra='$datousuario'");
          foreach ($usuarios as $key2 => $value2) {
             if($value2['codigo_hospedaje']!='0'){
                  $html.="<td><input type='checkbox' name='check".$value2['id_user']."' id='check".$value2['id_user']."' checked='checked' onclick='marcar_usuario_hospedaje(".$value2['id_user'].")'></td>";
                  }else{
                  $html.="<td><input type='checkbox' name='check".$value2['id_user']."' id='check".$value2['id_user']."' onclick='marcar_usuario_hospedaje(".$value2['id_user'].")'></td>";
                  }

                  $html.="<td>".$value2['rut_personal']."</td>
                    <td>".$value2['name']."</td>";
                    if($value2['codigo_hospedaje']=='0'){
                      $html.="<td>SIN ASIGNAR</td>";
                    }elseif($value2['codigo_hospedaje']=='1'){
                        $html.="<td>Habitacion Simple</td>";
                    }elseif($value2['codigo_hospedaje']=='2'){
                        $html.="<td>Habitacion Doble</td>";
                    }elseif($value2['codigo_hospedaje']=='3'){
                        $html.="<td>Habitacion Triple</td>";
                    }else{
                        $html.="<td>Cabaña o Depto</td>";
                    }

                    $html.="</tr>";
          }
          $html.=
          "<tr>
        </tbody>
      </table>

      </div>";

  return array('success' => '1', 'html'=>$html);

}

public function costo_hospedaje(){
  global $http;
  $dias=$http->request->get('dias');
  $datusu=$this->user;
  $datousuario=$datusu['id_user'];
  $html="";
    $tipo_hospedaje=$this->db->query_select("select DISTINCT codigo_hospedaje, tbltipohospedaje.tipo_habitacion,tbltipohospedaje.cantidad_personas from tbldetalleviatico_temporal inner join tbltipohospedaje on tbldetalleviatico_temporal.codigo_hospedaje=tbltipohospedaje.cod_tipo where user_registra='$datousuario'");
    if($tipo_hospedaje!=false){
        foreach ($tipo_hospedaje as $key => $value) {
            $cantidadxtipo=$this->db->query_select("select count(codigo_hospedaje) as cantidad from tbldetalleviatico_temporal where codigo_hospedaje='".$value['codigo_hospedaje']."' and where user_registra='$datousuario'");
            $cantidadhabitaciones=$cantidadxtipo[0][0]%$value['cantidad_personas'];
            if($cantidadxtipo[0][0]>='4'){
              $cantidadhabitaciones='0';
            }

            if($cantidadhabitaciones=='0'){
            $numdhabitaciones=$cantidadxtipo[0][0]/$value['cantidad_personas'];
            $numdhabitaciones=round($numdhabitaciones);
            $html.="<div class='col-md-3'>
            <br>
              <label>Tipo Hospedaje:</label><input type='text' name='txttipo".$value['codigo_hospedaje']."' id='txttipo".$value['codigo_hospedaje']."' value='".$value['tipo_habitacion']."' class='form-control'>
            </div>
            <div class='col-md-2'>
            <br>
              <label>N° Habitaciones</label><input type='number' name='txthabitaciones".$value['codigo_hospedaje']."' id='txthabitaciones".$value['codigo_hospedaje']."' value='$numdhabitaciones'  class='form-control' readonly>
            </div>
            <div class='col-md-2'>
            <br>
              <label>Costo por dia:</label><input type='number' name='txtcostoxdia".$value['codigo_hospedaje']."' id='txtcostoxdia".$value['codigo_hospedaje']."' onfocusout='validarhospedaje(".$value['codigo_hospedaje'].")' class='form-control'>
            </div>
            <div class='col-md-2'>
            <br>
              <label>Dias</label><input type='number' name='txtdia".$value['codigo_hospedaje']."' id='txtdia".$value['codigo_hospedaje']."' value='$dias'  class='form-control' readonly>
            </div>
            <div class='col-md-3'>
            <br>
              <label>Total:</label><input type='text'  name='txtcostototal".$value['codigo_hospedaje']."' id='txtcostototal".$value['codigo_hospedaje']."' class='form-control'>
            </div>";

          }else{
            return array('success' => '0', 'message'=>'La distribucion no se ha realizado correctamente');
          }
            }
            $html.="<div class='col-md-5'>
            <br>
            </div>
            <div class='col-md-4'>
            <br>
            </div>
            <div class='col-md-3'>
            <br>
              <label>Total Hospedaje:</label><input type='text'  name='txttotalhospedaje' id='txttotalhospedaje' value='0' class='form-control'>
            </div>";
            return array('success' => '1', 'html'=>$html);
     }
     return array('success' => '0', 'message'=>'Debe asignar habitaciones');
}

public function cantidad_hospedaje(){
  global $http;
  $id=$http->request->get('id');
  $costohab=$http->request->get('costohab');
  $habitaciones=$http->request->get('habitaciones');

  $this->db->update('tbldetalleviatico_temporal', array(
    'cantidad_ha'=>$habitaciones,
    'costo_hab'=>$costohab
  ),"codigo_hospedaje='$id' where user_registra='$datousuario'");

  $tipohospedaje=$this->db->query_select("select count(cod_tipo) from tbltipohospedaje");
  return array('success' => '1', 'num'=>$tipohospedaje[0][0]);
}

public function marcar_hos(){
  global $http;
  $id=$http->request->get('id');
  $datusu=$this->user;
  $datousuario=$datusu['id_user'];
  $this->db->insert('detalle_hospedaje_temporal', array(
    'id_tipohospedaje'=>$id,
    'usuario_registra'=>$datousuario
  ));
}

public function descartar_hos(){
  global $http;
  $id=$http->request->get('id');
  $this->db->query_select("delete from detalle_hospedaje_temporal where id_tipohospedaje='$id'");
}

public function validar_precio(){
  global $http;
  $id=$http->request->get('id');
  $localidad=$http->request->get('localidades');
  $area=$http->request->get('area');
  $costodia=$http->request->get('costodia');

  $comprobarlocalidad=$this->db->query_select("select * from tbllocalidades where id_localidad='$localidad'");
  if($comprobarlocalidad==false){
  $verlocalidad=$this->db->query_select("select id_localidad from tbllocalidades where descripcion='$localidad'");
  $localidad=$verlocalidad[0][0];
  }

  $comprobararea=$this->db->query_select("select * from tblareas where cod_area='$area'");
  if($comprobararea==false){
  $verarea=$this->db->query_select("select cod_area from tblareas where descripcion='$area'");
  $area=$verarea[0][0];
  }

  if($id==1){
    $valorhospedaje=$this->db->query_select("select valor_habsimple from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
    if($valorhospedaje[0][0]<$costodia){
      $valor=$valorhospedaje[0][0];
      return array('success'=>'0', "message"=>"El valor del hospedaje no puede exceder ".$valor);
    }
  }elseif($id==2){
    $valorhospedaje=$this->db->query_select("select valor_habdoble from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
    if($valorhospedaje[0][0]<$costodia){
      $valor=$valorhospedaje[0][0];
      return array('success'=>'0', "message"=>"El valor del hospedaje no puede exceder ".$valor);
    }
  }elseif($id==3){
    $valorhospedaje=$this->db->query_select("select valor_habtriple from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
    if($valorhospedaje[0][0]<$costodia){
      $valor=$valorhospedaje[0][0];
      return array('success'=>'0', "message"=>"El valor del hospedaje no puede exceder ".$valor);
    }
  }elseif($id==4){
    $valorhospedaje=$this->db->query_select("select valor_habdepto from tblvaloresmaximos where id_localidad='$localidad' and id_area='$area'");
    if($valorhospedaje[0][0]<$costodia){
      $valor=$valorhospedaje[0][0];
      return array('success'=>'0', "message"=>"El valor del hospedaje no puede exceder ".$valor);
    }
  }else{
  }
}

public function eliminar(){
  global $http;
  $id=$http->request->get('id');
  $orden=$this->db->query_select("select num_proyecto from tblcontrol_proyectos where id_proyecto='$id'");
  $numproyecto=$orden[0][0];
  $this->db->query_select("delete from tbldetalleviatico where id_detalleproyecto='$numproyecto'");
  $this->db->query_select("delete from tbldetalletransporte where id_detalletransporte='$numproyecto'");
  $this->db->query_select("delete from tbldetallemovil where id_detallemovil='$numproyecto'");
  $this->db->query_select("delete from tbldetallehospedaje where id_detallehospedaje='$numproyecto'");
  $this->db->query_select("delete from tblcontrol_proyectos where num_proyecto='$numproyecto'");

  return array('success'=>'1','message'=>'Control Eliminado');

}

public function pagar_control(){
  global $http;
  $id=$http->request->get('id');
  $this->db->update('tblcontrol_proyectos', array(
    'estado'=>'4'
  ),"id_proyecto='$id'");

  return array('success'=>'1');
}
public function cargararchivo(){
  global $http;
  $id=$http->request->get('id');
  $documento=$http->files->get('documento');

  $docname="";
  if(null!==$documento){
    $ext_doc=$documento->getClientOriginalExtension();

     if ($ext_doc<>'pdf' and $ext_doc<>'jpg') return array('success' => 0, 'message' => "Debe seleccionar un archivo valido...");
          $docname="CONTROL_$id.".$ext_doc;

  $documento->move(API_INTERFACE . 'views/app/facturas/', $docname);
  $this->db->update('tblcontrol_proyectos', array(
      'factura'=>'1'
    ),"id_proyecto='$id'");
    return array('success'=>'1', 'message'=>'Factura Ingresada');

  }else{
             return array('success' => 0, 'message' => "Debe seleccionar un archivo valido...");
         }
  }
  public function verfactura(){
    global $http;
    $id=$http->request->get('id');
    $factura=$this->db->query_select("select factura from tblcontrol_proyectos where id_proyecto='$id' and factura='1'");
    if($factura!=false){

            $html="
            <div id='portapdf'>
            <div class='col-md-1'>
            </div>
            <div class='col-md-5'>
            <iframe src='views/app/facturas/CONTROL_$id.pdf' id='factura' name='factura' width='1300' height='700'/>
            </div>
            </div>
            </div>";

            return array('success'=>'1','html'=>$html);
    }else{
        return array('success'=>'0','message'=>'No existe factura asociada');
    }




  }
//----------------------------------------------------------------------------------------------------------------------Areas
  public function listar_areas(){
    return $this->db->query_select("select * from tblareas");
  }
  public function listar_areas_activas(){
    return $this->db->query_select("select * from tblareas where estado=1");
  }

  public function ver_areas(){
    return $this->db->query_select("select * from tblareas where estado=1");
  }

  public function guardararea(){
     global $http;
     $codarea=$http->request->get('txtcodarea');
     $decripcion=$http->request->get('txtnombrearea');
     $area=$this->db->query_select("select * from tblarea where cod_area='$codarea'");
     if($area!=false){
         $this->db->insert('tblareas', array (
           'cod_area'=>$codarea,
           'descripcion'=>$descripcion
         ));

         return array('success'=>1, 'message'=>'La nueva area se guardo correctamente');
      }else{
          return array('success'=>0, 'message'=>'El area ya existe');
      }

  }

  public function eliminararea(){
    global $http;
    $id=$http->request->get('id');
    $this->db->query_select("update tblareas set estado='0' where codigo='$id'");

    return array('success'=>1, 'message'=>'Datos Eliminados');
  }

  public function get_orden_byId3(int $id){
    return $this->db->query_select("select * from tblareas where codigo=$id");

   }

   public function modificararea(){
     global $http;
     $codarea=$http->request->get('txteditarcodarea');
     $descripcion=$http->request->get('txteditarnombrearea');
     $codigo=$http->request->get('textid');

     $this->db->update('tblareas', array(
       'cod_area'=>$codarea,
       'descripcion'=>$descripcion

     ), "codigo='$codigo'");

     return array('success'=>1, 'message'=>'Datos modificados correctamente');
   }

   public function reactivararea(){

     $dias=$this->db->query_select("select id_proyecto, (cant_dias-1) as datos from tblcontrol_proyectos");
     foreach ($dias as $key => $value) {
       $id=$value['id_proyecto'];
       $this->db->update('tblcontrol_proyectos', array (
         'cant_dias_hospedaje'=>$value['datos']
       ),"id_proyecto='$id'");
     }

     // global $http;
     // $codigo=$http->request->get('id');
     //
     // $this->db->update('tblareas', array(
     //   'estado'=>'1'
     //
     // ), "codigo='$codigo'");
     //
     // return array('success'=>1, 'message'=>'Area Reactivada');

   }

   public function eliminardatos(){
     global $http;
     $resultado=$http->request->get('resultado');
     if($resultado=='0'){
       $datusu=$this->user;
       $datousuario=$datusu['id_user'];
       $this->db->query_select("delete from tbldetalleviatico_temporal where user_registra='$datousuario'");
       return array("success"=>1);
     }
   }

   public function cambiardatos(){
     global $http;
     $fecha=date('Y-m-d');
     $tipotrabajo=$http->request->get('cmbtipotrabajo');
     $localidad=$http->request->get('cmblocalidades');
     $datusu=$this->user;
     $datousuario=$datusu['id_user'];
     $this->db->query_select("delete from tbldetalleviatico_temporal where user_registra='$datousuario'");
     $this->db->query_select("delete from tblcalculotemporal where usuario_registra='$datousuario'");
     $opciones=$this->db->query_select("select * from tblvaloresmaximos where id_area='$tipotrabajo' and id_localidad='$localidad'");
     if($opciones==false){
       return array('success'=>0,'message'=>'Verificar que hayan valores asignados para la Region y el Area seleccionada');
     }else{
       $html="<div class='box'>
          <div class='box-header'>
          <h3 class='box-title'>Viatico</h3>
          </div>
        <div class='box-body'>
          <div class='col-md-4'>
            <label>INICIO:</label><input type='DATE' name='txtinicio' id='txtinicio' class='form-control' VALUE='$fecha'>
          </div>
          <div class='col-md-4'>
            <label>TERMINO:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='calc_dias(1)' class='form-control'  VALUE='$fecha'>
          </div>
          <div class='col-md-4'>
            <label>DIAS VIATICO:</label><input type='number' name='txtdias' id='txtdias' class='form-control'>
          </div>
          <div class='col-md-2'>
          <br>
          <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(1)' title='Seleccionar' data-toggle='tooltip'>
           Seleccionar Personal
          </a>
          </div>
          <div class='col-md-3'>
          <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control'>
          </div>
          <div class='col-md-3'>
              <label>MONTO VIATICO P/P</label><input type='text' name='txtviatico' id='txtviatico' value='".$opciones[0]['valor_viatico']."' class='form-control' readonly='readonly'>
          </div>
          <div class='col-md-4'>
              <label>TOTAL VIATICO</label><input type='number' name='txtrest' id='txtrest' class='form-control total'>
              <br>
          </div>
          <input type='hidden' id='textprincipal' name='textprincipal' value='1'>
            <div class='col-md-12' id='divpersonal' name='divpersonal'>

            </div>
      </div>
    </div>";

    $html2="<div class='box'>
            <div class='box-header'>
           <h3 class='box-title'>Transporte</h3>
            &nbsp
            &nbsp
           <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(4)' checked='checked'>BUS</label>
           &nbsp
           <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(5)'>AVION</label>
           &nbsp
           <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(6)'>MOVIL</label>
           </div>
           <div class='box-body'>
           <div class='col-md-4'>
            <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='validarpasajes()' class='form-control'>
            </div>
           <div class='col-md-4'>
           <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
           </div>
           <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
           </div>
           </div>
           </div>";

           return array('success'=>1,'html'=>$html, 'html2'=>$html2);
     }


   }
   public function cargarareas(){
        global $http;
        $area=$http->request->get('area');
        $localidades=$http->request->get('localidades');
        $valoresmaximos=$this->db->query_select("select * from tblvaloresmaximos where id_localidad='$localidades' and id_area='$area'");

        if($valoresmaximos==false){
          $html="<div class='form-group'>
                <br>
                <label>VIATICO</label>
                <br>
                <label for='txtcheckviatico'>Monto Viatico</label>
                <input type='text' class='form-control' name='txtcheckviatico' id='txtcheckviatico'>
                <br>
                <label>TRANSPORTE BUS</label>
                <br>
                <label for='txtmontobus'>Valor maximo pasaje bus</label>
                <input type='text' class='form-control' name='txtmontobus' id='txtmontobus'>
                <br>
                <label>TRANSPORTE AVION</label>
                <br>
                <label for='txtmontoavion'>Valor maximo pasaje Avion</label>
                <input type='text' class='form-control' name='txtmontoavion' id='txtmontoavion'>
                <br>
                <label>HOSPEDAJE</label>
                <br>
                <label for='txthabitacion1'>Valor maximo habitacion simple</label>
                <input type='text' class='form-control' name='txthabitacion1' id='txthabitacion1'>
                <br>
                <label for='txthabitacion2'>Valor maximo habitacion doble</label>
                <input type='text' class='form-control' name='txthabitacion2' id='txthabitacion2'>
                <br>
                <label for='txthabitacion3'>Valor maximo habitacion triple</label>
                <input type='text' class='form-control' name='txthabitacion3' id='txthabitacion3'>
                <br>
                <label for='txthabitacion4'>Valor maximo Depto o Cabaña</label>
                <input type='text' class='form-control' name='txthabitacion4' id='txthabitacion4'>
                <br>
                <div class='box-body col-md-4'>
                </div>
                <div class='box-body col-md-4'>
                  <center>
                  <button type='button' class='btn btn-primary' id='btnmodificar' onclick='modificarlocalidad()' name='btnmodificar'>MODIFICAR LOCALIDAD</button>
                </center>
                </div>";

        }else{
          $html="<div class='form-group'>
                <br>
                <label>VIATICO</label>
                <br>
                <label for='txtcheckviatico'>Monto Viatico</label>
                <input type='text' class='form-control' name='txtcheckviatico' id='txtcheckviatico' value=".$valoresmaximos[0]['valor_viatico'].">
                <br>
                <label>TRANSPORTE BUS</label>
                <br>
                <label for='txtmontobus'>Valor maximo pasaje bus</label>
                <input type='text' class='form-control' name='txtmontobus' id='txtmontobus' value=".$valoresmaximos[0]['valor_bus'].">
                <br>
                <label>TRANSPORTE AVION</label>
                <br>
                <label for='txtmontoavion'>Valor maximo pasaje Avion</label>
                <input type='text' class='form-control' name='txtmontoavion' id='txtmontoavion' value=".$valoresmaximos[0]['valor_avion'].">
                <br>
                <label>HOSPEDAJE</label>
                <br>
                <label for='txthabitacion1'>Valor maximo habitacion simple</label>
                <input type='text' class='form-control' name='txthabitacion1' id='txthabitacion1' value=".$valoresmaximos[0]['valor_habsimple'].">
                <br>
                <label for='txthabitacion2'>Valor maximo habitacion doble</label>
                <input type='text' class='form-control' name='txthabitacion2' id='txthabitacion2' value=".$valoresmaximos[0]['valor_habdoble'].">
                <br>
                <label for='txthabitacion3'>Valor maximo habitacion triple</label>
                <input type='text' class='form-control' name='txthabitacion3' id='txthabitacion3' value=".$valoresmaximos[0]['valor_habtriple'].">
                <br>
                <label for='txthabitacion4'>Valor maximo Depto o Cabaña</label>
                <input type='text' class='form-control' name='txthabitacion4' id='txthabitacion4' value=".$valoresmaximos[0]['valor_habdepto'].">
                <br>
                </div>
                <br>
                <div class='box-body col-md-4'>
                </div>
                <div class='box-body col-md-4'>
                  <center>
                  <button type='button' class='btn btn-primary' id='btnmodificar' onclick='modificarlocalidad()' name='btnmodificar'>GUARDAR LOCALIDAD</button>
                </center>
                </div>";
              }
              return array('success'=>'1','html'=>$html);
   }


public function generar_pdf($id){
  global $http;
  global $config;


  if ($id != false){
  $mpdf = new mPDF('c', 'A4-L');
  $mpdf->allow_charset_conversion=true;
  $mpdf->charset_in = 'ISO-8859-1';

  $mpdf->SetDisplayMode('fullpage');
  $html="<html>";
  $html.="<head>
        <link href='views/app/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet' />
        </head>";
  $html.="<body>";
  $orden=$this->db->query_select("select tbllocalidades.descripcion,tblcontrol_proyectos.id_proyecto,tblcontrol_proyectos.num_proyecto,tblcontrol_proyectos.cod_localidad,tblcontrol_proyectos.area,tblcontrol_proyectos.descrip_proyecto,tblcontrol_proyectos.nodocuadrante,tblcontrol_proyectos.fecha_inicio,tblcontrol_proyectos.fecha_final,tblcontrol_proyectos.cant_dias,tblcontrol_proyectos.cant_dias_hospedaje,tblcontrol_proyectos.id_detalleviatico,tblcontrol_proyectos.id_detalletransporte,tblcontrol_proyectos.id_detallehospedaje,tblcontrol_proyectos.cant_personas,tblcontrol_proyectos.costo_total,tblcontrol_proyectos.estado,tblcontrol_proyectos.fecha_ingreso,tblcontrol_proyectos.id_user,(select email from users inner join tblcontrol_proyectos tblcon2 on users.id_user=tblcon2.id_user where tblcon2.id_proyecto=tblcontrol_proyectos.id_proyecto) as correo, tblcontrol_proyectos.observacion,tblcontrol_proyectos.usuario_aprueba from tblcontrol_proyectos inner join tbllocalidades on tblcontrol_proyectos.cod_localidad=tbllocalidades.id_localidad where id_proyecto='$id'");
  if ($orden != false)
  {
  foreach ($orden as $key => $value) {
  $html.="<div class='box'>";
    $html.="<div class='col-md-10'>";
        $html.="<div class='box'>";
        $html.="<div class='box-body'>";
        $html.="<div class='box-header'>";
        $html.="<h3 class='box-title'>DATOS</h3>";
        $html.="</div>";
        $html.="<br>";
        $html.="<div class='col-md-6'>";
        $html.="<label>CODIGO PROYECTO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>CODIGO LOCALIDAD</label>";
        $html.="<p>";
        $html.="<input type='text' size='120' name='textocodigo' id='textocodigo' value='".strtolower(utf8_decode($value['num_proyecto']))."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textocodigolocalidad' size='120' id='textocodigolocalidad' value='".strtolower(utf8_decode($value['descripcion']))."'  class='form-control'>";
        $html.="</div>";
        $html.="<p>";
        $html.="<div class='col-md-4'>";
        $html.="<label>SOLICITANTE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>AREA</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>DESCRIPCION PROYECTO</label>";
        $html.="<p>";
        $html.="<input type='text' name='textsolicitante' size='80' id='textsolicitante' value='".strtolower(utf8_decode($value['correo']))."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textarea' size='80' id='textarea' value='".utf8_decode($value['area'])."'  class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textdescripcion' size='80' id='textdescripcion' value='".strtolower(utf8_decode($value['descrip_proyecto']))."' class='form-control'>";
        $html.="</div>";
        $html.="<p>";
        $html.="<div class='col-md-4'>";
        $html.="<label>FECHA INICIO</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>FECHA FINAL</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>CANTIDAD PERSONAS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>CANTIDAD DE DIAS</label>";
        $html.="<p>";
        $html.="<input type='text' name='textofechainicio' size='55' id='textofechainicio' value='".strtolower(utf8_decode($value['fecha_inicio']))."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textofechafinal' id='textofechafinal' size='55' value='".strtolower(utf8_decode($value['fecha_final']))."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textocantidadpersonas' id='textocantidadpersonas' size='55' value='".strtolower(utf8_decode($value['cant_personas']))."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        if($value['cant_dias']==0){
        $html.="<input type='text' name='textocantidaddias' id='textocantidaddias' size='55' value='".strtolower(utf8_decode($value['cant_dias_hospedaje']))."'  class='form-control'>";
        }else{
        $html.="<input type='text' name='textocantidaddias' size='55' id='textocantidaddias' value='".strtolower(utf8_decode($value['cant_dias']))."'  class='form-control'>";
        }
        $html.="</div>";
        $html.="<br>";


        if($value['cant_dias']==0){
        }else{
                $transporte=$this->db->query_select("select precio_pasaje,tipo_transporte from tbldetalletransporte where id_detalletransporte='".$value['num_proyecto']."'");
                if($transporte==false){
                    $peaje=$this->db->query_select("select tbldetallemovil.cant_movil,tbldetallemovil.cantidad_peajes,tbldetallemovil.costo_movil from tbldetallemovil where id_detallemovil='".$value['num_proyecto']."'");
                    foreach ($peaje as $key3 => $value3) {
                    $total=$value3['costo_movil']*$value3['cant_movil'];
                    if($total==false){
                      $html.="<div class='box-header'>
                        <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                        <br>
                        <br>
                      </div>
                      <div class='col-md-12'>
                      <table class='table table-bordered table-responsive'>
                           <thead>
                           <tr>
                             <th>RUT</th>
                             <th>USUARIO</th>
                             <th>VIATICO</th>
                             <th>ORDEN ASOCIADA</th>
                            </tr>
                           </thead>
                           <tbody>";
                              $valorviatico='0';
                              $viaticopp='0';
                              $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                              foreach ($usuarios as $key2 => $value2) {
                                  $html.="<tr>";
                                    $viaticopp=$value2['montoviaticopp']*$value['cant_dias'];
                                    $html.="<td>".$value2['rut_personal']."</td>
                                            <td>".strtolower(utf8_decode($value2['nombre_personal']))."</td>
                                            <td>".$viaticopp."</td>
                                            </tr>";
                                            $valorviatico=$valorviatico+$viaticopp;
                              }
                              $html.=
                              "<tr>
                                <td>TOTAL</td>
                                <td></td>
                                <td>".$valorviatico."</td>
                            </tbody>
                          </table>
                          </div>";


                    }else{
                    $html.="<div class='box-header'>
                            <h3 class='box-title'>TRANSPORTE</h3>
                          </div>
                            <br>
                          <div class='col-md-2'>
                              <label>TIPO DE TRANSPORTE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>CANTIDAD MOVILES</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>VALOR PEAJES</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>CANTIDAD DE PEAJES</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>TOTAL TRANSPORTE</label>
                          </div>
                          <div class='col-md-2'>
                              <input type='text' name='textotipo' size='45' id='textotipo' value='MOVIL' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textocantidadmovil' size='45' id='textocantidadmovil' value='".$value3['cant_movil']."'  class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textovalorpeaje' size='45' id='textovalorpeaje' value='".$value3['costo_movil']."'  class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textocantidadpeaje' size='45' id='textocantidadpeaje' value='".$value3['cantidad_peajes']."'  class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textototaltrans' size='45' id='textototaltrans' value='$total'  class='form-control'>
                           <br>
                           <br>
                           <br>
                          </div>
                            <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                            <br>
                            <br>

                         <table class='table table-bordered'>
                         <thead>
                            <tr>
                                 <th>RUT</th>
                                 <th>USUARIO</th>
                                 <th>VIATICO</th>
                                 <th>PEAJES(CHOFER)</th>
                                 <th>TOTAL_POR_PERSONA</th>
                                 <th>ORDEN ASOCIADA</th>
                            </tr>
                          </thead>";
                      $html.="<tbody>";

                      $valorviatico='0';
                      $viaticopp='0';
                      $valormovil='0';
                      $suma_peaje='0';
                      $suma_x_persona='0';
                      $totaltodo='0';
                      $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.chofer, tbldetallemovil.costo_movil from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                      foreach ($usuarios as $key2 => $value2) {
                          $html.="<tr>";
                            $viaticopp=$value2['montoviaticopp']*$value['cant_dias'];
                            $html.="<td>".$value2['rut_personal']."</td>
                                    <td>".strtolower(utf8_decode($value2['nombre_personal']))."</td>
                                    <td>".$viaticopp."</td>";
                                    if($value2['chofer']=='1'){
                            $html.="<td>".$value2['costo_movil']."</td>";
                                    $valormovil=$value2['costo_movil'];
                                    }else{
                            $html.="<td>0</td>";
                                   $valormovil='0';
                                    }
                                    $suma_x_persona=$viaticopp+$valormovil;
                            $html.="<td>".$suma_x_persona."</td>
                                    </tr>";
                                    $valorviatico=$valorviatico+$viaticopp;
                                    $suma_peaje=$suma_peaje+$valormovil;
                            $totaltodo=$totaltodo+$suma_x_persona;
                      }
                      $html.=
                      "<tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td>".$valorviatico."</td>
                        <td>".$suma_peaje."</td>
                        <td>".$totaltodo."</td>
                        </tbody>
                        </table>";
                        }
                      }
                 }else{
                    foreach ($transporte as $key3 => $value3) {
                    if($value3['tipo_transporte']=='1'){
                      $trans='BUS';
                    }elseif($value3['tipo_transporte']=='2'){
                      $trans='AVION';
                    }else{
                      $trans='MOVIL';
                    }
                    $totalpasaje=$value3['precio_pasaje']*$value['cant_personas'];
                    $html.="
                    </div>
                      <div class='box-body'>
                        <div class='box-header'>
                          <h3 class='box-title'>TRANSPORTE</h3>
                        </div>
                        <br>
                        <div class='col-md-3'>
                          <label>TIPO DE TRANSPORTE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>VALOR PASAJES P/P</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>TOTAL PASAJES</label>
                        </div>
                        <div class='col-md-3'>
                          <input type='text' name='textoprepasaje' size='80' id='textoprepasaje' value='".$value3['precio_pasaje']."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textotipo' size='80' id='textotipo' value='$trans' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textototalpasaje' size='80' id='textototalpasaje' value='$totalpasaje'  class='form-control'>
                        </div>
                        <div class='col-md-3'>
                          <br>
                          <br>
                        </div>
                        <div class='box-header'>
                          <h3 class='box-title'>DETALLE DE TRANSPORTE Y VIATICO POR PERSONA</h3>
                          <br>
                          <br>
                        </div>
                        <div class='col-md-12'>
                           <table class='table table-bordered table-responsive' >
                             <thead>
                             <tr>
                             <th>RUT</th>
                             <th>USUARIO</th>
                             <th>VIATICO</th>
                             <th>PASAJES</th>
                             <th>TOTAL_POR_PERSONA</th>
                             <th>ORDEN ASOCIADA</th>
                             </tr>
                             </thead>
                             <tbody>";
                                $suma='0';
                                $total_x_pp='0';
                                $totalpasa='0';
                                $totalpp='0';
                                $cantusuarios=$this->db->query_select("select tbldetalleviatico.id_usuarios,(select tbldetalletransporte.precio_pasaje from tbldetalletransporte inner join tblcontrol_proyectos tblpro2 on tbldetalletransporte.id_detalletransporte=tblpro2.num_proyecto where tblcontrol_proyectos.id_proyecto=tblpro2.id_proyecto) as pasaje,tbldetalleviatico.montoviaticopp from tbldetalleviatico inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.num_proyecto where id_detalleviatico='".$value['num_proyecto']."'");
                                foreach ($cantusuarios as $key2 => $value2) {
                                      $html.="<tr>";
                                      $nomusuarios=$this->db->query_select("select tblpersonal.rut_personal,tblpersonal.nombre_personal from tblpersonal where cod_personal='".$value2['id_usuarios']."'");
                                      $gasto=$value2['montoviaticopp']*$value['cant_dias'];
                                      $total_x_pp=$gasto+$value2['pasaje'];
                                      $html.="<td>".$nomusuarios[0][0]."</td>
                                              <td>".strtolower(utf8_decode($nomusuarios[0][1]))."</td>
                                              <td>".$gasto."</td>
                                              <td>".$value2['pasaje']."</td>
                                              <td>".$total_x_pp."</td>
                                              </tr>";
                                              $totalpasa=$totalpasa+$value2['pasaje'];
                                              $suma=$suma+$gasto;
                                              $totalpp=$totalpp+$total_x_pp;
                                }
                                $html.=
                                "<tr>
                                  <td>TOTAL</td>
                                  <td></td>
                                  <td>".$suma."</td>
                                  <td>".$totalpasa."</td>
                                  <td>".$totalpp."</td>
                              </tbody>
                            </table>
                        </div>";

                    }
                  }
                }
                $hospedaje=$this->db->query_select("select * from tbldetallehospedaje where id_detallehospedaje='".$value['num_proyecto']."' limit 1");
                if($hospedaje!=false){
                  foreach ($hospedaje as $key4 => $value4) {
                    $totalhospedaje=$value4['costo_dia']*$value['cant_dias'];
                $html.="
                </div>
                <div class='box-body'>
                      <div class='col-md-12'>
                      </div>
                      <div class='box-header'>
                        <h3 class='box-title'>HOSPEDAJE</h3>
                      </div>
                      <br>
                      <div class='col-md-3'>
                          <label>RUT HOSPEDAJE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>NOMBRE HOSPEDAJE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>DIRECCION HOSPEDAJE</label>
                      </div>
                      <div class='col-md-3'>
                        <input type='text' name='textoruthospedaje' size='80' id='textoruthospedaje' value='".strtolower(utf8_decode($value4['rut_hospedaje']))."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textonombrehospedaje' size='80' id='textonombrehospedaje' value='".strtolower(utf8_decode($value4['nombre_hospedaje']))."'  class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textodireccionhospedaje' size='80' id='textodireccionhospedaje' value='".strtolower(utf8_decode($value4['direccion_hospedaje']))."' class='form-control'>
                      </div>
                      <div class='col-md-12'>
                      <br>
                      <br>
                      </div>

                      <div class='col-md-12'>
                      <br>
                      <br>
                      </div>
                      <div class='col-md-12'>
                      <table class='table table-bordered table-responsive'>
                           <thead>
                           <tr>
                             <th>TIPO_HABITACION</th>
                             <th>NUMERO_DE_HABITACIONES</th>
                             <th>COSTO_HABITACION</th>
                             <th>CANTIDAD_DIAS</th>
                             <th>TOTAL</th>
                             </tr>
                           </thead>
                           <tbody>";

                              $costop='0';
                              $totalp='0';
                              $hospedaje=$this->db->query_select("select DISTINCT tipo_hospedaje,cant_habitaciones,costo_dia,dias,porcentaje from tbldetallehospedaje where id_detallehospedaje='".$value['num_proyecto']."' order by tipo_hospedaje asc");
                              foreach ($hospedaje as $key => $value4) {
                                $html.="<tr>";
                                if($value4['tipo_hospedaje']=='1'){
                                   $html.="<td>Habitacion simple</td>";
                                }elseif($value4['tipo_hospedaje']=='2'){
                                      $html.="<td>Habitacion doble</td>";
                                }elseif($value4['tipo_hospedaje']=='3'){
                                       $html.="<td>Habitacion triple</td>";
                                }else{
                                       $html.="<td>Cabaña o Depto </td>";
                                }
                                $costop=$value4['cant_habitaciones']*$value4['costo_dia']*$value4['dias'];
                              $html.="<td>".$value4['cant_habitaciones']."</td>
                                      <td>".$value4['costo_dia']."</td>
                                      <td>".$value4['dias']."</td>
                                      <td>".$costop."</td>
                              </tr>";
                              $totalp=$totalp+$costop;

                              }
                              $html.="
                              <tr>
                              <td>TOTAL</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>$totalp</td>
                            </tbody>
                       </table>
                       </div>";


                    }
                  }
                  $html.="
                  <br>
                  <br>
                  <div class='col-md-3'>
                      <label>PORCENTAJE DE PAGO %</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>SUB TOTAL</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>TOTAL HOSPEDAJE A PAGAR</label>
                  </div>
                  <div class='col-md-3'>";
                  $finalresultado=($totalp*$hospedaje[0]['porcentaje'])/100;
                  $html.="<input type='text' name='textorporcentajedepago' size='80' id='textorporcentajedepago' value='".$hospedaje[0]['porcentaje']."' class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textosubtotal' size='80' id='textosubtotal' value=".$totalp."  class='form-control'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='textototalapagar' size='80' id='textototalapagar' value='".$finalresultado."' class='form-control'>
                  </div>

           </div>
           </div>
           </div>
           </div>";


  }
  }
  $mpdf->writeHTML($html);

  $mpdf->Output("test.pdf",'I');
  }

}


public function listar_usuarios_sistema(){
  return $this->db->query_select("select users.id_user,users.rut_personal,users.name,users.email,users.cargo,users.perfil,users.estado from users where rut_personal!=0");
}

public function getPerfiles(string $select = '*') {

    if ($select === '*')
    {
        $perfiles = $this->db->query_select('Select nombre from tblperfiles group by nombre order by nombre');
        return $perfiles;
    }else{
        $perfiles = $this->db->select($select,'tblperfiles',"",'Limit 1');
        return $perfiles[0];
    }
}


public function revisarpersonal(){
         global $http;
         $datusu=$this->user;
         $datousuario=$datusu['id_user'];
         $fechainicio=$http->request->get('inicio');
         $fechafin=$http->request->get('fin');
         $dias=$http->request->get('dias');
         $viatico=$http->request->get('viatico');

         $usuariostemporales=$this->db->query_select("select id_user from tbldetalleviatico_temporal where user_registra='$datousuario'");
         $this->db->query_select("delete from tblcalculotemporal where usuario_registra='$datousuario'");
         if($usuariostemporales!=false){
         foreach ($usuariostemporales as $key => $value) {
            $usuariosconviatico=$this->db->query_select("select id_detalleproyecto,fecha_inicio,fecha_termino,montoviaticopp from tbldetalleviatico where '$fechainicio' between fecha_inicio and fecha_termino and  id_usuarios='".$value['id_user']."'");
            if($usuariosconviatico==false){
            $usuariosconviatico=$this->db->query_select("select id_detalleproyecto,fecha_inicio,fecha_termino,montoviaticopp from tbldetalleviatico where '$fechafin' between fecha_inicio and fecha_termino and  id_usuarios='".$value['id_user']."'");
              if($usuariosconviatico==false){
                $usuariosconviatico=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino,montoviaticopp from tbldetalleviatico where id_usuarios='".$value['id_user']."' and fecha_inicio between '$fechainicio' and '$fechafin' limit 1");
              }
            }
                    if($usuariosconviatico[0]['montoviaticopp']==0){
             //return array('success'=>0, 'resultado'=>'0');
                        $this->db->insert('tblcalculotemporal', array (
                          'id_usuario'=>$value['id_user'],
                          'cantidad_dias'=>$dias,
                          'idasociada'=>$usuariosconviatico[0]['id_detalleproyecto'],
                          'usuario_registra'=>$datousuario
                        ));
                    }else{
                        $fechainiciopro=$usuariosconviatico[0]['fecha_inicio'];
                            if($fechainiciopro<=$fechainicio){
                                 $diastrabajo=$this->db->query_select("select datediff('$fechafin','".$usuariosconviatico[0]['fecha_inicio']."') as cantidad");
                                 $diasnuevos=$this->db->query_select("select datediff('".$usuariosconviatico[0]['fecha_termino']."','".$usuariosconviatico[0]['fecha_inicio']."') as nuvcantidad");
                                 $diastrabajofinal=$this->db->query_select("select datediff('$fechafin','".$usuariosconviatico[0]['fecha_termino']."') as cantidadfinal");

                                 $num1=intval($diastrabajo[0]['cantidad']);
                                 $num2=intval($diasnuevos[0]['nuvcantidad']);
                                 $cantdias=$num1-$num2;
                                 if($cantdias<0){
                                   $cantdias=0;
                                 }
                                 //return array('success'=>0, 'resultado'=>'2');
                                 $this->db->insert('tblcalculotemporal', array (
                                   'id_usuario'=>$value['id_user'],
                                   'cantidad_dias'=>$cantdias,
                                   'idasociada'=>$usuariosconviatico[0]['id_detalleproyecto'],
                                   'usuario_registra'=>$datousuario
                                 ));
                             }else{
                               $diasatrabajar=$this->db->query_select("select datediff('$fechafin','".$usuariosconviatico[0]['fecha_inicio']."') as cantidad");
                               $diasproyectoante=$this->db->query_select("select datediff('".$usuariosconviatico[0]['fecha_termino']."','".$usuariosconviatico[0]['fecha_inicio']."') as proyectoante");
                               $diastrabajofinal=$this->db->query_select("select datediff('$fechafin','".$usuariosconviatico[0]['fecha_termino']."') as cantidadfinal");
                               $num1=intval($diasatrabajar[0]['cantidad']);
                               $num2=intval($diasproyectoante[0]['proyectoante']);
                               $num3=intval($diastrabajofinal[0]['cantidadfinal']);
                               if($num3<0){
                                 $num3=0;
                               }

                                $totaldias=$num1+$num3-$num2;
                                if($totaldias<0){
                                  $totaldias=0;
                                }
                                 $this->db->insert('tblcalculotemporal', array (
                                   'id_usuario'=>$value['id_user'],
                                   'cantidad_dias'=>$totaldias,
                                   'idasociada'=>$usuariosconviatico[0]['id_detalleproyecto'],
                                   'usuario_registra'=>$datousuario
                                 ));
                    }
                  }
                }
              $datoscalculo=$this->db->query_select("select * from tblcalculotemporal where usuario_registra='$datousuario'");
              $totalviatico=0;
              $viaticoporpersona=0;
              foreach ($datoscalculo as $key => $value2) {
                 $viaticoporpersona=$value2['cantidad_dias']*$viatico;
                 $totalviatico=$totalviatico+$viaticoporpersona;
              }
              $cantidadusuarios=$this->db->query_select("select count(id_usuario) as cantidad from tblcalculotemporal where usuario_registra='$datousuario'");

              return array('success'=>1,'res'=>$totalviatico,'cantidad'=>$cantidadusuarios[0]['cantidad']);
            }
      }

      public function modificardatos(){
        global $http;
        $datusu=$this->user;
        $datousuario=$datusu['id_user'];
        $orden=$http->request->get('txtidproyecto');
        $fechainicio=$http->request->get('txtinicio');
        $fechafin=$http->request->get('txtfinal');
        $dias=$http->request->get('txtdias');
        $viatico=$http->request->get('txtviatico');

        $usuarios=$this->db->query_select("select * from tblcalculotemporal where usuario_registra='$datousuario'");
        if($usuarios==false){
          $usuariosorden=$this->db->query_select("select id_usuarios from tbldetalleviatico where id_detalleproyecto='$orden'");
          if($usuariosorden!=false){
          foreach ($usuariosorden as $key => $value) {
             $datosusuarios=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino from tbldetalleviatico where id_usuarios='".$value['id_usuarios']."' and '$fechainicio' between fecha_inicio and fecha_termino and id_detalleproyecto!='$orden'");
             if($datosusuarios==false){
               $datosusuarios=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino from tbldetalleviatico where id_usuarios='".$value['id_usuarios']."' and '$fechafin' between fecha_inicio and fecha_termino and id_detalleproyecto!='$orden'");
               if($datosusuarios==false){
                 $datosusuarios=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino from tbldetalleviatico where id_usuarios='".$value['id_usuarios']."' and fecha_inicio between $fechainicio and $fechafin and id_detalleproyecto!='$orden' limit 1");
               }
             }
             if($datosusuarios==false){
                   $this->db->insert('tblcalculotemporal', array (
                     'id_usuario'=>$value['id_usuarios'],
                     //'cantidad_dias'=>'1',
                     'cantidad_dias'=>$dias,
                     'idasociada'=>$datosusuarios[0]['id_detalleproyecto'],
                     'usuario_registra'=>$datousuario
                   ));
             }else{
                 if($datosusuarios[0]['fecha_inicio']>$fechainicio){
                      $diastrabajo=$this->db->query_select("select datediff('".$datosusuarios[0]['fecha_termino']."','$fechainicio') as cantidad");
                      $diasnuevos=$this->db->query_select("select datediff('".$datosusuarios[0]['fecha_termino']."','".$datosusuarios[0]['fecha_inicio']."') as nuvcantidad");
                      $num1=intval($diastrabajo[0]['cantidad']);
                      $num2=intval($diasnuevos[0]['nuvcantidad']);
                      $cantdias=$num1-$num2;

                      if($cantdias<0){
                        $cantdias=0;
                      }
                      //return array('success'=>0, 'resultado'=>'1');
                      $this->db->insert('tblcalculotemporal', array (
                        'id_usuario'=>$value['id_usuarios'],
                        //'cantidad_dias'=>'2',
                        'cantidad_dias'=>$cantdias,
                        'idasociada'=>$datosusuarios[0]['id_detalleproyecto'],
                        'usuario_registra'=>$datousuario
                      ));
                  }else{
                      if($datosusuarios[0]['fecha_termino']>$fechafin){
                          $this->db->insert('tblcalculotemporal', array (
                            'id_usuario'=>$value['id_usuarios'],
                            //'cantidad_dias'=>'3',
                            'cantidad_dias'=>"0",
                            'idasociada'=>$value['id_detalleproyecto'],
                            'usuario_registra'=>$datousuario
                          ));
                      }else{
                          $diastrabajo=$this->db->query_select("select datediff('$fechafin','".$datosusuarios[0]['fecha_inicio']."') as cantidad");
                          $diasnuevos=$this->db->query_select("select datediff('".$datosusuarios[0]['fecha_termino']."','".$datosusuarios[0]['fecha_inicio']."') as nuvcantidad");

                          $num1=intval($diastrabajo[0]['cantidad']);
                          $num2=intval($diasnuevos[0]['nuvcantidad']);
                          $cantdias=$num1-$num2;
                          if($cantdias<0){
                            $cantdias=0;
                          }
                          //return array('success'=>0, 'resultado'=>'2');
                          $this->db->insert('tblcalculotemporal', array (
                            'id_usuario'=>$value['id_usuarios'],
                            //'cantidad_dias'=>'4',
                            'cantidad_dias'=>$cantdias,
                            'idasociada'=>$value['id_detalleproyecto'],
                            'usuario_registra'=>$datousuario
                          ));
                      }
                  }
            }
          }
}

        }else{
           foreach ($usuarios as $key => $value) {
                 $datosusuarios=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino from tbldetalleviatico where id_usuarios='".$value['id_usuario']."' and '$fechainicio' between fecha_inicio and fecha_termino and id_detalleproyecto!='$orden'");
                 if($datosusuarios==false){
                   $datosusuarios=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino from tbldetalleviatico where id_usuarios='".$value['id_usuario']."' and '$fechafin' between fecha_inicio and fecha_termino and id_detalleproyecto!='$orden'");
                   if($datosusuarios==false){
                     $datosusuarios=$this->db->query_select("select id_detalleproyecto,id_usuarios,fecha_inicio,fecha_termino from tbldetalleviatico where id_usuarios='".$value['id_usuario']."' and fecha_inicio between '$fechainicio' and '$fechafin' and id_detalleproyecto!='$orden' limit 1");
                   }
                 }


                 if($datosusuarios==false){
                       $this->db->update('tblcalculotemporal', array (
                         //'cantidad_dias'=>'5',
                         'cantidad_dias'=>$dias,
                         'usuario_registra'=>$datousuario
                       ), "id_usuario='".$value['id_usuario']."'");
                 }else{

                       if($datosusuarios[0]['fecha_inicio']>$fechainicio){

                         $diastrabajo=$this->db->query_select("select datediff('".$datosusuarios[0]['fecha_termino']."','$fechainicio') as cantidad");
                         $diastrabajofinal=$this->db->query_select("select datediff('$fechafin','".$datosusuarios[0]['fecha_termino']."') as cantidadfinal");
                         $diasnuevos=$this->db->query_select("select datediff('".$datosusuarios[0]['fecha_termino']."','".$datosusuarios[0]['fecha_inicio']."') as nuvcantidad");
                         $num1=intval($diastrabajo[0]['cantidad']);
                         $num2=intval($diasnuevos[0]['nuvcantidad']);
                         $num3=intval($diastrabajofinal[0]['cantidadfinal']);
                         if($num3<0){
                           $num3=0;
                         }

                         $cantdias=$num1+$num3-$num2;

                         if($cantdias<0){
                           $cantdias=0;
                         }


                        $this->db->update('tblcalculotemporal', array (
                          //'cantidad_dias'=>'6',
                          'cantidad_dias'=>$cantdias,
                          'usuario_registra'=>$datousuario
                        ), "id_usuario='".$value['id_usuario']."'");
                    }else{

                      $diastrabajo=$this->db->query_select("select datediff('$fechafin','".$datosusuarios[0]['fecha_inicio']."') as cantidad");
                      $diasnuevos=$this->db->query_select("select datediff('".$datosusuarios[0]['fecha_termino']."','".$datosusuarios[0]['fecha_inicio']."') as nuvcantidad");

                      $num1=intval($diastrabajo[0]['cantidad']);
                      $num2=intval($diasnuevos[0]['nuvcantidad']);
                      $cantdias=$num1-$num2;
                      if($cantdias<0){
                        $cantdias=0;
                      }
                    //  return array('success'=>0, 'resultado'=>'4');
                      $this->db->update('tblcalculotemporal', array (
                        //'cantidad_dias'=>'7',
                        'cantidad_dias'=>$cantdias,
                        'usuario_registra'=>$datousuario
                      ), "id_usuario='".$value['id_usuario']."'");
                    }
                 }
           }
        }
        $caldatos=0;
        $totaldatos=0;
        $calculo=$this->db->query_select("select * from tblcalculotemporal where usuario_registra='$datousuario'");
        if($calculo!=false){
        foreach ($calculo as $key => $value3) {
        $caldatos=$value3['cantidad_dias']*$viatico;
        $totaldatos=$totaldatos+$caldatos;
        }
        return array('success'=>1, 'resultado'=>$totaldatos);
        }
      }

      public function quitar_filtro(){
        global $http;
        $fecha=date('Y-m-d');

        $html="<div class='col-md-2'>
            <label>Estados</label>
            <select class='form-control' id='cmbestado' onchange='filtrar_estado()'' name='cmbestado' >
              <option value='4'>--</option>
              <option value='0'>PENDIENTE</option>
              <option value='1'>PREVALIDADO</option>
              <option value='2'>APROBADO</option>
              <option value='3'>RECHAZADO</option>
              <option value='4'>PAGADO</option>
            </select>
          </div>

            <label>Fecha:</label>
            <label>&nbsp;</label>
            <input type='date' id='fechadesde' name='fechadesde' style='width:130px' value='$fecha'>
            <label>&nbsp;</label>
            <input type='date' id='fechahasta' name='fechahasta' style='width:130px' value='$fecha'>
            <label>&nbsp;</label>
            <button type='button' name='btnbuscar' id='btnbuscar' onclick='filtrar_por_fecha()' style='width:95px' class='btn btn-success'>Filtrar</button>
            <button type='button' name='btnquitar' id='btnquitar' onclick='quitar_filtro()' style='width:95px' class='btn btn-danger'>Quitar Filtro</button>

            <a class='btn btn-primary' id='btn_exporta_excel' href='avar/test' style='width:115px' title='Nueva Actividad' data-toggle='tooltip'>
                  Nueva Solicitud
            </a>";

            return array("success"=>1, "html"=>$html);
      }

      public function cargar_inicio(){
        global $http;
        $datusu=$this->user;
        $datousuario=$datusu['id_user'];
        $fecha=date('Y-m-d');

        $fechatbl=$this->db->query_select("select * from tblfechatemporal where id_user=$datousuario");
        if($fechatbl==false){

        }else{
          $fechadesde=$fechatbl[0]['fecha_inicio'];
          $fechafinal=$fechatbl[0]['fecha_final'];

          $html5="<div class='col-md-2'>
              <label>Estados</label>
              <select class='form-control' id='cmbestado' onchange='filtrar_estado()'' name='cmbestado' >
                <option value='4'>--</option>
                <option value='0'>PENDIENTE</option>
                <option value='1'>PREVALIDADO</option>
                <option value='2'>APROBADO</option>
                <option value='3'>RECHAZADO</option>
                <option value='4'>PAGADO</option>
              </select>
            </div>

              <label>Fecha:</label>
              <label>&nbsp;</label>
              <input type='date' id='fechadesde' name='fechadesde' style='width:130px' value='$fechadesde'>
              <label>&nbsp;</label>
              <input type='date' id='fechahasta' name='fechahasta' style='width:130px' value='$fechafinal'>
              <label>&nbsp;</label>
              <button type='button' name='btnbuscar' id='btnbuscar' onclick='filtrar_por_fecha()' style='width:95px' class='btn btn-success'>Filtrar</button>
              <button type='button' name='btnquitar' id='btnquitar' onclick='quitar_filtro()' style='width:95px' class='btn btn-danger'>Quitar Filtro</button>

              <a class='btn btn-primary' id='btn_exporta_excel' href='avar/test' style='width:115px' title='Nueva Actividad' data-toggle='tooltip'>
                    Nueva Solicitud
              </a>";

          $resultado= $this->listar_proyecto($fechadesde,$fechafinal);

          $usucompa=(new Model\Users)->getOwnerUser();

          $perfil=$usucompa['perfil'];
          if ($resultado === false){
              return array('success' => 0, 'message' => 'Para la fecha seleccionada no existen datos');
          }else{
              $json = array(
              "aaData"=>array(
              )
              );
              foreach ($resultado as $key => $value) {
                   if($perfil=='CONTROL_INGRESO'){
                   $html="<td><a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                         <i class='glyphicon glyphicon-edit'></i></a>
                         <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                         <i class='glyphicon glyphicon-remove'></i>
                         </a></td>";
                   }elseif($perfil=='CONTROL_PREVALIDADOR'){
                   $html="<td><a data-toggle='tooltip' data-placement='top' id='btnprevalidador' name='btnprevalidador' title='Aprobar' onclick='prevalidar(".$value['id_proyecto'].")' class='btn btn-primary btn-sm'>
                         <i class='glyphicon glyphicon-edit'></i></a>
                         <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                         <i class='glyphicon glyphicon-edit'></i></a>
                         <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")'  title='Eliminar' class='btn btn-danger btn-sm'>
                         <i class='glyphicon glyphicon-remove'></i>
                         </a></td>";
                   }else{
                  if($value['estado']!='2'){
                    $html="<td><a data-toggle='tooltip' data-placement='top' id='btnaprobar' name='btnaprobar' title='Completar' onclick='prevalidar(".$value['id_proyecto'].")'  class='btn btn-primary btn-sm'>
                          <i class='glyphicon glyphicon-edit'></i></a>
                          <a data-toggle='tooltip' data-placement='top' id='btnmodificar' name='btnmodificar' title='Modificar' class='btn btn-success btn-sm' href='avar/editar_control/".$value['id_proyecto']."'>
                          <i class='glyphicon glyphicon-edit'></i></a>
                          <a data-toggle='tooltip' data-placement='top' name='btnlisteliminar' id='btnlisteliminar' onclick='eliminar(".$value['id_proyecto'].")' title='Eliminar' class='btn btn-danger btn-sm'>
                          <i class='glyphicon glyphicon-remove'></i>
                          </a></td>";
                  }else{
                    $html="<td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-success btn-sm'><i class='fa fa-check-square-o'></i></a><td>";
                    }
                  }
                   $html.="</tr>";

                   if($value['estado']=='0'){
                     $estado='PENDIENTE';
                   }elseif($value['estado']=='1'){
                     $estado='PREVALIDADO';
                   }elseif($value['estado']=='2'){
                     $estado='APROBADO';
                   }elseif($value['estado']=='4'){
                     $estado='PAGADO';
                   }else{
                     $estado='RECHAZADO';
                   }
                   if($value['hospedaje']==false){
                     $diashospedaje='NO APLICA';
                   }else{
                     $diashospedaje=$value['cant_dias_hospedaje'];
                   }
                   $btn='<class="text-center" onclick="consultarorden('.$value['id_proyecto'].')"><a class="btn">'.$value['num_proyecto'].'</a>';

                   $json['aaData'][] = array($btn,$value['descripcion'],$value['areas'],$value['fecha_inicio'],$value['fecha_final'],$value['cant_dias'],$value['cant_dias_hospedaje'],$value['costo_total'],$estado,$html );
                 }
               }
               $jsonencoded = json_encode($json,JSON_UNESCAPED_UNICODE);
               $fh = fopen(API_INTERFACE . "views/app/temp/result_cons_".$usucompa['id_user'].".dbj", 'w');
               fwrite($fh, $jsonencoded);
               fclose($fh);
               return array('success' => 1, 'message' => "result_cons_".$usucompa['id_user'].".dbj",'html5'=>$html5 );

        }



      }






    public function __construct(IRouter $router = null) {
        parent::__construct($router);
        $this->startDBConexion();
        $this->user=(new Model\Users)->getOwnerUser();
    }
    public function __destruct() {
        parent::__destruct();
        $this->endDBConexion();
    }
}
