<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/ImagenesController.php");

use App\Controllers\ImagenesController;
use App\Controllers\ProductosController;
use App\Models\Imagenes;
use App\Models\GeneralFunctions;

$nameModel = "Imagen";
$pluralModel = $nameModel.'es';
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL;
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
                        <h1>Informacion de la <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
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
            <?= (empty($_GET['id'])) ? GeneralFunctions::getAlertDialog('error', 'Faltan Criterios de B??squeda') : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-green">
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) {
                                $DataImagen = ImagenesController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataImagen Imagenes */
                                if (!empty($DataImagen)) {
                                    ?>
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Ver Informaci??n
                                            de la imagen <?= $DataImagen->getNombre() ?? '' ?></h3>
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
                                                <strong><i class="fas fa-signature"></i> Nombre</strong>
                                                <p class="text-muted">
                                                    <?= $DataImagen->getNombre() ?>
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-align-justify mr-1"></i> Descripci??n</strong>
                                                <p class="text-muted"><?= $DataImagen->getDescripcion() ?></p>
                                                <hr>
                                                <?php if (!empty($DataImagen->getOferta())) {?>
                                                <strong><i class="fas fa-piggy-bank"></i> Oferta</strong>
                                                    <p class="text-muted"><?= $DataImagen->getOferta()->getNombre(); ?></p>
                                                    <hr>
                                                <?php }else{  ?>
                                                <strong><i class="fas fa-hamburger"></i> Producto</strong>
                                                <p class="text-muted"><?= $DataImagen->getProducto()->getNombre(); ?></p>
                                                <hr>
                                                <?php } ?>
                                                <strong><i class="fas fa-check"></i> Estado</strong>
                                                <p class="text-muted"><?= $DataImagen->getEstado() ?></p>
                                                </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="row info-box">
                                                    <div class="col-12">
                                                        <h4>Imagen</h4>
                                                    </div>
                                                    <div class="col-12">
                                                        <?php if (!empty($DataImagen->getOferta())) {?>
                                                            <?php if(!empty($DataImagen->getRuta())){ ?>
                                                                <img class='img-thumbnail rounded' src='../../public/uploadFiles/photos/ofertas/<?= $DataImagen->getRuta(); ?>' alt="Imagen Oferta">
                                                            <?php }
                                                        }else{?>
                                                            <?php if(!empty($DataImagen->getRuta())){ ?>
                                                                <img class='img-thumbnail rounded' src='../../public/uploadFiles/photos/productos/<?= $DataImagen->getRuta(); ?>' alt="Imagen Producto">
                                                            <?php }
                                                         } ?>
                                                    </div>
                                                </div>
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
                                                <?php if (!empty($DataImagen->getOferta())) {?>
                                                    <a role="button" href="../oferta/index.php" class="btn btn-primary float-right"
                                                       style="margin-right: 5px;">
                                                       <i class="fas fa-undo-alt"></i> Volver a ofertas
                                                    </a>
                                                <?php }elseif(!empty($DataImagen->getProducto())){?>
                                                    <a role="button" href="../producto/index.php" class="btn btn-primary float-right"
                                                        style="margin-right: 5px;">
                                                        <i class="fas fa-undo-alt"></i> Volver a productos
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <div class="col-auto">
                                                <a role="button" href="edit.php?id=<?= $DataImagen->getId(); ?>" class="btn btn-primary float-right"
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
                    </div>
                </div>
            </div>
            <!-- /.card -->
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
