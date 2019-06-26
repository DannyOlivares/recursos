<?php

/* avar/Areas/nueva_area.twig */
class __TwigTemplate_b05620367f96496cc84f072167c20bfa94609ca33e22f72be6fcc0172bb2aef8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/Areas/nueva_area.twig", 1);
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
          Areas
            <small>Nueva Area</small>
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
                    <form id=\"formarea\" action=\"\" method=\"POST\">
                        <div class=\"col-sm-4\"></div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                CODIGO AREA
                                <input class=\"form-control\" name=\"txtcodarea\" id=\"txtcodarea\" type=\"text\" placeholder=\"Codigo Area\" required=\"required\"/>
                                <br>
                                NOMBRE
                                <input class=\"form-control\" name=\"txtnombrearea\" id=\"txtnombrearea\" type=\"text\" placeholder=\"Nombre Area\" required=\"required\"/>
                                <br>
                            </div>
                        <div class=\"col-md-12\">
                          <div class=\"col-md-4\">
                          </div>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnguardararea\" onclick=\"guardararea()\" name=\"btnguardararea\">GUARDAR AREA</button>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
      </div>
    </section>

";
    }

    // line 47
    public function block_appScript($context, array $blocks = array())
    {
        // line 48
        echo "    <script src=\"views/app/js/area/area.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "avar/Areas/nueva_area.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 48,  84 => 47,  38 => 4,  35 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}{% endblock %}
{% block appBody %}
    <section class=\"content-header\">
        <h1>
          Areas
            <small>Nueva Area</small>
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
                    <form id=\"formarea\" action=\"\" method=\"POST\">
                        <div class=\"col-sm-4\"></div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                CODIGO AREA
                                <input class=\"form-control\" name=\"txtcodarea\" id=\"txtcodarea\" type=\"text\" placeholder=\"Codigo Area\" required=\"required\"/>
                                <br>
                                NOMBRE
                                <input class=\"form-control\" name=\"txtnombrearea\" id=\"txtnombrearea\" type=\"text\" placeholder=\"Nombre Area\" required=\"required\"/>
                                <br>
                            </div>
                        <div class=\"col-md-12\">
                          <div class=\"col-md-4\">
                          </div>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnguardararea\" onclick=\"guardararea()\" name=\"btnguardararea\">GUARDAR AREA</button>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
      </div>
    </section>

{% endblock %}
{% block appScript %}
    <script src=\"views/app/js/area/area.js\"></script>
{% endblock %}
", "avar/Areas/nueva_area.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\avar\\Areas\\nueva_area.twig");
    }
}
