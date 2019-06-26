<?php

/* avar/editar_control.twig */
class __TwigTemplate_6eabaf87463ddab257cea0b8d381303a2e791a9fd06ab16acf7d91b62ffb6ea1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/editar_control.twig", 1);
        $this->blocks = array(
            'appStylos' => array($this, 'block_appStylos'),
            'appBody' => array($this, 'block_appBody'),
            'appScript' => array($this, 'block_appScript'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "portal/portal";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_appStylos($context, array $blocks = array())
    {
        // line 3
        echo "  <style media=\"screen\">
    .at {
      display: none;
    }
  </style>
";
    }

    // line 9
    public function block_appBody($context, array $blocks = array())
    {
        // line 10
        echo "  <div class=\"row\">
    <div class=\"col-md-12\">
      <section class=\"content-header\">
        <h1>
          Gestion de recursos
          <small>Editor de control</small>
        </h1>
      </section>
    </div>
  </div>
  <section class=\"content\">
    <form id=\"formmodif\" name=\"formmodif\">
      <input type=\"hidden\" name=\"id_proyecto\" id=\"id_proyecto\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "id_proyecto", array()), "html", null, true);
        echo "\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box\">
            <div class=\"box-header\">
              <h3 class=\"box-title\">Datos actividad</h3>
            </div>
            <div class=\"box-body\">
              <div class=\"col-md-3\">
                <label>id de proyecto:</label><input type=\"text\" name=\"txtidproyecto\" id=\"txtidproyecto\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "num_proyecto", array()), "html", null, true);
        echo "\" class=\"form-control\" readonly>
              </div>
              <div class=\"col-md-3\">
                <label>Zona:</label><input type=\"text\" name=\"cmblocalidades\" id=\"cmblocalidades\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "descripcion", array()), "html", null, true);
        echo "\" class=\"form-control\" readonly>
                <input type=\"hidden\" id=\"textlocalidades\" name=\"textlocalidades\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "cod_localidad", array()), "html", null, true);
        echo "\">
              </div>
              <div class=\"col-md-3\">
                <label for=\"cmbtipotrabajo\">Tipo trabajo</label>
                  <input type=\"text\" name=\"cmbtipotrabajo\" id=\"cmbtipotrabajo\" value='";
        // line 39
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "areas", array()), "html", null, true);
        echo "' class=\"form-control\" readonly='readonly'>
              </div>
              <div class=\"col-md-3\">
                <label>SOLICITANTE</label><input type=\"text\" name=\"txtsolicitante\" id=\"txtsolicitante\" class=\"form-control\" value=\"";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["owner_user"] ?? null), "name", array(), "array"), "html", null, true);
        echo "\" readonly=\"readonly\">
              </div>
              <div class=\"col-md-6\">
                <label>Descripcion de proyecto</label><input type=\"text\" name=\"txtdetalle\" id=\"txtdetalle\" class=\"form-control\" value=\"";
        // line 45
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "descrip_proyecto", array()), "html", null, true);
        echo "\">
              </div>
              <div class=\"col-md-3\">
                <label>Nodo Cuadrante</label><input type=\"text\" name=\"txtnodo\" id=\"txtnodo\" class=\"form-control\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "nodocuadrante", array()), "html", null, true);
        echo "\">
              </div>
              <div class=\"col-md-12\">
                <br>
              </div>
              <div id=\"diveditarseleccion\" name=\"diveditarseleccion\" class=\"col-md-12\">
                <div class=\"col-md-2\">
                </div>
                  <div class=\"col-md-2\">
                    <h4><label>SELECCION</label></h4>
                  </div>
                  <div class=\"col-md-2\">
                    ";
        // line 60
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) == "1")) {
            // line 61
            echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditarviatico\" id=\"checkeditarviatico\"  disabled='true' checked='checked'>VIATICO<label></h4>
                    ";
        } else {
            // line 63
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "viatico", array()) == true)) {
                // line 64
                echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditarviatico\" id=\"checkeditarviatico\" onclick=\"editaropcion(1)\" checked='checked' >VIATICO<label></h4>
                      ";
            } else {
                // line 66
                echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditarviatico\" id=\"checkeditarviatico\" onclick=\"editaropcion(1)\">VIATICO<label></h4>
                      ";
            }
            // line 68
            echo "                    ";
        }
        // line 69
        echo "                  </div>
                  <div class=\"col-md-2\">
                      ";
        // line 71
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) == "2")) {
            // line 72
            echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditartransporte\" id=\"checkeditartransporte\" disabled='true' checked='checked'>TRANSPORTE</label></h4>
                      ";
        } else {
            // line 74
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "pasaje", array()) == true)) {
                // line 75
                echo "                        <h4><label><input type=\"checkbox\" name=\"checkeditartransporte\" id=\"checkeditartransporte\" onclick=\"editaropcion(2)\" checked='checked'>TRANSPORTE</label></h4>
                        ";
            } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),             // line 76
