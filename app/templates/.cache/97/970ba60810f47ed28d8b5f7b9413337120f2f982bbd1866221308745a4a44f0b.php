<?php

/* avar/editar_localidades.twig */
class __TwigTemplate_631abdc8a528023a2f948a9e55150c5ff17a7b4e22abdc2ddd8c4bba0a062b4d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/editar_localidades.twig", 1);
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
          Localidades
            <small>Editar Localidad</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-primary\">
                    <form id=\"editar_localidad\" name=\"editar_localidad\" action=\"\" method=\"POST\">
                        <div class=\"box-body col-sm-4\"></div>
                        <div class=\"box-body col-sm-4\">
                            <input type='hidden' name='id_localidad' id='id_localidad' value='";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_localidades"] ?? null), "id_localidad", array()), "html", null, true);
        echo "'/>
                            <div class=\"form-group\">
                                Codigo Localidad
                                <input class=\"form-control\" name=\"numlocalidad\" id=\"numlocalidad\" type=\"text\" value='";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_localidades"] ?? null), "cod_localidad", array()), "html", null, true);
        echo "' required=\"required\"/>
                                <br>
                                Nombre Localidad
                                <input class=\"form-control\" name=\"descripcionlocalidad\" id=\"descripcionlocalidad\" type=\"text\"  value='";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_localidades"] ?? null), "descripcion", array()), "html", null, true);
        echo "' required=\"required\"/>
                                <br>
                                Hub Localidad
                                <input class=\"form-control\" name=\"hublocalidad\" id=\"hublocalidad\" type=\"text\"  value='";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_localidades"] ?? null), "hub", array()), "html", null, true);
        echo "' required=\"required\"/>
                                <br>
                                Area
                                <select class=\"form-control\" name=\"cmbareas\" id=\"cmbareas\" onchange=\"cargadeareas()\">
                                  <option value=\"--\">--</option>
                                  ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_areas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            if ((false != ($context["db_areas"] ?? null))) {
                // line 34
                echo "                                   <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
                echo "\" >";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "descripcion", array()), "html", null, true);
                echo "</option>
                                  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "                                </select>
                                <br>
                                <div id=\"divopciones\" name=\"divopciones\">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

";
    }

    // line 51
    public function block_appScript($context, array $blocks = array())
    {
        // line 52
        echo "    <script src=\"views/app/js/localidades/localidades.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "avar/editar_localidades.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 52,  116 => 51,  98 => 36,  86 => 34,  81 => 33,  73 => 28,  67 => 25,  61 => 22,  55 => 19,  38 => 4,  35 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}{% endblock %}
{% block appBody %}
    <section class=\"content-header\">
        <h1>
          Localidades
            <small>Editar Localidad</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-primary\">
                    <form id=\"editar_localidad\" name=\"editar_localidad\" action=\"\" method=\"POST\">
                        <div class=\"box-body col-sm-4\"></div>
                        <div class=\"box-body col-sm-4\">
                            <input type='hidden' name='id_localidad' id='id_localidad' value='{{ db_localidades.id_localidad }}'/>
                            <div class=\"form-group\">
                                Codigo Localidad
                                <input class=\"form-control\" name=\"numlocalidad\" id=\"numlocalidad\" type=\"text\" value='{{ db_localidades.cod_localidad }}' required=\"required\"/>
                                <br>
                                Nombre Localidad
                                <input class=\"form-control\" name=\"descripcionlocalidad\" id=\"descripcionlocalidad\" type=\"text\"  value='{{ db_localidades.descripcion }}' required=\"required\"/>
                                <br>
                                Hub Localidad
                                <input class=\"form-control\" name=\"hublocalidad\" id=\"hublocalidad\" type=\"text\"  value='{{ db_localidades.hub }}' required=\"required\"/>
                                <br>
                                Area
                                <select class=\"form-control\" name=\"cmbareas\" id=\"cmbareas\" onchange=\"cargadeareas()\">
                                  <option value=\"--\">--</option>
                                  {% for a in db_areas if false != db_areas %}
                                   <option value=\"{{a.cod_area}}\" >{{a.descripcion}}</option>
                                  {% endfor %}
                                </select>
                                <br>
                                <div id=\"divopciones\" name=\"divopciones\">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

{% endblock %}
{% block appScript %}
    <script src=\"views/app/js/localidades/localidades.js\"></script>
{% endblock %}
", "avar/editar_localidades.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\avar\\editar_localidades.twig");
    }
}
