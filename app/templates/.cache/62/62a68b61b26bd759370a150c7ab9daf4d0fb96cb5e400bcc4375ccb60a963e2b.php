<?php

/* andes/editar_orden.twig */
class __TwigTemplate_157d1afb7eb8838ddb02277a2417a6c47b0a7e6eaf7c07f169dbcc320fbc37d3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "andes/editar_orden.twig", 1);
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
    <form id=\"formeditarandes\" name=\"formeditarandes\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                    <h3 class=\"box-title\">Datos Cliente</h3>
                    </div>
                  <div class=\"box-body\">
                    <div class=\"col-md-4\">
                      <label>Rut:</label><input type=\"text\" name=\"txteditarrut\" id=\"txteditarrut\" class=\"form-control\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "rut_cliente", array()), "html", null, true);
        echo "\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Nombre Cliente:</label><input type=\"text\" name=\"txteditarcliente\" id=\"txteditarcliente\" class=\"form-control\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "nombre_cliente", array()), "html", null, true);
        echo "\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Direccion:</label><input type=\"text\" name=\"txteditardireccion\" id=\"txteditardireccion\" class=\"form-control\" value=\"";
        // line 37
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "direccion", array()), "html", null, true);
        echo "\">
                    </div>
                    <div class=\"col-md-4\">
                        <label>Telefono</label><input type=\"text\" name=\"txteditartelefono\" id=\"txteditartelefono\" class=\"form-control\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "telefono", array()), "html", null, true);
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
                    <label>Numero Actividad</label><input type=\"text\" name=\"txteditarnum\" id=\"txteditarnum\" class=\"form-control\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "numero_orden", array()), "html", null, true);
        echo "\">
                  </div>
                  <div class=\"col-md-4\">
                    <label>Id Orden:</label><input type=\"text\" name=\"txteditarid\" id=\"txteditarid\" class=\"form-control\" value=\"";
        // line 57
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "id_actividad", array()), "html", null, true);
        echo "\">
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbeditarzona\">Zona</label>
                      <select class=\"form-control\" id=\"cmbeditarzona\" name=\"cmbeditarzona\" onchange=\"seleceditartzona()\">
                      <option value=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "zona", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "zona", array()), "html", null, true);
        echo "</option>
                        ";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_zonas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["z"]) {
            // line 64
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "zona", array()) == twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()))) {
                // line 65
                echo "                        ";
            } else {
                // line 66
                echo "                          <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["z"], "zona", array()), "html", null, true);
                echo "</option>
                          ";
            }
            // line 68
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['z'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "                      </select>
                   </div>
                  <div class=\"col-md-4\" id=\"diveditarcomuna\" name=\"diveditarcomuna\">
                      <label for=\"cmbeditarcomuna\">Comuna</label>
                      <select class=\"form-control\" id=\"cmbeditarcomuna\" name=\"cmbeditarcomuna\">
                        <option value=\"";
        // line 74
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "id_comuna", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "descripcion", array()), "html", null, true);
        echo "</option>
                          ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_zonaeditada"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
            // line 76
            echo "                          ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["e"], "descripcion", array()) == twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "descripcion", array()))) {
                // line 77
                echo "                          ";
            } else {
                // line 78
                echo "                          <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["e"], "id_comuna", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["e"], "descripcion", array()), "html", null, true);
                echo "</option>}
                          ";
            }
            // line 80
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "                      </select>
                   </div>
                  <div class=\"col-md-4\">
                       <label for=\"cmbaeditarctividad\">Tipo Actividad</label>
                       <select class=\"form-control\" id=\"cmbaeditarctividad\" name=\"cmbaeditarctividad\">
                         ";
        // line 86
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "tipo_actividad", array()) == "0")) {
            // line 87
            echo "                         <option value=\"0\">--</option>
                         <option value=\"1\">Alta</option>
                         <option value=\"2\">Reparacion</option>
                         <option value=\"3\">Modificacion</option>
                         ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 91
($context["db_ordenandes"] ?? null), "tipo_actividad", array()) == "1")) {
            // line 92
            echo "                          <option value=\"1\">Alta</option>
                          <option value=\"0\">--</option>
                          <option value=\"2\">Reparacion</option>
                          <option value=\"3\">Modificacion</option>
                         ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 96
($context["db_ordenandes"] ?? null), "tipo_actividad", array()) == "2")) {
            // line 97
            echo "                          <option value=\"2\">Reparacion</option>
                          <option value=\"0\">--</option>
                          <option value=\"1\">Alta</option>
                          <option value=\"3\">Modificacion</option>
                           ";
        } else {
            // line 102
            echo "                         <option value=\"3\">Modificacion</option>
                         <option value=\"0\">--</option>
                         <option value=\"1\">Alta</option>
                         <option value=\"2\">Reparacion</option>
                         ";
        }
        // line 107
        echo "                       </select>
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbeditarfranja\">Franja</label>
                      <select class=\"form-control\" id=\"cmbeditarfranja\" name=\"cmbeditarfranja\">
                        ";
        // line 112
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "franja", array()) == "0")) {
            // line 113
            echo "                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 118
($context["db_ordenandes"] ?? null), "franja", array()) == "1")) {
            // line 119
            echo "                        <option value=\"1\">09-13</option>
                        <option value=\"0\">--</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 124
($context["db_ordenandes"] ?? null), "franja", array()) == "2")) {
            // line 125
            echo "                        <option value=\"2\">13-16</option>
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 130
($context["db_ordenandes"] ?? null), "franja", array()) == "3")) {
            // line 131
            echo "                        <option value=\"3\">16-19</option>
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"4\">19-21</option>
                        ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 136
($context["db_ordenandes"] ?? null), "franja", array()) == "4")) {
            // line 137
            echo "                        <option value=\"4\">19-21</option>
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        ";
        } else {
            // line 143
            echo "                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        ";
        }
        // line 149
        echo "                      </select>
                   </div>
                   <div class=\"col-md-4\">
                     <label>Fecha:</label><input type=\"date\" name=\"txteditarfecha\" id=\"txteditarfecha\" class=\"form-control\" value=\"";
        // line 152
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "fecha", array()), "html", null, true);
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
                    <label for=\"cmbeditarestado\">Estado</label>
                    <select class=\"form-control\" id=\"cmbeditarestado\" name=\"cmbeditarestado\">
                      ";
        // line 168
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "estado", array()) == "0")) {
            // line 169
            echo "                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"4\">Cancelada</option>
                      ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 174
($context["db_ordenandes"] ?? null), "estado", array()) == "1")) {
            // line 175
            echo "                      <option value=\"1\">Iniciado</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"4\">Cancelada</option>
                      ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 180
($context["db_ordenandes"] ?? null), "estado", array()) == "2")) {
            // line 181
            echo "                      <option value=\"2\">Completado</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"4\">Cancelada</option>
                      ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 186
($context["db_ordenandes"] ?? null), "estado", array()) == "3")) {
            // line 187
            echo "                      <option value=\"3\">Derivado</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Cancelada</option>
                      ";
        } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),         // line 192
