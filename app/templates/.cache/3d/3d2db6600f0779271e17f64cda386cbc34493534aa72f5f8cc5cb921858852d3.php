<?php

/* avar/test.twig */
class __TwigTemplate_7fed665a482c4b5524b791d8d7c43907fd4449b2c15e8ad17434550a599984e7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "avar/test.twig", 1);
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
        echo "  <style media=\"screen\">
    .at{
      display: none;
    }
  </style>
";
    }

    // line 9
    public function block_appBody($context, array $blocks = array())
    {
        // line 10
        echo "<div class=\"row\">
    <div class=\"col-md-12\">
        <section class=\"content-header\">
            <h1>
                Gestion de recursos
                <small>Nuevo Proyecto</small>
            </h1>
        </section>
    </div>
</div>
<section class=\"content\">
    <form id=\"formtest\" name=\"formtest\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                    <h3 class=\"box-title\">Datos actividad</h3>
                    </div>
                  <div class=\"box-body\">
                    <div class=\"col-md-4\">
                      <label>id de proyecto:</label><input type=\"text\" name=\"txtrut\" id=\"txtrut\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>LOCALIDAD:</label> <select class=\"form-control\" id=\"cmbactividad\" name=\"cmbactividad\" onchange=\"selectlocalidad()\">
                         <option value=\"0\">--</option>
                         <option value=\"1\">ARICA</option>
                         <option value=\"2\">RANCAGUA</option>
                         <option value=\"3\">TALCA</option>
                         <option value=\"4\">PUERTO MONTT</option>
                       </select>
                    </div>
                    <div class=\"col-md-4\">
                      <label>SOLICITANTE</label><input type=\"text\" name=\"txtdireccion\" id=\"txtdireccion\" class=\"form-control\" value=\"TEST\" readonly>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class=\"row\">
            <div class=\"col-md-12\" id=\"divviatico\" name=\"divviatico\">

          </div>
        </div>
        <div class=\"row\">
          <div class=\"col-md-12\" id=\"divpeaje\" name=\"divpeaje\">
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-12\" id=\"divpasaje\" name=\"divpasaje\">
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-md-12\" id=\"divhospedaje\" name=\"divhospedaje\">
    </div>
  </div>
  <div class=\"col-md-12\">
  <br>
  <br>
  <div class=\"col-md-4\">
  </div>
<div class=\"\">
  <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnguardar\" name=\"btnguardar\">Guardar Actividad</button>
</div>
<br>
</div>
  </form>
</section>

";
    }

    // line 79
    public function block_appScript($context, array $blocks = array())
    {
        // line 80
        echo "
  <script src=\"views/app/js/test/test.js\"></script>


";
    }

    public function getTemplateName()
    {
        return "avar/test.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 80,  117 => 79,  45 => 10,  42 => 9,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
  <style media=\"screen\">
    .at{
      display: none;
    }
  </style>
{% endblock %}
{% block appBody %}
<div class=\"row\">
    <div class=\"col-md-12\">
        <section class=\"content-header\">
            <h1>
                Gestion de recursos
                <small>Nuevo Proyecto</small>
            </h1>
        </section>
    </div>
</div>
<section class=\"content\">
    <form id=\"formtest\" name=\"formtest\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                <div class=\"box\">
                    <div class=\"box-header\">
                    <h3 class=\"box-title\">Datos actividad</h3>
                    </div>
                  <div class=\"box-body\">
                    <div class=\"col-md-4\">
                      <label>id de proyecto:</label><input type=\"text\" name=\"txtrut\" id=\"txtrut\" class=\"form-control\">
                    </div>
                    <div class=\"col-md-4\">
                      <label>LOCALIDAD:</label> <select class=\"form-control\" id=\"cmbactividad\" name=\"cmbactividad\" onchange=\"selectlocalidad()\">
                         <option value=\"0\">--</option>
                         <option value=\"1\">ARICA</option>
                         <option value=\"2\">RANCAGUA</option>
                         <option value=\"3\">TALCA</option>
                         <option value=\"4\">PUERTO MONTT</option>
                       </select>
                    </div>
                    <div class=\"col-md-4\">
                      <label>SOLICITANTE</label><input type=\"text\" name=\"txtdireccion\" id=\"txtdireccion\" class=\"form-control\" value=\"TEST\" readonly>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class=\"row\">
            <div class=\"col-md-12\" id=\"divviatico\" name=\"divviatico\">

          </div>
        </div>
        <div class=\"row\">
          <div class=\"col-md-12\" id=\"divpeaje\" name=\"divpeaje\">
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-12\" id=\"divpasaje\" name=\"divpasaje\">
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-md-12\" id=\"divhospedaje\" name=\"divhospedaje\">
    </div>
  </div>
  <div class=\"col-md-12\">
  <br>
  <br>
  <div class=\"col-md-4\">
  </div>
<div class=\"\">
  <button type=\"button\" class=\"btn btn-primary col-md-2\" id=\"btnguardar\" name=\"btnguardar\">Guardar Actividad</button>
</div>
<br>
</div>
  </form>
</section>

{% endblock %}
{% block appScript %}

  <script src=\"views/app/js/test/test.js\"></script>


{% endblock %}
", "avar/test.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\avar\\test.twig");
    }
}
