<?php

/* andes/nueva_orden.twig */
class __TwigTemplate_dac52f78b865280a975039e45faf3b763f8ec6e1032d571b98a1a80e45cf1a7a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "andes/nueva_orden.twig", 1);
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
        // line 3
        echo "  <style media=\"screen\">
    .at{
      display: none;
    }
  </style>
";
    }

    // line 9
    public function block_appBody($context, array $blocks = array())
    {
        // line 10
        echo "<div class=\"row\">
    <div class=\"col-md-12\">
        <section class=\"content-header\">
            <h1>
                Ordenes Andes
                <small>Nueva Orden</small>

            </h1>
        </section>
    </div>
</div>
<section class=\"content\">
    <form id=\"formandes\" name=\"formandes\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                    <h3 class=\"box-title\">Datos Cliente</h3>
                    </div>
                  <div class=\"box-body\">
                    <div class=\"col-md-4\">
                      <label>Rut:</label><input type=\"text\" name=\"txtrut\" id=\"txtrut\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Nombre Cliente:</label><input type=\"text\" name=\"txtcliente\" id=\"txtcliente\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Direccion:</label><input type=\"text\" name=\"txtdireccion\" id=\"txtdireccion\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                        <label>Telefono</label><input type=\"text\" name=\"txttelefono\" id=\"txttelefono\" class=\"form-control\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_fen"] ?? null), "numerotango", array()), "html", null, true);
        echo "\">
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class=\"row\">
            <div class=\"col-md-12\">
              <div class=\"box\">
                  <div class=\"box-header\">
                  <h3 class=\"box-title\">Datos Orden</h3>
                  </div>
                <div class=\"box-body\">
                  <div class=\"col-md-4\">
                    <label>Numero Actividad</label><input type=\"text\" name=\"txtnum\" id=\"txtnum\" class=\"form-control\">
                  </div>
                  <div class=\"col-md-4\">
                    <label>Id Orden:</label><input type=\"text\" name=\"txtid\" id=\"txtid\" class=\"form-control\">
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbzona\">Zona</label>
                      <select class=\"form-control\" id=\"cmbzona\" name=\"cmbzona\" onchange=\"selectzona()\">
                      <option value=\"0\">--</option>
                        ";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_zonas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["z"]) {
            // line 64
            echo "                          <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['z'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "                      </select>
                   </div>
                  <div class=\"col-md-4\" id=\"divcomuna\" name=\"divcomuna\">
                      <label for=\"cmbcomuna\">Comuna</label>
                      <select class=\"form-control\" id=\"cmbcomuna\" name=\"cmbcomuna\">
                        <option value=\"0\">--</option>
                      </select>
                   </div>
                  <div class=\"col-md-4\">
                       <label for=\"cmbactividad\">Tipo Actividad</label>
                       <select class=\"form-control\" id=\"cmbactividad\" name=\"cmbactividad\">
                         <option value=\"0\">--</option>
                         <option value=\"1\">Alta</option>
                         <option value=\"2\">Reparacion</option>
                         <option value=\"2\">Modificacion</option>
                       </select>
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbfranja\">Franja</label>
                      <select class=\"form-control\" id=\"cmbfranja\" name=\"cmbfranja\">
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"3\">19-21</option>
                      </select>
                   </div>
                   <div class=\"col-md-4\">
                     <label>Fecha:</label><input type=\"date\" name=\"txtfecha\" id=\"txtfecha\" class=\"form-control\" value=\"";
        // line 94
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "\">
                   </div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"box\">
                <div class=\"box-header\">
                <h3 class=\"box-title\">Estado de la orden</h3>
                </div>
              <div class=\"box-body\">
                <div class=\"col-md-4\">
                    <label for=\"cmbestado\">Estado</label>
                    <select class=\"form-control\" id=\"cmbestado\" name=\"cmbestado\">
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"3\">Cancelada</option>
                    </select>
                 </div>
                <div class=\"col-md-4\">
                  <label>Observacion:</label><input type=\"text\" name=\"txtobservacion\" id=\"txtobservacion\" class=\"form-control\">
                </div>
                <div class=\"col-md-4\" id=\"divtecnico\" name=\"divtecnico\">
                    <label for=\"cmbtecnico\">Tecnico</label>
                    <select class=\"form-control\" id=\"cmbtecnico\" name=\"cmbtecnico\">
                        <option value=\"0\">--</option>
                        ";
        // line 124
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_tecnicos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 125
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "codigo", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "codigo", array()), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 127
        echo "                    </select>
                 </div>
                <div class=\"col-md-4\" id=\"diveps\" name=\"diveps\">
                    <label>EPS</label><input type=\"text\" name=\"txteps\" id=\"txteps\" class=\"form-control\">
                </div>
                  <div class=\"col-md-12\">
                  <br>
                  <br>
                  <div class=\"col-md-4\">
                  </div>
                <div class=\"\">
                  <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnguardar\" name=\"btnguardar\">Guardar Orden</button>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
  </form>
</section>

