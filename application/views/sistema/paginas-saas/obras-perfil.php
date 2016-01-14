<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 class="page-header">Obra: <?=$obra->nome;?></h3>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#detalhes" data-toggle="tab">Detalhes</a>
                        </li>
                        <li><a href="#etapas" data-toggle="tab">Etapas</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="detalhes">
                            <br />
                            <?php $this->load->view('sistema/paginas-saas/obras-perfil-inc'); ?>
                        </div>
                        <div class="tab-pane fade" id="etapas">
                        <br />
                        <?php $this->load->view('sistema/paginas-saas/etapas-listar-inc'); ?>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>


    <div class="row">
        <div class="col-lg-6 col-md-6">
            <a href="<?=base_url() . 'saas/obras/listar';?>" type="button" class="btn btn-default"><< Voltar</a>
        </div>
    </div>
    <br /><hr /><br />
</div>