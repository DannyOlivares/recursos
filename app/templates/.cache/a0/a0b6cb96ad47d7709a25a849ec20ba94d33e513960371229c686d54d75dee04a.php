<?php

/* home/lostpass.twig */
class __TwigTemplate_1dd4f4c638a5851a3826bb796b683c85aca6e001c05d4386d590771531140ae3 extends Twig_Template
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
        echo "<div id=\"lostpass\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Recuperar Contraseña</h4>
      </div>
      <div class=\"modal-body\">
        <form id=\"lostpass_form\" class=\"form-signin\" method=\"POST\">
            <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Email de cuenta a recuperar\" autofocus>
        </form>
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cerrar</button>
        <button type=\"button\" id=\"recuperar\" class=\"btn btn-success\">Recuperar</button>
      </div>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "home/lostpass.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home/lostpass.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\home\\lostpass.twig");
    }
}
