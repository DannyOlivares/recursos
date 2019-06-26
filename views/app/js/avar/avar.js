    function subirarchivoexcel() {
        $("#div_cargando").html($("#cargador").html());
        var formData = new FormData();
        formData.append("excel", document.getElementById("blindfile").files[0]);
        $.ajax({
            type: "POST",
            url: "api/cargar_excel_blindaje",
            contentType: false,
            processData: false,
            data: formData,
            success: function(json) {
                if (json.success == 1) {
                    msg_box_alert(json.success,"Registro Guardado",json.message,"reload");
                } else {
                    msg_box_alert(json.success, "Error", json.message);
                    $("#div_cargando").html(
                        '<a class="btn btn-success btn-social" title="Exportar a Excel" data-toggle="tooltip" onclick="subirarchivoexcel()"><i class="fa fa-arrow-up"></i> Cargar Turnos</a>'
                    );
                }
            },
            error: function(xhr, status) {
                $("#div_cargando").html(
                    '<a class="btn btn-success btn-social" title="Exportar a Excel" data-toggle="tooltip" onclick="subirarchivoexcel()"><i class="fa fa-arrow-up"></i> Cargar Turnos</a>'
                );
                msg_box_alert(99, "Error", xhr.responseText);
            }
        });
    }

    $("#bloqueAvR").on("change", function() {
        $("#listar_bloque_ejecutivo").html($("#cargador").html());
        $("#listar_pendiente_ordenes_n1").html($("#cargador").html());
        var bloque = document.getElementById("bloqueAvR").value;
        if (bloque != '--' ){
            var formData = new FormData();
            formData.append("bloque", bloque);
            $.ajax({
                type: "POST",
                url: "api/avar_traer_users",
                contentType: false,
                processData: false,
                data: formData,
                success: function(json) {
                    if (json.success == 1) {
                        $("#listar_bloque_ejecutivo").html(json.tabla);$("#listar_pendiente_ordenes_n1").html(json.tabla_pendiente);
                    } else {
                        $("#listar_bloque_ejecutivo").html("");$("#listar_pendiente_ordenes_n1").html("");
                        msg_box_alert(json.success, "Error", json.message);
                    }
                },
                error: function(xhr, status) {
                    $("#listar_bloque_ejecutivo").html("");$("#listar_pendiente_ordenes_n1").html("");
                    msg_box_alert(99, "Error", xhr.responseText);
                }
            });
        }else{
            $("#listar_bloque_ejecutivo").html("");$("#listar_pendiente_ordenes_n1").html("");
        }
    });
    function des_marcar_ejecutivo(id,nivel,bloque){
        contenido_div = $("#div-"+id).html();
        $("#div-"+id).html($("#cargador").html());
        var formData = new FormData();
        formData.append("id_user", id);
        formData.append("nivel", nivel);
        formData.append("bloque", bloque);
        formData.append("check", document.getElementById('check-'+id).checked?1:0);
        $.ajax({
            type: "POST",
            url: "api/avar_des_marcar_ejecutivo",
            contentType: false,
            processData: false,
            data: formData,
            success: function (json) {
                $("#div-"+id).html(contenido_div);
            },
            error: function (xhr, status) {
                $("#div-"+id).html(0);
                msg_box_alert(99, "Error", xhr.responseText);
            }
        });
    }
