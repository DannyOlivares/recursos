<?php

/* portal/portal.twig */
class __TwigTemplate_d9c8445c4ab9d2909d87c60da6dfcf2c7378353f7816c9dd1b49e451ef7febe4 extends Twig_Template
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
        // line 66
        $this->displayBlock('appHead', $context, $blocks);
        // line 69
        echo "
        ";
        // line 70
        $this->displayBlock('appside', $context, $blocks);
        // line 73
        echo "
        ";
        // line 75
        echo "         <div class=\"content-wrapper\">
            ";
        // line 76
        $this->displayBlock('appBody', $context, $blocks);
        // line 79
        echo "        </div>


      ";
        // line 83
        echo "      ";
        $this->displayBlock('appFooter', $context, $blocks);
        // line 86
        echo "
      ";
        // line 87
        $this->loadTemplate("portal/resetpass", "portal/portal.twig", 87)->display($context);
        // line 88
        echo "    </div>
    ";
        // line 90
        echo "    ";
        if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["config"] ?? null), "framework", array()), "debug", array())) {
            // line 91
            echo "      ";
            // line 92
            echo "      <script src=\"views/app/js/jdev.min.js\"></script>
    ";
        } else {
            // line 94
            echo "      ";
            // line 95
            echo "      <script src=\"views/app/template/jquery/dist/jquery.min.js\"></script>
    ";
        }
        // line 97
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
        // line 138
        echo "    ";
        $this->displayBlock('appScript', $context, $blocks);
        // line 141
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

    // line 66
    public function block_appHead($context, array $blocks = array())
    {
        // line 67
        echo "            ";
        $this->loadTemplate("portal/header", "portal/portal.twig", 67)->display($context);
        // line 68
        echo "        ";
    }

    // line 70
    public function block_appside($context, array $blocks = array())
    {
        // line 71
        echo "            ";
        $this->loadTemplate("portal/menu", "portal/portal.twig", 71)->display($context);
        // line 72
        echo "        ";
    }

    // line 76
    public function block_appBody($context, array $blocks = array())
    {
        // line 77
        echo "
            ";
    }

    // line 83
    public function block_appFooter($context, array $blocks = array())
    {
        // line 84
        echo "        ";
        $this->loadTemplate("portal/footer", "portal/portal.twig", 84)->display($context);
        // line 85
        echo "      ";
    }

    // line 138
    public function block_appScript($context, array $blocks = array())
    {
        // line 139
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
        return array (  256 => 139,  253 => 138,  249 => 85,  246 => 84,  243 => 83,  238 => 77,  235 => 76,  231 => 72,  228 => 71,  225 => 70,  221 => 68,  218 => 67,  215 => 66,  210 => 51,  207 => 50,  202 => 42,  199 => 41,  192 => 141,  189 => 138,  147 => 97,  143 => 95,  141 => 94,  137 => 92,  135 => 91,  132 => 90,  129 => 88,  127 => 87,  124 => 86,  121 => 83,  116 => 79,  114 => 76,  111 => 75,  108 => 73,  106 => 70,  103 => 69,  101 => 66,  86 => 53,  83 => 50,  77 => 47,  73 => 44,  71 => 41,  32 => 6,  26 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "portal/portal.twig", "/home/leon/lamp/apache2/htdocs/recursos/app/templates/portal/portal.twig");
    }
}
