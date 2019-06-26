<?php

/* portal/home.twig */
class __TwigTemplate_532883fb3e7f4b119d70cfa21116abbbffb2b3009d2dd93f03eff2c7db5e6120 extends Twig_Template
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
        echo "  <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
  <style media=\"screen\">
    .at{
      display: none;
    }
  </style>
";
    }

    // line 10
    public function block_appBody($context, array $blocks = array())
    {
        // line 11
        echo "<div class=\"row\">
    <div class=\"col-md-12\">
      <div class=\"col-md-4\">
        <section class=\"content-header\">
          <h4>
               Plataforma Solicitud de Fondos para Proyectos
          </h4>
        </section>
      </div>
      <div class=\"col-md-8\">
        <div class=\"box\">
          <div class=\"pull-right\">
                  <div class=\"pull-right\" id=\"divfiltros\" name=\"divfiltros\">
                    <div class=\"col-md-2\">
                      <label>Estados</label>
                      <select class=\"form-control\" id='cmbestado' onchange=\"filtrar_estado()\" name=\"cmbestado\" >
                        <option value=\"4\">--</option>
                        <option value=\"0\">PENDIENTE</option>
                        <option value=\"1\">PREVALIDADO</option>
                        <option value=\"2\">APROBADO</option>
                        <option value=\"3\">RECHAZADO</option>
                        <option value=\"4\">PAGADO</option>
                      </select>
                    </div>

                      <label>Fecha:</label>
                      <label>&nbsp;</label>
                      <input type=\"date\" id=\"fechadesde\" name=\"fechadesde\" style=\"width:130px\" value='";
        // line 38
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "'>
                      <label>&nbsp;</label>
                      <input type=\"date\" id=\"fechahasta\" name=\"fechahasta\" style=\"width:130px\" value='";
        // line 40
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "'>
                      <label>&nbsp;</label>
                      <button type=\"button\" name=\"btnbuscar\" id=\"btnbuscar\" onclick=\"filtrar_por_fecha()\" style=\"width:95px\" class=\"btn btn-success\">Filtrar</button>
                      <button type=\"button\" name=\"btnquitar\" id=\"btnquitar\" onclick=\"quitar_filtro()\" style=\"width:95px\" class=\"btn btn-danger\">Quitar Filtro</button>

                      <a class=\"btn btn-primary\" id=\"btn_exporta_excel\" href=\"avar/test\" style=\"width:115px\" title=\"Nueva Actividad\" data-toggle=\"tooltip\">
                            Nueva Solicitud
                      </a>

                </div>
          </div>
        </div>

      </div>
    </div>
</div>
<section class=\"content\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-primary\">
                <div class=\"box-body\">
                    <form id=\"formordenesandes\" name=\"formordenesandes\">
                      <div id=\"tblordenesandes\" name=\"tblordenesandes\">
                        <table id=\"tablorden\" name=\"tablorden\" class=\"table table-bordered table-responsive\">
                            <thead>
                                <tr>
                                    <th>ID_DE_PROYECTO</th>
                                    <th>LOCALIDAD</th>
                                    <th>AREA</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FINAL</th>
                                    <th>DIAS_VIATICO_Y_TRANS.</th>
                                    <th>DIAS_HOSPEDAJE</th>
                                    <th>COSTO TOTAL</th>
                                    <th>ESTADO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                              ";
        // line 79
        $context["No"] = 1;
        // line 80
        echo "                              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_proyecto"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            if ((false != ($context["db_proyecto"] ?? null))) {
                // line 81
                echo "                                  <tr>

                                      <td class='text-center' onclick='consultarorden(";
                // line 83
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                echo ")'><a class='btn'>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "num_proyecto", array()), "html", null, true);
                echo "</a></td>
                                      <td>";
                // line 84
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "descripcion", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 85
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "areas", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 86
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "fecha_inicio", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 87
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "fecha_final", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 88
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cant_dias", array()), "html", null, true);
                echo "</td>
                                      ";
                // line 89
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "hospedaje", array()) == false)) {
                    // line 90
                    echo "                                      <td>NO APLICA</td>
                                      ";
                } else {
                    // line 92
                    echo "                                      <td>";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cant_dias_hospedaje", array()), "html", null, true);
                    echo "</td>
                                      ";
                }
                // line 94
                echo "                                      <td>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "costo_total", array()), "html", null, true);
                echo "</td>
                                      ";
                // line 95
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "0")) {
                    // line 96
                    echo "                                      <td>PENDIENTE</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 97
$context["p"], "estado", array()) == "1")) {
                    // line 98
                    echo "                                      <td>PREVALIDADO</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 99
$context["p"], "estado", array()) == "2")) {
                    // line 100
                    echo "                                      <td>APROBADO</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 101
$context["p"], "estado", array()) == "3")) {
                    // line 102
                    echo "                                      <td>RECHAZADO</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 103
$context["p"], "estado", array()) == "4")) {
                    // line 104
                    echo "                                      <td>PAGADO</td>
                                      ";
                }
                // line 106
                echo "                                      ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_INGRESO")) {
                    // line 107
                    echo "                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo "\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                    // line 109
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo ")\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                        </a>
                                        ";
                    // line 112
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                        // line 113
                        echo "                                          <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-open'></i>
                                        </a></td>
                                        ";
                    } else {
                        // line 117
                        echo "                                          <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                          <i class='glyphicon glyphicon-file'></i>
                                        </a></td>
                                        ";
                    }
                    // line 121
                    echo "                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_PREVALIDADOR")) {
                    // line 122
                    echo "                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo ")\" class='btn btn-primary btn-sm'>
                                          <i class='glyphicon glyphicon-ok'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                    // line 124
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo "\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" onclick=\"eliminar(";
                    // line 126
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo ")\"  title=\"Eliminar\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                          </a>
                                          ";
                    // line 129
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                        // line 130
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a></td>
                                          ";
                    } else {
                        // line 133
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a></td>
                                          ";
                    }
                    // line 136
                    echo "                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_CONTADOR")) {
                    // line 137
                    echo "                                          ";
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) != 4)) {
                        // line 138
                        echo "                                          <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnpagar\" name=\"btnpagar\" title='Pagar' onclick=\"pagar(";
                        // line 139
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'><i class=\"fa fa-dollar\"></i></a>
                                          ";
                    } else {
                        // line 141
                        echo "                                          <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnpagar\" name=\"btnpagar\" title='Pagar' class='btn btn-success btn-sm'><i class=\"fa fa-dollar\"></i></a>
                                          ";
                    }
                    // line 144
                    echo "
                                          ";
                    // line 145
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                        // line 146
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/";
                        // line 148
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "' target='_blank'  class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                          ";
                    } else {
                        // line 150
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/";
                        // line 152
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "' target='_blank'  class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                          ";
                    }
                    // line 154
                    echo "                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_ADMIN")) {
                    // line 155
                    echo "                                            ";
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "0")) {
                        // line 156
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 158
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 160
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 161
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 164
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 167
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "1")) {
                        // line 168
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                        // line 170
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" onclick=\"eliminar(";
                        // line 172
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\"  title=\"Eliminar\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 174
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 175
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 178
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 181
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "2")) {
                        // line 182
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar(";
                        // line 183
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 184
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                            <i class='glyphicon glyphicon-remove'></i></a>
                                            ";
                        // line 186
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 187
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a></td>
                                            ";
                        } else {
                            // line 190
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a></td>
                                            ";
                        }
                        // line 193
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "3")) {
                        // line 194
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 196
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                     // line 198
$context["p"], "estado", array()) == "4")) {
                        // line 199
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completados' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                            ";
                        // line 200
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 201
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a>
                                            ";
                        } else {
                            // line 204
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a>
                                            ";
                        }
                        // line 207
                        echo "                                              <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "' target='_blank' class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                            ";
                    }
                    // line 209
                    echo "                                      ";
                } else {
                    // line 210
                    echo "                                            ";
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) != "2")) {
                        // line 211
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnaprobar\" name=\"btnaprobar\" title='Completar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\"  class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                        // line 213
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 215
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 217
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 218
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 221
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 224
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "0")) {
                        // line 225
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 227
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 229
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 230
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 233
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 236
                        echo "                                            ";
                    } else {
                        // line 237
                        echo "                                                <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-success btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                                ";
                        // line 238
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 239
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 242
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 245
                        echo "                                            ";
                    }
                    // line 246
                    echo "                                       ";
                }
                // line 247
                echo "                                  </tr>
                                  ";
                // line 248
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 249
                echo "                              ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 250
        echo "                            </tbody>
                        </table>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
