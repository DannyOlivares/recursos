<?php

/* portal/footer.twig */
class __TwigTemplate_072ca3b4bc9e4a2b28c3eedad6859a34200c94aa1fc74a2c13a7ad4702d19845 extends Twig_Template
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
        return new Twig_Source("", "portal/footer.twig", "/home/leon/lamp/apache2/htdocs/recursos/app/templates/portal/footer.twig");
    }
}
