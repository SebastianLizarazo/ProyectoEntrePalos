<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/OfertasController.php");



use App\Controllers\OfertasController;
use App\Models\GeneralFunctions;
use App\Models\Ofertas;


$nameModel = "Oferta";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frmEdit'.$pluralModel] ?? null;

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
                                <h3 class="card-title"><i class="fas fa-info"></i>&nbsp; Información de la <?= $nameModel ?></h3>
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

                                $DataOferta =OfertasController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataOferta Ofertas */
                                if (!empty($DataOferta)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="frmEdit<?= $nameModel ?>"
                                              name="frmEdit<?= $nameModel ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataOferta->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Nombre"
                                                                   name="Nombre" value="<?= $DataOferta->getNombre(); ?>"
                                                                   placeholder="Ingrese el nombre de la oferta">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Descripcion" class="col-sm-2 col-form-label">Descripción</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Descripcion"
                                                                   name="Descripcion" value="<?= $DataOferta->getDescripcion(); ?>"
                                                                   placeholder="Ingrese la descripción de la oferta">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="PrecioUnidadVentaOferta" class="col-sm-2 col-form-label">Precio Unidad Venta Oferta</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" max="9999999" min="50" class="form-control" id="PrecioUnidadVentaOferta"
                                                                   name="PrecioUnidadVentaOferta" value="<?= $DataOferta->getPrecioUnidadVentaOferta(); ?>"
                                                                   placeholder="Ingrese el precio unidad venta oferta">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                        <div class="col-sm-10">
                                                            <select required id="Estado" name="Estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ($DataOferta->getEstado() == "Disponible") ? "selected" : ""; ?> value="Disponible">Disponible</option>
                                                                <option <?= ($DataOferta->getEstado() == "No disponible") ? "selected" : ""; ?> value="No disponible">No Disponible</option>
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
