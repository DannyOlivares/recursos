<?php

/* portal/footer.twig */
class __TwigTemplate_519aad2c97352e40b2f1435ce627a8a2eefdfa56296d96c5a9b9c58544fa7267 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<footer class=\"main-footer\">
    <div class=\"pull-right hidden-xs\">
        <b>Version</b> 3.0.0
    </div>
    <strong>Copyright &copy; ";
        // line 5
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " <a href=\"#\">HELPDESK TEAM DEVELOPER</a>.</strong>
</footer>
";
    }

    public function getTemplateName()
    {
        return "portal/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<footer class=\"main-footer\">
    <div class=\"pull-right hidden-xs\">
        <b>Version</b> 3.0.0
    </div>
    <strong>Copyright &copy; {{ \"now\"|date(\"Y\") }} <a href=\"#\">HELPDESK TEAM DEVELOPER</a>.</strong>
</footer>
", "portal/footer.twig", "C:\\xampp\\htdocs\\cp\\app\\templates\\portal\\footer.twig");
    }
}
