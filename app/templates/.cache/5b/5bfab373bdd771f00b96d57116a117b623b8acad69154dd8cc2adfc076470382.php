<?php

/* plataforma/mantenedores_crud_masters/comuna/listar_comuna.twig */
class __TwigTemplate_e7c10f2895afb96d4f2a1cf3fe6f8b7769c345a667dd213e57b66c793a2f1600 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "plataforma/mantenedores_crud_masters/comuna/listar_comuna.twig", 1);
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
        echo "    <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
";
    }

    // line 5
    public function block_appBody($context, array $blocks = array())
    {
        // line 6
        echo "    <section class=\"content-header\">
        <h1>
            Plataforma
            <small>Listado de Comunas</small>
            <a class=\"btn btn-primary btn-social pull-right\" href=\"plataforma/nueva_comuna\" title=\"Agregar\" data-toggle=\"tooltip\">
                <i class=\"fa fa-plus\"></i>
                Agregar
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
                                    <th>Codigo</th>
                                    <th>Comunas</th>
                                    <th>Zona</th>
                                    <th>AVAR</th>
                                    <th>Empresa</th>
                                    <th width='100'>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                ";
        // line 35
        $context["No"] = 1;
        // line 36
        echo "                                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["comunas_db"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["comunas_db"] ?? null))) {
                // line 37
                echo "                                    <tr>
                                        <td>";
                // line 38
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "nombre", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 39
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "descripcion", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "zona", array()), "html", null, true);
                echo "</td>
                                        ";
                // line 41
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "avar", array()) == 1)) {
                    // line 42
                    echo "                                            <td class=\"text-center\">
                                                <span class=\"glyphicon glyphicon-ok text-success text-center\"></span>
                                            </td>
                                        ";
                } else {
                    // line 46
                    echo "                                            <td class=\"text-center\">
                                                <span class=\"glyphicon glyphicon-remove text-danger\"></span>
                                            </td>
                                        ";
                }
                // line 50
                echo "                                        <td>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "empresa", array()), "html", null, true);
                echo "</td>
                                        <td class='center' width='80'>
                                            <a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-success btn-sm' href=\"plataforma/editar_comuna/";
                // line 52
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id_comuna", array()), "html", null, true);
                echo "\">
                                                <i class='glyphicon glyphicon-edit'></i>
                                            </a>

                                            ";
                // line 56
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "estado", array()) == 0)) {
                    // line 57
                    echo "                                                <a data-toggle='tooltip' data-placement='top' title='Bloqueado' class='btn btn-warning btn-sm' href=\"plataforma/estado_comuna/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id_comuna", array()), "html", null, true);
                    echo "\">
                                                    <i class='glyphicon glyphicon-off'></i>
                                                </a>

                                            ";
                } else {
                    // line 62
                    echo "                                                <a data-toggle='tooltip' data-placement='top' title='Activo' class='btn btn-danger btn-sm' href=\"plataforma/estado_comuna/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "id_comuna", array()), "html", null, true);
                    echo "\">
                                                    <i class='glyphicon glyphicon-check'></i>
                                                </a>
                                            ";
                }
                // line 66
                echo "                                        </td>
                                    </tr>
                                    ";
                // line 68
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 69
                echo "                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

";
    }

    // line 80
    public function block_appScript($context, array $blocks = array())
    {
        // line 81
        echo "    <!-- DATA TABES SCRIPT -->
    <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
    <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>

    <script src=\"views/app/js/plataforma/plataforma.js\"></script>

    <script>
        \$(\"#dataTables1\").dataTable({
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
            \"scrollX\": true
        });
    </script>

";
    }

    public function getTemplateName()
    {
        return "plataforma/mantenedores_crud_masters/comuna/listar_comuna.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 81,  167 => 80,  154 => 70,  147 => 69,  145 => 68,  141 => 66,  133 => 62,  124 => 57,  122 => 56,  115 => 52,  109 => 50,  103 => 46,  97 => 42,  95 => 41,  91 => 40,  87 => 39,  83 => 38,  80 => 37,  74 => 36,  72 => 35,  41 => 6,  38 => 5,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "plataforma/mantenedores_crud_masters/comuna/listar_comuna.twig", "C:\\xampp\\htdocs\\proyectos\\helpdesk\\app\\templates\\plataforma\\mantenedores_crud_masters\\comuna\\listar_comuna.twig");
    }
}