($context["db_modificar"] ?? null), "movil", array()) == true)) {
                // line 77
                echo "                        <h4><label><input type=\"checkbox\" name=\"checkeditartransporte\" id=\"checkeditartransporte\" onclick=\"editaropcion(2)\" checked='checked'>TRANSPORTE</label></h4>
                        ";
            } else {
                // line 79
                echo "                        <h4><label><input type=\"checkbox\" name=\"checkeditartransporte\" id=\"checkeditartransporte\" onclick=\"editaropcion(2)\">TRANSPORTE</label></h4>
                        ";
            }
            // line 81
            echo "                      ";
        }
        // line 82
        echo "                  </div>
                  <div class=\"col-md-2\">
                    ";
        // line 84
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) == "3")) {
            // line 85
            echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditarhospedaje\" id=\"checkeditarhospedaje\" disabled='true' checked='checked'>HOSPEDAJE</label></h4>
                    ";
        } else {
            // line 87
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "hospedaje", array()) == true)) {
                // line 88
                echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditarhospedaje\" id=\"checkeditarhospedaje\" onclick=\"editaropcion(3)\" checked='checked'>HOSPEDAJE</label></h4>
                      ";
            } else {
                // line 90
                echo "                      <h4><label><input type=\"checkbox\" name=\"checkeditarhospedaje\" id=\"checkeditarhospedaje\" onclick=\"editaropcion(3)\">HOSPEDAJE</label></h4>
                      ";
            }
            // line 92
            echo "                    ";
        }
        // line 93
        echo "                  </div>
                  <input type=\"hidden\" name=\"idcount\" id=\"idcount\" value=\"3\">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class=\"row\">
      ";
        // line 101
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "viatico", array()) != "0")) {
            // line 102
            echo "       ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) == "1")) {
                // line 103
                echo "        <div class=\"col-md-12\" id=\"divviatico\" name=\"divviatico\">
          <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>Viatico</h3>
                </div>
                <div class='box-body'>
                  <div class='col-md-4'>
                    <label>INICIO:</label><input type='DATE' name='txtinicio' id='txtinicio' class='form-control' VALUE='";
                // line 110
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_inicio", array()), "html", null, true);
                echo "'>
                  </div>
                  <div class='col-md-4'>
                    <label>TERMINO:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='modificardatos()' class='form-control'  VALUE='";
                // line 113
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_final", array()), "html", null, true);
                echo "'>
                  </div>
                  <div class='col-md-4'>
                    <label>DIAS:</label><input type='text' name='txtdias' id='txtdias' class='form-control' value='";
                // line 116
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "cant_dias", array()), "html", null, true);
                echo "'>
                  </div>
                  <div class='col-md-2'>
                  <br>
                  <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(1)' title='Seleccionar' data-toggle='tooltip'>
                   Seleccionar Personal
                  </a>
                  </div>
                  <div class='col-md-3'>
                      <label>Cantidad Personas</label><input type='number' name='txtpersonal' id='txtpersonal' class='form-control' value=\"";
                // line 125
                echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
                echo "\">
                  </div>
                  <div class='col-md-3'>
                      <label>MONTO VIATICO P/P</label><input type='number' name='txtviatico' id='txtviatico' value='";
                // line 128
                echo twig_escape_filter($this->env, ($context["db_detalleviatico"] ?? null), "html", null, true);
                echo "' class='form-control' readonly='readonly'>
                  </div>
                  <div class='col-md-4'>
                      <label>TOTAL VIATICOsssss</label><input type='number' name='txtrest' id='txtrest' value='";
                // line 131
                echo twig_escape_filter($this->env, ($context["total_viatico"] ?? null), "html", null, true);
                echo "' class='form-control total'>
                      <br>
                  </div>
                  <div class=\"col-md-12\">

                  </div>
                  <div class=\"col-md-12\" id=\"divpersonal\" name=\"divpersonal\">
                    <div class='box'>
                      <table id='tblpersonal' name='tblpersonal' class='table table-bordered table-responsive'>
                      <thead>
                          <tr>
                              <th>RUT</th>
                              <th>NOMRE</th>
                              <th>CARGO</th>
                          </tr>
                      </thead>
                      <tbody>
                      <tr>
                        ";
                // line 149
                $context["No"] = 1;
                // line 150
                echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["db_usuviatico"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["usv"]) {
                    if ((false != ($context["db_usuviatico"] ?? null))) {
                        // line 151
                        echo "                        <td>";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["usv"], "rut_personal", array()), "html", null, true);
                        echo "</td>
                        <td>";
                        // line 152
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["usv"], "nombre_personal", array()), "html", null, true);
                        echo "</td>
                        <td>";
                        // line 153
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["usv"], "cargo_personal", array()), "html", null, true);
                        echo "</td>
                      </tr>
                        ";
                        // line 155
                        $context["No"] = (($context["No"] ?? null) + 1);
                        // line 156
                        echo "                        ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['usv'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 157
                echo "                      </tbody>
                      </table>
                  </div>
              </div>
            </div>
        </div>
      </div>
            ";
            } else {
                // line 165
                echo "            <div class=\"col-md-12\" id=\"divviatico\" name=\"divviatico\">
            <div class='box'>
                    <div class='box-header'>
                    <h3 class='box-title'>Viatico</h3>
                    </div>
                  <div class='box-body'>
                    <div class='col-md-4'>
                      <label>DIAS VIATICO:</label><input type='number' name='txtdias' id='txtdias' class='form-control' value='";
                // line 172
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "cant_dias", array()), "html", null, true);
                echo "'>
                    </div>
                    <div class='col-md-4'>
                        <label>MONTO VIATICO P/P</label><input type='text' name='txtviatico' id='txtviatico' value='";
                // line 175
                echo twig_escape_filter($this->env, ($context["db_detalleviatico"] ?? null), "html", null, true);
                echo "' class='form-control' readonly='readonly'>
                    </div>
                    <div class='col-md-4'>
                        <label>TOTAL VIATICOaaaaaaa</label><input type='number' name='txtrest' value='";
                // line 178
                echo twig_escape_filter($this->env, ($context["total_viatico"] ?? null), "html", null, true);
                echo "' id='txtrest' class='form-control total'>
                        <br>
                    </div>
                      <div class='col-md-12' id='divpersonal' name='divpersonal'></div>
                </div>
              </div>
            </div>
            ";
            }
            // line 186
            echo "        ";
        } else {
            // line 187
            echo "        <div class=\"col-md-12\" id=\"divviatico\" name=\"divviatico\"></div>
        ";
        }
        // line 189
        echo "       <input type=\"hidden\" name=\"contador2\" id=\"contador2\" value=\"";
        echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
        echo "\">
      </div>
      <div class=\"row\">
        ";
        // line 192
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "pasaje", array()) != false)) {
            // line 193
            echo "           ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) == "2")) {
                // line 194
                echo "           <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\">
                 ";
                // line 195
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "id_detalletransporte", array()) == twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "num_proyecto", array()))) {
                    // line 196
                    echo "                                  ";
                    if ((($context["db_tipo_transporte"] ?? null) == "1")) {
                        // line 197
                        echo "                                       <div class='box'>
                                               <div class='box-header'>
                                               <h3 class='box-title'>Transporte BUS</h3>
                                               </div>
                                             <div class='box-body'>
                                               <div class='col-md-4'>
                                                 <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio' class='form-control' VALUE='";
                        // line 203
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_inicio", array()), "html", null, true);
                        echo "'>
                                               </div>
                                               <div class='col-md-4'>
                                                 <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='modificardatos()' class='form-control'  VALUE='";
                        // line 206
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_final", array()), "html", null, true);
                        echo "'>
                                               </div>
                                               <div class='col-md-4'>
                                               <!--<input type='hidden' name='txtdias' id='txtdias'  value='";
                        // line 209
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "cant_dias", array()), "html", null, true);
                        echo "' class='form-control'>-->
                                               </div>
                                               <div class='col-md-4'>
                                                   <label>Valor Pasaje Bus ida / vuelta</label><input type='number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='recalcular()' value='";
                        // line 212
                        echo twig_escape_filter($this->env, ($context["db_precio_transporte"] ?? null), "html", null, true);
                        echo "' class='form-control'>
                                               </div>
                                               <div class='col-md-4'>
                                               <br>
                                               <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                                                Seleccionar Personal
                                               </a>
                                               </div>
                                               <div class='col-md-4'>
                                               <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' value=\"";
                        // line 221
                        echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
                        echo "\" class='form-control'>
                                                </div>
                                               <div class='col-md-4'>
                                                   <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                               </div>
                                               <div class='col-md-12' id='divpersonaltransporte' name='divpersonaltransporte'></div>
                                               <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
                                           </div>
                                         </div>
                                     ";
                    } elseif ((                    // line 230
($context["db_tipo_transporte"] ?? null) == "2")) {
                        // line 231
                        echo "                                     <div class='box'>
                                             <div class='box-header'>
                                             <h3 class='box-title'>Transporte AVION</h3>
                                             </div>
                                             <div class='box-body'>
                                             <div class='col-md-4'>
                                               <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='";
                        // line 237
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_inicio", array()), "html", null, true);
                        echo "'>
                                             </div>
                                             <div class='col-md-4'>
                                               <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='modificardatos()' class='form-control'  VALUE='";
                        // line 240
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_final", array()), "html", null, true);
                        echo "'>
                                             </div>
                                             <div class='col-md-4'>
                                                 <label>Valor Pasaje Avion</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' value='";
                        // line 243
                        echo twig_escape_filter($this->env, ($context["db_precio_transporte"] ?? null), "html", null, true);
                        echo "' onfocusout='recalcular()'  class='form-control'>
                                             </div>
                                             <div class='col-md-4'>
                                             <br>
                                             <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                                              Seleccionar Personal
                                             </a>
                                             </div>
                                             <div class='col-md-4'>
                                                 <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' value=\"";
                        // line 252
                        echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
                        echo "\" class='form-control'>
                                             </div>
                                             <div class='col-md-4'>
                                                 <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                                <br>
                                             </div>
                                             <input type='hidden' id='textprincipal' name='textprincipal' value='2'>
                                             <div class='col-md-12' id='divpersonaltransporte' name='divpersonaltransporte'></div>
                                                <!-- <input type='hidden' name='txtdias' id='txtdias'  value='";
                        // line 260
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "cant_dias", array()), "html", null, true);
                        echo "' class='form-control' >-->
                                                 <input type='hidden' id='txtopcion' name='txtopcion' value='2'>
                                           </div>
                                       </div>
                                   ";
                    } else {
                        // line 265
                        echo "                                         <div class='box'>
                                                 <div class='box-header'>
                                                 <h3 class='box-title'>Transporte MOVIL</h3>
                                                 </div>
                                                 <div class='box-body'>
                                                   <div class='col-md-4'>
                                                     <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='";
                        // line 271
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_inicio", array()), "html", null, true);
                        echo "'>
                                                   </div>
                                                   <div class='col-md-4'>
                                                     <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='modificardatos()' class='form-control'  VALUE='";
                        // line 274
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_final", array()), "html", null, true);
                        echo "'>
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
                                                       <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' value=\"";
                        // line 286
                        echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
                        echo "\" class='form-control'>
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
                                                   <div class=\"col-md-12\" id=\"divmovil\" name=\"divmovil\">
                                                     <div class='box'>
                                                        <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
                                                        <thead>
                                                          <th>CHOFER</th>
                                                          <th>RUT</th>
                                                          <th>NOMBRE</th>
                                                          <th>CARGO</th>
                                                        </thead>
                                                        <tbody>
                                                           <tr>
                                                             ";
                        // line 311
                        $context["No"] = 0;
                        // line 312
                        echo "                                                             ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["db_mod_chof"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["mod"]) {
                            if ((false != ($context["db_mod_chof"] ?? null))) {
                                // line 313
                                echo "                                                             ";
                                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "chofer", array()) == "1")) {
                                    // line 314
                                    echo "                                                             <td><input type='checkbox' name='checkchof";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                                    echo "' id='checkchof";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                                    echo "' onclick=\"marcar(";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                                    echo ")\" checked=checked></td>
                                                             ";
                                    // line 315
                                    $context["No"] = (($context["No"] ?? null) + 1);
                                    // line 316
                                    echo "                                                             ";
                                } else {
                                    // line 317
                                    echo "                                                             <td><input type='checkbox' name='checkchof";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                                    echo "' id='checkchof";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                                    echo "' disabled='true'></td>
                                                             ";
                                }
                                // line 319
                                echo "                                                             <td>";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "rut_personal", array()), "html", null, true);
                                echo "</td>
                                                             <td>";
                                // line 320
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "nombre_personal", array()), "html", null, true);
                                echo "</td>
                                                             <td>";
                                // line 321
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cargo_personal", array()), "html", null, true);
                                echo "</td>
                                                           </tr>

                                                             ";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mod'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 325
                        echo "
                                                           </tr>
                                                         </tbody>
                                                       </table>
                                                       </div>
                                                   </div>
                                                     <input type='hidden' id='txtopcion' name='txtopcion' value='3'>
                                                     <input type=\"hidden\" name=\"txtnummovil\" id=\"txtnummovil\" value='";
                        // line 332
                        echo twig_escape_filter($this->env, ($context["No"] ?? null), "html", null, true);
                        echo "'>
                                               </div>
                                           </div>
                                       ";
                    }
                    // line 336
                    echo "                            ";
                }
                // line 337
                echo "                 </div>
           ";
            } else {
                // line 339
                echo "              <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\">
                    ";
                // line 340
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "id_detalletransporte", array()) == twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "num_proyecto", array()))) {
                    // line 341
                    echo "                              ";
                    if ((($context["db_tipo_transporte"] ?? null) == true)) {
                        // line 342
                        echo "                                     ";
                        if ((($context["db_tipo_transporte"] ?? null) == "1")) {
                            // line 343
                            echo "                                          <div class='box'>
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
                                                      <label>Valor Pasaje Bus ida / vuelta</label><input type='number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='recalcular()' value='";
                            // line 356
                            echo twig_escape_filter($this->env, ($context["db_precio_transporte"] ?? null), "html", null, true);
                            echo "' class='form-control'>
                                                  </div>
                                                  <div class='col-md-4'>
                                                      <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                                  </div>
                                                  <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
                                              </div>
                                            </div>
                                        ";
                        } else {
                            // line 365
                            echo "                                            <div class='box'>
                                                    <div class='box-header'>
                                                    <h3 class='box-title'>Transporte AVION</h3>
                                                    &nbsp
                                                    &nbsp
                                                    <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(7)'>BUS</label>
                                                    &nbsp
                                                    <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(8)' checked='checked'>AVION</label>
                                                    &nbsp
                                                    <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(9)'>MOVIL</label>
                                                    </div>
                                                    <div class='box-body'>
                                                      <div class='col-md-4'>
                                                          <label>Valor Pasaje Avion ida / vuelta</label><input type='number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='recalcular()' value='";
                            // line 378
                            echo twig_escape_filter($this->env, ($context["db_precio_transporte"] ?? null), "html", null, true);
                            echo "' class='form-control av'>
                                                      </div>
                                                      <div class='col-md-4'>
                                                          <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                                      </div>
                                                        <input type='hidden' id='txtopcion' name='txtopcion' value='2'>
                                                  </div>
                                              </div>
                                      ";
                        }
                        // line 387
                        echo "                                  ";
                    } else {
                        // line 388
                        echo "
                                ";
                    }
                    // line 390
                    echo "                      ";
                }
                // line 391
                echo "                    </div>

                  ";
            }
            // line 394
            echo "            ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "movil", array()) != false)) {
            // line 395
            echo "               ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) != "2")) {
                // line 396
                echo "                    <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\">
                    <div class='box'>
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
                                  <label>Numero de Moviles</label><input type='number' name='txtcantmovil' id='txtcantmovil' onfocusout='calcularmovilychofer()' class='form-control' value=\"";
                // line 411
                echo twig_escape_filter($this->env, ($context["db_cantidad_movil"] ?? null), "html", null, true);
                echo "\">
                              </div>
                              <div class='col-md-4'>
                                  <label>Cantidad peaje</label><input type='number' name='txtpeajes' id='txtpeajes' class='form-control' value=\"";
                // line 414
                echo twig_escape_filter($this->env, ($context["db_cantidad_peaje"] ?? null), "html", null, true);
                echo "\">
                              </div>
                              <div class='col-md-4'>
                                  <label>Monto para peajes</label><input type='number' name='txtmontopeaje' id='txtmontopeaje' class='form-control' value=\"";
                // line 417
                echo twig_escape_filter($this->env, ($context["db_cantidad_monto"] ?? null), "html", null, true);
                echo "\">
                              </div>
                              <div class='col-md-4'>
                                  <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total' >
                              <br>
                              </div>
                              <div class=\"col-md-12\" id=\"divmovil\" name=\"divmovil\">
                                <div class='box'>
                                   <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
                                   <thead>
                                     <th>CHOFER</th>
                                     <th>RUT</th>
                                     <th>NOMBRE</th>
                                     <th>CARGO</th>
                                   </thead>
                                   <tbody>
                                      <tr>
                                        ";
                // line 434
                $context["No"] = 0;
                // line 435
                echo "                                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["db_mod_chof"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["mod"]) {
                    if ((false != ($context["db_mod_chof"] ?? null))) {
                        // line 436
                        echo "                                        ";
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "chofer", array()) == "1")) {
                            // line 437
                            echo "                                        <td><input type='checkbox' name='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' id='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' onclick=\"marcar(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo ")\" checked=checked></td>
                                        ";
                            // line 438
                            $context["No"] = (($context["No"] ?? null) + 1);
                            // line 439
                            echo "                                        ";
                        } else {
                            // line 440
                            echo "                                        <td><input type='checkbox' name='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' id='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' disabled='true'></td>
                                        ";
                        }
                        // line 442
                        echo "                                        <td>";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "rut_personal", array()), "html", null, true);
                        echo "</td>
                                        <td>";
                        // line 443
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "nombre_personal", array()), "html", null, true);
                        echo "</td>
                                        <td>";
                        // line 444
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cargo_personal", array()), "html", null, true);
                        echo "</td>
                                      </tr>

                                        ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mod'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 448
                echo "
                                      </tr>
                                    </tbody>
                                  </table>
                                  </div>
                              </div>
                                <input type='hidden' id='txtopcion' name='txtopcion' value='3'>
                                <input type=\"hidden\" name=\"txtnummovil\" id=\"txtnummovil\" value='";
                // line 455
                echo twig_escape_filter($this->env, ($context["No"] ?? null), "html", null, true);
                echo "'>
                          </div>
                      </div>
                    </div>
                    ";
            } else {
                // line 460
                echo "                    <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\">
                    <div class='box'>
                            <div class='box-header'>
                            <h3 class='box-title'>Transporte MOVIL</h3>
                            </div>
                            <div class='box-body'>
                              <div class='col-md-4'>
                                <label>IDA:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' VALUE='";
                // line 467
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_inicio", array()), "html", null, true);
                echo "'>
                              </div>
                              <div class='col-md-4'>
                                <label>VUELTA:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='modificardatos()' class='form-control'  VALUE='";
                // line 470
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_final", array()), "html", null, true);
                echo "'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Monto para peajes</label><input type='Number' name='txtmontopeaje' id='txtmontopeaje' value=\"";
                // line 473
                echo twig_escape_filter($this->env, ($context["db_cantidad_monto"] ?? null), "html", null, true);
                echo "\" onfocusout=calcularmovil() class='form-control'>
                              </div>
                              <div class='col-md-4'>
                              <br>
                              <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(2)' title='Seleccionar' data-toggle='tooltip'>
                               Seleccionar Personal
                              </a>
                              </div>
                              <div class='col-md-4'>
                                  <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' value=\"";
                // line 482
                echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
                echo "\" class='form-control'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Numero de Moviles</label><input type='Number' name='txtcantmovil' id='txtcantmovil' onfocusout='calcularmovilychofer()'  value=\"";
                // line 485
                echo twig_escape_filter($this->env, ($context["db_cantidad_movil"] ?? null), "html", null, true);
                echo "\" class='form-control'>
                              </div>
                              <div class='col-md-4'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Cantidad peaje</label><input type='Number' name='txtpeajes' id='txtpeajes'  value=\"";
                // line 490
                echo twig_escape_filter($this->env, ($context["db_cantidad_peaje"] ?? null), "html", null, true);
                echo "\" class='form-control'>
                              </div>
                              <div class='col-md-4'>
                                  <label>Total transporte</label><input type='Number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total'>
                                  <br>
                              </div>
                              <div class=\"col-md-12\" id=\"divmovil\" name=\"divmovil\">
                                <div class='box'>
                                   <table id='tblchofer' name='tblchofer' class='table table-bordered table-responsive'>
                                   <thead>
                                     <th>CHOFER</th>
                                     <th>RUT</th>
                                     <th>NOMBRE</th>
                                     <th>CARGO</th>
                                   </thead>
                                   <tbody>
                                      <tr>
                                        ";
                // line 507
                $context["No"] = 0;
                // line 508
                echo "                                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["db_mod_chof"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["mod"]) {
                    if ((false != ($context["db_mod_chof"] ?? null))) {
                        // line 509
                        echo "                                        ";
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "chofer", array()) == "1")) {
                            // line 510
                            echo "                                        <td><input type='checkbox' name='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' id='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' onclick=\"marcar(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo ")\" checked=checked></td>
                                        ";
                            // line 511
                            $context["No"] = (($context["No"] ?? null) + 1);
                            // line 512
                            echo "                                        ";
                        } else {
                            // line 513
                            echo "                                        <td><input type='checkbox' name='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' id='checkchof";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cod_personal", array()), "html", null, true);
                            echo "' disabled='true'></td>
                                        ";
                        }
                        // line 515
                        echo "                                        <td>";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "rut_personal", array()), "html", null, true);
                        echo "</td>
                                        <td>";
                        // line 516
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "nombre_personal", array()), "html", null, true);
                        echo "</td>
                                        <td>";
                        // line 517
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["mod"], "cargo_personal", array()), "html", null, true);
                        echo "</td>
                                      </tr>

                                        ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mod'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 521
                echo "
                                      </tr>
                                    </tbody>
                                  </table>
                                  </div>
                              </div>
                                <input type='hidden' id='txtopcion' name='txtopcion' value='3'>
                                <input type=\"hidden\" name=\"txtnummovil\" id=\"txtnummovil\" value='";
                // line 528
                echo twig_escape_filter($this->env, ($context["No"] ?? null), "html", null, true);
                echo "'>
                          </div>
                      </div>
                    </div>
                    ";
            }
            // line 533
            echo "            ";
        } else {
            // line 534
            echo "              <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\"></div>
            ";
        }
        // line 536
        echo "


      </div>
       <div class=\"row\">
        ";
        // line 541
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "hospedaje", array()) != "0")) {
            // line 542
            echo "           ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "principal", array()) != "3")) {
                // line 543
                echo "        <div class=\"col-md-12\" id=\"divhospedaje\" name=\"divhospedaje\">
          ";
                // line 544
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "rut_hospedaje", array()) != false)) {
                    // line 545
                    echo "               <div class='box'>
                 <div class=\"box-body\">
                    <div class='box-header'>
                       <h3 class='box-title'>Hospedaje</h3>
                    </div>
                    <br>
                         <div class='col-md-4'>
                           <label>Rut comercial</label><input type='text' name='txtrut' id='txtrut' class='form-control' value=\"";
                    // line 552
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "rut_hospedaje", array()), "html", null, true);
                    echo "\">
                         </div>
                         <div class='col-md-4'>
                           <label>Nombre Residencial / Hotel </label><input type='text' name='txtcliente' id='txtcliente' class='form-control' value=\"";
                    // line 555
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "nombre_hospedaje", array()), "html", null, true);
                    echo "\">
                         </div>
                         <div class='col-md-4'>
                           <label>Direccion:</label><input type='text' name='txtdireccion' id='txtdireccion' class='form-control' value=\"";
                    // line 558
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "direccion_hospedaje", array()), "html", null, true);
                    echo "\">
                         </div>
                         <div class='col-md-12'>
                         <br>
                         </div>
                         <div class=\"col-md-12\" id=\"tipohospedaje\" name=\"tipohospedaje\">
                           ";
                    // line 564
                    $context["No"] = 1;
                    // line 565
                    echo "                           ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["db_tipo_hospedaje"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
                        if ((false != ($context["db_tipo_hospedaje"] ?? null))) {
                            // line 566
                            echo "                              ";
                            $context["pasa"] = 0;
                            // line 567
                            echo "                               ";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["db_detalle_hospedaje"] ?? null));
                            foreach ($context['_seq'] as $context["_key"] => $context["detalle"]) {
                                if ((false != ($context["db_detalle_hospedaje"] ?? null))) {
                                    // line 568
                                    echo "                                  ";
                                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()) == twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "tipo_hospedaje", array()))) {
                                        // line 569
                                        echo "                                    ";
                                        $context["pasa"] = 1;
                                        // line 570
                                        echo "                                     <div class='col-md-2'>
                                     <br>
                                     <br>
                                       <label><input type='checkbox' name='checktipo";
                                        // line 573
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' id='checktipo";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' onclick='marcar_tipo_hospedaje(";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo ")'>&nbsp&nbsp";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "tipo_habitacion", array()), "html", null, true);
                                        echo "</label>
                                     </div>
                                     <div class='col-md-2'>
                                     <br>
                                       <label>N° Habitaciones</label><input type='number' name='txthabitaciones";
                                        // line 577
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' id='txthabitaciones";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' value='";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "cant_habitaciones", array()), "html", null, true);
                                        echo "' onfocusout='calcular_total(\"";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "\")' class='form-control' disabled='true' >
                                     </div>
                                     <div class='col-md-2'>
                                     <br>
                                       <label>Personas por habitacion</label><input type='number' name='txtperp";
                                        // line 581
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' id='txtperp";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' value='";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "persoxhabi", array()), "html", null, true);
                                        echo "' onfocusout='sumapersonas(\"";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "\")'  class='form-control pr' disabled='true'>

                                     </div>
                                     <div class='col-md-2'>
                                     <br>
                                       <label>Costo por dia:</label><input type='number' name='txtcostoxdia";
                                        // line 586
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' id='txtcostoxdia";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' onfocusout='validarhospedaje(";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo ")' value='";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "costo_dia", array()), "html", null, true);
                                        echo "' class='form-control ' disabled='true' >
                                     </div>
                                     <div class='col-md-2'>
                                     <br>
                                       <label>Dias</label><input type='number' name='txtdia";
                                        // line 590
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' id='txtdia";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' value='";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "dias", array()), "html", null, true);
                                        echo "'  class='form-control' onfocusout='calcular_total(";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo ")' disabled='true'>
                                     </div>
                                     <div class='col-md-2'>
                                     <br>
                                       <label>Total:</label><input type='text'  name='txtcostototal";
                                        // line 594
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "' id='txtcostototal";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                        echo "'  class='form-control cl' value='";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "monto", array()), "html", null, true);
                                        echo "' disabled='true'>
                                     </div>
                                  ";
                                    }
                                    // line 597
                                    echo "                                ";
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detalle'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 598
                            echo "                                ";
                            if ((($context["pasa"] ?? null) == 0)) {
                                // line 599
                                echo "                                    <div class='col-md-2'>
                                    <br>
                                    <br>
                                      <label><input type='checkbox' name='checktipo";
                                // line 602
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' id='checktipo";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' onclick='marcar_tipo_hospedaje(";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo ")'>&nbsp&nbsp";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "tipo_habitacion", array()), "html", null, true);
                                echo "</label>
                                    </div>
                                    <div class='col-md-2'>
                                    <br>
                                      <label>N° Habitaciones</label><input type='number' name='txthabitaciones";
                                // line 606
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' id='txthabitaciones";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' value='0' onfocusout='calcular_total(\"";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "\")' class='form-control ' disabled='true'>
                                    </div>
                                    <div class='col-md-2'>
                                    <br>
                                      <label>Personas por habitacion</label><input type='number' name='txtperp";
                                // line 610
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' id='txtperp";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' value='0' onfocusout='sumapersonas(\"";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "\")'  class='form-control pr' disabled='true'>

                                    </div>
                                    <div class='col-md-2'>
                                    <br>
                                      <label>Costo por dia:</label><input type='number' name='txtcostoxdia";
                                // line 615
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' id='txtcostoxdia";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' onfocusout='validarhospedaje(";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo ")' value='0' class='form-control ' disabled='true'>
                                    </div>
                                    <div class='col-md-2'>
                                    <br>
                                      <label>Dias</label><input type='number' name='txtdia";
                                // line 619
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' id='txtdia";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' value='0'  class='form-control' onfocusout='calcular_total(";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo ")' disabled='true'>
                                    </div>
                                    <div class='col-md-2'>
                                    <br>
                                      <label>Total:</label><input type='text'  name='txtcostototal";
                                // line 623
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "' id='txtcostototal";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                echo "'  class='form-control cl' value='";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["detalle"] ?? null), "total_hospedaje", array()), "html", null, true);
                                echo "' disabled='true'>
                                    </div>
                                ";
                            }
                            // line 626
                            echo "                                ";
                            $context["No"] = (($context["No"] ?? null) + 1);
                            // line 627
                            echo "                            ";
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 628
                    echo "

                        <input type='hidden' id='per' name='per'>
                        <div class='col-md-8'></div>
                                   <div class='col-md-2'>
                                   <br>
                                   <p>
                                   <center>
                                   <label>TOTAL</label>
                                 </center></div>

                              <div class='col-md-2'>
                           <br>
                           <input type='number' name='txtvalortotal' id='txtvalortotal' value='";
                    // line 641
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "total_hospedaje", array()), "html", null, true);
                    echo "'  class='form-control total'>
                           </div>


                         <div class=\"col-md-12\">
                            <br>
                            <br>
                         </div>
                         <div id='costohospedaje' name='costohospedaje'>
                               <div class='col-md-3'>
                               <br>
                                 <label><input type='checkbox' name='checkpago' id='checkpago' onclick='modificarporcentaje()'>Modificar porcentaje de pago </label>
                               </div>
                               <div class='col-md-3'>
                                 <label>PORCENTAJE DE PAGO %</label><input type='number' name='txtpago' step='0.01' id='txtpago' onfocusout='validarporcentaje();' class='form-control' value='";
                    // line 655
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "porcentaje", array()), "html", null, true);
                    echo "' disabled='true'>

                               </div>
                               <div class='col-md-3'>
                                 <label>SUB TOTAL</label><input type='number' name='txtsubtotal' id='txtsubtotal' value='";
                    // line 659
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "total_hospedaje", array()), "html", null, true);
                    echo "' class='form-control' disabled='true'>
                               </div>
                               <div class='col-md-3'>
                                 <label>MONTO TOTAL A PAGAR</label><input type='number' name='texttotalhos' id='texttotalhos' class='form-control' value='";
                    // line 662
                    echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "total_hospedaje", array()) * twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "porcentaje", array())) / "100"), "html", null, true);
                    echo "' disabled='true'>
                               </div>
                               <input type=\"hidden\" id=\"txtestado\" name=\"txtestado\" value=\"0\">
                         </div>
                     </div>
                  </div>
            </div>
            ";
                } else {
                    // line 670
                    echo "            ";
                }
                // line 671
                echo "          </div>
             ";
            } else {
                // line 673
                echo "             <div class='box'>
                     <div class='box-header'>
                     <h3 class='box-title'>Hospedaje</h3>
                     </div>
                   <div class='box-body'>
                     <div class='col-md-4'>
                       <label>INICIO:</label><input type='DATE' name='txtinicio' id='txtinicio' class='form-control' VALUE='";
                // line 679
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_inicio", array()), "html", null, true);
                echo "'>
                     </div>
                     <div class='col-md-4'>
                       <label>TERMINO:</label><input type='DATE' name='txtfinal' id='txtfinal'  onfocusout='calc_dias_hospedaje()' class='form-control'  VALUE='";
                // line 682
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "fecha_final", array()), "html", null, true);
                echo "'>
                     </div>
                     <div class='col-md-4'>
                       <label>CANTIDAD DE DIAS:</label><input type='number' name='txtdiashospedaje' id='txtdiashospedaje' class='form-control' VALUE='";
                // line 685
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "cant_dias_hospedaje", array()), "html", null, true);
                echo "'>
                     </div>
                     <div class='col-md-4'>
                       <label>Rut comercial</label><input type='text' name='txtrut' id='txtrut' class='form-control' VALUE='";
                // line 688
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "rut_hospedaje", array()), "html", null, true);
                echo "'>
                     </div>
                     <div class='col-md-4'>
                       <label>Nombre Residencial / Hotel </label><input type='text' name='txtcliente' id='txtcliente' class='form-control' VALUE='";
                // line 691
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "nombre_hospedaje", array()), "html", null, true);
                echo "'>
                     </div>
                     <div class='col-md-4'>
                       <label>Direccion:</label><input type='text' name='txtdireccion' id='txtdireccion'  class='form-control' VALUE='";
                // line 694
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "direccion_hospedaje", array()), "html", null, true);
                echo "'>
                     </div>
                     <div class='col-md-4'>
                     <br>
                     <a class='btn btn-success' id='seleccionar' name='seleccionar' onclick='seleccionar(3)' title='Seleccionar' data-toggle='tooltip'>
                      Seleccionar Personal
                     </a>
                     </div>
                     <div class='col-md-4'>
                     <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' value=\"";
                // line 703
                echo twig_escape_filter($this->env, ($context["db_cant_usuarios"] ?? null), "html", null, true);
                echo "\" class='form-control'>
                     <br>
                     </div>
                     <div class='col-md-12'>
                     <br>
                     </div>
                     <div class=\"col-md-12\" id=\"tipohospedaje\" name=\"tipohospedaje\">
                       ";
                // line 710
                $context["No"] = 1;
                // line 711
                echo "                       ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["db_tipo_hospedaje"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
                    if ((false != ($context["db_tipo_hospedaje"] ?? null))) {
                        // line 712
                        echo "                          ";
                        $context["pasa"] = 0;
                        // line 713
                        echo "                           ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["db_detalle_hospedaje"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["detalle"]) {
                            if ((false != ($context["db_detalle_hospedaje"] ?? null))) {
                                // line 714
                                echo "                              ";
                                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()) == twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "tipo_hospedaje", array()))) {
                                    // line 715
                                    echo "                                ";
                                    $context["pasa"] = 1;
                                    // line 716
                                    echo "                                 <div class='col-md-2'>
                                 <br>
                                 <br>
                                   <label><input type='checkbox' name='checktipo";
                                    // line 719
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' id='checktipo";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' onclick='marcar_tipo_hospedaje(";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo ")'>&nbsp&nbsp";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "tipo_habitacion", array()), "html", null, true);
                                    echo "</label>
                                 </div>
                                 <div class='col-md-2'>
                                 <br>
                                   <label>N° Habitaciones</label><input type='number' name='txthabitaciones";
                                    // line 723
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' id='txthabitaciones";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' value='";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "cant_habitaciones", array()), "html", null, true);
                                    echo "' onfocusout='calcular_total(\"";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "\")' class='form-control' disabled='true' >
                                 </div>
                                 <div class='col-md-2'>
                                 <br>
                                   <label>Personas por habitacion</label><input type='number' name='txtperp";
                                    // line 727
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' id='txtperp";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' value='";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "persoxhabi", array()), "html", null, true);
                                    echo "' onfocusout='sumapersonas(\"";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "\")'  class='form-control pr' disabled='true'>

                                 </div>
                                 <div class='col-md-2'>
                                 <br>
                                   <label>Costo por dia:</label><input type='number' name='txtcostoxdia";
                                    // line 732
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' id='txtcostoxdia";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' onfocusout='validarhospedaje(";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo ")' value='";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "costo_dia", array()), "html", null, true);
                                    echo "' class='form-control ' disabled='true' >
                                 </div>
                                 <div class='col-md-2'>
                                 <br>
                                   <label>Dias</label><input type='number' name='txtdia";
                                    // line 736
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' id='txtdia";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' value='";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "dias", array()), "html", null, true);
                                    echo "'  class='form-control' onfocusout='calcular_total(";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo ")' disabled='true'>
                                 </div>
                                 <div class='col-md-2'>
                                 <br>
                                   <label>Total:</label><input type='text'  name='txtcostototal";
                                    // line 740
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "' id='txtcostototal";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                                    echo "'  class='form-control cl' value='";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["detalle"], "monto", array()), "html", null, true);
                                    echo "' disabled='true'>
                                 </div>
                              ";
                                }
                                // line 743
                                echo "                            ";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detalle'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 744
                        echo "                            ";
                        if ((($context["pasa"] ?? null) == 0)) {
                            // line 745
                            echo "                                <div class='col-md-2'>
                                <br>
                                <br>
                                  <label><input type='checkbox' name='checktipo";
                            // line 748
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' id='checktipo";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' onclick='marcar_tipo_hospedaje(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo ")'>&nbsp&nbsp";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "tipo_habitacion", array()), "html", null, true);
                            echo "</label>
                                </div>
                                <div class='col-md-2'>
                                <br>
                                  <label>N° Habitaciones</label><input type='number' name='txthabitaciones";
                            // line 752
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' id='txthabitaciones";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' value='0' onfocusout='calcular_total(\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "\")' class='form-control ' disabled='true'>
                                </div>
                                <div class='col-md-2'>
                                <br>
                                  <label>Personas por habitacion</label><input type='number' name='txtperp";
                            // line 756
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' id='txtperp";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' value='0' onfocusout='sumapersonas(\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "\")'  class='form-control pr' disabled='true'>

                                </div>
                                <div class='col-md-2'>
                                <br>
                                  <label>Costo por dia:</label><input type='number' name='txtcostoxdia";
                            // line 761
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' id='txtcostoxdia";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' onfocusout='validarhospedaje(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo ")' value='0' class='form-control ' disabled='true'>
                                </div>
                                <div class='col-md-2'>
                                <br>
                                  <label>Dias</label><input type='number' name='txtdia";
                            // line 765
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' id='txtdia";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' value='0'  class='form-control' onfocusout='calcular_total(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo ")' disabled='true'>
                                </div>
                                <div class='col-md-2'>
                                <br>
                                  <label>Total:</label><input type='text'  name='txtcostototal";
                            // line 769
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "' id='txtcostototal";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["tipo"], "cod_tipo", array()), "html", null, true);
                            echo "'  class='form-control cl' value='";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["detalle"] ?? null), "total_hospedaje", array()), "html", null, true);
                            echo "' disabled='true'>
                                </div>
                            ";
                        }
                        // line 772
                        echo "                            ";
                        $context["No"] = (($context["No"] ?? null) + 1);
                        // line 773
                        echo "                        ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 774
                echo "

                    <input type='hidden' id='per' name='per'>
                    <div class='col-md-8'></div>
                               <div class='col-md-2'>
                               <br>
                               <p>
                               <center>
                               <label>TOTAL</label>
                             </center></div>

                          <div class='col-md-2'>
                       <br>
                       <input type='number' name='txtvalortotal' id='txtvalortotal' value='";
                // line 787
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "total_hospedaje", array()), "html", null, true);
                echo "'  class='form-control total'>
                       </div>
                      </div>
                      <div class=\"col-md-12\">
                         <br>
                         <br>
                      </div>
                      <div id='costohospedaje' name='costohospedaje'>
                            <div class='col-md-3'>
                            <br>
                              <label><input type='checkbox' name='checkpago' id='checkpago' onclick='modificarporcentaje()'>Modificar porcentaje de pago </label>
                            </div>
                            <div class='col-md-3'>
                              <label>PORCENTAJE DE PAGO %</label><input type='number' name='txtpago' step='0.01' id='txtpago' onfocusout='validarporcentaje();' class='form-control' value='";
                // line 800
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "porcentaje", array()), "html", null, true);
                echo "' disabled='true'>

                            </div>
                            <div class='col-md-3'>
                              <label>SUB TOTAL</label><input type='number' name='txtsubtotal' id='txtsubtotal' value='";
                // line 804
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "total_hospedaje", array()), "html", null, true);
                echo "' class='form-control' disabled='true'>
                            </div>
                            <div class='col-md-3'>
                              <label>MONTO TOTAL A PAGAR</label><input type='number' name='texttotalhos' id='texttotalhos' class='form-control' value='";
                // line 807
                echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "total_hospedaje", array()) * twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_monto"] ?? null), "porcentaje", array())) / "100"), "html", null, true);
                echo "' disabled='true'>
                            </div>
                            <input type=\"hidden\" id=\"txtestado\" name=\"txtestado\" value=\"0\">
                      </div>

                 </div>
               </div>
             ";
            }
            // line 815
            echo "          ";
        } else {
            // line 816
            echo "          <div class=\"col-md-12\" id=\"divhospedaje\" name=\"divhospedaje\"></div>
        ";
        }
        // line 818
        echo "        </div>
      <div class='box'>
              <div class='box-header'>
              <label>GASTO TOTAL:</label><input type='text' name='txttotalcontrol' id='txttotalcontrol' value='";
        // line 821
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar"] ?? null), "costo_total", array()), "html", null, true);
        echo "'onChange=\"validarSiNumero(this.value)\" class='form-control'>
              </div>
      </div>
      <div class=\"col-md-12\">
        <br>
        <br>
        <div class=\"col-md-4\"></div>
        <input type=\"hidden\" id=\"txttotal\" name=\"txttotal\">
        <input type=\"hidden\" id=\"totalxpersona\" name=\"totalxpersona\">
        <div class=\"\">
          <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnmodificar\" name=\"btnmodificar\" onclick=\"modificar_control()\">Modificar Control</button>
        </div>
        <br>
      </div>
    </form>
  </section>
