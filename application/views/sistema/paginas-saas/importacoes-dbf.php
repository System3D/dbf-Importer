<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Importação de arquivos</h3>
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
                            <h4>Importação de arquivos padrão Tecnometal</h4>
                            <br />
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="<?=base_url() . 'saas/importacoes/gravardbf';?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Arquivo DFB</label>
                                            <input type="file" name="dbf" />
                                        </div>
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea name="observacoes" class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-cloud-upload"></i> Importar</button>
                                    </form>
                                </div>
                            </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>

        <div class="col-lg-4">
            <?php
                if(!empty($this->session->flashdata('danger'))){
                ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro!
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
                elseif(!empty($this->session->flashdata('todelete'))){
                    list($delName, $delID) = explode('&xx&',$this->session->flashdata('todelete'));
                ?>
             <div class="panel panel-primary" id="rusure">
                <div class="panel-heading">
                    Realmente Deseja deletar o banco <strong><?= $delName ?></strong>?
                </div>
                <div class="panel-body">
                    <p>Saiba que ao deletar um banco DBF todas informações, arquivos e desenhos ligadas a ele serão deletados completamente do sistema. <br />
                        <br>Continuar? </p>
                    <div style="text-align:center;font-size:20px;margin-bottom:none;padding-bottom:none">
                        <a href="<?= base_url()."saas/importacoes/excluirdbf/".$delID ?>" style="color:green">SIM</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?= base_url()."saas/importacoes/dbf" ?>" style="color:red">NÃO</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-lg-4">
         <div class="panel panel-default">
            <div class="panel-heading">
                Bancos Importados
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
       <?php
            if(!isset($files)){
                echo "<h5>Sem Bancos Cadastrados.</h5>";
            }else{
                foreach($files as $fil){
                 $name =    explode('/',$fil['name']);
                 $name = end($name);
                $path = $fil['name'];
                $path=explode('/',$path);
                array_shift($path);
                array_shift($path);
                array_shift($path);
                array_shift($path);
                $path = base_url(implode('/',$path));

            ?>
            <div class="row">
             <div class="col-lg-12" id="editorino">
                <h5 style='font-size:16px'>Nome: <strong><?= $name ?></strong>
                <div style="float:right;margin-right:15px">
                <a href="<?= base_url()."saas/importacoes/todeletedbf/".$fil['id'] ?>"  title="Excluir" style="color:red"><i class="fa fa-trash-o fa"></i></a>
                &nbsp;
                <a href="<?= $path ?>" target="_blank" title="Download" style="color:#323232"><i class="fa fa-download fa"></i></a>
                </div>
                </h5>
            <?php if(isset($fil['observacao'])){ ?>
                <p style='font-size:12px;padding:5px'> <?= $fil['observacao'] ?> </p>
                <?php } ?>
              </div>
            </div>
            <?php
                }
            }
            ?>   
         </div>
      </div>
    </div>
    </div> 
  <a style="float:left" href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>
