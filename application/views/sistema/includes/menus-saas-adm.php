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
             Hoje : <?= date('d/m/Y') ?> <a style="margin-left:15px" href="<?=base_url('logout');?>" class="btn btn-danger square-btn-adjust">Logout</a>
          </div>
    </nav>   

 <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <a href="<?=base_url('saas/profile/ver');?>" title="Perfil de Usuario"><img src="<?= base_url() ?>assets/template/img/find_user.png" class="user-image img-responsive"/></a>
                    </li>
                
                    
                    <li>
                        <a  href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                      <li>
                        <a href="#"><i class="fa fa-upload fa-3x"></i> Importações<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('saas/importacoes/dbf');?>"> Banco de Dados(.DBF)</a>
                            </li>
                            <li>
                                <a href="<?=base_url('saas/importacoes/dwg');?>"> Desenhos(.DWG)</a>
                            </li>
                        </ul>
                      </li>  
                   <li>
                        <a  href="<?=base_url('saas/conjuntos/desenhos');?>"><i class="fa fa-list-alt fa-3x"></i> Listar Desenhos</a>
                    </li>
                    <li>
                        <a  href="<?=base_url('saas/conjuntos/listar');?>"><i class="fa fa-list-alt fa-3x"></i> Listar Conjuntos</a>
                    </li>
                     <?php if($this->session->userdata('tipoUsuarioID') == 1){ ?>
                           <li  >
                        <a  href="<?=base_url('saas/logs/listar');?>"><i class="fa fa-eye fa-3x"></i> Logs</a>
                    </li>   
                    <?php } ?>
                </ul>
               
            </div>
            
        </nav>  