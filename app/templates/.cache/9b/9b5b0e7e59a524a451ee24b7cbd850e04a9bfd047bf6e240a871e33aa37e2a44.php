<?php

/* avar/listar_areas.twig */
class __TwigTemplate_86b550b9972c94e36a5248804e1d4d39e281c5ed83989012eb01a884f2d72c77 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/listar_areas.twig", 1);
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
                Areas

                <div class=\"pull-right\">
                        <small>
                        <div class=\"pull-right\" id=\"divareas\" name=\"divareas\">
                          <a class=\"btn btn-primary\" id=\"btn_nueva_area\" href=\"avar/nueva_area\" title=\"Nueva Area\" data-toggle=\"tooltip\">
                              Nueva Area
                          </a>
                        </div>
                    </small>
                </div>
            </h1>

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


                        <table id=\"tblareas\" style=\"width:100%\" name=\"tblareas\" class=\"table table-bordered table-responsive\">
                            <thead>
                                <tr>
                                    <th style=\"width:30%\">CODIGO</th>
                                    <th style=\"width:50%\">AREA</th>
                                    <th style=\"width:20%\">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                              ";
        // line 49
        $context["No"] = 1;
        // line 50
        echo "                              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_areas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            if ((false != ($context["db_areas"] ?? null))) {
                // line 51
                echo "                                  <tr>
                                      <td>";
                // line 52
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "descripcion", array()), "html", null, true);
                echo "</td>
                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificararea\" name=\"btnmodificararea\" title='Modificar Area'  href=\"avar/editar_area/";
                // line 54
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
                echo "\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btneliminararea\" id=\"btneliminararea\" title=\"Eliminar Area\" onclick=\"eliminararea(";
                // line 56
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["a"], "cod_area", array()), "html", null, true);
                echo ")\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                          </a>
                                      </td>
                                  </tr>
                                  ";
                // line 61
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 62
                echo "                              ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
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

    // line 73
    public function block_appScript($context, array $blocks = array())
    {
        // line 74
        echo "
  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/area/area.js\"></script>

    <script>
        \$(\"#tblareas\").dataTable({
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
        return "avar/listar_areas.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 74,  140 => 73,  127 => 63,  120 => 62,  118 => 61,  110 => 56,  105 => 54,  101 => 53,  97 => 52,  94 => 51,  88 => 50,  86 => 49,  46 => 11,  43 => 10,  33 => 3,  30 => 2,  11 => 1,);
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
                Areas

                <div class=\"pull-right\">
                        <small>
                        <div class=\"pull-right\" id=\"divareas\" name=\"divareas\">
                          <a class=\"btn btn-primary\" id=\"btn_nueva_area\" href=\"avar/nueva_area\" title=\"Nueva Area\" data-toggle=\"tooltip\">
                              Nueva Area
                          </a>
                        </div>
                    </small>
                </div>
            </h1>

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


                        <table id=\"tblareas\" style=\"width:100%\" name=\"tblareas\" class=\"table table-bordered table-responsive\">
                            <thead>
                                <tr>
                                    <th style=\"width:30%\">CODIGO</th>
                                    <th style=\"width:50%\">AREA</th>
                                    <th style=\"width:20%\">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                              {% set No = 1 %}
                              {% for a in db_areas if false != db_areas %}
                                  <tr>
                                      <td>{{ a.cod_area }}</td>
                                      <td>{{ a.descripcion}}</td>
                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificararea\" name=\"btnmodificararea\" title='Modificar Area'  href=\"avar/editar_area/{{ a.cod_area }}\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btneliminararea\" id=\"btneliminararea\" title=\"Eliminar Area\" onclick=\"eliminararea({{a.cod_area }})\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                          </a>
                                      </td>
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
  <script src=\"views/app/js/area/area.js\"></script>

    <script>
        \$(\"#tblareas\").dataTable({
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
", "avar/listar_areas.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\avar\\listar_areas.twig");
    }
}
