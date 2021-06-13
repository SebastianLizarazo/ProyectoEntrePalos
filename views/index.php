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
                        <h1>Pagina Principal</h1>
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

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Galeria</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
                            <i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title">Productos</h4>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <div class="btn-group w-100 mb-2">
                                                    <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> Todas las fotos </a>
                                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Hamburguesas </a>
                                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Alitas </a>
                                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Costillitas </a>
                                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> A la carta </a>
                                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Bebidas </a>
                                                </div>
                                                <div class="mb-2">
                                                    <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                                                    <div class="float-right">
                                                        <select class="custom-select" style="width: auto;" data-sortOrder>
                                                            <option value="index"> Sort by Position </option>
                                                            <option value="sortData"> Sort by Custom Data </option>
                                                        </select>
                                                        <div class="btn-group">
                                                            <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                                                            <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $arrImagenes = ImagenesController::getAll();
                                            if (!empty($arrImagenes))
                                            /* @var $arrImagenes Imagenes[] */
                                            foreach ($arrImagenes as $DataImagen){
                                            ?>
                                            <div>
                                                <div class="filter-container p-0 row">
                                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                        <a href="http://localhost/ProyectoEntrePalos/views/modules/imagen/show.php?id=<?= $DataImagen->getId()?>" data-toggle="lightbox" data-title="sample 1 - white">
                                                            <?php if (!empty($DataImagen->getOferta())){?>
                                                                <img src="../../public/uploadFiles/photos/ofertas/<?= $DataImagen->getRuta(); ?>" alt="Foto Oferta" class="img-fluid mb-2" alt="white sample"/>
                                                            <?php }else{?>
                                                                <img src="../../public/uploadFiles/photos/productos/<?= $DataImagen->getRuta(); ?>" alt="Foto Producto" class="img-fluid mb-2" alt="white sample"/>
                                                            <?php }?>
                                                        </a>
                                                    </div>
                                            <?php } ?>
                                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black">
                                                            <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red">
                                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red">
                                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2" alt="red sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                                        <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox" data-title="sample 5 - black">
                                                            <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox" data-title="sample 6 - white">
                                                            <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox" data-title="sample 7 - white">
                                                            <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                                        <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black">
                                                            <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red">
                                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox" data-title="sample 10 - white">
                                                            <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox" data-title="sample 11 - white">
                                                            <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample"/>
                                                        </a>
                                                    </div>
                                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                                        <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black">
                                                            <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample"/>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title">Ofertas</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2" alt="red sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox" data-title="sample 7 - white" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox" data-title="sample 11 - white" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample"/>
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black" data-gallery="gallery">
                                                        <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <footer class="main-footer">
                    <div class="float-right d-none d-sm-block">
                        <b>Version</b> 3.1.0
                    </div>
                    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
                </footer>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->

            <!-- jQuery -->
            <script src="../plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Ekko Lightbox -->
            <script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/adminlte.min.js"></script>
            <!-- Filterizr-->
            <script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../dist/js/demo.js"></script>
            <!-- Page specific script -->
            <script>
                $(function () {
                    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                        event.preventDefault();
                        $(this).ekkoLightbox({
                            alwaysShowClose: true
                        });
                    });

                    $('.filter-container').filterizr({gutterPixels: 3});
                    $('.btn[data-filter]').on('click', function() {
                        $('.btn[data-filter]').removeClass('active');
                        $(this).addClass('active');
                    });
                })
            </script>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Pie de Página.
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
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