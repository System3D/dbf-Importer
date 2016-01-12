<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Arquivos de Banco Importados</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Importações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                            <h4>Escolhe um arquivo DBF para enviar os desenhos</h4>
                            <br />
                            
                                
                                    <?php
                                        foreach($files as $file){
                                            $fileName = explode('/', $file);
                                            $fileName = end($fileName);
                                    ?>
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method="post" action="<?=base_url() . 'saas/importacoes/gravardwg';?>" enctype="multipart/form-data">
                                            <div class="form-group">
                                              <label><?= $fileName ?></label>
                                              <input type="hidden" name="filename" value="<?= $file ?>" />
                                              <button type="submit" class="btn btn-primary btn-block" style="width:35%;float:right"><i class="fa fa-cloud-upload"></i> Importar</button>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                
                            
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
          <?php
                if(!empty($this->session->flashdata('danger'))){
                ?>
        <div class="col-lg-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('danger'); ?></p>
                </div>
            </div>
            </div>
            <?php
                }elseif(!empty($this->session->flashdata('success'))){
            ?><div class="col-lg-4">
                <div class="panel panel-success">
                <div class="panel-heading">
                    Sucesso!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('success'); ?></p>
                </div>
            </div>
            </div>
            <?php
                }
            ?>
    </div> 
  <a style="float:left" href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>
