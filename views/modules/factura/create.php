<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\FacturasController;
use App\Controllers\UsuariosController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "Factura"; //Nombre del Modelo
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL; //Nombre del formulario (frmUsuarios)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear | <?= $nameModel ?></title>
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
                        <h1>Crear una nueva <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Crear</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensaje de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Información de la <?= $nameModel ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <!-- form start -->
                                <form class="form-horizontal" method="post" id="frmCreate<?= $nameModel ?>"
                                      name="frmCreate<?= $nameModel ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">
                                      <div class="row">
                                          <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="Numero" class="col-sm-2 col-form-label">Numero</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" class="form-control" id="Numero" name="Numero"
                                                               placeholder="Ingrese el numero de la factura" value="<?= $frmSession['Numero'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Fecha" class="col-sm-2 col-form-label">Fecha</label>
                                                    <div class="col-sm-10">
                                                        <input required type="date" max="<?= Carbon::now()->format('Y-m-d')?>" class="col-sm-3 form-control" id="Fecha" name="Fecha"
                                                               value="<?= $frmSession['Fecha'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="IVA" class="col-sm-2 col-form-label">IVA</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" step="0.01" class="form-control" id="IVA" name="IVA"
                                                               placeholder="IVA" value="<?= $frmSession['IVA'] ?? '0.19' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="MedioPago" class="col-sm-2 col-form-label">Medio de pago</label>
                                                    <div class="col-sm-10">
                                                        <select required id="MedioPago" name="MedioPago" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['MedioPago']) && $frmSession['MedioPago'] == "Datafono") ? "selected" : ""; ?> value="Datafono">Datafono</option>
                                                            <option <?= ( !empty($frmSession['MedioPago']) && $frmSession['MedioPago'] == "Efectivo") ? "selected" : ""; ?> value="Efectivo">Efectivo</option>
                                                            <option <?= ( !empty($frmSession['MedioPago']) && $frmSession['MedioPago'] == "Nequi") ? "selected" : ""; ?> value="Nequi">Nequi</option>
                                                            <option <?= ( !empty($frmSession['MedioPago']) && $frmSession['MedioPago'] == "Ahorro a la mano") ? "selected" : ""; ?> value="Ahorro a la mano">Ahorro a la mano</option>
                                                            <option <?= ( !empty($frmSession['MedioPago']) && $frmSession['MedioPago'] == "Daviplata") ? "selected" : ""; ?> value="Daviplata">Daviplata</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Mesero_id" class="col-sm-2 col-form-label">Mesero</label>
                                                    <div class="col-sm-10">
                                                        <?= UsuariosController::selectUsuario(
                                                            array(
                                                                'id' => 'Mesero_id',
                                                                'name' => 'Mesero_id',
                                                                'defaultValue' => (!empty($frmSession['MedioPago']))? $frmSession['MedioPago']:'',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo' and rol = 'Mesero'"
                                                            )
                                                        )
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                    <div class="col-sm-10">
                                                        <select required name="Estado" id="Estado" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Pendiente") ? "selected" : ""; ?>value="Pendiente">Pendiente</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Paga") ? "selected" : ""; ?>value="Paga">Paga</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Cancelada") ? "selected" : ""; ?>value="Cancelada">Cancelada</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="TipoPedido" class="col-sm-2 col-form-label">Tipo de pedido</label>
                                                    <div class="col-sm-10">
                                                        <select required name="TipoPedido" id="TipoPedido" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['TipoPedido']) && $frmSession['TipoPedido'] == "Mesa") ? "selected" : ""; ?>value="Mesa">Mesa</option>
                                                            <option <?= ( !empty($frmSession['TipoPedido']) && $frmSession['TipoPedido'] == "Domicilio") ? "selected" : ""; ?>value="Domicilio">Domicilio</option>
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

