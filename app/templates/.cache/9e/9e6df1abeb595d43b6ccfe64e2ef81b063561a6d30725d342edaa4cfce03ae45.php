<?php

/* rrhh/rrhh.twig */
class __TwigTemplate_44d700b0a20c60e00ac835415b09fa95759c6009f827ae4284deb1e7b1ef7451 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "rrhh/rrhh.twig", 1);
        $this->blocks = array(
            'appBody' => array($this, 'block_appBody'),
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
    public function block_appBody($context, array $blocks = array())
    {
        // line 3
        echo "    <section class=\"content-header\">
        <h1>
            RRHH
            <small>Principal</small>
        </h1>
        <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-home\"></i> Home</a></li>
        <li class=\"active\">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">Resumen Asistencia</h3>
                    </div>
                    <div class=\"box-body\">
                        <div class=\"col-lg-3\">
                            <table class=\"table table-bordered\">
                                <tbody>
                                    <tr>
                                    ";
        // line 27
        $context["total"] = 0;
        // line 28
        echo "                                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["GetAllTurnoDiaResumen"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["GetAllTurnoDiaResumen"] ?? null))) {
                // line 29
                echo "
                                        <td>
                                            <a href=\"\">
                                            ";
                // line 32
                if ((twig_slice($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array()), 0, 5) == "Falta")) {
                    // line 33
                    echo "                                                <span class=\"label label-danger\">
                                            ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 34
$context["d"], "asistencia", array()) == "C/TURNO")) {
                    // line 35
                    echo "                                                <span class=\"label label-success\">
                                            ";
                } elseif (((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 36
$context["d"], "asistencia", array()) == "LIBRE") || (twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array()) == "S/TURNO"))) {
                    // line 37
                    echo "                                                <span class=\"label label-primary\">
                                            ";
                } else {
                    // line 39
                    echo "                                                <span class=\"label label-warning\">
                                            ";
                }
                // line 41
                echo "                                            ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array()), "html", null, true);
                echo "</span>
                                            </a>
                                        </td>
                                        <td> ";
                // line 44
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "cuenta", array()), "html", null, true);
                echo "</td>
                                        ";
                // line 45
                $context["total"] = (($context["total"] ?? null) + twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "cuenta", array()));
                // line 46
                echo "                                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "                                        <td>TOTAL</td><td>";
        echo twig_escape_filter($this->env, ($context["total"] ?? null), "html", null, true);
        echo "</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"box\">

                <div class=\"box-body\">
                    ";
        // line 61
        $context["count"] = 1;
        // line 62
        echo "                    ";
        $context["tope"] = 21;
        // line 63
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["getAllTurnosDia"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["getAllTurnosDia"] ?? null))) {
                // line 64
                echo "                        ";
                if ((($context["count"] ?? null) == 1)) {
                    // line 65
                    echo "                            <div class=\"col-lg-4\">
                                <table class=\"table table-bordered\">
                                    <thead>
                                        <th>Ejecutivo</th>
                                        <th>Asistencia</th>
                                    </thead>
                                    <tbody>

                        ";
                }
                // line 74
                echo "                                        <tr>
                                            <td>";
                // line 75
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "name", array()), "html", null, true);
                echo "</td>
                                            <td>
                                                ";
                // line 77
                if ((twig_slice($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array()), 0, 5) == "Falta")) {
                    // line 78
                    echo "                                                    <span class=\"label label-danger\">
                                                ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 79
$context["d"], "asistencia", array()) == "C/TURNO")) {
                    // line 80
                    echo "                                                    <span class=\"label label-success\">
                                                ";
                } elseif (((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 81
$context["d"], "asistencia", array()) == "LIBRE") || (twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array()) == "S/TURNO"))) {
                    // line 82
                    echo "                                                    <span class=\"label label-primary\">
                                                ";
                } else {
                    // line 84
                    echo "                                                    <span class=\"label label-warning\">
                                                ";
                }
                // line 86
                echo "                                            ";
                echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array())) ? (twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "asistencia", array())) : ("C/TURNO")), "html", null, true);
                echo "</td>
                                        </tr>
                        ";
                // line 88
                $context["count"] = (($context["count"] ?? null) + 1);
                // line 89
                echo "                        ";
                if ((($context["count"] ?? null) == ($context["tope"] ?? null))) {
                    // line 90
                    echo "                                    </tbody>
                                </table>
                            </div>
                            ";
                    // line 93
                    $context["count"] = 1;
                    // line 94
                    echo "                        ";
                }
                // line 95
                echo "
                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        echo "                    ";
        if ((($context["count"] ?? null) < ($context["tope"] ?? null))) {
            // line 98
            echo "                                </tbody>
                            </table>
                        </div>
                    ";
        }
        // line 102
        echo "                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

";
    }

    public function getTemplateName()
    {
        return "rrhh/rrhh.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 102,  213 => 98,  210 => 97,  202 => 95,  199 => 94,  197 => 93,  192 => 90,  189 => 89,  187 => 88,  181 => 86,  177 => 84,  173 => 82,  171 => 81,  168 => 80,  166 => 79,  163 => 78,  161 => 77,  156 => 75,  153 => 74,  142 => 65,  139 => 64,  133 => 63,  130 => 62,  128 => 61,  110 => 47,  103 => 46,  101 => 45,  97 => 44,  90 => 41,  86 => 39,  82 => 37,  80 => 36,  77 => 35,  75 => 34,  72 => 33,  70 => 32,  65 => 29,  59 => 28,  57 => 27,  31 => 3,  28 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "rrhh/rrhh.twig", "C:\\xampp\\htdocs\\proyectos\\helpdesk\\app\\templates\\rrhh\\rrhh.twig");
    }
}
