<?php use App\Controllers\ImagenesController;
use App\Models\Imagenes;

require("partials/routes.php"); ?>
<?php $baseURL = $baseURL ?? ""; require("partials/check_login.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Home</title>
    <?php require("partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("partials/navbar_customization.php"); ?>

    <?php require("partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inicio</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/index.php"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row ">
                <div class="col-12 col-sm-10 col-lg-8 mx-auto mb-5">
                    <img class="card-img-top" src="../views/public/img/Entre-palos-inicio.jpeg"
                         alt="Entre palos inicio">
                    <div class="bg-white p-5 shadow rounded">
                        <div class=" m-auto">
                            <h1 class="mb-0">¿Qué quieres hacer hoy?</h1>
                        </div>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <div class="btn-group btn-group-sm m-auto">
                                    <a href="<?= $baseURL ?>/views/modules/producto/index.php" class="btn btn-success">
                                        <strong> Gestionar productos </strong>
                                    </a>
                                    <a href="<?= $baseURL ?>/views/modules/usuario/index.php" class="btn btn-primary">
                                        <strong> Gestionar usuarios </strong>
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require ('partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('partials/scripts.php');?>
</body>
</html>