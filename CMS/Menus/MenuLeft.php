<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/cms/img/users.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $ses->item->Info->nombre; ?> <?php echo $ses->item->Info->apellidos; ?></p>
                <a href="#"> 
                    <i class="fa fa-circle text-success"></i> Online
                </a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Men&#250;</li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-user-secret"></i>&nbsp;
                    <span> Administradores</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="/cms/pages/administradores/Create.php">
                            <i class="fa fa-circle-o"></i> Crear Administrador
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/administradores/Listar.php">
                            <i class="fa fa-circle-o"></i> Listar Administradores
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/cms/pages/HomeWeb.php">
                    <i class="fa fa-th"></i> Home Web
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-shopping-bag"></i>&nbsp;
                    <span>Nosotros</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/cms/pages/nosotros/cabecera.php">
                            <i class="fa fa-circle-o"></i> Cabecera
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/nosotros/informacion.php">
                            <i class="fa fa-circle-o"></i> Información
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/nosotros/beneficios.php">
                            <i class="fa fa-circle-o"></i> Beneficios
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-archive"></i>&nbsp;
                    <span> Productos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="/cms/pages/productos/categorias.php">
                            <i class="fa fa-circle-o"></i> Categorias
                        </a>
                    </li>
                    <li class="">
                        <a href="/cms/pages/productos/subcategorias.php">
                            <i class="fa fa-circle-o"></i> Filtros
                        </a>
                    </li>
                    <li class="">
                        <a href="/cms/pages/productos/servicios.php">
                            <i class="fa fa-circle-o"></i> Servicios
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/productos/productos.php">
                            <i class="fa fa-circle-o"></i> Productos
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/productos/multimedia.php">
                            <i class="fa fa-circle-o"></i> Multimedia
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-share-alt"></i>&nbsp;
                    <span> Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="/cms/pages/blog/create_post.php">
                            <i class="fa fa-circle-o"></i> Crear Post
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/blog/Listar.php">
                            <i class="fa fa-circle-o"></i> Listar Post's
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/blog/multimedia.php">
                            <i class="fa fa-circle-o"></i> Multimedia
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-balance-scale"></i>&nbsp;
                    <span> Textos Legales</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="/cms/pages/legales/terminosicondiciones.php">
                            <i class="fa fa-circle-o"></i> Terminos y condiciones
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/legales/politicadeprivacidad.php">
                            <i class="fa fa-circle-o"></i> Política de privacidad
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/legales/politicadecoockies.php">
                            <i class="fa fa-circle-o"></i> Política de Coockies
                        </a>
                    </li>
                    <li>
                        <a href="/cms/pages/legales/Infomracionlegal.php">
                            <i class="fa fa-circle-o"></i> Infomración legal
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/">
                    <i class="fab fa-chrome"></i> Ver Web
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>