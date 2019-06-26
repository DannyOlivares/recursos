<?php

/* andes/listar_tecnicos.twig */
class __TwigTemplate_5977a6513d69e9e5eb337448bfa2d8e0ee23444654c6777220a70ef5472f9b64 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "andes/listar_tecnicos.twig", 1);
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
        echo "  <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
";
    }

    // line 5
    public function block_appBody($context, array $blocks = array())
    {
        // line 6
        echo "    <section class=\"content-header\">
        <h1>
            Andes
            <small>Listado de Tecnicos</small>
          <a class=\"btn btn-primary btn-social pull-right\" href=\"andes/nuevo_tecnico\" title=\"Agregar\" data-toggle=\"tooltip\">
            <i class=\"fa fa-plus\"></i> Agregar
          </a>
        </h1>
    </section>

    <!-- Main content -->
    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box box-primary\">
            <div class=\"box-body\">
            <table id=\"dataTablestecnicos\" class=\"table table-bordered\">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Rut</th>
                  <th>Nombres</th>
                  <th>Telefono</th>
                  <th>Zona</th>
                  <th>EPS</th>
                  <th>OPCIONES</th>
                </tr>
              </thead>
              <tbody>
                ";
        // line 35
        $context["No"] = 1;
        // line 36
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_tecnicos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            if ((false != ($context["db_tecnicos"] ?? null))) {
                // line 37
                echo "                  <tr>
                    <td>";
                // line 38
                echo twig_escape_filter($this->env, ($context["No"] ?? null), "html", null, true);
                echo "</td>
                    <td>";
                // line 39
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "rut", array()), "html", null, true);
                echo "</td>
                    <td>";
                // line 40
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "nombre", array())), "html", null, true);
                echo "</td>
                    <td>";
                // line 41
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "telefono", array()), "html", null, true);
                echo "</td>
                    <td>";
                // line 42
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "zona", array()), "html", null, true);
                echo "</td>
                    <td>";
                // line 43
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["t"], "codigo_eps", array()), "html", null, true);
                echo "</td>
                    <td class='center' width='80'>
                      <a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-success btn-sm' href=\"despacho/editar_tecnico/";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["d"] ?? null), "id_tecnicos", array()), "html", null, true);
                echo "\">
                      <i class='glyphicon glyphicon-edit'></i>
                      </a>

                      ";
                // line 49
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["d"] ?? null), "estado", array()) == 0)) {
                    // line 50
                    echo "                          <a data-toggle='tooltip' data-placement='top' title='Bloqueado' class='btn btn-warning btn-sm' href=\"despacho/estado_tecnico/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["d"] ?? null), "id_tecnicos", array()), "html", null, true);
                    echo "\">
                          <i class='glyphicon glyphicon-off'></i>
                          </a>

                      ";
                } else {
                    // line 55
                    echo "                          <a data-toggle='tooltip' data-placement='top' title='Activo' class='btn btn-danger btn-sm' href=\"despacho/estado_tecnico/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["d"] ?? null), "id_tecnicos", array()), "html", null, true);
                    echo "\">
                          <i class='glyphicon glyphicon-check'></i>
                          </a>

                      ";
                }
                // line 60
                echo "
                    </td>
                  </tr>
                  ";
                // line 63
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 64
                echo "                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

";
    }

    // line 75
    public function block_appScript($context, array $blocks = array())
    {
        // line 76
        echo "    <!-- DATA TABES SCRIPT -->
    <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
    <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>

    <script src=\"views/app/js/despacho/tecnicos.js\"></script>

    <script>
     \$(\"#dataTablestecnicos\").dataTable({
                \"language\": {
                    \"search\": \"Buscar:\",
                    \"zeroRecords\": \"No hay datos para mostrar\",
                    \"info\":\"Mostrando _END_ Registros, de un total de _TOTAL_ \",
                    \"loadingRecords\": \"Cargando...\",
                    \"processing\":\"Procesando...\",
                    \"infoEmpty\":\"No hay entradas para mostrar\",
                    \"lengthMenu\": \"Mostrar _MENU_ Filas\",
                    \"paginate\":{
                      \"first\":\"Primera\",
                      \"last\":\"Ultima\",
                      \"next\":\"Siguiente\",
                      \"previous\":\"Anterior\",
                    }
                              },
                \"autoWidth\": true,
                \"scrollX\": true
            });
    </script>

