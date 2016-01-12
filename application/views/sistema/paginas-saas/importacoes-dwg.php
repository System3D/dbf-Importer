<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Arquivos de Banco Importados</h3>
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
                            <h4>Escolhe um arquivo DBF para enviar os desenhos</h4>
                            <br />
                            
                                
                                    <?php
                                        foreach($files as $file){
                                            $fileName = explode('/', $file['name']);
                                            $fileName = end($fileName);
                                    ?>
                                    <div style="border:1px solid #E4E4E4;margin-bottom:5px" class="panel-body">

                                        <span style="font-size:16px;"><strong><?= $fileName ?></strong></span>
                                        <a style="width:25%;float:right" href="<?=base_url() . 'saas/importacoes/gravardwg/'.$file['id'];?>" class="btn btn-primary btn-block">Importar</a>

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
