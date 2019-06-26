<?php

/* andes/nuevo_tecnico.twig */
class __TwigTemplate_3efc377bd8982da181177558296606b091571ceb742c622422ecafcdd93cd459 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "andes/nuevo_tecnico.twig", 1);
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

    // line 4
    public function block_appBody($context, array $blocks = array())
    {
        // line 5
        echo "    <section class=\"content-header\">
        <h1>
            Andes
            <small>Agregar Tecnico</small>
        </h1>
        <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-home\"></i> Home</a></li>
        <li><a href=\"despacho/listar_tecnicos\">Listado de Tecnicos</a></li>
        <li class=\"active\">Agregar Tecnico</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box box-primary\">
            <form id=\"formnuevotecnico\">
              <div class=\"box\">
                  <div class=\"box-header\">
                  <h3 class=\"box-title\">Datos Tecnico</h3>
                  </div>
                  <div class=\"box-body\">
                  <div class=\"col-md-12\">
                    <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label>Rut:</label><input type=\"text\" name=\"txtrut\" id=\"txtrut\" class=\"form-control\">
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label>Nombre Tecnico:</label><input type=\"text\" name=\"txtcliente\" id=\"txtcliente\" class=\"form-control\">
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label>Telefono:</label><input type=\"text\" name=\"txtdireccion\" id=\"txtdireccion\" class=\"form-control\">
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label for=\"cmbzona\">Zona</label>
                    <select class=\"form-control\" id=\"cmbzona\" name=\"cmbzona\">
                    <option value=\"0\">--</option>
                      ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_zonas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["z"]) {
            // line 56
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()), "html", null, true);
            echo "</option>
                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['z'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "                    </select>
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label for=\"cmbeps\">EPS</label>
                    <select class=\"form-control\" id=\"cmbeps\" name=\"cmbeps\">
                    <option value=\"0\">--</option>
                      ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_eps"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
            // line 69
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["e"], "codigo_eps", array()) == false)) {
                // line 70
                echo "
                      ";
            } else {
                // line 72
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["e"], "codigo_eps", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["e"], "codigo_eps", array()), "html", null, true);
                echo "</option>
                      ";
            }
            // line 74
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "                    </select>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                      <br>
                      <br>
                      <br>
                  <div class=\"col-md-5\"></div>
                    <div >
                      <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnguardartecnico\" name=\"btnguardartecnico\">Guardar Tecnico</button>
                    </div>
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

    // line 96
    public function block_appScript($context, array $blocks = array())
    {
        // line 97
        echo "    <script src=\"views/app/js/andes/tecnico.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "andes/nuevo_tecnico.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 97,  166 => 96,  142 => 75,  136 => 74,  128 => 72,  124 => 70,  121 => 69,  117 => 68,  105 => 58,  94 => 56,  90 => 55,  38 => 5,  35 => 4,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
{% endblock %}
{% block appBody %}
    <section class=\"content-header\">
        <h1>
            Andes
            <small>Agregar Tecnico</small>
        </h1>
        <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-home\"></i> Home</a></li>
        <li><a href=\"despacho/listar_tecnicos\">Listado de Tecnicos</a></li>
        <li class=\"active\">Agregar Tecnico</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box box-primary\">
            <form id=\"formnuevotecnico\">
              <div class=\"box\">
                  <div class=\"box-header\">
                  <h3 class=\"box-title\">Datos Tecnico</h3>
                  </div>
                  <div class=\"box-body\">
                  <div class=\"col-md-12\">
                    <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label>Rut:</label><input type=\"text\" name=\"txtrut\" id=\"txtrut\" class=\"form-control\">
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label>Nombre Tecnico:</label><input type=\"text\" name=\"txtcliente\" id=\"txtcliente\" class=\"form-control\">
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label>Telefono:</label><input type=\"text\" name=\"txtdireccion\" id=\"txtdireccion\" class=\"form-control\">
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label for=\"cmbzona\">Zona</label>
                    <select class=\"form-control\" id=\"cmbzona\" name=\"cmbzona\">
                    <option value=\"0\">--</option>
                      {% for z in db_zonas %}
                        <option value=\"{{ z.zona }}\">{{ z.zona }}</option>
                      {% endfor %}
                    </select>
                    <br>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                  <div class=\"col-md-4\"></div>
                  <div class=\"col-md-4\">
                    <label for=\"cmbeps\">EPS</label>
                    <select class=\"form-control\" id=\"cmbeps\" name=\"cmbeps\">
                    <option value=\"0\">--</option>
                      {% for e in db_eps %}
                      {% if e.codigo_eps == false %}

                      {% else %}
                        <option value=\"{{ e.codigo_eps }}\">{{ e.codigo_eps }}</option>
                      {% endif %}
                      {% endfor %}
                    </select>
                  </div>
                  </div>
                  <div class=\"col-md-12\">
                      <br>
                      <br>
                      <br>
                  <div class=\"col-md-5\"></div>
                    <div >
                      <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnguardartecnico\" name=\"btnguardartecnico\">Guardar Tecnico</button>
                    </div>
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
    <script src=\"views/app/js/andes/tecnico.js\"></script>
{% endblock %}
", "andes/nuevo_tecnico.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\andes\\nuevo_tecnico.twig");
    }
}