";
        // line 837
        $this->loadTemplate("avar/modal_lista", "avar/editar_control.twig", 837)->display($context);
    }

    // line 839
    public function block_appScript($context, array $blocks = array())
    {
        // line 840
        echo "  <script src=\"views/app/js/test/test.js\"></script>
  <script>
  //viatico


  // //HOSPEDAJE
  // try {
  //   var dias=document.getElementById('txtcantidad').value;
  //   var costopordia=document.getElementById('txtcostopordia').value;
  //   var total_hospedaje=parseInt(dias)*parseInt(costopordia);
  //   document.getElementById('txttotalhospedaje').value=total_hospedaje;
  // } catch (e) {
  //
  // } finally {
  //
  // }
  //
  //
  //
  //
  //bus
  try {
    var personal=document.getElementById('txtpersonal').value
    document.getElementById('txtpersonal').value=personal;
    var bus=document.getElementById('txtcostopasaje').value;
    total_bus=parseInt(personal)*parseInt(bus);
    document.getElementById('txttotaltransportes').value=total_bus;
  } catch (e) {

  } finally {
    try {
      document.getElementById('txtpersonal').value=personal
    } catch (e) {

    } finally {

    }
    try {
      var cantmovil=document.getElementById('txtcantmovil').value;
      var costomovil=document.getElementById('txtmontopeaje').value;
      var total_transporte=parseInt(cantmovil)*parseInt(costomovil);
      document.getElementById('txttotaltransportes').value=total_transporte;
    } catch (e) {

    } finally {

    }


  }


  </script>

";
    }

    public function getTemplateName()
    {
        return "avar/editar_control.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1617 => 840,  1614 => 839,  1610 => 837,  1591 => 821,  1586 => 818,  1582 => 816,  1579 => 815,  1568 => 807,  1562 => 804,  1555 => 800,  1539 => 787,  1524 => 774,  1517 => 773,  1514 => 772,  1504 => 769,  1493 => 765,  1482 => 761,  1470 => 756,  1459 => 752,  1446 => 748,  1441 => 745,  1438 => 744,  1431 => 743,  1421 => 740,  1408 => 736,  1395 => 732,  1381 => 727,  1368 => 723,  1355 => 719,  1350 => 716,  1347 => 715,  1344 => 714,  1338 => 713,  1335 => 712,  1329 => 711,  1327 => 710,  1317 => 703,  1305 => 694,  1299 => 691,  1293 => 688,  1287 => 685,  1281 => 682,  1275 => 679,  1267 => 673,  1263 => 671,  1260 => 670,  1249 => 662,  1243 => 659,  1236 => 655,  1219 => 641,  1204 => 628,  1197 => 627,  1194 => 626,  1184 => 623,  1173 => 619,  1162 => 615,  1150 => 610,  1139 => 606,  1126 => 602,  1121 => 599,  1118 => 598,  1111 => 597,  1101 => 594,  1088 => 590,  1075 => 586,  1061 => 581,  1048 => 577,  1035 => 573,  1030 => 570,  1027 => 569,  1024 => 568,  1018 => 567,  1015 => 566,  1009 => 565,  1007 => 564,  998 => 558,  992 => 555,  986 => 552,  977 => 545,  975 => 544,  972 => 543,  969 => 542,  967 => 541,  960 => 536,  956 => 534,  953 => 533,  945 => 528,  936 => 521,  925 => 517,  921 => 516,  916 => 515,  908 => 513,  905 => 512,  903 => 511,  894 => 510,  891 => 509,  885 => 508,  883 => 507,  863 => 490,  855 => 485,  849 => 482,  837 => 473,  831 => 470,  825 => 467,  816 => 460,  808 => 455,  799 => 448,  788 => 444,  784 => 443,  779 => 442,  771 => 440,  768 => 439,  766 => 438,  757 => 437,  754 => 436,  748 => 435,  746 => 434,  726 => 417,  720 => 414,  714 => 411,  697 => 396,  694 => 395,  691 => 394,  686 => 391,  683 => 390,  679 => 388,  676 => 387,  664 => 378,  649 => 365,  637 => 356,  622 => 343,  619 => 342,  616 => 341,  614 => 340,  611 => 339,  607 => 337,  604 => 336,  597 => 332,  588 => 325,  577 => 321,  573 => 320,  568 => 319,  560 => 317,  557 => 316,  555 => 315,  546 => 314,  543 => 313,  537 => 312,  535 => 311,  507 => 286,  492 => 274,  486 => 271,  478 => 265,  470 => 260,  459 => 252,  447 => 243,  441 => 240,  435 => 237,  427 => 231,  425 => 230,  413 => 221,  401 => 212,  395 => 209,  389 => 206,  383 => 203,  375 => 197,  372 => 196,  370 => 195,  367 => 194,  364 => 193,  362 => 192,  355 => 189,  351 => 187,  348 => 186,  337 => 178,  331 => 175,  325 => 172,  316 => 165,  306 => 157,  299 => 156,  297 => 155,  292 => 153,  288 => 152,  283 => 151,  277 => 150,  275 => 149,  254 => 131,  248 => 128,  242 => 125,  230 => 116,  224 => 113,  218 => 110,  209 => 103,  206 => 102,  204 => 101,  194 => 93,  191 => 92,  187 => 90,  183 => 88,  180 => 87,  176 => 85,  174 => 84,  170 => 82,  167 => 81,  163 => 79,  159 => 77,  157 => 76,  154 => 75,  151 => 74,  147 => 72,  145 => 71,  141 => 69,  138 => 68,  134 => 66,  130 => 64,  127 => 63,  123 => 61,  121 => 60,  106 => 48,  100 => 45,  94 => 42,  88 => 39,  81 => 35,  77 => 34,  71 => 31,  59 => 22,  45 => 10,  42 => 9,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "avar/editar_control.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\avar\\editar_control.twig");
    }
}
