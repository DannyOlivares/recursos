<?php

/* andes/listar_ordenes.twig */
class __TwigTemplate_d1c452013f80b953fbbe49e16a116a6d331f3fbbcc93b4b13305af080cf8c4ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "andes/listar_ordenes.twig", 1);
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
  <style media=\"screen\">
    .at{
      display: none;
    }
  </style>
";
    }

    // line 10
    public function block_appBody($context, array $blocks = array())
    {
        // line 11
        echo "<div class=\"row\">
    <div class=\"col-md-12\">
        <section class=\"content-header\">
            <h1>
                Ordenes Andes
                <small>Listado Ordenes Andes</small>

                <a class=\"btn btn-primary btn-social pull-right\" href=\"andes/nueva_orden\" title=\"Agregar\" data-toggle=\"tooltip\">
                <i class=\"fa fa-plus\"></i> Agregar Nueva Orden
                </a>

                <a class=\"btn btn-success btn-social pull-right\" href=\"andes/importar_ordenes\" title=\"Importar\" data-toggle=\"tooltip\">
                <i class=\"fa fa-upload\"></i> Importar nuevas ordenes
                </a>
            </h1>
        </section>
    </div>
</div>
<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body\">
                    <form id=\"formordenesandes\" name=\"formordenesandes\">
                      <div id=\"tblordenesandes\" name=\"tblordenesandes\">


                        <table id=\"tablorden\" name=\"tablorden\" class=\"table table-bordered table-responsive\">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>NOMBRE_CLIENTE</th>
                                    <th>TELEFONO</th>
                                    <th>DIRECCION</th>
                                    <th>COMUNA</th>
                                    <th>ZONA</th>
                                    <th>TIPO_ACTIVIDAD</th>
                                    <th>FRANJA</th>
                                    <th>FECHA</th>
                                    <th>N°_ORDEN</th>
                                    <th>ID_ACTIVIDAD</th>
                                    <th>ESTADO</th>
                                    <th>TECNICO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                ";
        // line 58
        $context["No"] = 1;
        // line 59
        echo "                                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_ordenesandes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            if ((false != ($context["db_ordenesandes"] ?? null))) {
                // line 60
                echo "                                    <tr>
                                        <td>";
                // line 61
                echo twig_escape_filter($this->env, ($context["No"] ?? null), "html", null, true);
                echo "</td>
                                        <td>";
                // line 62
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "nombre_cliente", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 63
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "telefono", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 64
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "direccion", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "descripcion", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 66
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "zona", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 67
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "tipo_actividad", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 68
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "franja", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 69
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "fecha", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 70
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "numero_orden", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 71
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "id_actividad", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 72
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "estado", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 73
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "tecnombre", array()), "html", null, true);
                echo "</td>
                                        <td><a data-toggle='tooltip' data-placement='top' id=\"btnestado\" name=\"btnestado\" title='Estado' class='btn btn-primary btn-sm' onclick=\"cambiarestado(";
                // line 74
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "id_orden", array()), "html", null, true);
                echo ")\">
                                                    <i class='glyphicon glyphicon-edit'></i>
                                                </a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' class='btn btn-success btn-sm' href=\"andes/editar_orden/";
                // line 77
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "id_orden", array()), "html", null, true);
                echo "\">
                                                    <i class='glyphicon glyphicon-edit'></i>
                                                </a>
                                                <a data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminarfen(";
                // line 80
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["f"] ?? null), "id_fen", array()), "html", null, true);
                echo ")\" class='btn btn-danger btn-sm'>
                                                    <i class='glyphicon glyphicon-remove'></i>
                                                </a></td>
                                    </tr>
                                    ";
                // line 84
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 85
                echo "                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "                            </tbody>
                        </table>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
