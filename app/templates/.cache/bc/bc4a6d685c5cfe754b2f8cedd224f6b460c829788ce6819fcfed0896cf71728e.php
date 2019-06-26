<?php

/* casilleros/casilleros.twig */
class __TwigTemplate_d26636e02c2736be67812795ef5f87489a4da1a4e51cf91fe71b4546d007ff15 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "casilleros/casilleros.twig", 1);
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
            CASILLEROS
            <small>Control panel</small>
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
                        <h3 class=\"box-title\">Resumen Gestión Ejecutivos</h3>
                    </div>
                    <div class=\"box-body\">
                        <table class=\"table table-bordered\">
                            <thead>
                                <th>Ejecutivo</th>
                                ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accion"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            // line 27
            echo "                                    <th>";
            echo twig_escape_filter($this->env, $context["a"], "html", null, true);
            echo "</th>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "                                <th>TOTAL</th>
                            </thead>
                            <tbody>
                                ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["getEjecutivosCasilleros"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["getEjecutivosCasilleros"] ?? null))) {
                // line 33
                echo "                                    <tr>
                                        <td>";
                // line 34
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "name", array()), "html", null, true);
                echo "</td>
                                        ";
                // line 35
                $context["total_fila"] = 0;
                // line 36
                echo "                                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["accion"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 37
                    echo "                                            ";
                    $context["break_for"] = false;
                    // line 38
                    echo "                                            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["getResumenGestionEjecutivos"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                        if ((false != ($context["getResumenGestionEjecutivos"] ?? null))) {
                            // line 39
                            echo "                                                ";
                            if ((($context["break_for"] ?? null) == false)) {
                                // line 40
                                echo "                                                    ";
                                if ((($context["a"] == twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "accion", array())) && (twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "name", array()) == twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "name", array())))) {
                                    // line 41
                                    echo "                                                        <td class=\"text-center\">";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "cantidad", array()), "html", null, true);
                                    echo "</td>
                                                        ";
                                    // line 42
                                    $context["total_fila"] = (($context["total_fila"] ?? null) + twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "cantidad", array()));
                                    // line 43
                                    echo "                                                        ";
                                    $context["break_for"] = true;
                                    // line 44
                                    echo "                                                    ";
                                }
                                // line 45
                                echo "                                                ";
                            }
                            // line 46
                            echo "                                            ";
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 47
                    echo "                                            ";
                    if ((($context["break_for"] ?? null) == false)) {
                        // line 48
                        echo "                                                <td ></td>
                                            ";
                    }
                    // line 50
                    echo "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 51
                echo "
                                        <td class=\"text-center\">";
                // line 52
                echo twig_escape_filter($this->env, ($context["total_fila"] ?? null), "html", null, true);
                echo "</td>
                                    </tr>
                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "                            </tbody>
                        </table>
                    </div>
                    <div class=\"box-footer clearfix\">
                        <table>
                            ";
        // line 60
        $context["total_fila"] = 0;
        // line 61
        echo "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["getTotalesGestionEjecutivos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            if ((false != ($context["getTotalesGestionEjecutivos"] ?? null))) {
                // line 62
                echo "                                <td class=\"text-left\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "accion", array()), "html", null, true);
                echo ": ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "cantidad", array()), "html", null, true);
                echo "</td><td width='50'> </td>
                                ";
                // line 63
                $context["total_fila"] = (($context["total_fila"] ?? null) + twig_get_attribute($this->env, $this->getSourceContext(), $context["c"], "cantidad", array()));
                // line 64
                echo "                            ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "                            <td class=\"text-left\">TOTAL: ";
        echo twig_escape_filter($this->env, ($context["total_fila"] ?? null), "html", null, true);
        echo "</td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

";
    }

    public function getTemplateName()
    {
        return "casilleros/casilleros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 65,  181 => 64,  179 => 63,  172 => 62,  166 => 61,  164 => 60,  157 => 55,  147 => 52,  144 => 51,  138 => 50,  134 => 48,  131 => 47,  124 => 46,  121 => 45,  118 => 44,  115 => 43,  113 => 42,  108 => 41,  105 => 40,  102 => 39,  96 => 38,  93 => 37,  88 => 36,  86 => 35,  82 => 34,  79 => 33,  74 => 32,  69 => 29,  60 => 27,  56 => 26,  31 => 3,  28 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "casilleros/casilleros.twig", "C:\\xampp\\htdocs\\proyectos\\helpdesk\\app\\templates\\casilleros\\casilleros.twig");
    }
}
