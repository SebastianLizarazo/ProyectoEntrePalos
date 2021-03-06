<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\OfertasController;
use App\Controllers\ProductosController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "Imagen";
$nameForm = 'frmCreate'.$nameModel;
$pluralModel = $nameModel.'es';
$frmSession = $_SESSION[$nameForm] ?? NULL;


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
                        <h1>Crear una nueva <?= $nameModel ?> <?= !empty($_SESSION['idProducto']) ? 'de '.$_SESSION['idProducto']->getNombre() : '' ?></h1>
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
                                <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Informaci??n de la <?= $nameModel ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                      name="<?= $nameForm ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-8">
                                            <div class="form-group row">
                                                <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="Nombre" name="Nombre"
                                                           placeholder="Ingrese el nombre" value="<?= $frmSession['Nombre'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Descripcion" class="col-sm-2 col-form-label">Descripci??n</label>
                                                <div class="col-sm-10">
                                                    <textarea required class="form-control" id="Descripcion" name="Descripcion" rows="4"
                                                      placeholder="Ingrese una descripci??n"><?= $frmSession['Descripcion'] ?? '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Producto_id" class="col-sm-2 col-form-label">Producto</label>
                                                <div class="col-sm-10">
                                                    <?= ProductosController::selectProducto(
                                                        array (
                                                            'isRequired' => false,
                                                            'id' => 'Producto_id',
                                                            'name' => 'Producto_id',
                                                            'defaultValue' => $frmSession['Producto_id'] ?? '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    )
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Oferta_id" class="col-sm-2 col-form-label">Oferta</label>
                                                <div class="col-sm-10">
                                                    <?= OfertasController::selectOferta(
                                                        array (
                                                            'isRequired' => false,
                                                            'id' => 'Oferta_id',
                                                            'name' => 'Oferta_id',
                                                            'defaultValue' => $frmSession['Oferta_id'] ?? '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Disponible'"
                                                        )
                                                    )
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select required id="Estado" name="Estado" class="custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Activo") ? "selected" : ""; ?>
                                                                 value="Activo">Activo
                                                        </option>
                                                        <option <?= (!empty($frmSession['Estado']) && $frmSession['Estado'] == "Inactivo") ? "selected" : ""; ?>
                                                                 value="Inactivo">Inactivo
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="info-box">
                                                <div class="imageupload panel panel-primary ml-2">
                                                    <div class="panel-heading clearfix">
                                                        <h5 class="panel-title pull-left">Seleccionar foto:</h5>
                                                    </div>
                                                    <div class="file-tab panel-body">
                                                        <div class="row">
                                                            <label class="btn btn-default btn-file">
                                                                <span>Seleccionar</span>
                                                                <!-- The file is stored here. -->
                                                                <input required type="file" id="Imagen" name="Imagen">
                                                            </label>
                                                            <button type="button" class="btn btn-default">Eliminar</button>
                                                        </div>
                                                    </div>
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
