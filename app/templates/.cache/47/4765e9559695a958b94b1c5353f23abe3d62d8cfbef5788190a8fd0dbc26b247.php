<?php

/* avar/nuevo_control.twig */
class __TwigTemplate_89480b60741554a249da2f966a191387e6919ce2109a88ed21748cfadfd7609a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/nuevo_control.twig", 1);
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
          <small>Nuevo Proyecto</small>
        </h1>
      </section>
    </div>
  </div>
  <section class=\"content\">
    <form id=\"formtest\" name=\"formtest\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box\">
            <div class=\"box-header\">
              <h3 class=\"box-title\">Datos actividad</h3>
            </div>
            <div class=\"box-body\">
              <div class=\"col-md-3\">
                <label>id de proyecto:</label><input type=\"text\" name=\"txtidproyecto\" id=\"txtidproyecto\" onfocusout=\"validarcodigo()\" class=\"form-control\">
              </div>
              <div class=\"col-md-3\">
                <label for=\"cmblocalidades\">Zona</label>
                <select class=\"form-control\" id=\"cmblocalidades\" name=\"cmblocalidades\" >
                  <!-- onchange=\"seleclocalidades()\" -->
                  <option value=\"0\">--</option>
                  ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_localidades"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["l"]) {
            // line 38
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["l"], "id_localidad", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["l"], "descripcion", array()), "html", null, true);
            echo "</option>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "                </select>
              </div>
              <div class=\"col-md-3\">
                <label for=\"cmbtipotrabajo\">Tipo trabajo</label>
                <select class=\"form-control\" name=\"cmbtipotrabajo\" id=\"cmbtipotrabajo\" onchange=\"cambiardatos()\">
                  <option value=\"--\">--</option>
                  ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_areas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            // line 47
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "descripcion", array()), "html", null, true);
            echo "</option>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "                </select>
              </div>
              <div class=\"col-md-3\">
                <label>SOLICITANTE</label><input type=\"text\" name=\"txtsolicitante\" id=\"txtsolicitante\" class=\"form-control\" value=\"";
        // line 52
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["owner_user"] ?? null), "name", array(), "array"), "html", null, true);
        echo "\" readonly=\"readonly\">
              </div>
              <div class=\"col-md-6\">
                <label>Descripcion de proyecto</label><input type=\"text\" name=\"txtdetalle\" id=\"txtdetalle\" class=\"form-control\">
              </div>
              <div class=\"col-md-3\">
                <label>Nodo Cuadrante</label><input type=\"text\" name=\"txtnodo\" id=\"txtnodo\" class=\"form-control\">
              </div>
              <div class=\"col-md-12\">
                <br>
              </div>
              <div id=\"divseleccion\" name=\"divseleccion\" class=\"col-md-12\">
                <div class=\"col-md-2\">
                </div>
                  <div class=\"col-md-2\">
                    <h4><label>SELECCION</label></h4>
                  </div>
                  <div class=\"col-md-2\">
                      <h4><label><input type=\"checkbox\" name=\"checkviatico\" id=\"checkviatico\" onclick=\"seleccionopcion(1)\" disabled='true' checked='checked'>VIATICO<label></h4>
                  </div>
                  <div class=\"col-md-2\">
                      <h4><label><input type=\"checkbox\" name=\"checktransporte\" id=\"checktransporte\" onclick=\"seleccionopcion(2)\" disabled='true' checked='checked'>TRANSPORTE</label></h4>
                  </div>
                  <div class=\"col-md-2\">
                      <h4><label><input type=\"checkbox\" name=\"checkhospedaje\" id=\"checkhospedaje\" onclick=\"seleccionopcion(3)\" disabled='true'>HOSPEDAJE</label></h4>
                  </div>
                  <input type=\"hidden\" name=\"idcount\" id=\"idcount\" value=\"3\">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-12\" id=\"divviatico\" name=\"divviatico\">
                <div class='box'>
                   <div class='box-header'>
                   <h3 class='box-title'>Viatico</h3>
                   </div>
                 <div class='box-body'>
                   <div class='col-md-4'>
                     <label>INICIO:</label><input type='DATE' name='txtinicio' id='txtinicio'  class='form-control' value=\"";
        // line 93
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "\" readonly='readonly'>
                   </div>
                   <div class='col-md-4'>
                     <label>TERMINO:</label><input type='DATE' name='txtfinal' id='txtfinal' onfocusout='calc_dias(1)' class='form-control'  value=\"";
        // line 96
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "\" readonly='readonly'>
                   </div>
                   <div class='col-md-4'>
                     <label>DIAS VIATICO:</label><input type='number' name='txtdias' id='txtdias' class='form-control' readonly='readonly'>
                   </div>
                   <div class='col-md-2'>
                   <br>
                   <a class='btn btn-success' id='seleccionar' name='seleccionar' title='Seleccionar' data-toggle='tooltip' readonly='readonly'>
                    Seleccionar Personal
                   </a>
                   </div>
                   <div class='col-md-3'>
                   <label>Cantidad Personas</label><input type='Number' name='txtpersonal' id='txtpersonal' class='form-control' readonly='readonly'>
                   </div>
                   <div class='col-md-3'>
                       <label>MONTO VIATICO P/P</label><input type='text' name='txtviatico' id='txtviatico' value=\" \" class='form-control' readonly='readonly' readonly='readonly'>
                   </div>
                   <div class='col-md-4'>
                       <label>TOTAL VIATICO</label><input type='number' name='txtrest' id='txtrest' class='form-control total' readonly='readonly'>
                       <br>
                   </div>
                   <input type='hidden' id='textprincipal' name='textprincipal' value='1'>
                     <div class='col-md-12' id='divpersonal' name='divpersonal'>

                     </div>
               </div>
             </div>
         </div>
      </div>
      <input type=\"hidden\" name=\"contador2\" id=\"contador2\" value=\"0\">
      <div class=\"row\">
        <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\">
          <div class='box'>
                  <div class='box-header'>
                 <h3 class='box-title'>Transporte</h3>
                  &nbsp
                  &nbsp
                 <label><input type='radio' name='edrbopcion' id='edrbopcionbus' onchange='elegirtransporte(4)' checked='checked'>BUS</label>
                 &nbsp
                 <label><input type='radio' name='edrbopcion' id='edrbopcionavion' onchange='elegirtransporte(5)' disabled='true'>AVION</label>
                 &nbsp
                 <label><input type='radio' name='edrbopcion' id='edrbopcionmovil' onchange='elegirtransporte(6)' disabled='true'>MOVIL</label>
                 </div>
                 <div class='box-body'>
                 <div class='col-md-4'>
                  <label>Valor Pasaje Bus ida / vuelta</label><input type='Number' name='txtcostopasaje' id='txtcostopasaje' onfocusout='calcularpasaje()' class='form-control' readonly='readonly'>
                  </div>
                 <div class='col-md-4'>
                 <label>Total transporte</label><input type='number' name='txttotaltransportes' id='txttotaltransportes' class='form-control total' readonly='readonly'>
                 </div>
                 <input type='hidden' id='txtopcion' name='txtopcion' value='1'>
                 </div>
                 </div>
        </div>
     </div>
      <div class=\"row\">

          <input type=\"hidden\" name=\"txtnummovil\" id=\"txtnummovil\" value='0'>
      </div>
      <div class=\"row\">
        <div class=\"col-md-12\" id=\"divhospedaje\" name=\"divhospedaje\">

        </div>
        <input type='hidden' id='cantpersonas' name='cantpersonas' value='0'>
        <input type=\"hidden\" id=\"contadorpersonas\" name=\"contadorpersonas\" value='0'>
        <input type='hidden' id='txttipo' name='txttipo'>
      </div>
      <div class='box'>
              <div class='box-header'>
              <label>GASTO TOTAL:</label><input type='text' name='txttotalcontrol' id='txttotalcontrol' onChange=\"validarSiNumero(this.value)\" class='form-control'>
              </div>
      </div>
      <div class=\"col-md-12\">
        <br>
        <br>
        <div class=\"col-md-4\"></div>
        <input type=\"hidden\" id=\"txttotal\" name=\"txttotal\">
        <input type=\"hidden\" id=\"totalxpersona\" name=\"totalxpersona\">
        <div class=\"\">
          <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnenviar\" name=\"btnenviar\" onclick=\"guardar_vista()\">Enviar Control</button>
        </div>
        <br>
      </div>
    </form>
  </section>
";
        // line 181
        $this->loadTemplate("avar/modal_lista", "avar/nuevo_control.twig", 181)->display($context);
        // line 182
        $this->loadTemplate("avar/modal_visualizar", "avar/nuevo_control.twig", 182)->display($context);
    }

    // line 184
    public function block_appScript($context, array $blocks = array())
    {
        // line 185
        echo "  <script src=\"views/app/js/test/test.js\"></script>

";
    }

    public function getTemplateName()
    {
        return "avar/nuevo_control.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  264 => 185,  261 => 184,  257 => 182,  255 => 181,  167 => 96,  161 => 93,  117 => 52,  112 => 49,  101 => 47,  97 => 46,  89 => 40,  78 => 38,  74 => 37,  45 => 10,  42 => 9,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "avar/nuevo_control.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\avar\\nuevo_control.twig");
    }
}
