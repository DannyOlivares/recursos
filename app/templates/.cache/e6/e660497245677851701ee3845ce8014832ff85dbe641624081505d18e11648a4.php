<?php

/* portal/home.twig */
class __TwigTemplate_8295308277169b0ed7eb2db38cfd8b2863e38b22dbd3afe065bc27eaa9e5983b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "portal/home.twig", 1);
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
        echo "    <!-- fullcalendar -->
    <link rel='stylesheet' href='views/app/template/fullcalendar/fullcalendar.min.css'>
    <style media=\"screen\">
        #calendar_cumpleanos {
            max-width: 90%;
            margin: 0 auto;
        }
        #calendar_eventos {
            max-width: 90%;
            margin: 0 auto;
        }
    </style>

";
    }

    // line 17
    public function block_appBody($context, array $blocks = array())
    {
        // line 18
        echo "    <section class=\"content-header\">
        <h1>
            ESCRITORIO
            <small>HOME</small>
        </h1>
        <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-home\"></i> Home</a></li>
        <li class=\"active\">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"row\">
          <div class=\"col-lg-12 col-xs-12\">
            <div class=\"panel panel-info\">
              <div class=\"panel-heading\">
                <h3 class=\"panel-title\">  <i class=\"icon fa fa-user\"></i> Bienvenido <strong>";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["owner_user"] ?? null), "name", array(), "array"), "html", null, true);
        echo "</strong>.</h3>
              </div>
            </div>
          </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-6\">
                <div class=\"box\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">Cumpleaños del Mes</h3>
                    </div>
                    <div class=\"box-body\">

                        <div id='calendar_cumpleanos'></div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-6\">
                <div class=\"box\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">Eventos</h3>
                    </div>
                    <div class=\"box-body\">
                        <div id='calendar_eventos'></div>
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
        echo "    <!-- fullcalendar -->
    <script src='views/app/template/fullcalendar/lib/moment.min.js'></script>
    <!-- <script src='views/app/template/fullcalendar/lib/jquery.min.js'></script> -->
    <script src='views/app/template/fullcalendar/fullcalendar.min.js'></script>
    <script src='views/app/template/fullcalendar/locale-all.js'></script>

    <script>

        \$(document).ready(function() {
            var initialLocaleCode = 'es';

            \$('#calendar_cumpleanos').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                default: 1,
                locale: initialLocaleCode,
                defaultDate: '";
        // line 87
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y-m-d"), "html", null, true);
        echo "',
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: true, // allow \"more\" link when too many events
                events: [
                    ";
        // line 92
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["getCumpleañosUsuariosMes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["getCumpleañosUsuariosMes"] ?? null))) {
                // line 93
                echo "                        ";
                if ((twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "fecha_nacimiento", array()), "m-d") == twig_date_format_filter($this->env, ($context["now"] ?? null), "m-d"))) {
                    // line 94
                    echo "                            {
                                title: '";
                    // line 95
                    echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "name", array())), "html", null, true);
                    echo "',
                                start: '";
                    // line 96
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y"), "html", null, true);
                    echo "-";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "fecha_nacimiento", array()), "m-d"), "html", null, true);
                    echo "',
                                color: '#378006'
                            },
                        ";
                } else {
                    // line 100
                    echo "                            {
                                title: '";
                    // line 101
                    echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "name", array())), "html", null, true);
                    echo "',
                                start: '";
                    // line 102
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y"), "html", null, true);
                    echo "-";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["d"], "fecha_nacimiento", array()), "m-d"), "html", null, true);
                    echo "'
                            },
                        ";
                }
                // line 105
                echo "                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        echo "                ],

            });

            \$('#calendar_eventos').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                default: 1,
                locale: initialLocaleCode,
                defaultDate: '";
        // line 118
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y-m-d"), "html", null, true);
        echo "',
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: true, // allow \"more\" link when too many events
                events: [
                    {
                        title: 'HOY',
                        start: '";
        // line 125
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y-m-d"), "html", null, true);
        echo "',
                        rendering: 'background',
                        color: '#378006'
                    }
                ],

            });

        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "portal/home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 125,  200 => 118,  186 => 106,  179 => 105,  171 => 102,  167 => 101,  164 => 100,  155 => 96,  151 => 95,  148 => 94,  145 => 93,  140 => 92,  132 => 87,  111 => 68,  108 => 67,  72 => 35,  53 => 18,  50 => 17,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "portal/home.twig", "C:\\xampp\\htdocs\\proyectos\\helpdesk\\app\\templates\\portal\\home.twig");
    }
}
