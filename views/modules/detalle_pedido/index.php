<?php
require_once("../../../app/Controllers/DetallePedidosController.php");
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\DetallePedidosController;
use App\Models\GeneralFunctions;
use App\Models\DetallePedidos;

$nameModel = "Detalle Pedido";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title> Gestión de | <?= $pluralModel ?></title>
    <?php require("../../partials/head_imports.php"); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require_once("../../partials/navbar_customization.php"); ?>

    <?php require_once("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pagina Principal</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item active"><?= $pluralModel ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensajes de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Default box -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-search"></i> &nbsp; Gestionar <?= $pluralModel ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <a role="button" href="create.php<?= (!empty($_GET['idFactura'])) ? '?idFactura='.$_GET['idFactura'] : '' ?>" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i> Crear <?= $nameModel ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tbl<?= $pluralModel ?>" class="datatable table table-bordered table-striped display responsive nowrap"
                                            style="width:100%;">
                                            <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Numero de Factura</th>
                                                <th>Producto</th>
                                                <th>Oferta</th>
                                                <th>Cantidad Producto</th>
                                                <th>Cantidad Oferta</th>
                                                <th class="none">Numero de mesa:</th>
                                                <th data-priority="1">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($_GET['idFactura'])) {
                                                $arrDetallepedidos = DetallePedidos::search('SELECT * FROM detallepedido where Factura_id = '.$_GET['idFactura']);
                                            }else{
                                                $arrDetallepedidos = DetallePedidosController::getAll();
                                            }
                                            if (!empty($arrDetallepedidos))
                                                /* @var $arrDetallepedidos DetallePedidos */
                                                foreach ($arrDetallepedidos as $detallepedido) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $detallepedido->getId(); ?></td>
                                                        <td><?= $detallepedido->getFactura()->getNumero() ?></td>
                                                        <td><?= $detallepedido->getProducto()?->getNombre() ?? 'Sin Producto'; ?></td>
                                                        <td><?= $detallepedido->getOferta()?->getNombre() ?? 'Sin oferta'; ?></td>
                                                        <td><?= $detallepedido->getCantidadProducto() ?? 0; ?></td>
                                                        <td><?= $detallepedido->getCantidadOferta() ?? 0; ?></td>
                                                        <td><?= $detallepedido->getMesa()?->getNumero() ?? 'Domicilio'; ?></td>
                                                        <td>
                                                            <div  style="text-align: center;">
                                                            <a href="edit.php?id=<?= $detallepedido->getId(); ?>"
                                                               type="button" data-toggle="tooltip" title="Actualizar"
                                                               class="btn docs-tooltip btn-primary btn-xs"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="show.php?id=<?= $detallepedido->getId(); ?>"
                                                               type="button" data-toggle="tooltip" title="Ver"
                                                               class="btn docs-tooltip btn-warning btn-xs"><i
                                                                    class="fa fa-eye"></i></a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>N°</th>
                                                <th>Numero de Factura</th>
                                                <th>Producto</th>
                                                <th>Oferta</th>
                                                <th>Cantidad Producto</th>
                                                <th>Cantidad Oferta</th>
                                                <th>Numero de mesa</th>
                                                <th>Acciones</th>

                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>
                            <!-- /.card-footer-->
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
<!-- Scripts requeridos para las datatables -->
<?php require('../../partials/datatables_scripts.php'); ?>

</body>
</html>

