<?php

/* plataforma/mantenedores_crud_masters/motivos_casilleros/listar_motivo.twig */
class __TwigTemplate_e162322f8789e76378424c431e8cb66e322799671514a8a2623324b4ba891acd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "plataforma/mantenedores_crud_masters/motivos_casilleros/listar_motivo.twig", 1);
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
            Plataforma
            <small>Listado de Motivos</small>

          <a class=\"btn btn-primary btn-social pull-right\" href=\"plataforma/nuevo_motivo\" title=\"Agregar\" data-toggle=\"tooltip\">
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
            <table id=\"dataTables1\" class=\"table table-bordered\">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Acción</th>
                  <th>Descripcion</th>
                  <th width=\"100\">Acciones</th>
                </tr>
              </thead>
              <tbody>
                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["motivos_db"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["motivos_db"] ?? null))) {
                // line 34
                echo "                  <tr>
                    <td>";
                // line 35
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id", array()), "html", null, true);
                echo "</td>
                    <td>";
                // line 36
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "accion", array()), "html", null, true);
                echo "</td>
                    <td>";
                // line 37
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "descripcion", array()), "html", null, true);
                echo "</td>

                    <td class='center' width='80'>
                      <a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-success btn-sm' href=\"plataforma/editar_motivo/";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id", array()), "html", null, true);
                echo "\">
                      <i class='glyphicon glyphicon-edit'></i>
                      </a>

                      ";
                // line 44
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "estado", array()) == 0)) {
                    // line 45
                    echo "                          <a data-toggle='tooltip' data-placement='top' title='Bloqueado' class='btn btn-warning btn-sm' href=\"plataforma/estado_motivo/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id", array()), "html", null, true);
                    echo "\">
                          <i class='glyphicon glyphicon-off'></i>
                          </a>

                      ";
                } else {
                    // line 50
                    echo "                          <a data-toggle='tooltip' data-placement='top' title='Activo' class='btn btn-danger btn-sm' href=\"plataforma/estado_motivo/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id", array()), "html", null, true);
                    echo "\">
                          <i class='glyphicon glyphicon-check'></i>
                          </a>
                      ";
                }
                // line 54
                echo "                    </td>
                  </tr>
                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
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

    // line 67
    public function block_appScript($context, array $blocks = array())
    {
        // line 68
        echo "    <!-- DATA TABES SCRIPT -->
    <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
    <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>

    <script src=\"views/app/js/plataforma/plataforma.js\"></script>

    <script>
        \$(\"#dataTables1\").dataTable({
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
        return "plataforma/mantenedores_crud_masters/motivos_casilleros/listar_motivo.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 68,  140 => 67,  127 => 57,  118 => 54,  110 => 50,  101 => 45,  99 => 44,  92 => 40,  86 => 37,  82 => 36,  78 => 35,  75 => 34,  70 => 33,  41 => 6,  38 => 5,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "plataforma/mantenedores_crud_masters/motivos_casilleros/listar_motivo.twig", "C:\\xampp\\htdocs\\proyectos\\helpdesk\\app\\templates\\plataforma\\mantenedores_crud_masters\\motivos_casilleros\\listar_motivo.twig");
    }
}
