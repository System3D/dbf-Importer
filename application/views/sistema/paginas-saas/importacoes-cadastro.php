<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Importação de arquivos</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Importações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tecnometal" data-toggle="tab">Tecnometal</a>
                        </li>
                        <li><a href="#tekla" data-toggle="tab">Tekla</a>
                        </li>
                        <li><a href="#cadem" data-toggle="tab">ST_CadEM</a>
                        </li>
                        <li><a href="#manual" data-toggle="tab">Manual</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tecnometal">
                            <br />
                            <h4>Importação de arquivos padrão Tecnometal</h4>
                            <br />
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="<?=base_url() . 'saas/importacoes/gravar';?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Arquivo DFB</label>
                                            <input type="file" name="files[]" />
                                        </div>
                                        <div class="form-group">
                                            <label>Arquivo DAT</label>
                                            <input type="file" name="files[]" />
                                        </div>
                                        <div class="form-group">
                                            <label>Arquivo IFC</label>
                                            <input type="file" name="files[]" />
                                        </div>
                                        <div class="form-group">
                                            <label>Arquivo FBX</label>
                                            <input type="file" name="files[]" />
                                        </div>
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea name="observacoes" class="form-control" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" name="subetapaID" value="<?=$dados->subetapaID;?>">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-cloud-upload"></i> Importar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tekla">
                            <br />
                            <h4>Importação de arquivos padrão Tekla</h4>
                            <p>&nbsp;</p>
                            <h3>Em construção</h3>
                        </div>
                        <div class="tab-pane fade" id="cadem">
                            <br />
                            <h4>Importação de arquivos padrão ST_CadEM</h4>
                            <p>&nbsp;</p>
                            <h3>Em construção</h3>
                        </div>
                        <div class="tab-pane fade" id="manual">
                            <br />
                            <h4>Importação de arquivos Manual</h4>
                            <p>&nbsp;</p>
                            <h3>Em construção</h3>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Arquivos Importados
                </div>
                <!-- /.panel-heading -->
              <div class="panel-body">
                    <?php 
                    $nrArqui = 1;
                    foreach ($importacoes as $importacao) {
                        if ($nrArqui < $importacao->importacaoNr) {
                            echo '<hr />';
                            $nrArqui++;
                        }
                    ?>
                    <p align="center"><i class="fa fa-file-code-o fa-2x"></i> &nbsp;&nbsp; <strong><a href="<?=base_url() . 'arquivos/' . $importacao->locatarioID . '/' . $importacao->clienteID . '/' . $importacao->obraID . '/' . $importacao->etapaID . '/' . $importacao->subetapaID . '/' . $importacao->importacaoNr . '/' . $importacao->arquivo;?>" target="_blank"><?=$importacao->arquivo;?></a></strong> - <?=$importacao->importacaoNr;?>ª importação</p>
                    <?php
                    }
                    ?>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div> 
  <a href="<?=base_url() . 'saas/subetapa/listar/' . $dados->obraID . '/' . $dados->etapaID;?>" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>
