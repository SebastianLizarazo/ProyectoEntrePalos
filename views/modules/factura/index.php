<?php
require_once("../../../app/Controllers/FacturasController.php");
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\FacturasController;
use App\Models\GeneralFunctions;
use App\Models\Facturas;

$nameModel = "Factura";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Gestión de <?= $pluralModel ?></title>
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
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Gestionar <?= $pluralModel ?></h3>
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
                                        <a role="button" href="create.php" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i>&nbsp; Crear <?= $nameModel ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tbl<?= $pluralModel ?>" class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Numero</th>
                                                <th>Fecha</th>
                                                <th>IVA</th>
                                                <th>Medio de pago</th>
                                                <th>Mesero</th>
                                                <th>Estado</th>
                                                <th>Tipo de pedido</th>
                                                <th>Cambiar estado</th>
                                                <th>Mas acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $arrFacturas = FacturasController::getAll();
                                            if (!empty($arrFacturas))
                                            /* @var $arrFacturas Facturas */
                                            foreach ($arrFacturas as $factura) {
                                                if ($factura->getEstado() != 'Cancelada'){/*No va a mostrar las facuras que esten canceladas */
                                                    ?>
                                                    <tr>
                                                        <td><?= $factura->getId(); ?></td>
                                                        <td><?= $factura->getNumero(); ?></td>
                                                        <td><?= $factura->getFecha(); ?></td>
                                                        <td><?= $factura->getIVA(); ?></td>
                                                        <td><?= $factura->getMedioPago(); ?></td>
                                                        <td><?= $factura->getMeseroId(); ?></td>
                                                        <td><?= $factura->getEstado(); ?></td>
                                                        <td><?= $factura->getTipoPedido(); ?></td>
                                                        <td>
                                                            <?php if ($factura->getEstado() == "Pendiente") { ?>
                                                                <a href="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=statusPaga&id=<?= $factura->getId(); ?>"
                                                                   type="button" data-toggle="tooltip" title="Pagada"
                                                                   class="btn docs-tooltip btn-success btn-xs"><i
                                                                            class="far fa-check-circle"></i></a>
                                                            <?php } elseif($factura->getEstado() == "Paga") { ?>
                                                                <a href="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=statusPendiente&id=<?= $factura->getId(); ?>"
                                                                   type="button" data-toggle="tooltip" title="Pendiente"
                                                                   class="btn docs-tooltip btn-primary btn-xs"><i
                                                                            class="fa fa-times-circle"></i></a>
                                                            <?php }else{ ?>
                                                                <a href="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=statusPendiente&id=<?= $factura->getId(); ?>"
                                                                   type="button" data-toggle="tooltip" title="Restaurar"
                                                                   class="btn docs-tooltip btn-success btn-xs"><i
                                                                            class="fas fa-undo-alt"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="edit.php?id=<?= $factura->getId(); ?>"
                                                               type="button" data-toggle="tooltip" title="Actualizar"
                                                               class="btn docs-tooltip btn-primary btn-xs"><i
                                                                        class="fa fa-edit"></i></a>
                                                            <a href="show.php?id=<?= $factura->getId(); ?>"
                                                               type="button" data-toggle="tooltip" title="Ver"
                                                               class="btn docs-tooltip btn-warning btn-xs"><i
                                                                        class="fa fa-eye"></i></a>
                                                            <a href="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=statusCancelada&id=<?= $factura->getId(); ?>"
                                                               type="button" data-toggle="tooltip" title="Cancelar factura"
                                                               class="btn docs-tooltip btn-danger btn-xs"><i
                                                                        class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                               }
                                            } ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Numero</th>
                                                <th>Fecha</th>
                                                <th>IVA</th>
                                                <th>Medio de pago</th>
                                                <th>Mesero</th>
                                                <th>Estado</th>
                                                <th>Tipo de pedido</th>
                                                <th>Cambiar estado</th>
                                                <th>Mas acciones</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="col-auto mr-auto"></div>
                                <div class="col-auto">
                                    <a role="button" href="restore.php" class="btn btn-primary float-left"
                                       style="margin-right: 5px;">
                                        <i class="fas fa-undo-alt"></i>&nbsp;Restaurar <?= $pluralModel ?>
                                    </a>
                                </div>
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
