<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/ProductosController.php");


use App\Controllers\MarcasController;
use App\Controllers\ProductosController;
use App\Controllers\SubCategoriasController;
use App\Models\GeneralFunctions;
use App\Models\Productos;


$nameModel = "Producto";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frm'.$pluralModel] ?? null;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar |<?= $nameModel ?></title>
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

                                $DataProducto = ProductosController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataProducto Productos */
                                if (!empty($DataProducto)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="frmEdit<?= $nameModel ?>"
                                              name="frmEdit<?= $nameModel ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataProducto->getId(); ?>" hidden
                                                   required="required" type="text"><div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Nombre" name="Nombre"
                                                                   placeholder="Ingrese el nombre del producto" value="<?= $DataProducto->getNombre() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Tamano" class="col-sm-2 col-form-label">Tamaño</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" max="9999" class="form-control" id="Tamano" name="Tamano"
                                                                   placeholder="Ingrese el tamaño del producto" value="<?= $DataProducto->getTamano() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ReferenciaTamano" class="col-sm-2 col-form-label">Referencia tamaño</label>
                                                        <div class="col-sm-10">
                                                            <select required name="ReferenciaTamano" id="ReferenciaTamano" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataProducto->getReferenciaTamano() == "ml") ? "selected" : ""; ?> value="ml">ml</option>
                                                                <option <?= ( $DataProducto->getReferenciaTamano() == "Lt") ? "selected" : ""; ?> value="Lt">Lt</option>
                                                                <option <?= ( $DataProducto->getReferenciaTamano() == "Kg") ? "selected" : ""; ?> value="Kg">Kg</option>
                                                                <option <?= ( $DataProducto->getReferenciaTamano() == "gr") ? "selected" : ""; ?> value="gr">gr</option>
                                                                <option <?= ( $DataProducto->getReferenciaTamano() == "Oz") ? "selected" : ""; ?> value="Oz">Oz</option>
                                                                <option <?= ( $DataProducto->getReferenciaTamano() == "Lb") ? "selected" : ""; ?> value="Lb">Lb</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Referencia" class="col-sm-2 col-form-label">Referencia</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Referencia" name="Referencia"
                                                                   placeholder="Ingrese la referencia del producto" value="<?= $DataProducto->getReferencia() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="PrecioBase" class="col-sm-2 col-form-label">Precio base</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" step="0.01" max="999999" class="form-control" id="PrecioBase" name="PrecioBase"
                                                                   placeholder="Ingrese el precio base del producto" value="<?= $DataProducto->getPrecioBase() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="PrecioUnidadTrabajador" class="col-sm-2 col-form-label">Precio unidad trabajador</label>
                                                        <div class="col-sm-10">
                                                            <input  required type="number" step="0.01" max="999999" class="form-control" id="PrecioUnidadTrabajador" name="PrecioUnidadTrabajador"
                                                                    placeholder="Ingrese el precio unidad trabajador" value="<?= $DataProducto->getPrecioUnidadTrabajador() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="PrecioUnidadVenta" class="col-sm-2 col-form-label">Precio unidad venta</label>
                                                        <div class="col-sm-10">
                                                            <input  required type="number" step="0.01" max="999999" class="form-control" id="PrecioUnidadVenta" name="PrecioUnidadVenta"
                                                                    placeholder="Ingrese el precio de venta" value="<?= $DataProducto->getPrecioUnidadVenta() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="PresentacionProducto" class="col-sm-2 col-form-label">Presentación producto</label>
                                                        <div class="col-sm-10">
                                                            <select required id="PresentacionProducto" name="PresentacionProducto" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Lata") ? "selected" : ""; ?> value="Lata">Lata</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Botella vidrio") ? "selected" : ""; ?> value="Botella vidrio">Botella vidrio</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Botella plastico") ? "selected" : ""; ?> value="Botella plastico">Botella plastico</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Tetrapack") ? "selected" : ""; ?> value="Tetrapack">Tetrapack</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Predeterminado") ? "selected" : ""; ?> value="Predeterminado">Predeterminado</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Icopor") ? "selected" : ""; ?> value="Icopor">Icopor</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Vaso vidrio") ? "selected" : ""; ?> value="Vaso vidrio">Vaso vidrio</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Vaso plastico") ? "selected" : ""; ?> value="Vaso plastico">Vaso plastico</option>
                                                                <option <?= ( $DataProducto->getPresentacionProducto() == "Tasa") ? "selected" : ""; ?> value="Tasa">Tasa</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Marca_id" class="col-sm-2 col-form-label">Marca</label>
                                                        <div class="col-sm-10">
                                                            <?= MarcasController::selectMarca(
                                                                array(
                                                                    'id' => 'Marca_id',
                                                                    'name' => 'Marca_id',
                                                                    'defaultValue' => $DataProducto->getMarcaId(),
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Activa'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="CantidadProducto" class="col-sm-2 col-form-label">Cantidad producto</label>
                                                        <div class="col-sm-10">
                                                            <input  required type="number" max="9999" class="form-control" id="CantidadProducto" name="CantidadProducto"
                                                                    placeholder="Ingrese la cantidad del producto" value="<?= $DataProducto->getCantidadProducto() ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Subcategoria_id" class="col-sm-2 col-form-label">Sub Categoria</label>
                                                        <div class="col-sm-10">
                                                            <?= SubCategoriasController::selectsubcategoria(
                                                                array(
                                                                    'id' => 'Subcategoria_id',
                                                                    'name' => 'Subcategoria_id',
                                                                    'defaultValue' => $DataProducto->getSubcategoriaId(),
                                                                    'class' => 'form-control select2bs4 select2-info',
                                                                    'where' => "estado = 'Activo'"
                                                                )
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                        <div class="col-sm-10">
                                                            <select required name="Estado" id="Estado" class="custom-select">
                                                                <option value="">Seleccione</option>
                                                                <option <?= ( $DataProducto->getEstado() == "Activo") ? "selected" : ""; ?> value="Activo">Activo</option>
                                                                <option <?= ( $DataProducto->getEstado() == "Inactivo") ? "selected" : ""; ?> value="Inactivo">Inactivo</option>
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
