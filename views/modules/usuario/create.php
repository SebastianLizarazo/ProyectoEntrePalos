<?php
require_once("../../../app/Controllers/UsuariosController.php");
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Models\GeneralFunctions;
use App\Controllers\EmpresasController;
use Carbon\Carbon;


$nameModel = "Usuario"; //Nombre del Modelo
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION['frmCreate'.$pluralModel] ?? NULL; //Nombre del formulario (frmUsuarios)
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
                                <form class="form-horizontal" method="post" id="frmCreate<?= $nameModel ?>"
                                      name="frmCreate<?= $nameModel ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="Cedula" class="col-sm-2 col-form-label">Cedula</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" min="1111111" max="9999999999" class="form-control" id="Cedula" name="Cedula"
                                                           placeholder="Ingrese la cedula del usuario" value="<?= $frmSession['Nombre'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Nombres" class="col-sm-2 col-form-label">Nombres</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="Nombres" name="Nombres"
                                                           placeholder="Ingrese los nombres del usuario" value="<?= $frmSession['NIT'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="Apellidos" name="Apellidos"
                                                           placeholder="Ingrese los apellidos del usuario" value="<?= $frmSession['NIT'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Telefono" class="col-sm-2 col-form-label">Telefono</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" min="1111111111" max="9999999999" class="form-control" id="Telefono" name="Telefono"
                                                           placeholder="Ingrese el telefono del usuario" value="<?= $frmSession['Telefono'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Direccion" class="col-sm-2 col-form-label">Dirección</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="Direccion" name="Direccion"
                                                           placeholder="Ingrese la dirección del usuario" value="<?= $frmSession['Direccion'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input required type="email" class="form-control" id="Email" name="Email"
                                                           placeholder="Ingrese la Email del usuario" value="<?= $frmSession['Email'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Direccion" class="col-sm-2 col-form-label">Contraseña</label>
                                                <div class="col-sm-10">
                                                    <input required type="password" minlength="8" class="form-control" id="Contrasena" name="Contrasena"
                                                           placeholder="Ingrese la Contraseña del usuario" value="<?= $frmSession['Contrasena'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Rol" class="col-sm-2 col-form-label">Rol</label>
                                                <div class="col-sm-10">
                                                    <select required id="Rol" name="Rol" class="custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option <?= ( !empty($frmSession['Rol']) && $frmSession['Rol'] == "Administrador") ? "selected" : ""; ?> value="Administrador">Administrador</option>
                                                        <option <?= ( !empty($frmSession['Rol']) && $frmSession['Rol'] == "Proveedor") ? "selected" : ""; ?> value="Proveedor">Proveedor</option>
                                                        <option <?= ( !empty($frmSession['Rol']) && $frmSession['Rol'] == "Cliente") ? "selected" : ""; ?> value="Cliente">Cliente</option>
                                                        <option <?= ( !empty($frmSession['Rol']) && $frmSession['Rol'] == "Mesero") ? "selected" : ""; ?> value="Mesero">Mesero</option>
                                                        <option <?= ( !empty($frmSession['Rol']) && $frmSession['Rol'] == "Domiciliario") ? "selected" : ""; ?> value="Domiciliario">Domiciliario</option>
D                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select required id="Estado" name="Estado" class="custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Activo") ? "selected" : ""; ?> value="Activo">Activo</option>
                                                        <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Inactivo") ? "selected" : ""; ?> value="Inactivo">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Empresa_id" class="col-sm-2 col-form-label">Empresa</label>
                                                <div class="col-sm-10">
                                                    <?= EmpresasController::selectEmpresa(
                                                        array(
                                                            'id' => 'Empresa_id',
                                                            'name' => 'Empresa_id',
                                                            'defaultValue' => '', //Boyacá
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    )
                                                    ?>
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

