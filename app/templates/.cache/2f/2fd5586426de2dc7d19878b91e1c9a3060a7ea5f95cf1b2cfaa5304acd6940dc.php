<?php

/* personal/cargar_personal.twig */
class __TwigTemplate_b6833b64ad0222ed87a3ee37646e9ba952fd7baeef143cc67603a0b1be653972 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal/cargar_personal.twig", 1);
        $this->blocks = array(
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
    public function block_appBody($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"row\">
    <div class=\"col-md-12\">
    <section class=\"content-header\">
        <h1>
          Personal
            <small>Carga de personal</small>
        </h1>
        <ol class=\"breadcrumb\">
            <li>
                <a href=\"#\">
                    <i class=\"fa fa-home\"></i>
                    Home</a>
            </li>
        </ol>
    </section>
  </div>
</div>
<div class=\"row\">
  <div class=\"box-body\">
    <div class=\"col-md-12\">
      <br>
      <div class=\"col-md-4\">
        <label for=\"cmbareas\">Seleccione el Area a la que desea cargar personal</label>
        <select class=\"form-control\" name=\"cmbareas\" id=\"cmbareas\">
        <option value=\"0\">--</option>
        ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_area"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            if ((false != ($context["db_area"] ?? null))) {
                // line 29
                echo "          <option value=\"";
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
        // line 31
        echo "        </select>
        <br>
      </div>
      <div class=\"col-md-9\">
      </div>
      <div class=\"col-md-6\">
        <input class='filestyle' data-buttonText=\"Logo\" type=\"file\" name=\"imagefile\" id=\"imagefile\" onchange=\"document.getElementById('archivo').value=document.getElementById('imagefile').value\" tabindex=\"-1\" style=\"position:absolute; clip: rect(0px 0px 0px 0px);\" accept=\"file_extension|image/*|media_type\">
        <div class=\"bootstrap-filestyle input-group\">
        <input type=\"text\" class=\"form-control\" id=\"archivo\" placeholder=\"\" disabled=\"\">
        <span class=\"group-span-filestyle input-group-btn\" tabindex=\"0\">
        <label for=\"imagefile\" class=\"btn btn-default \">
        <span class=\"icon-span-filestyle glyphicon glyphicon-share\"></span>
        <span class=\"buttonText\">Buscar Archivo</span>
        </label>
        </span>
        </div>
        <div id=\"div_cargando\">
          <a class=\"btn btn-success btn-social\" title=\"Exportar a Excel\" data-toggle=\"tooltip\" onclick=\"subirarchivoexcel()\">
          <i class=\"fa fa-arrow-up\"></i> Cargar Personal
          </a>
          </div>
      </div>
    </div>
  </div>
</div>

";
    }

    // line 58
    public function block_appScript($context, array $blocks = array())
    {
        // line 59
        echo "  <script src=\"views/app/js/personal/personal.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "personal/cargar_personal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 59,  106 => 58,  76 => 31,  64 => 29,  59 => 28,  32 => 3,  29 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appBody %}
<div class=\"row\">
    <div class=\"col-md-12\">
    <section class=\"content-header\">
        <h1>
          Personal
            <small>Carga de personal</small>
        </h1>
        <ol class=\"breadcrumb\">
            <li>
                <a href=\"#\">
                    <i class=\"fa fa-home\"></i>
                    Home</a>
            </li>
        </ol>
    </section>
  </div>
</div>
<div class=\"row\">
  <div class=\"box-body\">
    <div class=\"col-md-12\">
      <br>
      <div class=\"col-md-4\">
        <label for=\"cmbareas\">Seleccione el Area a la que desea cargar personal</label>
        <select class=\"form-control\" name=\"cmbareas\" id=\"cmbareas\">
        <option value=\"0\">--</option>
        {% for a in db_area if  false != db_area %}
          <option value=\"{{a.cod_area}}\">{{a.descripcion}}</option>
        {%  endfor  %}
        </select>
        <br>
      </div>
      <div class=\"col-md-9\">
      </div>
      <div class=\"col-md-6\">
        <input class='filestyle' data-buttonText=\"Logo\" type=\"file\" name=\"imagefile\" id=\"imagefile\" onchange=\"document.getElementById('archivo').value=document.getElementById('imagefile').value\" tabindex=\"-1\" style=\"position:absolute; clip: rect(0px 0px 0px 0px);\" accept=\"file_extension|image/*|media_type\">
        <div class=\"bootstrap-filestyle input-group\">
        <input type=\"text\" class=\"form-control\" id=\"archivo\" placeholder=\"\" disabled=\"\">
        <span class=\"group-span-filestyle input-group-btn\" tabindex=\"0\">
        <label for=\"imagefile\" class=\"btn btn-default \">
        <span class=\"icon-span-filestyle glyphicon glyphicon-share\"></span>
        <span class=\"buttonText\">Buscar Archivo</span>
        </label>
        </span>
        </div>
        <div id=\"div_cargando\">
          <a class=\"btn btn-success btn-social\" title=\"Exportar a Excel\" data-toggle=\"tooltip\" onclick=\"subirarchivoexcel()\">
          <i class=\"fa fa-arrow-up\"></i> Cargar Personal
          </a>
          </div>
      </div>
    </div>
  </div>
</div>

{% endblock %}
{% block appScript %}
  <script src=\"views/app/js/personal/personal.js\"></script>
{% endblock %}
", "personal/cargar_personal.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\personal\\cargar_personal.twig");
    }
}
