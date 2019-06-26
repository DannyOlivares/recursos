<?php

/* personal/editar_personal.twig */
class __TwigTemplate_cdbe7a50ea16746238e534d954727e4185b2209975ffbd9fdc1656044badbf0a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal/editar_personal.twig", 1);
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
            <small>Editar Personal</small>
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
                    <form id=\"formeditarperso\" action=\"\" method=\"POST\">
                        <div class=\"col-sm-4\"></div>
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                <input type=\"hidden\" name=\"txteditarpersonalid\" value=\"";
        // line 27
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "cod_personal", array()), "html", null, true);
        echo "\">
                                Rut
                                <input class=\"form-control\" name=\"txtedirutpersonal\" id=\"txtedirutpersonal\" type=\"text\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "rut_personal", array()), "html", null, true);
        echo "\" required=\"required\"/>
                                NOMBRE
                                <input class=\"form-control\" name=\"txteditarnombrepersonal\" id=\"txteditarnombrepersonal\" type=\"text\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "nombre_personal", array()), "html", null, true);
        echo "\" required=\"required\"/>
                                EMAIL
                                <input class=\"form-control\" name=\"txteditaremailpersonal\" id=\"txteditaremailpersonal\" type=\"text\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "email", array()), "html", null, true);
        echo "\" required=\"required\"/>
                                Area
                                <select id=\"cmbeditararea\" name=\"cmbeditararea\" class=\"form-control\">
                                  <option value='";
        // line 36
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "area_personal", array()), "html", null, true);
        echo "'>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "descripcion", array()), "html", null, true);
        echo "</option>
                                  ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_area"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            if ((false != ($context["db_area"] ?? null))) {
                // line 38
                echo "                                  ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "area_personal", array()) != twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()))) {
                    // line 39
                    echo "                                        <option value=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "descripcion", array()), "html", null, true);
                    echo "</option>
                                  ";
                } else {
                    // line 41
                    echo "

                                    ";
                }
                // line 44
                echo "                                  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "                                </select>
                                Cargo
                                <input class=\"form-control\" name=\"txteditarcargopersonal\" id=\"txteditarcargopersonal\" type=\"text\" value=\"";
        // line 47
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_detalle"] ?? null), "cargo_personal", array()), "html", null, true);
        echo "\" required=\"required\"/>
                            </div>
                        <div class=\"col-md-12\">
                          <div class=\"col-md-4\">
                          </div>
                          <button type=\"button\" class=\"btn btn-primary\" id=\"btnmodificarpersonal\" onclick=\"modificarpersonal()\" name=\"btnmodificarpersonal\">MODIFICAR PERSONAL</button>
                        </div>
                      </div>
                    </form>
            </div>
        </div>
      </div>
    </section>

";
    }

    // line 62
    public function block_appScript($context, array $blocks = array())
    {
        // line 63
        echo "    <script src=\"views/app/js/personal/personal.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "personal/editar_personal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 63,  141 => 62,  122 => 47,  118 => 45,  111 => 44,  106 => 41,  98 => 39,  95 => 38,  90 => 37,  84 => 36,  78 => 33,  73 => 31,  68 => 29,  63 => 27,  38 => 4,  35 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "personal/editar_personal.twig", "C:\\xampp\\htdocs\\cp\\app\\templates\\personal\\editar_personal.twig");
    }
}
