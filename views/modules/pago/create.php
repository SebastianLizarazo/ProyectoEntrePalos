<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Models\GeneralFunctions;
use Carbon\Carbon;
use App\Controllers\UsuariosController;

$nameModel = "Pago"; //Nombre del Modelo
$nameForm = 'frmCreate'.$nameModel;
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION[$nameForm]?? NULL; //Nombre del formulario (frmUsuarios)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear |  <?= $nameModel ?></title>
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
                        <h1>Crear un nuevo <?= $nameModel ?></h1>
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
                                <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Información del <?= $nameModel ?></h3>
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
                                <form class="form-horizontal" method="post" id="<?= $nameForm ?>"
                                      name="<?= $nameForm ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">
                                      <div class="row">
                                          <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="Trabajador_id" class="col-sm-2 col-form-label">Trabajador</label>
                                                    <div class="col-sm-10">
                                                        <?= UsuariosController::selectUsuario(
                                                            array(
                                                                'id' => 'Trabajador_id',
                                                                'name' => 'Trabajador_id',
                                                                'defaultValue' => $frmSession['Trabajador_id'] ?? '',
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
                                                        <input required type="date" class="col-sm-3 form-control" id="Fecha" name="Fecha"
                                                                value="<?= $frmSession['Fecha'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ValorPago" class="col-sm-2 col-form-label">Valor</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" min="111111" max="9999999" class="col-sm-3 form-control" id="ValorPago" name="ValorPago"
                                                                value="<?= $frmSession['ValorPago'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                    <div class="form-group row">
                                                        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                                        <div class="col-sm-10">
                                                            <select required id="estado" name="estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( !empty($frmSession['estado']) && $frmSession['estado'] == "Pendiente") ? "selected" : ""; ?> value="Pendiente">Pendiente</option>
                                                                <option <?= ( !empty($frmSession['estado']) && $frmSession['estado'] == "Saldado") ? "selected" : ""; ?> value="Saldado">Saldado</option>
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

