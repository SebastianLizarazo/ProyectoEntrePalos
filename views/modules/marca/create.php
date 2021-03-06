<?php
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");
require_once("../../../app/Controllers/MarcasController.php");

use App\Models\GeneralFunctions;
use Carbon\Carbon;
use App\Controllers\UsuariosController;

$nameModel = "Marca"; //Nombre del Modelo
$nameForm = 'frmCreate'.$nameModel;
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION[$nameForm]?? NULL; //Nombre del formulario (frmUsuarios)
?>
<!DOCTYPE html>
<html>
<head>
    <title> Registrar | <?= $nameModel ?></title>
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
                                                    <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="Nombre" name="Nombre"
                                                               placeholder="Ingrese el nombre de la marca" value="<?= $frmSession['Nombre'] ?? '' ?>">
                                                    </div>
                                                </div>
                                              <div class="row">
                                                  <div class="col-sm-12">
                                                      <div class="form-group row">
                                                          <label for="Descripcion" class="col-sm-2 col-form-label">Descripci??n</label>
                                                          <div class="col-sm-10">
                                                              <input required type="text" class="form-control" id="Descripcion" name="Descripcion"
                                                                     placeholder="Ingrese la descripci??n de la marca" value="<?= $frmSession['Descripcion'] ?? '' ?>">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                                  <!-- /.Proveedor_id -->
                                              <div class="row">
                                                  <div class="col-sm-12">
                                                      <div class="form-group row">
                                                          <label for="Proveedor_id" class="col-sm-2 col-form-label">Proveedor</label>
                                                          <div class="col-sm-10">
                                                              <?= UsuariosController::selectUsuario(
                                                                  array(
                                                                      'id' => 'Proveedor_id',
                                                                      'name' => 'Proveedor_id',
                                                                      'defaultValue' => '1',
                                                                      'class' => 'form-control select2bs4 select2-info',
                                                                      'where' => "estado = 'Activo' and Rol = 'Proveedor'"
                                                                  )
                                                              )
                                                              ?>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>



                                                  <div class="row">
                                                      <div class="col-sm-12">
                                                          <div class="form-group row">
                                                             <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                             <div class="col-sm-10">
                                                            <select required id="estado" name="estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( !empty($frmSession['estado']) && $frmSession['estado'] == "Activa") ? "selected" : ""; ?> value="Activa">Activa</option>
                                                                <option <?= ( !empty($frmSession['estado']) && $frmSession['estado'] == "Inactiva") ? "selected" : ""; ?> value="Inactiva">Inactiva</option>
                                                            </select>
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

