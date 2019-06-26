<?php

/* portal/portal.twig */
class __TwigTemplate_ed79a226cc656782a1f88afd51b8698ccfc31b76658041a8ce8ad42739b393ee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'appStylos' => array($this, 'block_appStylos'),
            'appHeader' => array($this, 'block_appHeader'),
            'appHead' => array($this, 'block_appHead'),
            'appside' => array($this, 'block_appside'),
            'appBody' => array($this, 'block_appBody'),
            'appFooter' => array($this, 'block_appFooter'),
            'appScript' => array($this, 'block_appScript'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"es\">
  <head>

    ";
        // line 6
        echo "    ";
        echo $this->env->getExtension('Ocrend\Kernel\Helpers\Functions')->base_assets();
        echo "
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
    <!-- Bootstrap 3.3.7 -->
    <link rel=\"stylesheet\" href=\"views/app/template/bootstrap/dist/css/bootstrap.min.css\">
    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"views/app/template/font-awesome/css/font-awesome.min.css\">
    <!-- Ionicons -->
    <link rel=\"stylesheet\" href=\"views/app/template/Ionicons/css/ionicons.min.css\">
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"views/app/template/AdminLTE.min.css\">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel=\"stylesheet\" href=\"views/app/template/skins/_all-skins.min.css\">
    <!-- Alertas -->
    <link rel=\"stylesheet\" href=\"views/app/template/jquery-confirm/jquery-confirm.min.css\">
    <!-- Pace style -->
    <link rel=\"stylesheet\" href=\"views/app/template/PACE/pace.min.css\">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel=\"stylesheet\" href=\"views/app/template/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css\">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->

    <!-- Google Font -->
    <!-- <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic\"> -->

    ";
        // line 41
        $this->displayBlock('appStylos', $context, $blocks);
        // line 44
        echo "
    <link href=\"views/app/images/favicon.ico\" rel=\"shortcut icon\" type=\"image/x-icon\" />
    ";
        // line 47
        echo "    <title>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["config"] ?? null), "site", array()), "name", array()), "html", null, true);
        echo "</title>

    ";
        // line 50
        echo "    ";
        $this->displayBlock('appHeader', $context, $blocks);
        // line 53
        echo "
  </head>
  <body class=\"hold-transition skin-blue sidebar-mini\"> <!--<body class=\"hold-transition skin-blue sidebar-mini\">-->
    <div class=\"wrapper\">
        <div style=\"display: none;\" id=\"cargador\" align=\"center\">
            <br>
            <label style=\"color:#FFF; background-color:#ABB6BA; text-align:center\">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

            <img src=\"views/app/images/cargando.gif\" align=\"middle\" alt=\"cargador\"> &nbsp;<label style=\"color:#ABB6BA\">Realizando tarea solicitada ...</label>

            <br>
            <hr style=\"color:#003\" width=\"30%\">
            <br>
        </div>
        ";
        // line 67
        $this->displayBlock('appHead', $context, $blocks);
        // line 70
        echo "
        ";
        // line 71
        $this->displayBlock('appside', $context, $blocks);
        // line 74
        echo "
        ";
        // line 76
        echo "         <div class=\"content-wrapper\">
            ";
        // line 77
        $this->displayBlock('appBody', $context, $blocks);
        // line 80
        echo "        </div>


      ";
        // line 84
        echo "      ";
        $this->displayBlock('appFooter', $context, $blocks);
        // line 87
        echo "
      ";
        // line 88
        $this->loadTemplate("portal/resetpass", "portal/portal.twig", 88)->display($context);
        // line 89
        echo "    </div>
    ";
        // line 91
        echo "    ";
        if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["config"] ?? null), "framework", array()), "debug", array())) {
            // line 92
            echo "      ";
            // line 93
            echo "      <script src=\"views/app/js/jdev.min.js\"></script>
    ";
        } else {
            // line 95
            echo "      ";
            // line 96
            echo "      <script src=\"views/app/template/jquery/dist/jquery.min.js\"></script>
    ";
        }
        // line 98
        echo "
    <!-- jQuery UI 1.11.4 -->
    <script src=\"views/app/template/jquery-ui/jquery-ui.min.js\"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      \$.widget.bridge('uibutton', \$.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src=\"views/app/template/bootstrap/dist/js/bootstrap.min.js\"></script>
    <!-- Slimscroll -->
    <script src=\"views/app/template/jquery-slimscroll/jquery.slimscroll.min.js\"></script>
    <!-- FastClick -->
    <script src=\"views/app/template/fastclick/lib/fastclick.js\"></script>
    <!-- AdminLTE App -->
    <script src=\"views/app/template/adminlte.min.js\"></script>
    <!-- AdminLTE for demo purposes -->
    <script src=\"views/app/template/demo.js\"></script>
    <!-- PACE -->
    <script src=\"views/app/template/PACE/pace.min.js\"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src=\"views/app/template/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js\"></script>

    <!-- Alertas -->
    <script src=\"views/app/template/jquery-confirm/jquery-confirm.min.js\"></script>

    <script src=\"views/app/js/portal/portal.js\"></script>
    <script>
        var width = \$(document).width();
        if(width > 770){
            \$('body').addClass('sidebar-collapse');
        }
        \$(window).resize(function(){
            if(width <= 770){
                \$('body').removeClass('sidebar-collapse');
            }
        })

        \$(document).ajaxStart(function() { Pace.restart(); });
    </script>

    ";
        // line 139
        echo "    ";
        $this->displayBlock('appScript', $context, $blocks);
        // line 142
        echo "
  </body>
