<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/DetalleOfertasController.php");


use App\Controllers\DetalleOfertasController;
use App\Controllers\OfertasController;
use App\Controllers\ProductosController;
use App\Models\GeneralFunctions;
use App\Models\DetalleOfertas;


$nameModel = "DetalleOferta";
$nameForm = 'frmEdit'.$nameModel;
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION[$nameForm] ?? null;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar | <?= $nameModel ?></title>
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
            <?= (empty($_GET['id'])) ? GeneralFunctions::getAlertDialog('error', 'Faltan Criterios de B??squeda') : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info"></i>&nbsp; Informaci??n del <?= $nameModel ?></h3>
                                <div class="card-tools">
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

                                $DataDetalleO = DetalleOfertasController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataDetalleO DetalleOfertas */
                                if (!empty($DataDetalleO)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataDetalleO->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Numero" class="col-sm-2 col-form-label">Producto</label>
                                                        <div class="col-sm-10">
                                                            <?= ProductosController::selectProducto
                                                            (array (
                                                                    'id' => 'Producto_id',
                                                                    'name' => 'Producto_id',
                                                                    'defaultValue' =>  $DataDetalleO->getProductoId(),
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Activo'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Numero" class="col-sm-2 col-form-label">Oferta</label>
                                                        <div class="col-sm-10">
                                                            <?= OfertasController::selectOferta
                                                            (array (
                                                                    'id' => 'Oferta_id',
                                                                    'name' => 'Oferta_id',
                                                                    'defaultValue' => $DataDetalleO->getOfertaId(),
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Disponible'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="CantidadProducto" class="col-sm-2 col-form-label">Cantidad de producto</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" max="50" class="form-control" id="CantidadProducto"
                                                                   name="CantidadProducto" value="<?= $DataDetalleO->getCantidadProducto(); ?>"
                                                                   placeholder="Ingrese la cantidad de producto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <button id="frmName" name="frmName" value="<?= $nameForm ?>" type="submit" class="btn btn-info">Enviar</button>
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
