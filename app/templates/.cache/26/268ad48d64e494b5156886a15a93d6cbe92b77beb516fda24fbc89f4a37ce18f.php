<?php

/* personal/ingresar_personal.twig */
class __TwigTemplate_d051211beae7d732acce14ede26c82dec7a1c0eced149729fe3f3e121377d526 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal/ingresar_personal.twig", 1);
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
          Personal
            <small>Nuevo Personal</small>
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
                    <form id=\"formperso\" action=\"\" method=\"POST\">
                        <div class=\"col-sm-4\"></div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                Rut
                                <input class=\"form-control\" name=\"txtrutpersonal\" id=\"txtrutpersonal\" type=\"text\" placeholder=\"99999999-9\" required=\"required\"/>
                                NOMBRE
                                <input class=\"form-control\" name=\"txtnombrepersonal\" id=\"txtnombrepersonal\" type=\"text\" placeholder=\"Nombre\" required=\"required\"/>
                                EMAIL
                                <input class=\"form-control\" name=\"txtemailpersonal\" id=\"txtemailpersonal\" type=\"text\" placeholder=\"nombre@email.com\" required=\"required\"/>
                                Area
                                <select id=\"cmbarea\" name=\"cmbarea\" class=\"form-control\">
                                  <option value=\"0\">--</option>
                                  ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_area"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            if ((false != ($context["db_area"] ?? null))) {
                // line 37
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "descripcion", array()), "html", null, true);
                echo "</option>
                                  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "                                </select>
                                Cargo
                                <input class=\"form-control\" name=\"txtcargopersonal\" id=\"txtcargopersonal\" type=\"text\" placeholder=\"ej:Soporte\" required=\"required\"/>
                            </div>
                        <div class=\"col-md-12\">
                          <div class=\"col-md-4\">
                          </div>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnguardarpersonal\" onclick=\"guardarpersonal()\" name=\"btnguardarpersonal\">GUARDAR Personal</button>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
      </div>
    </section>

";
    }

    // line 56
    public function block_appScript($context, array $blocks = array())
    {
        // line 57
        echo "    <script src=\"views/app/js/personal/personal.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "personal/ingresar_personal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 57,  109 => 56,  89 => 39,  77 => 37,  72 => 36,  38 => 4,  35 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}{% endblock %}
{% block appBody %}
    <section class=\"content-header\">
        <h1>
          Personal
            <small>Nuevo Personal</small>
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
                    <form id=\"formperso\" action=\"\" method=\"POST\">
                        <div class=\"col-sm-4\"></div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                Rut
                                <input class=\"form-control\" name=\"txtrutpersonal\" id=\"txtrutpersonal\" type=\"text\" placeholder=\"99999999-9\" required=\"required\"/>
                                NOMBRE
                                <input class=\"form-control\" name=\"txtnombrepersonal\" id=\"txtnombrepersonal\" type=\"text\" placeholder=\"Nombre\" required=\"required\"/>
                                EMAIL
                                <input class=\"form-control\" name=\"txtemailpersonal\" id=\"txtemailpersonal\" type=\"text\" placeholder=\"nombre@email.com\" required=\"required\"/>
                                Area
                                <select id=\"cmbarea\" name=\"cmbarea\" class=\"form-control\">
                                  <option value=\"0\">--</option>
                                  {% for a in db_area if false != db_area %}
                                    <option value=\"{{a.cod_area}}\">{{a.descripcion}}</option>
                                  {% endfor %}
                                </select>
                                Cargo
                                <input class=\"form-control\" name=\"txtcargopersonal\" id=\"txtcargopersonal\" type=\"text\" placeholder=\"ej:Soporte\" required=\"required\"/>
                            </div>
                        <div class=\"col-md-12\">
                          <div class=\"col-md-4\">
                          </div>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnguardarpersonal\" onclick=\"guardarpersonal()\" name=\"btnguardarpersonal\">GUARDAR Personal</button>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
      </div>
    </section>

{% endblock %}
{% block appScript %}
    <script src=\"views/app/js/personal/personal.js\"></script>
{% endblock %}
", "personal/ingresar_personal.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\personal\\ingresar_personal.twig");
    }
}
