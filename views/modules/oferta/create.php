<?php
    require("../../partials/routes.php");
    require_once("../../partials/check_login.php");

use App\Controllers\OfertasController;
use App\Models\GeneralFunctions;


$nameModel = "Oferta"; //Nombre del Modelo
$nameForm = 'frmCreate'.$nameModel;
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION[$nameForm]?? NULL;

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
                                <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Informaci??n de la <?= $nameModel ?></h3>
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
                                                    <label for="Nombre" class="col-sm-2 col-form-label">Nombre de oferta</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="Nombre" name="Nombre"
                                                               placeholder="Ingrese el nombre de la oferta" value="<?= $frmSession['Nombre'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Descripcion" class="col-sm-2 col-form-label">Descripci??n Oferta</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="Descripcion" name="Descripcion"
                                                               placeholder="Ingrese la descripci??n de la oferta" value="<?= $frmSession['Descripcion'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="PrecioUnidadVentaOferta" class="col-sm-2 col-form-label">Precio unidad venta en oferta</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" max="9999999" min="50" class="form-control" id="PrecioUnidadVentaOferta" name="PrecioUnidadVentaOferta"
                                                               placeholder="Ingrese el precio unidad venta oferta" value="<?= $frmSession['PrecioUnidadVentaOferta'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Estado" class="col-sm-2 col-form-label">Estado Oferta</label>
                                                    <div class="col-sm-10">
                                                        <select required id="Estado" name="Estado" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Disponible") ? "selected" : ""; ?> value="Disponible">Disponible</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "No disponible") ? "selected" : ""; ?> value="No disponible">No disponible</option>
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