($context["db_ordenandes"] ?? null), "estado", array()) == "4")) {
            // line 193
            echo "                      <option value=\"4\">Cancelada</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      ";
        }
        // line 199
        echo "                    </select>
                 </div>
                <div class=\"col-md-4\">
                  <label>Observacion:</label><input type=\"text\" name=\"txteditarobservacion\" id=\"txteditarobservacion\" class=\"form-control\" value=\"";
        // line 202
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "observacion", array()), "html", null, true);
        echo "\">
                </div>
                <div class=\"col-md-4\" id=\"diveditartecnico\" name=\"diveditartecnico\">
                    <label>Tecnico</label>
                    <select class=\"form-control\" id=\"cmbeditartecnico\" name=\"cmbeditartecnico\" onchange=\"cargaeditareps\">
                        <option value=\"";
        // line 207
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "tecnico", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "tecnombre", array()), "html", null, true);
        echo "</option>
                        ";
        // line 208
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_tecnicos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 209
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "id_tecnicos", array()) == twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "tecnico", array()))) {
                // line 210
                echo "                        ";
            } else {
                // line 211
                echo "                          <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "id_tecnicos", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "nombre", array()), "html", null, true);
                echo "</option>
                        ";
            }
            // line 213
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 214
        echo "                    </select>
                 </div>
                <div class=\"col-md-4\" id=\"diveditareps\" name=\"diveditareps\">
                    <label>EPS</label><input type=\"text\" name=\"txteditareps\" id=\"txteditareps\" class=\"form-control\" value=\"";
        // line 217
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "eps", array()), "html", null, true);
        echo "\">
                </div>
                  <div class=\"col-md-12\">
                  <br>
                  <br>
                  <div class=\"col-md-4\">
                  </div>
                <div class=\"\">
                  <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnmodificar\" name=\"btnmodificar\">Modificar Orden</button>
                </div>
                <input type=\"hidden\" name=\"textid\" id=\"textid\" value=\"";
        // line 227
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_ordenandes"] ?? null), "id_orden", array()), "html", null, true);
        echo "\">
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

    // line 238
    public function block_appScript($context, array $blocks = array())
    {
        // line 239
        echo "
  <script src=\"views/app/js/andes/andes.js\"></script>


";
    }

    public function getTemplateName()
    {
        return "andes/editar_orden.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  433 => 239,  430 => 238,  415 => 227,  402 => 217,  397 => 214,  391 => 213,  383 => 211,  380 => 210,  377 => 209,  373 => 208,  367 => 207,  359 => 202,  354 => 199,  346 => 193,  344 => 192,  337 => 187,  335 => 186,  328 => 181,  326 => 180,  319 => 175,  317 => 174,  310 => 169,  308 => 168,  289 => 152,  284 => 149,  276 => 143,  268 => 137,  266 => 136,  259 => 131,  257 => 130,  250 => 125,  248 => 124,  241 => 119,  239 => 118,  232 => 113,  230 => 112,  223 => 107,  216 => 102,  209 => 97,  207 => 96,  201 => 92,  199 => 91,  193 => 87,  191 => 86,  184 => 81,  178 => 80,  170 => 78,  167 => 77,  164 => 76,  160 => 75,  154 => 74,  147 => 69,  141 => 68,  133 => 66,  130 => 65,  127 => 64,  123 => 63,  117 => 62,  109 => 57,  103 => 54,  86 => 40,  80 => 37,  74 => 34,  68 => 31,  45 => 10,  42 => 9,  33 => 3,  30 => 2,  11 => 1,);
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
    <form id=\"formeditarandes\" name=\"formeditarandes\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                    <h3 class=\"box-title\">Datos Cliente</h3>
                    </div>
                  <div class=\"box-body\">
                    <div class=\"col-md-4\">
                      <label>Rut:</label><input type=\"text\" name=\"txteditarrut\" id=\"txteditarrut\" class=\"form-control\" value=\"{{db_ordenandes.rut_cliente}}\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Nombre Cliente:</label><input type=\"text\" name=\"txteditarcliente\" id=\"txteditarcliente\" class=\"form-control\" value=\"{{db_ordenandes.nombre_cliente}}\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>Direccion:</label><input type=\"text\" name=\"txteditardireccion\" id=\"txteditardireccion\" class=\"form-control\" value=\"{{db_ordenandes.direccion}}\">
                    </div>
                    <div class=\"col-md-4\">
                        <label>Telefono</label><input type=\"text\" name=\"txteditartelefono\" id=\"txteditartelefono\" class=\"form-control\" value=\"{{db_ordenandes.telefono}}\">
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
                    <label>Numero Actividad</label><input type=\"text\" name=\"txteditarnum\" id=\"txteditarnum\" class=\"form-control\" value=\"{{db_ordenandes.numero_orden}}\">
                  </div>
                  <div class=\"col-md-4\">
                    <label>Id Orden:</label><input type=\"text\" name=\"txteditarid\" id=\"txteditarid\" class=\"form-control\" value=\"{{db_ordenandes.id_actividad}}\">
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbeditarzona\">Zona</label>
                      <select class=\"form-control\" id=\"cmbeditarzona\" name=\"cmbeditarzona\" onchange=\"seleceditartzona()\">
                      <option value=\"{{ db_ordenandes.zona }}\">{{ db_ordenandes.zona }}</option>
                        {% for z in db_zonas %}
                        {% if db_ordenandes.zona == z.zona %}
                        {% else %}
                          <option value=\"{{ z.zona }}\">{{ z.zona }}</option>
                          {% endif %}
                        {% endfor %}
                      </select>
                   </div>
                  <div class=\"col-md-4\" id=\"diveditarcomuna\" name=\"diveditarcomuna\">
                      <label for=\"cmbeditarcomuna\">Comuna</label>
                      <select class=\"form-control\" id=\"cmbeditarcomuna\" name=\"cmbeditarcomuna\">
                        <option value=\"{{ db_ordenandes.id_comuna }}\">{{ db_ordenandes.descripcion }}</option>
                          {% for e in db_zonaeditada %}
                          {% if e.descripcion == db_ordenandes.descripcion %}
                          {% else %}
                          <option value=\"{{ e.id_comuna }}\">{{ e.descripcion }}</option>}
                          {% endif %}
                        {% endfor %}
                      </select>
                   </div>
                  <div class=\"col-md-4\">
                       <label for=\"cmbaeditarctividad\">Tipo Actividad</label>
                       <select class=\"form-control\" id=\"cmbaeditarctividad\" name=\"cmbaeditarctividad\">
                         {% if db_ordenandes.tipo_actividad == '0'  %}
                         <option value=\"0\">--</option>
                         <option value=\"1\">Alta</option>
                         <option value=\"2\">Reparacion</option>
                         <option value=\"3\">Modificacion</option>
                         {% elseif db_ordenandes.tipo_actividad == '1'  %}
                          <option value=\"1\">Alta</option>
                          <option value=\"0\">--</option>
                          <option value=\"2\">Reparacion</option>
                          <option value=\"3\">Modificacion</option>
                         {% elseif db_ordenandes.tipo_actividad == '2'  %}
                          <option value=\"2\">Reparacion</option>
                          <option value=\"0\">--</option>
                          <option value=\"1\">Alta</option>
                          <option value=\"3\">Modificacion</option>
                           {% else %}
                         <option value=\"3\">Modificacion</option>
                         <option value=\"0\">--</option>
                         <option value=\"1\">Alta</option>
                         <option value=\"2\">Reparacion</option>
                         {% endif %}
                       </select>
                  </div>
                  <div class=\"col-md-4\">
                      <label for=\"cmbeditarfranja\">Franja</label>
                      <select class=\"form-control\" id=\"cmbeditarfranja\" name=\"cmbeditarfranja\">
                        {% if db_ordenandes.franja == '0'  %}
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        {% elseif db_ordenandes.franja == '1'  %}
                        <option value=\"1\">09-13</option>
                        <option value=\"0\">--</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        {% elseif db_ordenandes.franja == '2'  %}
                        <option value=\"2\">13-16</option>
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        {% elseif db_ordenandes.franja == '3'  %}
                        <option value=\"3\">16-19</option>
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"4\">19-21</option>
                        {% elseif db_ordenandes.franja == '4'  %}
                        <option value=\"4\">19-21</option>
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        {% else %}
                        <option value=\"0\">--</option>
                        <option value=\"1\">09-13</option>
                        <option value=\"2\">13-16</option>
                        <option value=\"3\">16-19</option>
                        <option value=\"4\">19-21</option>
                        {% endif %}
                      </select>
                   </div>
                   <div class=\"col-md-4\">
                     <label>Fecha:</label><input type=\"date\" name=\"txteditarfecha\" id=\"txteditarfecha\" class=\"form-control\" value=\"{{ db_ordenandes.fecha }}\">
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
                    <label for=\"cmbeditarestado\">Estado</label>
                    <select class=\"form-control\" id=\"cmbeditarestado\" name=\"cmbeditarestado\">
                      {% if db_ordenandes.estado == '0'  %}
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"4\">Cancelada</option>
                      {% elseif db_ordenandes.estado == '1'  %}
                      <option value=\"1\">Iniciado</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"4\">Cancelada</option>
                      {% elseif db_ordenandes.estado == '2'  %}
                      <option value=\"2\">Completado</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"3\">Derivado</option>
                      <option value=\"4\">Cancelada</option>
                      {% elseif db_ordenandes.estado == '3'  %}
                      <option value=\"3\">Derivado</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Cancelada</option>
                      {% elseif db_ordenandes.estado == '4'  %}
                      <option value=\"4\">Cancelada</option>
                      <option value=\"0\">Pendiente</option>
                      <option value=\"1\">Iniciado</option>
                      <option value=\"2\">Completado</option>
                      <option value=\"3\">Derivado</option>
                      {% endif %}
                    </select>
                 </div>
                <div class=\"col-md-4\">
                  <label>Observacion:</label><input type=\"text\" name=\"txteditarobservacion\" id=\"txteditarobservacion\" class=\"form-control\" value=\"{{db_ordenandes.observacion}}\">
                </div>
                <div class=\"col-md-4\" id=\"diveditartecnico\" name=\"diveditartecnico\">
                    <label>Tecnico</label>
                    <select class=\"form-control\" id=\"cmbeditartecnico\" name=\"cmbeditartecnico\" onchange=\"cargaeditareps\">
                        <option value=\"{{db_ordenandes.tecnico}}\">{{db_ordenandes.tecnombre}}</option>
                        {% for t in db_tecnicos %}
                        {% if t.id_tecnicos == db_ordenandes.tecnico %}
                        {% else %}
                          <option value=\"{{ t.id_tecnicos }}\">{{ t.nombre }}</option>
                        {% endif %}
                        {% endfor %}
                    </select>
                 </div>
                <div class=\"col-md-4\" id=\"diveditareps\" name=\"diveditareps\">
                    <label>EPS</label><input type=\"text\" name=\"txteditareps\" id=\"txteditareps\" class=\"form-control\" value=\"{{db_ordenandes.eps}}\">
                </div>
                  <div class=\"col-md-12\">
                  <br>
                  <br>
                  <div class=\"col-md-4\">
                  </div>
                <div class=\"\">
                  <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnmodificar\" name=\"btnmodificar\">Modificar Orden</button>
                </div>
                <input type=\"hidden\" name=\"textid\" id=\"textid\" value=\"{{db_ordenandes.id_orden}}\">
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
", "andes/editar_orden.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\andes\\editar_orden.twig");
    }
}
