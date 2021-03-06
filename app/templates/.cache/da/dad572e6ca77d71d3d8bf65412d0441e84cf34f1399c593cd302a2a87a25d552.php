<?php

/* personal_sistema/listar_personal_sistema.twig */
class __TwigTemplate_a4f63f7532b264ae6d70c4e6d0fa4353fbb917895dec33a4b6f94bf15953bf0a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "personal_sistema/listar_personal_sistema.twig", 1);
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
        Sistema
            <small>Listar Usuarios Sistema</small>
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
                    <form id=\"formsistema\" name=\"formsistema\">
                      <div id=\"tblpersistema\" name=\"tblpersistema\">
                        <table id=\"tblsistema\" name=\"tblsistema\" class=\"table table-bordered table-responsive\">
                          <thead>
                              <tr>
                                  <th>RUT</th>
                                  <th>NOMBRE</th>
                                  <th>EMAIL</th>
                                  <th>CARGO</th>
                                  <th>PERFIL</th>
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
        $context['_seq'] = twig_ensure_traversable(($context["db_usuarios"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            if ((false != ($context["db_usuarios"] ?? null))) {
                // line 44
                echo "                                <tr>
                                    <td>";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "rut_personal", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 46
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "name", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 47
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "email", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 48
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "cargo", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 49
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "perfil", array()), "html", null, true);
                echo "</td>
                                    ";
                // line 50
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "estado", array()) == 1)) {
                    // line 51
                    echo "                                    <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodpersistema\" name=\"btnmodpersistema\" title='Modificar Usuario Sistema'  href=\"usuarios/editar_personal_sistema/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "id_user", array()), "html", null, true);
                    echo "\" class='btn btn-success btn-sm'>
                                        <i class='glyphicon glyphicon-edit'></i></a>
                                        <a data-toggle='tooltip' data-placement='top' name=\"btnelipersistema\" id=\"btnelipersistema\" title=\"Desactivar Usuario Sistema\" onclick=\"eliminarpersonal_sistema(";
                    // line 53
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "id_user", array()), "html", null, true);
                    echo ")\" class='btn btn-danger btn-sm'>
                                        <i class='glyphicon glyphicon-off'></i>
                                        </a></td>
                                    ";
                } else {
                    // line 57
                    echo "                                    <td><a data-toggle='tooltip' data-placement='top' id=\"btnreactivarpersistema\" name=\"btnreactivarpersistema\" title='Reativar Usuario Sistema'  onclick=\"reactivarpersonal_sistema(";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["u"], "id_user", array()), "html", null, true);
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['u'], $context['_parent'], $context['loop']);
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
        \$(\"#tblsistema\").dataTable({
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
        return "personal_sistema/listar_personal_sistema.twig";
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
        return new Twig_Source("", "personal_sistema/listar_personal_sistema.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\personal_sistema\\listar_personal_sistema.twig");
    }
}
