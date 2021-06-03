<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/MesasController.php");


use App\Controllers\MesasController;
use App\Models\GeneralFunctions;
use App\Models\Mesas;


$nameModel = "Mesa";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frm'.$pluralModel] ?? null;

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE']  ?> | Editar <?= $nameModel ?></title>
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
                        <h1>Editar <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensajes de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <?= (empty($_GET['id'])) ? GeneralFunctions::getAlertDialog('error', 'Faltan Criterios de Búsqueda') : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i>&nbsp; Información del <?= $nameModel ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                            data-source="create.php" data-source-selector="#card-refresh-content"
                                            data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                                <p>
                                <?php

                                $DataMesa = MesasController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataMesa Mesas */
                                if (!empty($DataMesa)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="frmEdit<?= $nameModel ?>"
                                              name="frmEdit<?= $nameModel ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataMesa->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Numero" class="col-sm-2 col-form-label">Numero</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Numero"
                                                                   name="Numero" value="<?= $DataMesa->getNumero(); ?>"
                                                                   placeholder="Ingrese el numero de la mesa">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Ubicacion" class="col-sm-2 col-form-label">Ubicacion</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Ubicacion"
                                                                   name="Ubicacion" value="<?= $DataMesa->getUbicacion(); ?>"
                                                                   placeholder="Ingrese la ubicacion de la mesa">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Capacidad" class="col-sm-2 col-form-label">Capacidad</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Capacidad"
                                                                   name="Capacidad" value="<?= $DataMesa->getCapacidad(); ?>"
                                                                   placeholder="Ingrese la capacidad de la mesa">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Ocupacion" class="col-sm-2 col-form-label">Ocupación</label>
                                                        <div class="col-sm-10">
                                                            <select required id="Ocupacion" name="Ocupacion" class="custom-select">
                                                                <option <?= ($DataMesa->getOcupacion() == "disponible") ? "selected" : ""; ?> value="disponible">disponible</option>
                                                                <option <?= ($DataMesa->getOcupacion() == "ocupada") ? "selected" : ""; ?> value="ocupada">ocupada</option>
                                                            </select>
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

                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php } ?>
                                </p>
                            <?php } ?>
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

</body>
</html>
