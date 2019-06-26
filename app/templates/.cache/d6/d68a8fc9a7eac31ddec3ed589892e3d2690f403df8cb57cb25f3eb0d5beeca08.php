<?php

/* avar/modal_subirdocumento.twig */
class __TwigTemplate_b50caac60c6e9418dddd38828a039baa78da24442717684b9a007831bc14b936 extends Twig_Template
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
        echo "<div id=\"modal_subirdocumento\" class=\"modal fade\" role=\"dialog\">
    <div class=\"modal-body\" id=\"modalsubirdoc\" name=\"modalsubirdoc\">
      <div class=\"col-md-2\">
      </div>
     <div class=\"col-md-8\">
      <div class=\"box\">
        <div class=\"col-md-12\">
        </div>
         <div class=\"box-header\">
           <h3>CARGAR ARCHIVO</h3>
         </div>
        <div class=\"box-body\">
          <form id=\"formarch\" name=\"formarch\" method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"col-md-10\">
              <div class=\"col-md-1\">
              </div>
            <input type=\"hidden\" name=\"idarch\" id=\"idarch\" value=\"\">
            <input class='filestyle' data-buttontext=\"Logo\" type=\"file\" name=\"imagefile\" id=\"imagefile\"
              onchange=\"document.getElementById('archivo').value=document.getElementById('imagefile').value\" tabindex=\"-1\"
              style=\"position:absolute; clip: rect(0px 0px 0px 0px);\" accept=\"file_extension|image/*|media_type\">
            <div class=\"bootstrap-filestyle input-group\">
              <input type=\"text\" class=\"form-control\" id=\"archivo\" placeholder=\"\" disabled=\"\">
              <span class=\"group-span-filestyle input-group-btn\" tabindex=\"0\">
                <label for=\"imagefile\" class=\"btn btn-default \">
                  <span class=\"icon-span-filestyle glyphicon glyphicon-share\"></span>
                  <span class=\"buttonText\">Buscar Archivo</span>
                </label>
              </span>
            </div>
            <div class=\"col-md-1\">
            </div>
            <div id=\"div_cargando\">
               <a class=\"btn btn-success btn-social\" title=\"Cargar Archivo\" data-toggle=\"tooltip\" onclick=\"cargararchivo()\">
                  <i class=\"fa fa-arrow-up\"></i> Cargar documento
                </a>
                <br>
                <br>
            </div>
            </div>
      </form>
        </div>
      </div>
 </div>

    </div>
  </div>
";
    }

    public function getTemplateName()
    {
        return "avar/modal_subirdocumento.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "avar/modal_subirdocumento.twig", "/home/leon/lamp/apache2/htdocs/recursos/app/templates/avar/modal_subirdocumento.twig");
    }
}