";
    }

    public function getTemplateName()
    {
        return "andes/listar_tecnicos.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  165 => 76,  162 => 75,  149 => 65,  142 => 64,  140 => 63,  135 => 60,  126 => 55,  117 => 50,  115 => 49,  108 => 45,  103 => 43,  99 => 42,  95 => 41,  91 => 40,  87 => 39,  83 => 38,  80 => 37,  74 => 36,  72 => 35,  41 => 6,  38 => 5,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
  <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
{% endblock %}
{% block appBody %}
    <section class=\"content-header\">
        <h1>
            Andes
            <small>Listado de Tecnicos</small>
          <a class=\"btn btn-primary btn-social pull-right\" href=\"andes/nuevo_tecnico\" title=\"Agregar\" data-toggle=\"tooltip\">
            <i class=\"fa fa-plus\"></i> Agregar
          </a>
        </h1>
    </section>

    <!-- Main content -->
    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box box-primary\">
            <div class=\"box-body\">
            <table id=\"dataTablestecnicos\" class=\"table table-bordered\">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Rut</th>
                  <th>Nombres</th>
                  <th>Telefono</th>
                  <th>Zona</th>
                  <th>EPS</th>
                  <th>OPCIONES</th>
                </tr>
              </thead>
              <tbody>
                {% set No = 1 %}
                {% for t in db_tecnicos if false != db_tecnicos %}
                  <tr>
                    <td>{{ No }}</td>
                    <td>{{ t.rut }}</td>
                    <td>{{ t.nombre|raw|title }}</td>
                    <td>{{ t.telefono }}</td>
                    <td>{{ t.zona }}</td>
                    <td>{{ t.codigo_eps }}</td>
                    <td class='center' width='80'>
                      <a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-success btn-sm' href=\"despacho/editar_tecnico/{{ d.id_tecnicos }}\">
                      <i class='glyphicon glyphicon-edit'></i>
                      </a>

                      {% if d.estado == 0 %}
                          <a data-toggle='tooltip' data-placement='top' title='Bloqueado' class='btn btn-warning btn-sm' href=\"despacho/estado_tecnico/{{ d.id_tecnicos }}\">
                          <i class='glyphicon glyphicon-off'></i>
                          </a>

                      {% else %}
                          <a data-toggle='tooltip' data-placement='top' title='Activo' class='btn btn-danger btn-sm' href=\"despacho/estado_tecnico/{{ d.id_tecnicos }}\">
                          <i class='glyphicon glyphicon-check'></i>
                          </a>

                      {% endif %}

                    </td>
                  </tr>
                  {% set No =  No + 1 %}
                {% endfor %}
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

{% endblock %}
{% block appScript %}
    <!-- DATA TABES SCRIPT -->
    <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
    <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>

    <script src=\"views/app/js/despacho/tecnicos.js\"></script>

    <script>
     \$(\"#dataTablestecnicos\").dataTable({
                \"language\": {
                    \"search\": \"Buscar:\",
                    \"zeroRecords\": \"No hay datos para mostrar\",
                    \"info\":\"Mostrando _END_ Registros, de un total de _TOTAL_ \",
                    \"loadingRecords\": \"Cargando...\",
                    \"processing\":\"Procesando...\",
                    \"infoEmpty\":\"No hay entradas para mostrar\",
                    \"lengthMenu\": \"Mostrar _MENU_ Filas\",
                    \"paginate\":{
                      \"first\":\"Primera\",
                      \"last\":\"Ultima\",
                      \"next\":\"Siguiente\",
                      \"previous\":\"Anterior\",
                    }
                              },
                \"autoWidth\": true,
                \"scrollX\": true
            });
    </script>

{% endblock %}
", "andes/listar_tecnicos.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\andes\\listar_tecnicos.twig");
    }
}
