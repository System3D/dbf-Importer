
        <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('saas/admin');?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b style='color:#81DCA1'>G</b>ED</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b style='color:#81DCA1'>GED</b>Steel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
                  <span class="hidden-xs"><?= $this->session->userdata('nomeUsuario') ?></span>
                </a>
                <ul class="dropdown-menu">    
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=base_url('saas/usuarios/ver').'/'.$this->session->userdata('usuarioID');?>" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url('logout');?>" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>


      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu Principal</li>
            <li>
              <a href="<?=base_url('saas/admin');?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
             <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 3 || $this->session->userdata('tipoUsuarioID') == 4){ ?>
            <li class="treeview">
               <a href="#">
                  <i class="fa fa-book"></i> <span>Cadastrar</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a> 
               <ul class="treeview-menu">
                    <li>
                        <a href="<?=base_url('saas/obras/cadastrar');?>"><i class="fa fa-building-o"></i> Obra</a>
                    </li>
                    <li>
                        <a href="<?=base_url('saas/obras/addetapa');?>"><i class="fa fa-crop"></i> Etapa</a>
                    </li>
               </ul>
            </li>
            <?php } ?>
            <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 3 || $this->session->userdata('tipoUsuarioID') == 4){ ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-upload"></i>
                <span>Importações</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url('saas/importacoes/obras');?>"><i class="fa fa-plus"></i> Nova</a></li>
                <li><a href="<?=base_url('saas/importacoes/suas');?>"><i class="fa fa-folder-o"></i> Suas Importações</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 4){ ?>
            <li>
              <a href="<?=base_url('saas/importacoes/dbf');?>">
                <i class="fa fa-thumbs-o-up"></i> <span>Revisão</span>
              </a>
            </li>
            <?php } ?>
            <?php if($this->session->userdata('tipoUsuarioID') == 1){ ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url('saas/usuarios/cadastrar');?>"><i class="fa fa-plus"></i> Adicionar</a></li>
                <li><a href="<?=base_url('saas/usuarios/listar');?>"><i class="fa fa-tasks"></i> Gerenciar</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if($this->session->userdata('tipoUsuarioID') == 1){ ?>
            <li>
              <a href="<?=base_url('saas/logs/listar');?>">
                <i class="fa fa-eye"></i> <span>Logs</span>
              </a>
            </li>
            <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <div class="content-wrapper">