";
        // line 259
        $this->loadTemplate("avar/modal_orden", "portal/home.twig", 259)->display($context);
        // line 260
        $this->loadTemplate("avar/modal_aprobacion", "portal/home.twig", 260)->display($context);
        // line 261
        $this->loadTemplate("avar/modal_subirdocumento", "portal/home.twig", 261)->display($context);
        // line 262
        $this->loadTemplate("avar/modal_factura", "portal/home.twig", 262)->display($context);
    }

    // line 264
    public function block_appScript($context, array $blocks = array())
    {
        // line 265
        echo "
  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/test/test.js\"></script>


  <script>
    cargar_inicio();
  </script>
    <script>
        \$(\"#tablorden\").dataTable({
            \"language\": {
                \"search\": \"Buscar:\",
                \"zeroRecords\": \"No hay datos para mostrar\",
                \"info\": \"Mostrando _END_ Registros, de un total de _TOTAL_ \",
                \"loadingRecords\": \"Cargando...\",
                \"processing\": \"Procesando...\",
                \"infoEmpty\": \"No hay entradas para mostrar\",
                \"lengthMenu\": \"Mostrar _MENU_ Filas\",
                \"paginate\": {
                    \"first\": \"Primera\",
                    \"last\": \"Ultima\",
                    \"next\": \"Siguiente\",
                    \"previous\": \"Anterior\"
                }
            },
            \"autoWidth\": true,
            \"bSort\": false,
          \"scrollX\": true
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
        return array (  590 => 265,  587 => 264,  583 => 262,  581 => 261,  579 => 260,  577 => 259,  566 => 250,  559 => 249,  557 => 248,  554 => 247,  551 => 246,  548 => 245,  541 => 242,  534 => 239,  532 => 238,  529 => 237,  526 => 236,  519 => 233,  512 => 230,  510 => 229,  505 => 227,  499 => 225,  496 => 224,  489 => 221,  482 => 218,  480 => 217,  475 => 215,  470 => 213,  464 => 211,  461 => 210,  458 => 209,  452 => 207,  445 => 204,  438 => 201,  436 => 200,  433 => 199,  431 => 198,  426 => 196,  420 => 194,  417 => 193,  410 => 190,  403 => 187,  401 => 186,  396 => 184,  392 => 183,  389 => 182,  386 => 181,  379 => 178,  372 => 175,  370 => 174,  365 => 172,  360 => 170,  354 => 168,  351 => 167,  344 => 164,  337 => 161,  335 => 160,  330 => 158,  324 => 156,  321 => 155,  318 => 154,  313 => 152,  307 => 150,  302 => 148,  296 => 146,  294 => 145,  291 => 144,  286 => 141,  281 => 139,  278 => 138,  275 => 137,  272 => 136,  265 => 133,  258 => 130,  256 => 129,  250 => 126,  245 => 124,  239 => 122,  236 => 121,  228 => 117,  220 => 113,  218 => 112,  212 => 109,  206 => 107,  203 => 106,  199 => 104,  197 => 103,  194 => 102,  192 => 101,  189 => 100,  187 => 99,  184 => 98,  182 => 97,  179 => 96,  177 => 95,  172 => 94,  166 => 92,  162 => 90,  160 => 89,  156 => 88,  152 => 87,  148 => 86,  144 => 85,  140 => 84,  134 => 83,  130 => 81,  124 => 80,  122 => 79,  80 => 40,  75 => 38,  46 => 11,  43 => 10,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "portal/home.twig", "C:\\xampp\\htdocs\\cp\\app\\templates\\portal\\home.twig");
    }
}
