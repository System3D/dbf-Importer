<!-- Navigation -->
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url('saas/admin');?>" title="Dashboard">
                <div style="height:3.5px;width:1px"></div>
                <img src="<?= base_url() ?>assets/template/img/logo-Steel4web.png" style="margin-top:-5px"/>
            </a> 
        </div>
          <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;">
             Hoje : <?= date('d/m/Y') ?> <a style="margin-left:15px" href="<?=base_url('logout');?>" class="btn btn-logout">Logout</a>
          </div>
    </nav>   

 <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 3 || $this->session->userdata('tipoUsuarioID') == 4){ ?>
                    <li>
                       <a href="#"><i class="fa fa-book fa-3x"></i> Cadastrar<span class="fa arrow"></span></a> 
                       <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('saas/obras/cadastrar');?>"> Obra</a>
                            </li>
                            <li>
                                <a href="<?=base_url('saas/obras/addetapa');?>"> Etapa</a>
                            </li>
                       </ul>
                    </li>
                    <?php } ?>
                     <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 3){ ?>
                      <li>
                        <a href="#"><i class="fa fa-upload fa-3x"></i> Importações<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('saas/importacoes/nova');?>"> Nova</a>
                            </li>
                            <li>
                                <a href="<?=base_url('saas/importacoes/dwg');?>"> Listar</a>
                            </li>
                            <li>
                                <a href="<?=base_url('saas/importacoes/dbf');?>"> Banco de Dados(.DBF)</a>
                            </li>
                            <li>
                                <a href="<?=base_url('saas/importacoes/dwg');?>"> Desenhos(.DWG)</a>
                            </li>
                        </ul>
                      </li> 
                      <?php } ?>
                      <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 4){ ?>
                        <li>
                            <a href="#"><i class="fa fa-thumbs-o-up fa-3x"></i> Revisão<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url('saas/importacoes/dbf');?>"> Gerenciar</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                      <li>
                        <a  href="<?=base_url('saas/conjuntos/grds');?>"><i class="fa fa-table fa-3x"></i> Listar GRDs por Banco</a>
                    </li> 
                   <li>
                        <a  href="<?=base_url('saas/conjuntos/desenhos');?>"><i class="fa fa-list-alt fa-3x"></i> Listar Todos GRDs</a>
                    </li>
                    <li>
                        <a  href="<?=base_url('saas/conjuntos/listar');?>"><i class="fa fa-list-alt fa-3x"></i> Listar Todos Conjuntos</a>
                    </li>
                    <?php if($this->session->userdata('tipoUsuarioID') == 1 || $this->session->userdata('tipoUsuarioID') == 2 || $this->session->userdata('tipoUsuarioID') == 3 || $this->session->userdata('tipoUsuarioID') == 4){ ?>
                     <li>
                     <a href="" title="Usuarios"><i class="fa fa-user fa-3x"></i> Usuarios<span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('saas/profile/ver');?>"> Ver Perfil</a>
                            </li>
                            <?php if($this->session->userdata('tipoUsuarioID') == 1){ ?>
                            <li>
                                <a href="<?=base_url('saas/usuarios/cadastrar');?>"> Adicionar</a>
                            </li>
                            <li>
                                <a href="<?=base_url('saas/usuarios/listar');?>"> Gerenciar</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                     <?php } ?>
                     <?php if($this->session->userdata('tipoUsuarioID') == 1){ ?>
                           <li  >
                        <a  href="<?=base_url('saas/logs/listar');?>"><i class="fa fa-eye fa-3x"></i> Logs</a>
                    </li>   
                    <?php } ?>
                </ul>
               
            </div>
            
        </nav>  