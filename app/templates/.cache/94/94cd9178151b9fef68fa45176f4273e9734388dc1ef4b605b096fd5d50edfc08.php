<?php

/* andes/importar_ordenes.twig */
class __TwigTemplate_345033ee4f8400254ac41ad8dac925e5c6f2c6a9463f88ec08f398dfb144b42d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "andes/importar_ordenes.twig", 1);
        $this->blocks = array(
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

    // line 3
    public function block_appBody($context, array $blocks = array())
    {
        // line 4
        echo "<section class=\"content-header\">
    <h1>
        Despacho
        <small>Ordenes</small>
    </h1>
</section>

<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body col-sm-6\">
                    <div class=\"form-group\">
                        <form id=\"formordenes\" name=\"formordenes\">
                            <input class='filestyle' data-buttonText=\"Logo\" type=\"file\" name=\"imagefile\" id=\"imagefile\" onchange=\"document.getElementById('archivo').value=document.getElementById('imagefile').value\" tabindex=\"-1\" style=\"position:absolute; clip: rect(0px 0px 0px 0px);\" accept=\"file_extension|image/*|media_type\">
                            <div class=\"bootstrap-filestyle input-group\">
                                <input type=\"text\" class=\"form-control\" id=\"archivo\" placeholder=\"\" disabled=\"\">
                                <span class=\"group-span-filestyle input-group-btn\" tabindex=\"0\">
                                    <label for=\"imagefile\" class=\"btn btn-default \">
                                    <span class=\"icon-span-filestyle glyphicon glyphicon-share\"></span>
                                    <span class=\"buttonText\">Buscar Archivo</span>
                                    </label>
                                </span>
                            </div>
                            <div id=\"div_cargando\" name=\"div_cargando\">
                                <a class=\"btn btn-success btn-social\" title=\"Importar Excel\" data-toggle=\"tooltip\" onclick=\"cargaordenes()\">
                                    <i class=\"fa fa-arrow-up\"></i> Cargar Ordenes
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class=\"box-body col-sm-6\">
                    <span><b>Formato de Archivo</b>
                    <p>Col A -> Orden de trabajo</p>
                    <p>Col B -> Tipo actividad</p>
                    <p>Col C -> Franja</p>
                    <p>Col D -> Cliente</p>
                    <p>Col E -> Direccion</p>
                    <p>Col F -> Ciudad</p>
                    <p>Col G -> Rut cliente</p>
                    <p>Col H -> Numero telefono</p>
                    <p>Col I -> Numero Orden</p>
                    <p>Col J -> Estado</p>
                    <p>Col K -> Territorio</p>
                    <p>Col L -> Zona de trabajo</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
";
    }

    // line 58
    public function block_appScript($context, array $blocks = array())
    {
        // line 59
        echo "    <script src=\"views/app/js/andes/andes.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "andes/importar_ordenes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 59,  88 => 58,  32 => 4,  29 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}

{% block appBody %}
<section class=\"content-header\">
    <h1>
        Despacho
        <small>Ordenes</small>
    </h1>
</section>

<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body col-sm-6\">
                    <div class=\"form-group\">
                        <form id=\"formordenes\" name=\"formordenes\">
                            <input class='filestyle' data-buttonText=\"Logo\" type=\"file\" name=\"imagefile\" id=\"imagefile\" onchange=\"document.getElementById('archivo').value=document.getElementById('imagefile').value\" tabindex=\"-1\" style=\"position:absolute; clip: rect(0px 0px 0px 0px);\" accept=\"file_extension|image/*|media_type\">
                            <div class=\"bootstrap-filestyle input-group\">
                                <input type=\"text\" class=\"form-control\" id=\"archivo\" placeholder=\"\" disabled=\"\">
                                <span class=\"group-span-filestyle input-group-btn\" tabindex=\"0\">
                                    <label for=\"imagefile\" class=\"btn btn-default \">
                                    <span class=\"icon-span-filestyle glyphicon glyphicon-share\"></span>
                                    <span class=\"buttonText\">Buscar Archivo</span>
                                    </label>
                                </span>
                            </div>
                            <div id=\"div_cargando\" name=\"div_cargando\">
                                <a class=\"btn btn-success btn-social\" title=\"Importar Excel\" data-toggle=\"tooltip\" onclick=\"cargaordenes()\">
                                    <i class=\"fa fa-arrow-up\"></i> Cargar Ordenes
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class=\"box-body col-sm-6\">
                    <span><b>Formato de Archivo</b>
                    <p>Col A -> Orden de trabajo</p>
                    <p>Col B -> Tipo actividad</p>
                    <p>Col C -> Franja</p>
                    <p>Col D -> Cliente</p>
                    <p>Col E -> Direccion</p>
                    <p>Col F -> Ciudad</p>
                    <p>Col G -> Rut cliente</p>
                    <p>Col H -> Numero telefono</p>
                    <p>Col I -> Numero Orden</p>
                    <p>Col J -> Estado</p>
                    <p>Col K -> Territorio</p>
                    <p>Col L -> Zona de trabajo</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
{% endblock %}

{% block appScript %}
    <script src=\"views/app/js/andes/andes.js\"></script>
{% endblock %}
", "andes/importar_ordenes.twig", "C:\\xampp\\htdocs\\helpdesk\\app\\templates\\andes\\importar_ordenes.twig");
    }
}
