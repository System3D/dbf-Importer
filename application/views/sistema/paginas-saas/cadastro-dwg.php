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
                    <?php
                        $filename = (string )$dados[0]->fileName;
                        $filname = explode('/',$filename);
                        $filname = end($filname);
                    ?>
                    <h4>Conjuntos de <?= $filname ?></h4>
                    <br />
                            <?php
                                foreach($dados as $file){
                            ?>
                            <div class="row">
                             <div class="col-lg-12">
                                <h5>Marcação/Desenho: <?= $file->MAR_PEZ ?> / <?= $file->FLG_DWG ?></h5>
                              </div>
                            </div>
                            <?php
                                }
                            ?>
                        
                            
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-lg-4">
             <div class="panel panel-default">
                <div class="panel-heading">
                    Importar Desenhos
                </div>
            <form role="form" method="post" action="<?=base_url() . 'saas/importacoes/cadastrardwg';?>" enctype="multipart/form-data" style="width:94%;margin-left:3%;margin-top:5px;margin-bottom:10px">
                <div class="form-group">
                    <label>Arquivos DWG</label>
                    <input type="file" multiple name="dwg[]" />
                </div>
                <div class="form-group">
                    <label>Observações</label>
                    <textarea name="observacoes" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" name='fileName' value="<?= $dbfFile ?>">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-cloud-upload"></i> Importar</button>
            </form>
        </div>
        <?php
                if(!empty($erro)){
                ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('danger'); ?></p>
                </div>
            </div>
            <?php
                }elseif(!empty($this->session->flashdata('success'))){
            ?>
                <div class="panel panel-success">
                <div class="panel-heading">
                    Sucesso!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('success'); ?></p>
                </div>
            </div>
            <?php
                }
            ?>
    </div>
    <div class="col-lg-4">
             <div class="panel panel-default">
                <div class="panel-heading">
                    Desenhos Importados
                </div>
                 <div class="panel-body">
                    <h4>Desenhos de <?= $filname ?></h4>
                    <br />
                            <?php
                                foreach($files as $fil){
                            ?>
                            <div class="row">
                             <div class="col-lg-12">
                                <h5>Nome: <?= $fil->fileName ?></h5>
                              </div>
                            </div>
                            <?php
                                }
                            ?>   
                </div>
                <!-- /.panel-body -->
        </div>
    </div>
</div>
 <a style="float:left" href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>

 
    <!-- /.row -->
    <br /><hr /><br />
</div>