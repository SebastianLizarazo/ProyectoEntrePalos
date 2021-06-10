<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/FacturasController.php");


use App\Controllers\FacturasController;
use App\Models\GeneralFunctions;
use App\Models\Facturas;
use Carbon\Carbon;


$nameModel = "Factura";
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

                                $DataFactura = FacturasController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataFactura Facturas */
                                if (!empty($DataFactura)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="frmEdit<?= $nameModel ?>"
                                              name="frmEdit<?= $nameModel ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Numero" class="col-sm-2 col-form-label">Numero</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" class="form-control" id="Numero" name="Numero"
                                                                   placeholder="Ingrese el numero de la factura" value="<?= $DataFactura->getNumero() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Fecha" class="col-sm-2 col-form-label">Fecha</label>
                                                        <div class="col-sm-10">
                                                            <input required type="date" max="<?= Carbon::now()->format('Y-m-d')?>" class="col-sm-3 form-control" id="Fecha" name="Fecha"
                                                                   value="<?= $DataFactura->getFecha()->toDateString()?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="IVA" class="col-sm-2 col-form-label">IVA</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" step="0.01" class="form-control" id="IVA" name="IVA"
                                                                   placeholder="IVA" value="<?= $DataFactura->getIVA() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="MedioPago" class="col-sm-2 col-form-label">Medio de pago</label>
                                                        <div class="col-sm-10">
                                                            <select required id="MedioPago" name="MedioPago" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataFactura->getMedioPago() == "Datafono") ? "selected" : ""; ?> value="Datafono">Datafono</option>
                                                                <option <?= ( $DataFactura->getMedioPago() == "Efectivo") ? "selected" : ""; ?> value="Efectivo">Efectivo</option>
                                                                <option <?= ( $DataFactura->getMedioPago() == "Nequi") ? "selected" : ""; ?> value="Nequi">Nequi</option>
                                                                <option <?= ( $DataFactura->getMedioPago() == "Ahorro a la mano") ? "selected" : ""; ?> value="Ahorro a la mano">Ahorro a la mano</option>
                                                                <option <?= ( $DataFactura->getMedioPago() == "Daviplata") ? "selected" : ""; ?> value="Daviplata">Daviplata</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Mesero_id" class="col-sm-2 col-form-label">Mesero id</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" step="0.01" class="form-control" id="Mesero_id" name="Mesero_id"
                                                                   placeholder="Ingrese el id del mesero" value="<?= $DataFactura->getMeseroId() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                        <div class="col-sm-10">
                                                            <select required name="Estado" id="Estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataFactura->getEstado() == "Pendiente") ? "selected" : ""; ?> value="Pendiente" >Pendiente</option>
                                                                <option <?= ( $DataFactura->getEstado() == "Paga") ? "selected" : ""; ?> value="Paga" >Paga</option>
                                                                <option <?= ( $DataFactura->getEstado() == "Cancelada") ? "selected" : ""; ?> value="Cancelada" >Cancelada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="TipoPedido" class="col-sm-2 col-form-label">Tipo de pedido</label>
                                                        <div class="col-sm-10">
                                                            <select required name="TipoPedido" id="TipoPedido" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataFactura->getTipoPedido() == "Mesa") ? "selected" : ""; ?> value="Mesa" >Mesa</option>
                                                                <option <?= ( $DataFactura->getTipoPedido() == "Domicilio") ? "selected" : ""; ?> value="Domicilio" >Domicilio</option>
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
