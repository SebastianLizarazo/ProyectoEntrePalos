<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/DetallePedidosController.php");

use App\Controllers\DetallePedidosController;
use App\Models\GeneralFunctions;
use App\Models\DetallePedidos;

$nameModel = "DetallePedido";
$pluralModel = $nameModel . 's';
$frmSession = $_SESSION['frm' . $pluralModel] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title> Datos del | <?= $nameModel ?></title>
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
                        <h1>Informacion del <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Ver</li>
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
                        <div class="card card-green">
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) {
                                $DataDetallepedido = DetallePedidosController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataDetallepedido DetallePedidos */
                                if (!empty($DataDetallepedido)) {
                                    ?>
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Ver Información
                                            del detalle pedido N° <?= $DataDetallepedido->getId() ?> de la factura
                                            N° <?= $DataDetallepedido->getFactura()->getNumero() ?></h3>
                                        <div class="card-tools">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"
                                                    data-toggle="tooltip" title="Remove">
                                                <i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <p>
                                                    <strong><i class="fas fa-file-invoice-dollar"></i> &nbsp;Numero de factura</strong>
                                                <p class="text-muted"><?= $DataDetallepedido->getFactura()->getNumero() ?></p>
                                                <hr>
                                                <strong><i class="fas fa-hamburger"></i> &nbsp;Producto</strong>
                                                <p class="text-muted"><?= !empty($DataDetallepedido->getProducto()) ?
                                                        $DataDetallepedido->getProducto()->getNombre() : 'Sin producto' ?></p>
                                                <hr>
                                                <strong><i class="fas fa-piggy-bank"></i> &nbsp;Oferta</strong>
                                                <p class="text-muted"><?= !empty($DataDetallepedido->getOferta()) ?
                                                        $DataDetallepedido->getOferta()->getNombre() : 'Sin oferta' ?></p>
                                                <hr>
                                                <strong><i class="fas fa-sort-amount-up-alt"></i> &nbsp;Cantidad Producto</strong>
                                                <p class="text-muted"><?= $DataDetallepedido->getCantidadProducto()?? 0 ?></p>
                                                <hr>
                                                <strong><i class="fas fa-piggy-bank"></i>&nbsp;Cantidad Oferta</strong>
                                                <p class="text-muted"><?= $DataDetallepedido->getCantidadOferta()?? 0 ?></p>
                                                <hr>
                                                <strong><i class="fas fa-chair"></i> &nbsp;Numero de mesa</strong>
                                                <p class="text-muted"><?= !empty($DataDetallepedido->getMesa()) ?
                                                        $DataDetallepedido->getMesa()->getNumero() : 'Domicilio' ?></p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <a role="button" href="index.php" class="btn btn-success float-right"
                                                   style="margin-right: 5px;">
                                                    <i class="fas fa-tasks"></i> Gestionar <?= $pluralModel ?>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a role="button" href="edit.php?id=<?= $DataDetallepedido->getId(); ?>"
                                                   class="btn btn-primary float-right"
                                                   style="margin-right: 5px;">
                                                    <i class="fas fa-edit"></i> Editar <?= $nameModel ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php }
                            } ?>
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

