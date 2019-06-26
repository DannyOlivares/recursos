<?php

/* avar/nueva_localidad.twig */
class __TwigTemplate_d39aa82f503009c15d813a0a7f9ded91cd6fa5fbccd3b6ecd1230cc007d65542 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/nueva_localidad.twig", 1);
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
    }

    // line 3
    public function block_appBody($context, array $blocks = array())
    {
        // line 4
        echo "    <section class=\"content-header\">
        <h1>
          Localidad
            <small>Nueva Localidad</small>
        </h1>
        <ol class=\"breadcrumb\">
            <li>
                <a href=\"#\">
                    <i class=\"fa fa-home\"></i>
                    Home</a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-primary\">
                    <form id=\"formlocalidad\" action=\"\" method=\"POST\">
                        <div class=\"box-body col-sm-4\"></div>
                        <div class=\"box-body col-sm-4\">
                            <div class=\"form-group\">
                                CODIGO LOCALIDAD
                                <input class=\"form-control\" name=\"txtcod\" id=\"txtcod\" type=\"text\" placeholder=\"Codigo Localidad\" required=\"required\"/>
                                <br>
                                LOCALIDAD
                                <input class=\"form-control\" name=\"txtdescripcion\" id=\"txtdescripcion\" type=\"text\" placeholder=\"Localidad\" required=\"required\"/>
                                <br>
                                HUB
                                <input class=\"form-control\" name=\"txthub\" id=\"txthub\" type=\"text\" placeholder=\"Ingresar HUB\" onfocusout='checkviatico()' required=\"required\"/>
                                <br>

                              <!--  ACTIVIDADES
                                <div class=\"col-md-12\">
                                    <input  name=\"txtocultoviatico\" id=\"txtocultoviatico\" value=\"0\" type=\"hidden\"/>
                                  <div class=\"col-md-6\">
                                    <br>
                                      <label><input type=\"checkbox\" name=\"check2\" id=\"check2\" onclick=\"checktransporte()\">TRANSPORTE</label>
                                      <input class=\"form-control\" name=\"txtocultoavion\" id=\"txtocultoavion\" type=\"hidden\"/>
                                      <input class=\"form-control\" name=\"txtocultobus\" id=\"txtocultobus\" type=\"hidden\"/>
                                      <input class=\"form-control\" name=\"txtocultopeajes\" id=\"txtocultopeajes\" type=\"hidden\"/>
                                      <input class=\"form-control\" name=\"txtocultocostopeajes\" id=\"txtocultocostopeajes\" type=\"hidden\"/>
                                  </div>
                                  <div class=\"col-md-6\">
                                    <br>
                                      <label><input type=\"checkbox\" name=\"check3\" id=\"check3\" onclick=\"checkhospedaje()\">HOSPEDAJE</label>
                                      <input class=\"form-control\" name=\"txtocultohospedaje\" id=\"txtocultohospedaje\" type=\"hidden\"/>

                                  </div>
                               </div>

                               <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\" >


                               </div>
                        </div>-->
                        <div class=\"box-body col-md-4\">
                        </div>
                        <div class=\"box-body col-md-4\">
                          <center>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnguardar\" onclick=\"guardarlocalidad()\" name=\"btnguardar\">GUARDAR LOCALIDAD</button>
                        </center>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

";
    }

    // line 76
    public function block_appScript($context, array $blocks = array())
    {
        // line 77
        echo "    <script src=\"views/app/js/localidades/localidades.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "avar/nueva_localidad.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 77,  113 => 76,  38 => 4,  35 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}{% endblock %}
{% block appBody %}
    <section class=\"content-header\">
        <h1>
          Localidad
            <small>Nueva Localidad</small>
        </h1>
        <ol class=\"breadcrumb\">
            <li>
                <a href=\"#\">
                    <i class=\"fa fa-home\"></i>
                    Home</a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-primary\">
                    <form id=\"formlocalidad\" action=\"\" method=\"POST\">
                        <div class=\"box-body col-sm-4\"></div>
                        <div class=\"box-body col-sm-4\">
                            <div class=\"form-group\">
                                CODIGO LOCALIDAD
                                <input class=\"form-control\" name=\"txtcod\" id=\"txtcod\" type=\"text\" placeholder=\"Codigo Localidad\" required=\"required\"/>
                                <br>
                                LOCALIDAD
                                <input class=\"form-control\" name=\"txtdescripcion\" id=\"txtdescripcion\" type=\"text\" placeholder=\"Localidad\" required=\"required\"/>
                                <br>
                                HUB
                                <input class=\"form-control\" name=\"txthub\" id=\"txthub\" type=\"text\" placeholder=\"Ingresar HUB\" onfocusout='checkviatico()' required=\"required\"/>
                                <br>

                              <!--  ACTIVIDADES
                                <div class=\"col-md-12\">
                                    <input  name=\"txtocultoviatico\" id=\"txtocultoviatico\" value=\"0\" type=\"hidden\"/>
                                  <div class=\"col-md-6\">
                                    <br>
                                      <label><input type=\"checkbox\" name=\"check2\" id=\"check2\" onclick=\"checktransporte()\">TRANSPORTE</label>
                                      <input class=\"form-control\" name=\"txtocultoavion\" id=\"txtocultoavion\" type=\"hidden\"/>
                                      <input class=\"form-control\" name=\"txtocultobus\" id=\"txtocultobus\" type=\"hidden\"/>
                                      <input class=\"form-control\" name=\"txtocultopeajes\" id=\"txtocultopeajes\" type=\"hidden\"/>
                                      <input class=\"form-control\" name=\"txtocultocostopeajes\" id=\"txtocultocostopeajes\" type=\"hidden\"/>
                                  </div>
                                  <div class=\"col-md-6\">
                                    <br>
                                      <label><input type=\"checkbox\" name=\"check3\" id=\"check3\" onclick=\"checkhospedaje()\">HOSPEDAJE</label>
                                      <input class=\"form-control\" name=\"txtocultohospedaje\" id=\"txtocultohospedaje\" type=\"hidden\"/>

                                  </div>
                               </div>

                               <div class=\"col-md-12\" id=\"divtransporte\" name=\"divtransporte\" >


                               </div>
                        </div>-->
                        <div class=\"box-body col-md-4\">
                        </div>
                        <div class=\"box-body col-md-4\">
                          <center>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnguardar\" onclick=\"guardarlocalidad()\" name=\"btnguardar\">GUARDAR LOCALIDAD</button>
                        </center>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

{% endblock %}
{% block appScript %}
    <script src=\"views/app/js/localidades/localidades.js\"></script>
{% endblock %}
", "avar/nueva_localidad.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\avar\\nueva_localidad.twig");
    }
}
