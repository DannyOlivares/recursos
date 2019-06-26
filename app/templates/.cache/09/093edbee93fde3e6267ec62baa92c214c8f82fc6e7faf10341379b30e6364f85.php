<?php

/* personal/listar_personal.twig */
class __TwigTemplate_e6b3da08c173801ec9decdb5573fbd0dc946e7f8008fbc2d4dd35c920bc63864 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal/listar_personal.twig", 1);
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
        echo "<div class=\"row\">
    <div class=\"col-md-12\">
    <section class=\"content-header\">
        <h1>
          Personal
            <small>Lista de personal</small>
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
<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body\">
                    <form id=\"formareas\" name=\"formareas\">
                      <div id=\"tblcontrolareas\" name=\"tblcontrolareas\">
                        <table id=\"tblpersonal\" name=\"tblpersonal\" class=\"table table-bordered table-responsive\">
                          <thead>
                              <tr>
                                  <th>RUT</th>
                                  <th>NOMBRE</th>
                                  <th>EMAIL</th>
                                  <th>AREA</th>
                                  <th>CARGO</th>
                                  <th>OPCIONES</th>
                              </tr>
                          </thead>
                          <tbody>
                            ";
        // line 42
        $context["No"] = 1;
        // line 43
        echo "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_personal"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            if ((false != ($context["db_personal"] ?? null))) {
                // line 44
                echo "                                <tr>
                                    <td>";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "rut_personal", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 46
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "nombre_personal", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 47
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "email", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 48
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "descripcion", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 49
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cargo_personal", array()), "html", null, true);
                echo "</td>
                                    ";
                // line 50
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == 1)) {
                    // line 51
                    echo "                                    <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificarpersonal\" name=\"btnmodificarpersonal\" title='Modificar Personal'  href=\"usuarios/editar_personal/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cod_personal", array()), "html", null, true);
                    echo "\" class='btn btn-success btn-sm'>
                                        <i class='glyphicon glyphicon-edit'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name=\"btneliminarpersonal\" id=\"btneliminarpersonal\" title=\"Desactivar Personal\" onclick=\"eliminarpersonal(";
                    // line 53
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cod_personal", array()), "html", null, true);
                    echo ")\" class='btn btn-danger btn-sm'>
                                        <i class='glyphicon glyphicon-off'></i>
                                        </a></td>
                                    ";
                } else {
                    // line 57
                    echo "                                    <td><a data-toggle='tooltip' data-placement='top' id=\"btnreactivarpersonal\" name=\"btnreactivarpersonal\" title='Reativar Personal'  onclick=\"eliminarpersonal(";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cod_personal", array()), "html", null, true);
                    echo ")\" class='btn btn-warning btn-sm'>
                                        <i class='glyphicon glyphicon-off'></i></a></td>
                                    ";
                }
                // line 60
                echo "                                </tr>
                                ";
                // line 61
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 62
                echo "                            ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "                          </tbody>
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

    // line 73
    public function block_appScript($context, array $blocks = array())
    {
        // line 74
        echo "
  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/personal/personal.js\"></script>

    <script>
        \$(\"#tblpersonal\").dataTable({
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
        return "personal/listar_personal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 74,  157 => 73,  144 => 63,  137 => 62,  135 => 61,  132 => 60,  125 => 57,  118 => 53,  112 => 51,  110 => 50,  106 => 49,  102 => 48,  98 => 47,  94 => 46,  90 => 45,  87 => 44,  81 => 43,  79 => 42,  41 => 6,  38 => 5,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
  <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
{% endblock %}
{% block appBody %}
<div class=\"row\">
    <div class=\"col-md-12\">
    <section class=\"content-header\">
        <h1>
          Personal
            <small>Lista de personal</small>
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
<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body\">
                    <form id=\"formareas\" name=\"formareas\">
                      <div id=\"tblcontrolareas\" name=\"tblcontrolareas\">
                        <table id=\"tblpersonal\" name=\"tblpersonal\" class=\"table table-bordered table-responsive\">
                          <thead>
                              <tr>
                                  <th>RUT</th>
                                  <th>NOMBRE</th>
                                  <th>EMAIL</th>
                                  <th>AREA</th>
                                  <th>CARGO</th>
                                  <th>OPCIONES</th>
                              </tr>
                          </thead>
                          <tbody>
                            {% set No = 1 %}
                            {% for p in db_personal if false != db_personal %}
                                <tr>
                                    <td>{{ p.rut_personal }}</td>
                                    <td>{{ p.nombre_personal}}</td>
                                    <td>{{ p.email}}</td>
                                    <td>{{ p.descripcion}}</td>
                                    <td>{{ p.cargo_personal}}</td>
                                    {% if p.estado == 1 %}
                                    <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificarpersonal\" name=\"btnmodificarpersonal\" title='Modificar Personal'  href=\"usuarios/editar_personal/{{ p.cod_personal }}\" class='btn btn-success btn-sm'>
                                        <i class='glyphicon glyphicon-edit'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name=\"btneliminarpersonal\" id=\"btneliminarpersonal\" title=\"Desactivar Personal\" onclick=\"eliminarpersonal({{p.cod_personal }})\" class='btn btn-danger btn-sm'>
                                        <i class='glyphicon glyphicon-off'></i>
                                        </a></td>
                                    {% else %}
                                    <td><a data-toggle='tooltip' data-placement='top' id=\"btnreactivarpersonal\" name=\"btnreactivarpersonal\" title='Reativar Personal'  onclick=\"eliminarpersonal({{p.cod_personal }})\" class='btn btn-warning btn-sm'>
                                        <i class='glyphicon glyphicon-off'></i></a></td>
                                    {% endif %}
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
  <script src=\"views/app/js/personal/personal.js\"></script>

    <script>
        \$(\"#tblpersonal\").dataTable({
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
", "personal/listar_personal.twig", "C:\\xampp\\htdocs\\cp\\app\\templates\\personal\\listar_personal.twig");
    }
}
