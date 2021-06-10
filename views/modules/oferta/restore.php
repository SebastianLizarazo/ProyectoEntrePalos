<?php
require_once("../../../app/Controllers/OfertasController.php");
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\OfertasController;
use App\Models\GeneralFunctions;
use App\Models\Ofertas;

$nameModel = "Oferta";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Papelera de | <?= $pluralModel ?></title>
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
                        <h1>Papelera</h1>
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
                                <h3 class="card-title"><i class="fas fa-trash-restore"></i> &nbsp; Restaurar <?= $pluralModel ?></h3>
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
                                        <a role="button" href="index.php" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-backward"></i> Volver
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tbl<?= $pluralModel ?>" class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Precio de unidad venta oferta</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $arrOfertas = OfertasController::getAll();
                                            if (!empty($arrOfertas))
                                                /* @var $arrOfertas Ofertas */
                                                foreach ($arrOfertas as $oferta) {
                                                    if ($oferta->getEstado() == 'No disponible'){
                                                        ?>
                                                        <tr>
                                                        <td><?= $oferta->getId(); ?></td>
                                                        <td><?= $oferta->getNombre(); ?></td>
                                                        <td><?= $oferta->getDescripcion(); ?></td>
                                                        <td><?= $oferta->getPrecioUnidadVentaOferta(); ?></td>
                                                        <td><?= $oferta->getEstado(); ?></td>
                                                            <td>
                                                                <div style="text-align: center;">
                                                                        <a href="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=restaurar&id=<?= $oferta->getId(); ?>"
                                                                           type="button" data-toggle="tooltip" title="Restaurar"
                                                                           class="btn docs-tooltip btn-success btn-xs"><i
                                                                                class="fas fa-undo-alt"></i></a>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Precio de unidad venta oferta</th>
                                                <th>Estado</th>
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
