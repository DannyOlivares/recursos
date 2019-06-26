<?php

/* personal_sistema/editar_personal_sistema.twig */
class __TwigTemplate_47b498ae173106ce9d1231d70e17479de0cb09c5fee111f7dc03e2e06e511978 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal_sistema/editar_personal_sistema.twig", 1);
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
        echo "  <section class=\"content-header\">
      <h4>
        <i class=\"fa fa-user\"></i> EDITAR REGISTRO DE USUARIOS
      </h4>
      <ol class=\"breadcrumb\">
        <li><a href=\"portal\"><i class=\"fa fa-home\"></i> Home </a></li>
        <li><a href=\"usuarios/listar_personal_sistema\"> Usuarios </a></li>
        <li class=\"active\"> Editar </li>
      </ol>
  </section>

  <section class=\"content\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"box box-primary\">
          <form id=\"formeditar\" name=\"formeditar\">
            <div class=\"box-body col-sm-2\"></div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <input type=\"hidden\" name=\"editid_user\" id=\"editid_user\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "id_user", array()), "html", null, true);
        echo "\">
                <input class=\"form-control\" name=\"txtnombre\" id=\"txtnombre\" type=\"text\"  value='";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "name", array()), "html", null, true);
        echo "' required/>
                <input class=\"form-control\" name=\"txtemail\"  id=\"txtemail\"  type=\"email\"    value='";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "email", array()), "html", null, true);
        echo "' readonly='readonly'/>
                <input class=\"form-control\" name=\"txtcargo\"  id=\"txtcargo\"  type=\"text\"    value='";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "cargo", array()), "html", null, true);
        echo "' required/>
                <input class=\"form-control\" name=\"txtfono\"   id=\"txtfono\"   type=\"text\"    value='";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "fono", array()), "html", null, true);
        echo "'  required/>
              </div>
                <div class=\"form-group\">Perfil Asignado
                  <select name='cmbperfil' id='cmbperfil' class='form-control'>
                    <option>--</option>
                    ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_perfiles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            if ((false != ($context["db_perfiles"] ?? null))) {
                // line 32
                echo "                      ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()) == twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "perfil", array()))) {
                    // line 33
                    echo "                        <option value='";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()), "html", null, true);
                    echo "' selected='selected'>";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()), "html", null, true);
                    echo "</option>
                      ";
                } else {
                    // line 35
                    echo "                        <option value='";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()), "html", null, true);
                    echo "'>";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()), "html", null, true);
                    echo "</option>
                      ";
                }
                // line 37
                echo "                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "                  </select>
                </div>
              <div class=\"form-group\">
                <button type=\"button\" class=\"btn btn-default col-md-3\" id=\"btnmodificar\" name=\"btnmodificar\" onclick=\"modificar_usuario()\">Modificar Usuario</button>
              </div>
            </div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <label class=\"col-sm-4  control-label\">Rut Asocia Trabajador</label>
                <div class=\"col-sm-5\">
                  <input class=\"form-control\" name=\"rut_usuario\" id=\"rut_usuario\" type=\"text\" value='";
        // line 48
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_usuario"] ?? null), "rut_personal", array()), "html", null, true);
        echo "'/>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
";
    }

    // line 58
    public function block_appScript($context, array $blocks = array())
    {
        // line 59
        echo "    <script src=\"views/app/js/personal/personal.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "personal_sistema/editar_personal_sistema.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 59,  134 => 58,  120 => 48,  108 => 38,  101 => 37,  93 => 35,  85 => 33,  82 => 32,  77 => 31,  69 => 26,  65 => 25,  61 => 24,  57 => 23,  53 => 22,  32 => 3,  29 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appBody %}
  <section class=\"content-header\">
      <h4>
        <i class=\"fa fa-user\"></i> EDITAR REGISTRO DE USUARIOS
      </h4>
      <ol class=\"breadcrumb\">
        <li><a href=\"portal\"><i class=\"fa fa-home\"></i> Home </a></li>
        <li><a href=\"usuarios/listar_personal_sistema\"> Usuarios </a></li>
        <li class=\"active\"> Editar </li>
      </ol>
  </section>

  <section class=\"content\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"box box-primary\">
          <form id=\"formeditar\" name=\"formeditar\">
            <div class=\"box-body col-sm-2\"></div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <input type=\"hidden\" name=\"editid_user\" id=\"editid_user\" value=\"{{db_usuario.id_user}}\">
                <input class=\"form-control\" name=\"txtnombre\" id=\"txtnombre\" type=\"text\"  value='{{db_usuario.name}}' required/>
                <input class=\"form-control\" name=\"txtemail\"  id=\"txtemail\"  type=\"email\"    value='{{db_usuario.email}}' readonly='readonly'/>
                <input class=\"form-control\" name=\"txtcargo\"  id=\"txtcargo\"  type=\"text\"    value='{{db_usuario.cargo}}' required/>
                <input class=\"form-control\" name=\"txtfono\"   id=\"txtfono\"   type=\"text\"    value='{{db_usuario.fono}}'  required/>
              </div>
                <div class=\"form-group\">Perfil Asignado
                  <select name='cmbperfil' id='cmbperfil' class='form-control'>
                    <option>--</option>
                    {% for p in db_perfiles if false != db_perfiles %}
                      {% if p.nombre == db_usuario.perfil  %}
                        <option value='{{ p.nombre }}' selected='selected'>{{ p.nombre }}</option>
                      {% else %}
                        <option value='{{ p.nombre }}'>{{ p.nombre }}</option>
                      {% endif %}
                    {% endfor %}
                  </select>
                </div>
              <div class=\"form-group\">
                <button type=\"button\" class=\"btn btn-default col-md-3\" id=\"btnmodificar\" name=\"btnmodificar\" onclick=\"modificar_usuario()\">Modificar Usuario</button>
              </div>
            </div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <label class=\"col-sm-4  control-label\">Rut Asocia Trabajador</label>
                <div class=\"col-sm-5\">
                  <input class=\"form-control\" name=\"rut_usuario\" id=\"rut_usuario\" type=\"text\" value='{{db_usuario.rut_personal}}'/>
                </div>
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
", "personal_sistema/editar_personal_sistema.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\personal_sistema\\editar_personal_sistema.twig");
    }
}
