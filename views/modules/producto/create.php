<?php
require_once("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\SubCategoriasController;
use App\Controllers\MarcasController;
use App\Controllers\ProductosController;
use App\Models\GeneralFunctions;


$nameModel = "Producto"; //Nombre del Modelo
$pluralModel = $nameModel.'s'; //Nombre del modelo en plural
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL; //Nombre del formulario (frmUsuarios)
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
                                <h3 class="card-title"><i class="fas fa-box"></i> &nbsp; Información del <?= $nameModel ?></h3>
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
                                                    <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="Nombre" name="Nombre"
                                                               placeholder="Ingrese el nombre del producto" value="<?= $frmSession['Nombre'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Tamano" class="col-sm-2 col-form-label">Tamaño</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" class="form-control" id="Tamano" name="Tamano"
                                                                placeholder="Ingrese el tamaño del producto" value="<?= $frmSession['Tamano'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ReferenciaTamano" class="col-sm-2 col-form-label">Referencia tamaño</label>
                                                    <div class="col-sm-10">
                                                        <select required name="ReferenciaTamano" id="ReferenciaTamano" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['ReferenciaTamano']) && $frmSession['ReferenciaTamano'] == "ml") ? "selected" : ""; ?> value="ml">ml</option>
                                                            <option <?= ( !empty($frmSession['ReferenciaTamano']) && $frmSession['ReferenciaTamano'] == "Lt") ? "selected" : ""; ?> value="Lt">Lt</option>
                                                            <option <?= ( !empty($frmSession['ReferenciaTamano']) && $frmSession['ReferenciaTamano'] == "Kg") ? "selected" : ""; ?> value="Kg">Kg</option>
                                                            <option <?= ( !empty($frmSession['ReferenciaTamano']) && $frmSession['ReferenciaTamano'] == "gr") ? "selected" : ""; ?> value="gr">gr</option>
                                                            <option <?= ( !empty($frmSession['ReferenciaTamano']) && $frmSession['ReferenciaTamano'] == "Oz") ? "selected" : ""; ?> value="Oz">Oz</option>
                                                            <option <?= ( !empty($frmSession['ReferenciaTamano']) && $frmSession['ReferenciaTamano'] == "Lb") ? "selected" : ""; ?> value="Lb">Lb</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Referencia" class="col-sm-2 col-form-label">Referencia</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="Referencia" name="Referencia"
                                                               placeholder="Ingrese la referencia del producto" value="<?= $frmSession['Referencia'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="PrecioBase" class="col-sm-2 col-form-label">Precio base</label>
                                                    <div class="col-sm-10">
                                                        <input required type="number" step="0.01" class="form-control" id="PrecioBase" name="PrecioBase"
                                                               placeholder="Ingrese el precio base del producto" value="<?= $frmSession['PrecioBase'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="PrecioUnidadTrabajador" class="col-sm-2 col-form-label">Precio unidad trabajador</label>
                                                    <div class="col-sm-10">
                                                        <input  required type="number" step="0.01" class="form-control" id="PrecioUnidadTrabajador" name="PrecioUnidadTrabajador"
                                                                placeholder="Ingrese el precio unidad trabajador" value="<?= $frmSession['PrecioUnidadTrabajador'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                     <label for="PrecioUnidadVenta" class="col-sm-2 col-form-label">Precio unidad venta</label>
                                                    <div class="col-sm-10">
                                                        <input  required type="number" step="0.01" class="form-control" id="PrecioUnidadVenta" name="PrecioUnidadVenta"
                                                                placeholder="Ingrese el precio de venta" value="<?= $frmSession['PrecioBase'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="PresentacionProducto" class="col-sm-2 col-form-label">Presentación producto</label>
                                                    <div class="col-sm-10">
                                                        <select required id="PresentacionProducto" name="PresentacionProducto" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Lata") ? "selected" : ""; ?> value="Lata">Lata</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Botella vidrio") ? "selected" : ""; ?> value="Botella vidrio">Botella vidrio</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Botella plastico") ? "selected" : ""; ?> value="Botella plastico">Botella plastico</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Tetrapack") ? "selected" : ""; ?> value="Tetrapack">Tetrapack</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Predeterminado") ? "selected" : ""; ?> value="Predeterminado">Predeterminado</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Icopor") ? "selected" : ""; ?> value="Icopor">Icopor</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Vaso vidrio") ? "selected" : ""; ?> value="Vaso vidrio">Vaso vidrio</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Vaso plastico") ? "selected" : ""; ?> value="Vaso plastico">Vaso plastico</option>
                                                            <option <?= ( !empty($frmSession['PresentacionProducto']) && $frmSession['PresentacionProducto'] == "Tasa") ? "selected" : ""; ?> value="Tasa">Tasa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Marca_id" class="col-sm-2 col-form-label">Marca id</label>
                                                    <div class="col-sm-10">
                                                        <input  required type="number"  class="form-control" id="Marca_id" name="Marca_id"
                                                                placeholder="Ingrese el id de la marca" value="<?= $frmSession['Marca_id'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="CantidadProducto" class="col-sm-2 col-form-label">Cantidad producto</label>
                                                    <div class="col-sm-10">
                                                        <input  required type="number" class="form-control" id="CantidadProducto" name="CantidadProducto"
                                                                placeholder="Ingrese la cantidad del producto" value="<?= $frmSession['CantidadProducto'] ?? '' ?>" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Subcategoria_id" class="col-sm-2 col-form-label">SubCategoria id</label>
                                                    <div class="col-sm-10">
                                                        <input  required type="number"  class="form-control" id="Subcategoria_id" name="Subcategoria_id"
                                                                placeholder="Ingrese la subcategoria" value="<?= $frmSession['Subcategoria_id'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                    <div class="col-sm-10">
                                                        <select required name="Estado" id="Estado" class="custom-select">
                                                            <option value="">Seleccione</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Activo") ? "selected" : ""; ?>value="Activo">Activo</option>
                                                            <option <?= ( !empty($frmSession['Estado']) && $frmSession['Estado'] == "Inactivo") ? "selected" : ""; ?>value="Inactivo">Inactivo</option>
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

