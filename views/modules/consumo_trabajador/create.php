<?php
require_once("../../../app/Controllers/ConsumoTrabajadoresController.php");
require("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\ConsumoTrabajadoresController;
use App\Controllers\PagosController;
use App\Controllers\ProductosController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "Consumo trabajador"; //Nombre del Modelo
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL; //Nombre del formulario (frmUsuarios)
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Crear <?= $nameModel ?></title>
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
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                            data-source="create.php" data-source-selector="#card-refresh-content"
                                            data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
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
                                                    <label for="PagoId" class="col-sm-2 col-form-label">Numero de pago</label>
                                                    <div class="col-sm-10">
                                                        <?= PagosController::selectPago
                                                        (array (
                                                                'id' => 'Pago_id',
                                                                'name' => 'Pago_id',
                                                                'defaultValue' => (!empty($frmSession['pago_id'])) ? $frmSession['pago_id'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Pendiente'"
                                                            )
                                                        )
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ProductoId" class="col-sm-2 col-form-label">Producto</label>
                                                    <div class="col-sm-10">
                                                        <?= ProductosController::selectProducto
                                                        (array (
                                                                'id' => 'Producto_id',
                                                                'name' => 'Producto_id',
                                                                'defaultValue' => (!empty($frmSession['producto_id'])) ? $frmSession['producto_id'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo'"
                                                            )
                                                        )
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="CantidadProducto" class="col-sm-2 col-form-label">Cantidad del producto</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" class="form-control" id="CantidadProducto" name="CantidadProducto"
                                                               placeholder="Ingrese la cantidad del producto" value="<?= $frmSession['CantidadProducto'] ?? '' ?>">
                                                    </div>
                                                </div>
                                              <div class="form-group row">
                                                  <label for="Descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                                  <div class="col-sm-10">
                                                      <input required type="text" class="form-control" id="Descripcion" name="Descripcion"
                                                             placeholder="Ingrese una descripcion" value="<?= $frmSession['Descripcion'] ?? '' ?>">
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

