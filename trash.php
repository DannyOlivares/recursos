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
                                     <th>RUT</th>
                                     <th>USUARIO</th>
                                     <th>VIATICO</th>
                                   </thead>
                                   <tbody>
                                      <tr>";
                                      $valorviatico='0';
                                      $viaticopp='0';
                                      $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                      foreach ($usuarios as $key2 => $value2) {
                                            $viaticopp=$value2['montoviaticopp']*$value['cant_dias'];
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
                                       </thead>
                                       <tbody>
                                          <tr>";
                                          $valorviatico='0';
                                          $viaticopp='0';
                                          $valormovil='0';
                                          $suma_peaje='0';
                                          $suma_x_persona='0';
                                          $totaltodo='0';
                                          $usuarios=$this->db->query_select("select tblpersonal.cod_personal,tblpersonal.nombre_personal,tblpersonal.rut_personal, tbldetalleviatico.montoviaticopp,tbldetalleviatico.chofer, tbldetallemovil.costo_movil from tblpersonal inner join tbldetalleviatico on tblpersonal.cod_personal=tbldetalleviatico.id_usuarios inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.id_detalleviatico inner join tbldetallemovil on tblcontrol_proyectos.id_detalletransporte=tbldetallemovil.id_detallemovil where tblcontrol_proyectos.id_detalleviatico='".$value['num_proyecto']."'");
                                          foreach ($usuarios as $key2 => $value2) {
                                                $viaticopp=$value2['montoviaticopp']*$value['cant_dias'];
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
                                     </thead>
                                     <tbody>
                                        <tr>";
                                        $suma='0';
                                        $total_x_pp='0';
                                        $totalpasa='0';
                                        $totalpp='0';
                                        $cantusuarios=$this->db->query_select("select tbldetalleviatico.id_usuarios,(select tbldetalletransporte.precio_pasaje from tbldetalletransporte inner join tblcontrol_proyectos tblpro2 on tbldetalletransporte.id_detalletransporte=tblpro2.num_proyecto where tblcontrol_proyectos.id_proyecto=tblpro2.id_proyecto) as pasaje,tbldetalleviatico.montoviaticopp from tbldetalleviatico inner join tblcontrol_proyectos on tbldetalleviatico.id_detalleproyecto=tblcontrol_proyectos.num_proyecto where id_detalleviatico='".$value['num_proyecto']."'");
                                        foreach ($cantusuarios as $key2 => $value2) {
                                              $nomusuarios=$this->db->query_select("select tblpersonal.rut_personal,tblpersonal.nombre_personal from tblpersonal where cod_personal='".$value2['id_usuarios']."'");
                                              $gasto=$value2['montoviaticopp']*$value['cant_dias'];
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
