<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/PagosController.php");

use App\Controllers\UsuariosController;
use App\Controllers\PagosController;
use App\Models\GeneralFunctions;
use App\Models\Pagos;
use Carbon\Carbon;


$nameModel = "Pago";
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

                                $Datapago = PagosController::searchForID(["id" => $_GET["id"]]);
                                /* @var $Datapago Pagos */
                                if (!empty($Datapago)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $Datapago->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Trabajador_id" class="col-sm-2 col-form-label">Trabajador</label>
                                                        <div class="col-sm-10">
                                                            <?= UsuariosController::selectUsuario(
                                                                array(
                                                                    'id' => 'Trabajador_id',
                                                                    'name' => 'Trabajador_id',
                                                                    'defaultValue' =>$Datapago->getTrabajadorId(),
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Activo' and rol = 'Mesero' or rol = 'Proveedor' or rol = 'Domiciliario' or rol = 'Cocinero'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Fecha" class="col-sm-2 col-form-label">Fecha</label>
                                                        <div class="col-sm-10">
                                                            <input required type="date" max="<?= Carbon::now()->format('Y-m-d')?>" class="col-sm-3 form-control" id="Fecha" name="Fecha"
                                                                   value="<?= $Datapago->getFecha()->toDateString()?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ValorPago" class="col-sm-2 col-form-label">Valor</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" min="111111" max="9999999" class="col-sm-3 form-control" id="ValorPago" name="ValorPago"
                                                                   value="<?= $Datapago->getValorPago() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                        <div class="col-sm-10">
                                                            <select required id="Estado" name="Estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ($Datapago->getEstado() == "Pendiente") ? "selected" : ""; ?> value="Pendiente">Pendiente</option>
                                                                <option <?= ($Datapago->getEstado() == "Saldado") ? "selected" : ""; ?> value="Saldado">Saldado</option>
                                                            </select>
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
