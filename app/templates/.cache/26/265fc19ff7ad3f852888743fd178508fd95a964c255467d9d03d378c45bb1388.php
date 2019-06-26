<?php

/* portal/home.twig */
class __TwigTemplate_3ecadab268bfe404a9779e00bf1cf6ec16d5b757f15f5e10bbc3e3c1c97af050 extends Twig_Template
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
      <section class=\"content-header\">
        <h1>
            Plataforma de Solicitud de Fondos para Proyectos

            <div class=\"pull-right\">
                    <small>
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
                      <div class=\"col-md-10\">
                        <label>Fecha:</label>
                        <label>&nbsp;</label>
                        <input type=\"date\" id=\"fechadesde\" name=\"fechadesde\" value='";
        // line 34
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "'>
                        <label>&nbsp;</label>
                        <input type=\"date\" id=\"fechahasta\" name=\"fechahasta\" value='";
        // line 36
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y-m-d"), "html", null, true);
        echo "'>
                        <label>&nbsp;</label>
                        <button type=\"button\" name=\"btnbuscar\" id=\"btnbuscar\" onclick=\"filtrar_por_fecha()\" class=\"btn btn-primary\">Aplicar Filtrar</button>
                        <a class=\"btn btn-primary\" id=\"btn_exporta_excel\" href=\"avar/test\" title=\"Nueva Actividad\" data-toggle=\"tooltip\">
                              Nueva Solicitud
                        </a>
                      </div>
                  </div>
                </small>
            </div>
        </h1>
    </section>
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
        // line 73
        $context["No"] = 1;
        // line 74
        echo "                              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["db_proyecto"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            if ((false != ($context["db_proyecto"] ?? null))) {
                // line 75
                echo "                                  <tr>

                                      <td class='text-center' onclick='consultarorden(";
                // line 77
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                echo ")'><a class='btn'>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "num_proyecto", array()), "html", null, true);
                echo "</a></td>
                                      <td>";
                // line 78
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "descripcion", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 79
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "areas", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 80
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "fecha_inicio", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 81
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "fecha_final", array()), "html", null, true);
                echo "</td>
                                      <td>";
                // line 82
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cant_dias", array()), "html", null, true);
                echo "</td>
                                      ";
                // line 83
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "hospedaje", array()) == false)) {
                    // line 84
                    echo "                                      <td>NO APLICA</td>
                                      ";
                } else {
                    // line 86
                    echo "                                      <td>";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "cant_dias_hospedaje", array()), "html", null, true);
                    echo "</td>
                                      ";
                }
                // line 88
                echo "                                      <td>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "costo_total", array()), "html", null, true);
                echo "</td>
                                      ";
                // line 89
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "0")) {
                    // line 90
                    echo "                                      <td>PENDIENTE</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 91
$context["p"], "estado", array()) == "1")) {
                    // line 92
                    echo "                                      <td>PREVALIDADO</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 93
$context["p"], "estado", array()) == "2")) {
                    // line 94
                    echo "                                      <td>APROBADO</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 95
$context["p"], "estado", array()) == "3")) {
                    // line 96
                    echo "                                      <td>RECHAZADO</td>
                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 97
$context["p"], "estado", array()) == "4")) {
                    // line 98
                    echo "                                      <td>PAGADO</td>
                                      ";
                }
                // line 100
                echo "                                      ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_INGRESO")) {
                    // line 101
                    echo "                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo "\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                    // line 103
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo ")\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                        </a>
                                        ";
                    // line 106
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                        // line 107
                        echo "                                          <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-open'></i>
                                        </a></td>
                                        ";
                    } else {
                        // line 111
                        echo "                                          <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                          <i class='glyphicon glyphicon-file'></i>
                                        </a></td>
                                        ";
                    }
                    // line 115
                    echo "                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_PREVALIDADOR")) {
                    // line 116
                    echo "                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo ")\" class='btn btn-primary btn-sm'>
                                          <i class='glyphicon glyphicon-ok'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                    // line 118
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo "\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" onclick=\"eliminar(";
                    // line 120
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                    echo ")\"  title=\"Eliminar\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                          </a>
                                          ";
                    // line 123
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                        // line 124
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a></td>
                                          ";
                    } else {
                        // line 127
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a></td>
                                          ";
                    }
                    // line 130
                    echo "                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_CONTADOR")) {
                    // line 131
                    echo "                                          ";
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) != 4)) {
                        // line 132
                        echo "                                          <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnpagar\" name=\"btnpagar\" title='Pagar' onclick=\"pagar(";
                        // line 133
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'><i class=\"fa fa-dollar\"></i></a>
                                          ";
                    } else {
                        // line 135
                        echo "                                          <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnpagar\" name=\"btnpagar\" title='Pagar' class='btn btn-success btn-sm'><i class=\"fa fa-dollar\"></i></a>
                                          ";
                    }
                    // line 138
                    echo "
                                          ";
                    // line 139
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                        // line 140
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/";
                        // line 142
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "' target='_blank'  class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                          ";
                    } else {
                        // line 144
                        echo "                                            <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/";
                        // line 146
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "' target='_blank'  class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                          ";
                    }
                    // line 148
                    echo "                                      ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["db_perfil"] ?? null), "perfil", array()) == "CONTROL_ADMIN")) {
                    // line 149
                    echo "                                            ";
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "0")) {
                        // line 150
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 152
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 154
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 155
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 158
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 161
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "1")) {
                        // line 162
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                        // line 164
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" onclick=\"eliminar(";
                        // line 166
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\"  title=\"Eliminar\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 168
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 169
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 172
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 175
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "2")) {
                        // line 176
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar(";
                        // line 177
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 178
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                            <i class='glyphicon glyphicon-remove'></i></a>
                                            ";
                        // line 180
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 181
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a></td>
                                            ";
                        } else {
                            // line 184
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a></td>
                                            ";
                        }
                        // line 187
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "3")) {
                        // line 188
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 190
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                     // line 192
$context["p"], "estado", array()) == "4")) {
                        // line 193
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completados' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                            ";
                        // line 194
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 195
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a>
                                            ";
                        } else {
                            // line 198
                            echo "                                              <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a>
                                            ";
                        }
                        // line 201
                        echo "                                              <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "' target='_blank' class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                            ";
                    }
                    // line 203
                    echo "                                      ";
                } else {
                    // line 204
                    echo "                                            ";
                    if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) != "2")) {
                        // line 205
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnaprobar\" name=\"btnaprobar\" title='Completar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\"  class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/";
                        // line 207
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo "\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 209
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 211
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 212
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 215
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 218
                        echo "                                            ";
                    } elseif ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "estado", array()) == "0")) {
                        // line 219
                        echo "                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar(";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar(";
                        // line 221
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                        echo ")\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                ";
                        // line 223
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 224
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 227
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 230
                        echo "                                            ";
                    } else {
                        // line 231
                        echo "                                                <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-success btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                                ";
                        // line 232
                        if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "factura", array()) == 0)) {
                            // line 233
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                ";
                        } else {
                            // line 236
                            echo "                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura(";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["p"], "id_proyecto", array()), "html", null, true);
                            echo ")\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                ";
                        }
                        // line 239
                        echo "                                            ";
                    }
                    // line 240
                    echo "                                       ";
                }
                // line 241
                echo "                                  </tr>
                                  ";
                // line 242
                $context["No"] = (($context["No"] ?? null) + 1);
                // line 243
                echo "                              ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 244
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
        // line 253
        $this->loadTemplate("avar/modal_orden", "portal/home.twig", 253)->display($context);
        // line 254
        $this->loadTemplate("avar/modal_aprobacion", "portal/home.twig", 254)->display($context);
        // line 255
        $this->loadTemplate("avar/modal_subirdocumento", "portal/home.twig", 255)->display($context);
        // line 256
        $this->loadTemplate("avar/modal_factura", "portal/home.twig", 256)->display($context);
    }

    // line 258
    public function block_appScript($context, array $blocks = array())
    {
        // line 259
        echo "
  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/test/test.js\"></script>

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
        return array (  584 => 259,  581 => 258,  577 => 256,  575 => 255,  573 => 254,  571 => 253,  560 => 244,  553 => 243,  551 => 242,  548 => 241,  545 => 240,  542 => 239,  535 => 236,  528 => 233,  526 => 232,  523 => 231,  520 => 230,  513 => 227,  506 => 224,  504 => 223,  499 => 221,  493 => 219,  490 => 218,  483 => 215,  476 => 212,  474 => 211,  469 => 209,  464 => 207,  458 => 205,  455 => 204,  452 => 203,  446 => 201,  439 => 198,  432 => 195,  430 => 194,  427 => 193,  425 => 192,  420 => 190,  414 => 188,  411 => 187,  404 => 184,  397 => 181,  395 => 180,  390 => 178,  386 => 177,  383 => 176,  380 => 175,  373 => 172,  366 => 169,  364 => 168,  359 => 166,  354 => 164,  348 => 162,  345 => 161,  338 => 158,  331 => 155,  329 => 154,  324 => 152,  318 => 150,  315 => 149,  312 => 148,  307 => 146,  301 => 144,  296 => 142,  290 => 140,  288 => 139,  285 => 138,  280 => 135,  275 => 133,  272 => 132,  269 => 131,  266 => 130,  259 => 127,  252 => 124,  250 => 123,  244 => 120,  239 => 118,  233 => 116,  230 => 115,  222 => 111,  214 => 107,  212 => 106,  206 => 103,  200 => 101,  197 => 100,  193 => 98,  191 => 97,  188 => 96,  186 => 95,  183 => 94,  181 => 93,  178 => 92,  176 => 91,  173 => 90,  171 => 89,  166 => 88,  160 => 86,  156 => 84,  154 => 83,  150 => 82,  146 => 81,  142 => 80,  138 => 79,  134 => 78,  128 => 77,  124 => 75,  118 => 74,  116 => 73,  76 => 36,  71 => 34,  46 => 11,  43 => 10,  33 => 3,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'portal/portal' %}
{% block appStylos %}
  <link rel=\"stylesheet\" href=\"views/app/template/datatables/dataTables.bootstrap.css\">
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
            Plataforma de Solicitud de Fondos para Proyectos

            <div class=\"pull-right\">
                    <small>
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
                      <div class=\"col-md-10\">
                        <label>Fecha:</label>
                        <label>&nbsp;</label>
                        <input type=\"date\" id=\"fechadesde\" name=\"fechadesde\" value='{{ \"now\"|date(\"Y-m-d\") }}'>
                        <label>&nbsp;</label>
                        <input type=\"date\" id=\"fechahasta\" name=\"fechahasta\" value='{{ \"now\"|date(\"Y-m-d\") }}'>
                        <label>&nbsp;</label>
                        <button type=\"button\" name=\"btnbuscar\" id=\"btnbuscar\" onclick=\"filtrar_por_fecha()\" class=\"btn btn-primary\">Aplicar Filtrar</button>
                        <a class=\"btn btn-primary\" id=\"btn_exporta_excel\" href=\"avar/test\" title=\"Nueva Actividad\" data-toggle=\"tooltip\">
                              Nueva Solicitud
                        </a>
                      </div>
                  </div>
                </small>
            </div>
        </h1>
    </section>
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
                              {% set No = 1 %}
                              {% for p in db_proyecto if false != db_proyecto %}
                                  <tr>

                                      <td class='text-center' onclick='consultarorden({{p.id_proyecto}})'><a class='btn'>{{p.num_proyecto}}</a></td>
                                      <td>{{ p.descripcion}}</td>
                                      <td>{{ p.areas}}</td>
                                      <td>{{ p.fecha_inicio}}</td>
                                      <td>{{ p.fecha_final}}</td>
                                      <td>{{ p.cant_dias}}</td>
                                      {% if p.hospedaje == false %}
                                      <td>NO APLICA</td>
                                      {% else %}
                                      <td>{{ p.cant_dias_hospedaje}}</td>
                                      {% endif %}
                                      <td>{{ p.costo_total }}</td>
                                      {% if p.estado == '0' %}
                                      <td>PENDIENTE</td>
                                      {% elseif p.estado == '1'  %}
                                      <td>PREVALIDADO</td>
                                      {% elseif p.estado == '2'  %}
                                      <td>APROBADO</td>
                                      {% elseif p.estado == '3'  %}
                                      <td>RECHAZADO</td>
                                      {% elseif p.estado == '4'  %}
                                      <td>PAGADO</td>
                                      {% endif %}
                                      {% if db_perfil.perfil == 'CONTROL_INGRESO' %}
                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/{{p.id_proyecto}}\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar({{p.id_proyecto}})\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                        </a>
                                        {% if p.factura == 0 %}
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-open'></i>
                                        </a></td>
                                        {% else %}
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                          <i class='glyphicon glyphicon-file'></i>
                                        </a></td>
                                        {% endif %}
                                      {% elseif db_perfil.perfil == 'CONTROL_PREVALIDADOR' %}
                                      <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                          <i class='glyphicon glyphicon-ok'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/{{p.id_proyecto}}\" class='btn btn-success btn-sm'>
                                          <i class='glyphicon glyphicon-edit'></i></a>
                                          <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" onclick=\"eliminar({{p.id_proyecto}})\"  title=\"Eliminar\" class='btn btn-danger btn-sm'>
                                          <i class='glyphicon glyphicon-remove'></i>
                                          </a>
                                          {% if p.factura == 0 %}
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a></td>
                                          {% else %}
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a></td>
                                          {% endif %}
                                      {% elseif db_perfil.perfil == 'CONTROL_CONTADOR' %}
                                          {% if p.estado != 4 %}
                                          <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnpagar\" name=\"btnpagar\" title='Pagar' onclick=\"pagar({{p.id_proyecto}})\" class='btn btn-success btn-sm'><i class=\"fa fa-dollar\"></i></a>
                                          {% else %}
                                          <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                          <a data-toggle='tooltip' data-placement='top' id=\"btnpagar\" name=\"btnpagar\" title='Pagar' class='btn btn-success btn-sm'><i class=\"fa fa-dollar\"></i></a>
                                          {% endif %}

                                          {% if p.factura == 0 %}
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                            <i class='glyphicon glyphicon-open'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/{{p.id_proyecto}}' target='_blank'  class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                          {% else %}
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                            <i class='glyphicon glyphicon-file'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/{{p.id_proyecto}}' target='_blank'  class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                          {% endif %}
                                      {% elseif db_perfil.perfil == 'CONTROL_ADMIN' %}
                                            {% if p.estado == '0'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar({{p.id_proyecto}})\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                {% if p.factura == 0 %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                {% else %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                {% endif %}
                                            {% elseif p.estado == '1'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/{{p.id_proyecto}}\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" onclick=\"eliminar({{p.id_proyecto}})\"  title=\"Eliminar\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                {% if p.factura == 0 %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                {% else %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                {% endif %}
                                            {% elseif p.estado == '2'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id='btncompletado' name='btncompletado' title='Completado' class='btn btn-warning btn-sm'><i class='fa fa-check-square-o'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' id='btnpagar' name='btnpagar' title='Pagar' onclick='pagar({{p.id_proyecto}})' class='btn btn-success btn-sm'><i class='fa fa-dollar'></i></a>
                                            <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar({{p.id_proyecto}})\" class='btn btn-danger btn-sm'>
                                            <i class='glyphicon glyphicon-remove'></i></a>
                                            {% if p.factura == 0 %}
                                              <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a></td>
                                            {% else %}
                                              <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a></td>
                                            {% endif %}
                                            {% elseif p.estado == '3'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/{{p.id_proyecto}}\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar({{p.id_proyecto}})\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                            {% elseif p.estado == '4'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completados' class='btn btn-primary btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                            {% if p.factura == 0 %}
                                              <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                              <i class='glyphicon glyphicon-open'></i></a>
                                            {% else %}
                                              <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                              <i class='glyphicon glyphicon-file'></i></a>
                                            {% endif %}
                                              <a data-toggle='tooltip' data-placement='top' id=\"btnimprimir\" name=\"btnimprimir\" title='Descargar PDF' href='avar/descargar_pdf/{{p.id_proyecto}}' target='_blank' class='btn btn-danger btn-sm'><i class=\"glyphicon glyphicon-save\"></i></a></td>
                                            {% endif %}
                                      {% else  %}
                                            {% if p.estado != '2'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnaprobar\" name=\"btnaprobar\" title='Completar' onclick=\"prevalidar({{p.id_proyecto}})\"  class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' id=\"btnmodificar\" name=\"btnmodificar\" title='Modificar' href=\"avar/editar_control/{{p.id_proyecto}}\" class='btn btn-success btn-sm'>
                                                <i class='glyphicon glyphicon-edit'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar({{p.id_proyecto}})\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                {% if p.factura == 0 %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                {% else %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                {% endif %}
                                            {% elseif p.estado == '0'  %}
                                            <td><a data-toggle='tooltip' data-placement='top' id=\"btnprevalidador\" name=\"btnprevalidador\" title='Aprobar' onclick=\"prevalidar({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                <i class='glyphicon glyphicon-ok'></i></a>
                                                <a data-toggle='tooltip' data-placement='top' name=\"btnlisteliminar\" id=\"btnlisteliminar\" title=\"Eliminar\" onclick=\"eliminar({{p.id_proyecto}})\" class='btn btn-danger btn-sm'>
                                                <i class='glyphicon glyphicon-remove'></i></a>
                                                {% if p.factura == 0 %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                {% else %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                {% endif %}
                                            {% else %}
                                                <td><a data-toggle='tooltip' data-placement='top' id=\"btncompletado\" name=\"btncompletado\" title='Completado' class='btn btn-success btn-sm'><i class=\"fa fa-check-square-o\"></i></a>
                                                {% if p.factura == 0 %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnsubir\" id=\"btnsubir\" title=\"Subir Archivo\" onclick=\"subirdoc({{p.id_proyecto}})\" class='btn btn-success btn-sm'>
                                                  <i class='glyphicon glyphicon-open'></i></a></td>
                                                {% else %}
                                                  <a data-toggle='tooltip' data-placement='top' name=\"btnverfactura\" id=\"btnverfactura\" title=\"Ver Factura\" onclick=\"verfactura({{p.id_proyecto}})\" class='btn btn-primary btn-sm'>
                                                  <i class='glyphicon glyphicon-file'></i></a></td>
                                                {% endif %}
                                            {% endif %}
                                       {% endif %}
                                  </tr>
                                  {% set No = No + 1 %}
                              {% endfor %}
                            </tbody>
                        </table>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
{% include 'avar/modal_orden' %}
{% include 'avar/modal_aprobacion' %}
{% include 'avar/modal_subirdocumento' %}
{% include 'avar/modal_factura' %}
{% endblock %}
{% block appScript %}

  <script src=\"views/app/template/datatables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/template/datatables/dataTables.bootstrap.min.js\" type=\"text/javascript\"></script>
  <script src=\"views/app/js/test/test.js\"></script>

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
{% endblock %}
", "portal/home.twig", "C:\\xampp\\htdocs\\recursos\\app\\templates\\portal\\home.twig");
    }
}
