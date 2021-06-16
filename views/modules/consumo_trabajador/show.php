<?php
require_once("../../../app/Controllers/ConsumoTrabajadoresController.php");
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\ConsumoTrabajadoresController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "ConsumoTrabajador";
$pluralModel = $nameModel . 'es';
$frmSession = $_SESSION['frm' . $pluralModel] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Datos del | <?= $nameModel ?></title>
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
                        <h1>Información del <?= $nameModel ?></h1>
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
                                $DataConsumoT = ConsumoTrabajadoresController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataConsumoT \App\Models\ConsumoTrabajadores */
                                if (!empty($DataConsumoT)) {
                                    ?>
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Ver Información
                                            del consumo de trabajador numero <?= $DataConsumoT->getId() ?> del trabajador
                                            <?= $DataConsumoT->getPagos()->getTrabajador()->getNombres().' '.
                                            $DataConsumoT->getPagos()->getTrabajador()->getApellidos() ?></h3>
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
                                            <div class="col-sm-10">
                                                <p>
                                                    <strong><i class="nav-icon fas fa-dollar-sign"></i>&nbsp;Pago</strong>
                                                        <p class="text-muted"><?= 'El pago numero '.$DataConsumoT->getPagoId()
                                                        .' de '.$DataConsumoT->getPagos()->getTrabajador()->getNombres().' '.
                                                        $DataConsumoT->getPagos()->getTrabajador()->getApellidos() .' - '.
                                                        $DataConsumoT->getPagos()->getFecha()->format('Y-m-d') ?></p>
                                                <hr>
                                                    <strong><i class="fas fa-hamburger"></i>&nbsp;Producto</strong>
                                                        <p class="text-muted"><?= $DataConsumoT->getProducto()->getNombre() ?></p>
                                                <hr>
                                                    <strong><i class="fas fa-sort-numeric-up-alt"></i>&nbsp;Cantidad Producto</strong>
                                                        <p class="text-muted"><?= $DataConsumoT->getCantidadProducto() ?></p>
                                                <hr>
                                                    <strong><i class="fas fa-file-alt"></i>&nbsp;Descripción</strong>
                                                        <p class="text-muted"><?= $DataConsumoT->getDescripcion() ?></p>
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
                                                <a role="button" href="edit.php?id=<?= $DataConsumoT->getId(); ?>"
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
