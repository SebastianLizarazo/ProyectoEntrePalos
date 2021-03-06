<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $baseURL; ?>/views/index.php" class="brand-link">
        <img src="<?= $baseURL ?>/views/public/img/Logo-entre-palos.jpeg"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $_ENV['ALIASE_SITE'] ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 d-flex">
            <div class="image align-middle">
                <img src="<?= $baseURL ?>/views/public/img/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="d-flex flex-column">
                <div class="info"  style="padding-bottom: 0px; !important;">
                    <a href="<?= "$baseURL/views/modules/usuario/show.php?id=" .$_SESSION['UserInSession']['id']?>" class="d-block">
                        <?= $_SESSION['UserInSession']['Nombres'] ?>
                    </a>
                </div>
                <div class="info"  style="padding-top: 0px; !important;">
                    <a href="#" class="d-block">
                        <?= $_SESSION['UserInSession']['Rol'] ?>
                    </a>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= $baseURL; ?>/views/index.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                <li class="nav-header">Modulos Principales</li>
                <?php  if ( $_SESSION['UserInSession']['Rol'] == 'Administrador'){ ?>

                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Mesas') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Mesas') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chair"></i>
                            <p>
                                Mesas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/mesa/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/mesa/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Imagenes') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Imagenes') ? 'active' : '' ?>">
                            <i class="nav-icon far fa-images"></i>
                            <p>
                                Imagenes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/imagen/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/imagen/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Empresas') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Empresas') ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-city"></i>
                            <p>
                                Empresas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/empresa/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/empresa/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                  <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Facturas') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Facturas') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                           <p>
                                Facturas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/factura/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                           <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/factura/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'DetallePedidos') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'DetallePedidos') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-table"></i>
                            <p>
                                Detalle Pedidos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/detalle_pedido/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/detalle_pedido/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                   <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Productos') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Productos') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-hamburger"></i>
                            <p>
                                Productos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/producto/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/producto/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Marcas') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Marcas') ? 'active' : '' ?>">
                            <i class="nav-icon far fa-registered"></i>
                            <p>
                                Marcas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/marca/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/marca/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Subcategorias') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Subcategorias') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-sitemap"></i>
                            <p>
                                Subcategoria
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/subcategoria/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/subcategoria/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                       <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Ofertas') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Ofertas') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-piggy-bank"></i> <p>
                                Ofertas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/oferta/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/oferta/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'DetalleOfertas') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'DetalleOfertas') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-pen-square"></i>
                            <p>
                                Detalle oferta
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/detalle_oferta/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/detalle_oferta/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Usuarios') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Usuarios') ? 'active' : '' ?>">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/usuario/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/usuario/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'Pagos') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'Pagos') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Pagos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/pago/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/pago/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= strpos($_SERVER['REQUEST_URI'],'ConsumoTrabajadores') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'],'ConsumoTrabajadores') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>
                                Consumo trabajador
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/consumo_trabajador/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $baseURL ?>/views/modules/consumo_trabajador/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>