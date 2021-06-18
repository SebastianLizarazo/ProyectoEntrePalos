<?php
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");
require_once("../../../app/Controllers/UsuariosController.php");


use App\Controllers\UsuariosController;
use App\Controllers\EmpresasController;
use App\Models\GeneralFunctions;
use App\Models\Usuarios;


$nameModel = "Usuario";
$nameForm = 'frmEdit'.$nameModel;
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION[$nameForm] ?? null;

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

                                $DataUsuario = UsuariosController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataUsuario Usuarios */
                                if (!empty($DataUsuario)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataUsuario->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Cedula" class="col-sm-2 col-form-label">Cedula</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" min="1111111" max="9999999999" class="form-control" id="Cedula"
                                                                   name="Cedula" value="<?= $DataUsuario->getCedula(); ?>"
                                                                   placeholder="Ingrese la cedula del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Nombres" class="col-sm-2 col-form-label">Nombres</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Nombres"
                                                                   name="Nombres" value="<?= $DataUsuario->getNombres(); ?>"
                                                                   placeholder="Ingrese los nombres del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Apellidos"
                                                                   name="Apellidos" value="<?= $DataUsuario->getApellidos(); ?>"
                                                                   placeholder="Ingrese los apellidos del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Telefono" class="col-sm-2 col-form-label">Telefono</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" min="111111111" max="9999999999" class="form-control" id="Telefono"
                                                                   name="Telefono" value="<?= $DataUsuario->getTelefono(); ?>"
                                                                   placeholder="Ingrese el telefono del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Direccion" class="col-sm-2 col-form-label">Dirección</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Direccion"
                                                                   name="Direccion" value="<?= $DataUsuario->getDireccion(); ?>"
                                                                   placeholder="Ingrese la dirección del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-10">
                                                            <input required type="email" class="form-control" id="Email"
                                                                   name="Email" value="<?= $DataUsuario->getEmail(); ?>"
                                                                   placeholder="Ingrese el email del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Contrasena" class="col-sm-2 col-form-label">Contraseña</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" minlength="8" class="form-control" id="Contrasena"
                                                                   name="Contrasena"
                                                                   placeholder="Ingrese la nueva contraseña del usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Rol" class="col-sm-2 col-form-label">Rol</label>
                                                        <div class="col-sm-10">
                                                            <select required id="Rol" name="Rol" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataUsuario->getRol()  == "Administrador") ? "selected" : ""; ?> value="Administrador">Administrador</option>
                                                                <option <?= ( $DataUsuario->getRol() == "Proveedor") ? "selected" : ""; ?> value="Proveedor">Proveedor</option>
                                                                <option <?= ( $DataUsuario->getRol() == "Cliente") ? "selected" : ""; ?> value="Cliente">Cliente</option>
                                                                <option <?= ( $DataUsuario->getRol() == "Mesero") ? "selected" : ""; ?> value="Mesero">Mesero</option>
                                                                <option <?= ( $DataUsuario->getRol() == "Domiciliario") ? "selected" : ""; ?> value="Domiciliario">Domiciliario</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                        <div class="col-sm-10">
                                                            <select required id="Estado" name="Estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ($DataUsuario->getEstado() == "Activo") ? "selected" : ""; ?> value="Activo">Activo</option>
                                                                <option <?= ($DataUsuario->getEstado() == "Inactivo") ? "selected" : ""; ?> value="Inactivo">Inactivo</option>
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
                                                                    'defaultValue' =>$DataUsuario->getEmpresaId(),
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
                                            <button id="frmName" name="frmName" value="<?= $nameForm ?>" type="submit" class="btn btn-info">Enviar</button>
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
