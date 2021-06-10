<?php
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");
require_once("../../../app/Controllers/DetallePedidosController.php");


use App\Controllers\DetallePedidosController;
use App\Controllers\FacturasController;
use App\Controllers\MesasController;
use App\Controllers\OfertasController;
use App\Controllers\ProductosController;
use App\Models\GeneralFunctions;
use App\Models\DetallePedidos;


$nameModel = "Detalle Pedido";
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
                                <h3 class="card-title"><i class="fas fa-info"></i>&nbsp; Información del <?= $nameModel ?></h3>
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

                                $DataDetallepedido = DetallePedidosController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataDetallepedido DetallePedidos */
                                if (!empty($DataDetallepedido)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="frmEdit<?= $nameModel ?>"
                                              name="frmEdit<?= $nameModel ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataDetallepedido->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Factura_id" class="col-sm-2 col-form-label">Numero de factura</label>
                                                        <div class="col-sm-10">
                                                            <?=FacturasController::selectFactura(
                                                                array(
                                                                    'id' => 'Factura_id',
                                                                    'name' => 'Factura_id',
                                                                    'defaultValue' => '1',
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Producto_id" class="col-sm-2 col-form-label">Producto</label>
                                                        <div class="col-sm-10">
                                                            <?= ProductosController::selectProducto(
                                                                array(
                                                                    'id' => 'Producto_id',
                                                                    'name' => 'Producto_id',
                                                                    'defaultValue' => '1',
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Activo'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Ofertas_id" class="col-sm-2 col-form-label">Oferta</label>
                                                        <div class="col-sm-10">
                                                            <?= OfertasController::selectOferta(
                                                                array(
                                                                    'id' => 'Oferta_id',
                                                                    'name' => 'Oferta_id',
                                                                    'defaultValue' => '1',
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Disponible'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="CantidadProducto" class="col-sm-2 col-form-label">Cantidad Producto</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="CantidadProducto"
                                                                   name="CantidadProducto" value="<?= $DataDetallepedido->getCantidadProducto(); ?>"
                                                                   placeholder="Ingrese la cantidad del producto">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="CantidadOferta" class="col-sm-2 col-form-label">Cantidad Oferta</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" class="form-control" id="CantidadOferta"
                                                                   name="CantidadOferta" value="<?= $DataDetallepedido->getCantidadProducto(); ?>"
                                                                   placeholder="Ingrese la cantidad de oferta">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="Mesa_id" class="col-sm-2 col-form-label">Numero de mesa</label>
                                                        <div class="col-sm-10">
                                                            <?= MesasController::selectMesa(
                                                                array(
                                                                    'id' => 'Mesa_id',
                                                                    'name' => 'Mesa_id',
                                                                    'defaultValue' => '1',
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "Ocupacion = 'Disponible'"
                                                                )
                                                            )
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