";
    }

    // line 150
    public function block_appScript($context, array $blocks = array())
    {
        // line 151
        echo "
  <script src=\"views/app/js/andes/andes.js\"></script>


";
    }

    public function getTemplateName()
    {
        return "andes/nueva_orden.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 151,  222 => 150,  196 => 127,  185 => 125,  181 => 124,  148 => 94,  118 => 66,  107 => 64,  103 => 63,  77 => 40,  45 => 10,  42 => 9,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
  <style media=\"screen\">
    .at{
      display: none;
    }
  </style>
{% endblock %}
{% block appBody %}
<div class=\"row\">
    <div class=\"col-md-12\">
        <section class=\"content-header\">
            <h1>
                Ordenes Andes
                <small>Nueva Orden</small>

            </h1>
        </section>
    </div>
</div>
<section class=\"content\">
    <form id=\"formandes\" name=\"formandes\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                    <h3 class=\"box-title\">Datos Cliente</h3>
                    </div>
                  <div class=\"box-body\">
                    <div class=\"col-md-4\">
                      <label>Rut:</label><input type=\"text\" name=\"txtrut\" id=\"txtrut\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Nombre Cliente:</label><input type=\"text\" name=\"txtcliente\" id=\"txtcliente\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Direccion:</label><input type=\"text\" name=\"txtdireccion\" id=\"txtdireccion\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                        <label>Telefono</label><input type=\"text\" name=\"txttelefono\" id=\"txttelefono\" class=\"form-control\" value=\"{{ db_fen.numerotango }}\">
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class=\"row\">
            <div class=\"col-md-12\">
              <div class=\"box\">
                  <div class=\"box-header\">
                  <h3 class=\"box-title\">Datos Orden</h3>
                  </div>
                <div class=\"box-body\">
                  <div class=\"col-md-4\">
                    <label>Numero Actividad</label><input type=\"text\" name=\"txtnum\" id=\"txtnum\" class=\"form-control\">
                  </div>
                  <div class=\"col-md-4\">
                    <label>Id Orden:</label><input type=\"text\" name=\"txtid\" id=\"txtid\" class=\"form-control\">
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbzona\">Zona</label>
                      <select class=\"form-control\" id=\"cmbzona\" name=\"cmbzona\" onchange=\"selectzona()\">
                      <option value=\"0\">--</option>
                        {% for z in db_zonas %}
                          <option value=\"{{ z.zona }}\">{{ z.zona }}</option>
                        {% endfor %}
                      </select>
                   </div>
                  <div class=\"col-md-4\" id=\"divcomuna\" name=\"divcomuna\">
                      <label for=\"cmbcomuna\">Comuna</label>
                      <select class=\"form-control\" id=\"cmbcomuna\" name=\"cmbcomuna\">
                        <option value=\"0\">--</option>
                      </select>
                   </div>
                  <div class=\"col-md-4\">
                       <label for=\"cmbactividad\">Tipo Actividad</label>
                       <select class=\"form-control\" id=\"cmbactividad\" name=\"cmbactividad\">
                         <option value=\"0\">--</option>
                         <option value=\"1\">Alta</option>
                         <option value=\"2\">Reparacion</option>
                         <option value=\"2\">Modificacion</option>
                       </select>
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbfranja\">Franja</label>
                      <select class=\"form-control\" id=\"cmbfranja\" name=\"cmbfranja\">
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"3\">19-21</option>
                      </select>
                   </div>
                   <div class=\"col-md-4\">
                     <label>Fecha:</label><input type=\"date\" name=\"txtfecha\" id=\"txtfecha\" class=\"form-control\" value=\"{{ \"now\"|date(\"Y-m-d\") }}\">
                   </div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"box\">
                <div class=\"box-header\">
                <h3 class=\"box-title\">Estado de la orden</h3>
                </div>
              <div class=\"box-body\">
                <div class=\"col-md-4\">
                    <label for=\"cmbestado\">Estado</label>
                    <select class=\"form-control\" id=\"cmbestado\" name=\"cmbestado\">
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"3\">Cancelada</option>
                    </select>
                 </div>
                <div class=\"col-md-4\">
                  <label>Observacion:</label><input type=\"text\" name=\"txtobservacion\" id=\"txtobservacion\" class=\"form-control\">
                </div>
                <div class=\"col-md-4\" id=\"divtecnico\" name=\"divtecnico\">
                    <label for=\"cmbtecnico\">Tecnico</label>
                    <select class=\"form-control\" id=\"cmbtecnico\" name=\"cmbtecnico\">
                        <option value=\"0\">--</option>
                        {% for t in db_tecnicos %}
                        <option value=\"{{ t.codigo }}\">{{ t.codigo }}</option>
                        {% endfor %}
                    </select>
                 </div>
                <div class=\"col-md-4\" id=\"diveps\" name=\"diveps\">
                    <label>EPS</label><input type=\"text\" name=\"txteps\" id=\"txteps\" class=\"form-control\">
                </div>
                  <div class=\"col-md-12\">
                  <br>
                  <br>
                  <div class=\"col-md-4\">
                  </div>
                <div class=\"\">
                  <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnguardar\" name=\"btnguardar\">Guardar Orden</button>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
  </form>
</section>

{% endblock %}
{% block appScript %}

  <script src=\"views/app/js/andes/andes.js\"></script>


{% endblock %}
", "andes/nueva_orden.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\andes\\nueva_orden.twig");
    }
}