</html>
";
    }

    // line 41
    public function block_appStylos($context, array $blocks = array())
    {
        // line 42
        echo "
    ";
    }

    // line 50
    public function block_appHeader($context, array $blocks = array())
    {
        // line 51
        echo "      <!-- :) -->
    ";
    }

    // line 67
    public function block_appHead($context, array $blocks = array())
    {
        // line 68
        echo "            ";
        $this->loadTemplate("portal/header", "portal/portal.twig", 68)->display($context);
        // line 69
        echo "        ";
    }

    // line 71
    public function block_appside($context, array $blocks = array())
    {
        // line 72
        echo "            ";
        $this->loadTemplate("portal/menu", "portal/portal.twig", 72)->display($context);
        // line 73
        echo "        ";
    }

    // line 77
    public function block_appBody($context, array $blocks = array())
    {
        // line 78
        echo "
            ";
    }

    // line 84
    public function block_appFooter($context, array $blocks = array())
    {
        // line 85
        echo "        ";
        $this->loadTemplate("portal/footer", "portal/portal.twig", 85)->display($context);
        // line 86
        echo "      ";
    }

    // line 139
    public function block_appScript($context, array $blocks = array())
    {
        // line 140
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "portal/portal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 140,  254 => 139,  250 => 86,  247 => 85,  244 => 84,  239 => 78,  236 => 77,  232 => 73,  229 => 72,  226 => 71,  222 => 69,  219 => 68,  216 => 67,  211 => 51,  208 => 50,  203 => 42,  200 => 41,  193 => 142,  190 => 139,  148 => 98,  144 => 96,  142 => 95,  138 => 93,  136 => 92,  133 => 91,  130 => 89,  128 => 88,  125 => 87,  122 => 84,  117 => 80,  115 => 77,  112 => 76,  109 => 74,  107 => 71,  104 => 70,  102 => 67,  86 => 53,  83 => 50,  77 => 47,  73 => 44,  71 => 41,  32 => 6,  26 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"es\">
  <head>

    {# Formato #}
    {{ base_assets()|raw }}
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
    <!-- Bootstrap 3.3.7 -->
    <link rel=\"stylesheet\" href=\"views/app/template/bootstrap/dist/css/bootstrap.min.css\">
    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"views/app/template/font-awesome/css/font-awesome.min.css\">
    <!-- Ionicons -->
    <link rel=\"stylesheet\" href=\"views/app/template/Ionicons/css/ionicons.min.css\">
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"views/app/template/AdminLTE.min.css\">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel=\"stylesheet\" href=\"views/app/template/skins/_all-skins.min.css\">
    <!-- Alertas -->
    <link rel=\"stylesheet\" href=\"views/app/template/jquery-confirm/jquery-confirm.min.css\">
    <!-- Pace style -->
    <link rel=\"stylesheet\" href=\"views/app/template/PACE/pace.min.css\">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel=\"stylesheet\" href=\"views/app/template/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css\">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->

    <!-- Google Font -->
    <!-- <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic\"> -->

    {% block appStylos %}

    {% endblock %}

    <link href=\"views/app/images/favicon.ico\" rel=\"shortcut icon\" type=\"image/x-icon\" />
    {# Título #}
    <title>{{ config.site.name }}</title>

    {# Extras en el header #}
    {% block appHeader %}
      <!-- :) -->
    {% endblock %}

  </head>
  <body class=\"hold-transition skin-blue sidebar-mini\"> <!--<body class=\"hold-transition skin-blue sidebar-mini\">-->
    <div class=\"wrapper\">
        <div style=\"display: none;\" id=\"cargador\" align=\"center\">
            <br>
            <label style=\"color:#FFF; background-color:#ABB6BA; text-align:center\">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

            <img src=\"views/app/images/cargando.gif\" align=\"middle\" alt=\"cargador\"> &nbsp;<label style=\"color:#ABB6BA\">Realizando tarea solicitada ...</label>

            <br>
            <hr style=\"color:#003\" width=\"30%\">
            <br>
        </div>
        {% block appHead %}
            {% include 'portal/header' %}
        {% endblock %}

        {% block appside %}
            {% include 'portal/menu' %}
        {% endblock %}

        {# Contenido real #}
         <div class=\"content-wrapper\">
            {% block appBody %}

            {% endblock %}
        </div>


      {# Footer #}
      {% block appFooter %}
        {% include 'portal/footer' %}
      {% endblock %}

      {% include 'portal/resetpass' %}
    </div>
    {# Carga de jQuery #}
    {% if config.framework.debug %}
      {# jQuery para ver errores de ajax vía consola, no eliminar #}
      <script src=\"views/app/js/jdev.min.js\"></script>
    {% else %}
      {# jQuery para su plantilla, este puede ser modificado a voluntad #}
      <script src=\"views/app/template/jquery/dist/jquery.min.js\"></script>
    {% endif %}

    <!-- jQuery UI 1.11.4 -->
    <script src=\"views/app/template/jquery-ui/jquery-ui.min.js\"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      \$.widget.bridge('uibutton', \$.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src=\"views/app/template/bootstrap/dist/js/bootstrap.min.js\"></script>
    <!-- Slimscroll -->
    <script src=\"views/app/template/jquery-slimscroll/jquery.slimscroll.min.js\"></script>
    <!-- FastClick -->
    <script src=\"views/app/template/fastclick/lib/fastclick.js\"></script>
    <!-- AdminLTE App -->
    <script src=\"views/app/template/adminlte.min.js\"></script>
    <!-- AdminLTE for demo purposes -->
    <script src=\"views/app/template/demo.js\"></script>
    <!-- PACE -->
    <script src=\"views/app/template/PACE/pace.min.js\"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src=\"views/app/template/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js\"></script>

    <!-- Alertas -->
    <script src=\"views/app/template/jquery-confirm/jquery-confirm.min.js\"></script>

    <script src=\"views/app/js/portal/portal.js\"></script>
    <script>
        var width = \$(document).width();
        if(width > 770){
            \$('body').addClass('sidebar-collapse');
        }
        \$(window).resize(function(){
            if(width <= 770){
                \$('body').removeClass('sidebar-collapse');
            }
        })

        \$(document).ajaxStart(function() { Pace.restart(); });
    </script>

    {# Scripts globales #}
    {% block appScript %}

    {% endblock %}

  </body>
</html>
", "portal/portal.twig", "C:\\xampp\\htdocs\\cp\\app\\templates\\portal\\portal.twig");
    }
}
