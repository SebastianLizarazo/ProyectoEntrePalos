<?php
require_once("../../../app/Controllers/EmpresasController.php");
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\DepartamentosController;
use App\Controllers\MunicipiosController;
use  App\Controllers\EmpresasController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "Empresa"; //Nombre del Modelo
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION['frmCreate'.$pluralModel] ?? NULL; //Nombre del formulario (frmUsuarios)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear | <?= $nameModel ?></title>
    <?php require("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear una nueva <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Crear</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensaje de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Información de la <?= $nameModel ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form class="form-horizontal" method="post" id="frmCreate<?= $nameModel ?>"
                                      name="frmCreate<?= $nameModel ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="Nombre" name="Nombre"
                                                           placeholder="Ingrese el nombre de la empresa" value="<?= $frmSession['Nombre'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="NIT" class="col-sm-2 col-form-label">NIT</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="NIT" name="NIT"
                                                           placeholder="Ingrese el NIT de la empresa" value="<?= $frmSession['NIT'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Telefono" class="col-sm-2 col-form-label">Telefono</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" min="1111111111" max="9999999999" class="form-control" id="Telefono" name="Telefono"
                                                           placeholder="Ingrese el telefono de la empresa" value="<?= $frmSession['Telefono'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Direccion" class="col-sm-2 col-form-label">Direccion</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="Direccion" name="Direccion"
                                                           placeholder="Ingrese la direccion de la empresa" value="<?= $frmSession['Direccion'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select required id="Estado" name="Estado" class="custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Activo") ? "selected" : ""; ?> value="Activo">Activo</option>
                                                        <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Inactivo") ? "selected" : ""; ?> value="Inactivo">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="departamento_id" class="col-sm-2 col-form-label">Departamentos</label>
                                                <div class="col-sm-5">
                                                    <?= DepartamentosController::selectDepartamentos(
                                                        array(
                                                            'id' => 'departamento_id',
                                                            'name' => 'departamento_id',
                                                            'defaultValue' => (!empty($frmSession['departamento_id'])) ? $frmSession['departamento_id'] : '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    )
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Municipio_id" class="col-sm-2 col-form-label">Municipios</label>
                                                <div class="col-sm-5 ">
                                                    <?= MunicipiosController::selectMunicipios(array (
                                                        'id' => 'Municipio_id',
                                                        'name' => 'Municipio_id',
                                                        'defaultValue' => (!empty($frmSession['municipio_id'])) ? $frmSession['municipio_id'] : '',
                                                        'class' => 'form-control select2bs4 select2-info',
                                                        'where' => "departamento_id = 15 and estado = 'Activo'"))
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
<script>
    $(function() {
        $('#departamento_id').on('change', function() {
            $.post("../../../app/Controllers/MainController.php?controller=Municipios&action=selectMunicipios", {
                isMultiple: false,
                isRequired: true,
                id: "Municipio_id",
                nombre: "Municipio_id",
                defaultValue: "",
                class: "form-control select2bs4 select2-info",
                where: "departamento_id = "+$('#departamento_id').val()+" and estado = 'Activo'",
                request: 'ajax'
            }, function(e) {
                if (e)
                    console.log(e);
                $("#Municipio_id").html(e).select2({ height: '100px'});
            });
        });
        $('.btn-file span').html('Seleccionar');
    });
</script>
</body>
</html>

