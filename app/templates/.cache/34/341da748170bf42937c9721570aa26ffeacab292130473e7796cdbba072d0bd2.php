<?php

/* avar/Areas/editar_area.twig */
class __TwigTemplate_0913c4b018241b6d0d3de809880c9d5460300fb633450d630df3091fc0fd8710 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/Areas/editar_area.twig", 1);
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
            <small>Editar Area</small>
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
                    <form id=\"formeditararea\" action=\"\" method=\"POST\">
                        <div class=\"col-sm-4\"></div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                              <input type=\"hidden\" name=\"textid\" id=\"textid\" value=\"";
        // line 27
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar_area"] ?? null), "codigo", array()), "html", null, true);
        echo "\">
                                CODIGO AREA
                                <input class=\"form-control\" name=\"txteditarcodarea\" id=\"txteditarcodarea\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar_area"] ?? null), "cod_area", array()), "html", null, true);
        echo "\" type=\"text\" required=\"required\"/>
                                <br>
                                NOMBRE
                                <input class=\"form-control\" name=\"txteditarnombrearea\" id=\"txteditarnombrearea\"  value=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_modificar_area"] ?? null), "descripcion", array()), "html", null, true);
        echo "\" type=\"text\"  required=\"required\"/>
                                <br>
                            </div>
                        <div class=\"col-md-12\">
                          <div class=\"col-md-4\">
                          </div>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnmodificararea\" onclick=\"modificararea()\" name=\"btnmodificararea\">MODIFICAR AREA</button>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
      </div>
    </section>

";
    }

    // line 48
    public function block_appScript($context, array $blocks = array())
    {
        // line 49
        echo "    <script src=\"views/app/js/area/area.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "avar/Areas/editar_area.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 49,  94 => 48,  74 => 32,  68 => 29,  63 => 27,  38 => 4,  35 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "avar/Areas/editar_area.twig", "C:\\xampp\\htdocs\\proyectos\\recursos\\app\\templates\\avar\\Areas\\editar_area.twig");
    }
}