";
    }

    // line 96
    public function block_appScript($context, array $blocks = array())
    {
        // line 97
        echo "
  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/andes/andes.js\"></script>

    <script>
        \$(\"#tablorden\").dataTable({
            \"language\": {
                \"search\": \"Buscar:\",
                \"zeroRecords\": \"No hay datos para mostrar\",
                \"info\": \"Mostrando _END_ Registros, de un total de _TOTAL_ \",
                \"loadingRecords\": \"Cargando...\",
                \"processing\": \"Procesando...\",
                \"infoEmpty\": \"No hay entradas para mostrar\",
                \"lengthMenu\": \"Mostrar _MENU_ Filas\",
                \"paginate\": {
                    \"first\": \"Primera\",
                    \"last\": \"Ultima\",
                    \"next\": \"Siguiente\",
                    \"previous\": \"Anterior\"
                }
            },
            \"autoWidth\": true,
            \"bSort\": false,
          \"scrollX\": true
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "andes/listar_ordenes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  202 => 97,  199 => 96,  186 => 86,  179 => 85,  177 => 84,  170 => 80,  164 => 77,  158 => 74,  154 => 73,  150 => 72,  146 => 71,  142 => 70,  138 => 69,  134 => 68,  130 => 67,  126 => 66,  122 => 65,  118 => 64,  114 => 63,  110 => 62,  106 => 61,  103 => 60,  97 => 59,  95 => 58,  46 => 11,  43 => 10,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
  <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
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
                <small>Listado Ordenes Andes</small>

                <a class=\"btn btn-primary btn-social pull-right\" href=\"andes/nueva_orden\" title=\"Agregar\" data-toggle=\"tooltip\">
                <i class=\"fa fa-plus\"></i> Agregar Nueva Orden
                </a>

                <a class=\"btn btn-success btn-social pull-right\" href=\"andes/importar_ordenes\" title=\"Importar\" data-toggle=\"tooltip\">
                <i class=\"fa fa-upload\"></i> Importar nuevas ordenes
                </a>
            </h1>
        </section>
    </div>
</div>
<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body\">
                    <form id=\"formordenesandes\" name=\"formordenesandes\">
                      <div id=\"tblordenesandes\" name=\"tblordenesandes\">


                        <table id=\"tablorden\" name=\"tablorden\" class=\"table table-bordered table-responsive\">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>NOMBRE_CLIENTE</th>
                                    <th>TELEFONO</th>
                                    <th>DIRECCION</th>
                                    <th>COMUNA</th>
                                    <th>ZONA</th>
                                    <th>TIPO_ACTIVIDAD</th>
                                    <th>FRANJA</th>
                                    <th>FECHA</th>
                                    <th>N°_ORDEN</th>
                                    <th>ID_ACTIVIDAD</th>
                                    <th>ESTADO</th>
                                    <th>TECNICO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% set No = 1 %}
                                {% for a in db_ordenesandes if false != db_ordenesandes %}
                                    <tr>
                                        <td>{{No}}</td>
                                        <td>{{ a.nombre_cliente }}</td>
                                        <td>{{ a.telefono}}</td>
                                        <td>{{ a.direccion }}</td>
                                        <td>{{ a.descripcion }}</td>
                                        <td>{{ a.zona  }}</td>
                                        <td>{{ a.tipo_actividad }}</td>
                                        <td>{{ a.franja }}</td>
                                        <td>{{ a.fecha }}</td>
                                        <td>{{ a.numero_orden }}</td>
                                        <td>{{ a.id_actividad }}</td>
                                        <td>{{ a.estado }}</td>
                                        <td>{{ a.tecnombre }}</td>
                                        <td><a data-toggle='tooltip' data-placement='top' id=\"btnestado\" name=\"btnestado\" title='Estado' class='btn btn-primary btn-sm' onclick=\"cambiarestado({{a.id_orden}})\">
                                                    <i class='glyphicon glyphicon-edit'></i>
                                                </a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' class='btn btn-success btn-sm' href=\"andes/editar_orden/{{a.id_orden}}\">
                                                    <i class='glyphicon glyphicon-edit'></i>
                                                </a>
                                                <a data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminarfen({{f.id_fen}})\" class='btn btn-danger btn-sm'>
                                                    <i class='glyphicon glyphicon-remove'></i>
                                                </a></td>
                                    </tr>
                                    {% set No = No + 1 %}
                                {% endfor %}
                            </tbody>
                        </table>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
{% endblock %}
{% block appScript %}

  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/andes/andes.js\"></script>

    <script>
        \$(\"#tablorden\").dataTable({
            \"language\": {
                \"search\": \"Buscar:\",
                \"zeroRecords\": \"No hay datos para mostrar\",
                \"info\": \"Mostrando _END_ Registros, de un total de _TOTAL_ \",
                \"loadingRecords\": \"Cargando...\",
                \"processing\": \"Procesando...\",
                \"infoEmpty\": \"No hay entradas para mostrar\",
                \"lengthMenu\": \"Mostrar _MENU_ Filas\",
                \"paginate\": {
                    \"first\": \"Primera\",
                    \"last\": \"Ultima\",
                    \"next\": \"Siguiente\",
                    \"previous\": \"Anterior\"
                }
            },
            \"autoWidth\": true,
            \"bSort\": false,
          \"scrollX\": true
        });
    </script>
{% endblock %}
", "andes/listar_ordenes.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\andes\\listar_ordenes.twig");
    }
}
