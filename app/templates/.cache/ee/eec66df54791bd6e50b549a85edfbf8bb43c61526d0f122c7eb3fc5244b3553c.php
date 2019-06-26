<?php

/* plataforma/mantenedores_crud_masters/motivos_casilleros/editar_motivo.twig */
class __TwigTemplate_3fe6091478e28ea9c046c5869c15eb612959a2b6eb8f60d3b1d7fbeac5d7f34a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("portal/portal", "plataforma/mantenedores_crud_masters/motivos_casilleros/editar_motivo.twig", 1);
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
    }

    // line 4
    public function block_appBody($context, array $blocks = array())
    {
        // line 5
        echo "    <section class=\"content-header\">
        <h1>
            Motivos Casilleros
            <small>Editar Motivo</small>
        </h1>
        <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-home\"></i> Home</a></li>
        <li><a href=\"plataforma/mantenedores_crud_masters\">Mantenedores</a></li>
        <li><a href=\"plataforma/listar_motivos\">Listado de Motivos</a></li>
        <li class=\"active\">Editar Motivo</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"box box-primary\">
            <form id=\"editar_motivo_form\"  action=\"\" method=\"POST\">
              <div class=\"box-body col-sm-4\"></div>
              <div class=\"box-body col-sm-4\">
                <input type='hidden' name='id_motivo' id='id_motivo' value='";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_motivo"] ?? null), "id", array()), "html", null, true);
        echo "' />
                <div class=\"form-group\">
                    <select class=\"form-control\" name=\"ubicacion\">
                        ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_ubicacion"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            if ((false != ($context["db_ubicacion"] ?? null))) {
                // line 30
                echo "                            ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_motivo"] ?? null), "ubicacion", array()) == $context["d"])) {
                    // line 31
                    echo "                            <option value=\"";
                    echo twig_escape_filter($this->env, $context["d"], "html", null, true);
                    echo "\" selected>";
                    echo twig_escape_filter($this->env, $context["d"], "html", null, true);
                    echo "</option>
                            ";
                } else {
                    // line 33
                    echo "                            <option value=\"";
                    echo twig_escape_filter($this->env, $context["d"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["d"], "html", null, true);
                    echo "</option>
                            ";
                }
                // line 35
                echo "                        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "                    </select>

                  <br>
                  <input class=\"form-control\" name=\"descripcion\" id=\"descripcion\" type=\"text\" value='";
        // line 39
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_motivo"] ?? null), "descripcion", array()), "html", null, true);
        echo "' required/>
                  <br>
                </div>
                <div class=\"panel-footer text-center\">
                  <button type=\"button\" id=\"update_motivo\" class=\"btn btn-default\">Grabar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

";
    }

    // line 54
    public function block_appScript($context, array $blocks = array())
    {
        // line 55
        echo "    <script src=\"views/app/js/plataforma/plataforma.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "plataforma/mantenedores_crud_masters/motivos_casilleros/editar_motivo.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 55,  122 => 54,  103 => 39,  98 => 36,  91 => 35,  83 => 33,  75 => 31,  72 => 30,  67 => 29,  61 => 26,  38 => 5,  35 => 4,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "plataforma/mantenedores_crud_masters/motivos_casilleros/editar_motivo.twig", "C:\\xampp\\htdocs\\proyectos\\helpdesk\\app\\templates\\plataforma\\mantenedores_crud_masters\\motivos_casilleros\\editar_motivo.twig");
    }
}
