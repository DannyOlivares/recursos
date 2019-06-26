<?php

/* personal_sistema/ingresar_personal_sistema.twig */
class __TwigTemplate_6607f4e5b2ca69faa9fea01ed73f43e90b92be2e8db9ed3e223f864bbf6857d9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal_sistema/ingresar_personal_sistema.twig", 1);
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
        <i class=\"fa fa-user\"></i> REGISTRO DE USUARIOS
      </h4>
      <ol class=\"breadcrumb\">
        <li><a href=\"portal\"><i class=\"fa fa-home\"></i> Home </a></li>
        <li><a href=\"usuarios/listar_personal_sistema\"> Usuarios </a></li>
        <li class=\"active\"> Ingreso </li>
      </ol>
  </section>

  <section class=\"content\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"box box-primary\">
          <form id=\"formingreso\" name=\"formingreso\">
            <div class=\"box-body col-sm-2\"></div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <input class=\"form-control\" name=\"txtnombre\" id=\"txtnombre\" type=\"text\"  placeholder=\"Nombre Completo\" required/>
                <input class=\"form-control\" name=\"txtemail\"  id=\"txtemail\"  type=\"email\"    placeholder=\"E-Mail\" required/>
                <input class=\"form-control\" name=\"txtcargo\"  id=\"txtcargo\"  type=\"text\"    placeholder=\"Cargo\" value='SUPERVISOR / JEFE' required/>
                <input class=\"form-control\" name=\"txtfono\"   id=\"txtfono\"   type=\"text\"    placeholder=\"Fono\" value='+56' required/>
              </div>
              <div class=\"form-group\">
                <input class=\"form-control\" name=\"txtpass\" id=\"txtpass\" type=\"password\" placeholder=\"Password\" value='1' required/>
                <input class=\"form-control\" name=\"txtpassrepeat\" id=\"txtpassrepeat\" type=\"password\" placeholder=\"Repita Password\" value='1' required/>
              </div>
              <div class=\"form-group\">Perfil Asignado
                <select name='cmdperfil' id='cmdperfil' class='form-control'>
                <option selected='selected'>--</option>
                ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_perfiles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            if ((false != ($context["db_perfiles"] ?? null))) {
                // line 35
                echo "                <option value='";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()), "html", null, true);
                echo "'>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre", array()), "html", null, true);
                echo "</option>
                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "                </select>
              </div>
              <div class=\"form-group\">
                <button type=\"button\" class=\"btn btn-default col-md-3\" id=\"btnguardar\" name=\"btnguardar\" onclick=\"guardar_usuario()\">Guardar Usuario</button>
              </div>
            </div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <label class=\"col-sm-4  control-label\">Rut Asocia Trabajador</label>
                <div class=\"col-sm-5\">
                  <input class=\"form-control\" name=\"rut_usuario\" id=\"rut_usuario\" type=\"text\" placeholder=\"xxxxxxxx-x\"/>
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

    // line 57
    public function block_appScript($context, array $blocks = array())
    {
        // line 58
        echo "    <script src=\"views/app/js/personal/personal.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "personal_sistema/ingresar_personal_sistema.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 58,  105 => 57,  82 => 37,  70 => 35,  65 => 34,  32 => 3,  29 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appBody %}
  <section class=\"content-header\">
      <h4>
        <i class=\"fa fa-user\"></i> REGISTRO DE USUARIOS
      </h4>
      <ol class=\"breadcrumb\">
        <li><a href=\"portal\"><i class=\"fa fa-home\"></i> Home </a></li>
        <li><a href=\"usuarios/listar_personal_sistema\"> Usuarios </a></li>
        <li class=\"active\"> Ingreso </li>
      </ol>
  </section>

  <section class=\"content\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"box box-primary\">
          <form id=\"formingreso\" name=\"formingreso\">
            <div class=\"box-body col-sm-2\"></div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <input class=\"form-control\" name=\"txtnombre\" id=\"txtnombre\" type=\"text\"  placeholder=\"Nombre Completo\" required/>
                <input class=\"form-control\" name=\"txtemail\"  id=\"txtemail\"  type=\"email\"    placeholder=\"E-Mail\" required/>
                <input class=\"form-control\" name=\"txtcargo\"  id=\"txtcargo\"  type=\"text\"    placeholder=\"Cargo\" value='SUPERVISOR / JEFE' required/>
                <input class=\"form-control\" name=\"txtfono\"   id=\"txtfono\"   type=\"text\"    placeholder=\"Fono\" value='+56' required/>
              </div>
              <div class=\"form-group\">
                <input class=\"form-control\" name=\"txtpass\" id=\"txtpass\" type=\"password\" placeholder=\"Password\" value='1' required/>
                <input class=\"form-control\" name=\"txtpassrepeat\" id=\"txtpassrepeat\" type=\"password\" placeholder=\"Repita Password\" value='1' required/>
              </div>
              <div class=\"form-group\">Perfil Asignado
                <select name='cmdperfil' id='cmdperfil' class='form-control'>
                <option selected='selected'>--</option>
                {% for p in db_perfiles if false != db_perfiles %}
                <option value='{{ p.nombre }}'>{{ p.nombre }}</option>
                {% endfor %}
                </select>
              </div>
              <div class=\"form-group\">
                <button type=\"button\" class=\"btn btn-default col-md-3\" id=\"btnguardar\" name=\"btnguardar\" onclick=\"guardar_usuario()\">Guardar Usuario</button>
              </div>
            </div>
            <div class=\"box-body col-sm-4\">
              <div class=\"form-group\">
                <label class=\"col-sm-4  control-label\">Rut Asocia Trabajador</label>
                <div class=\"col-sm-5\">
                  <input class=\"form-control\" name=\"rut_usuario\" id=\"rut_usuario\" type=\"text\" placeholder=\"xxxxxxxx-x\"/>
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
", "personal_sistema/ingresar_personal_sistema.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\personal_sistema\\ingresar_personal_sistema.twig");
    }
}
