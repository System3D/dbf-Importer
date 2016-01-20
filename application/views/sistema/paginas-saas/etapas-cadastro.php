<?php
if (isset($edicao)) {
    $name  = 'form-etapa-edita';
    $title = 'Edição';
} else {
    $name = 'form-etapa';
    $title = 'Cadastro';
}
?>
 <section class="content-header">
          <h1>
            <?= $title ?> de Etapas
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url('saas/importacoes/obras');?>"><i class="fa fa-building"></i> Obras</a></li>
            <li class="active">Etapas</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title;?> de etapa
                </div>
                <div class="panel-body" style='width:90%;margin-left:5%'>
                    <div class="row">
                         <div class="col-lg-12">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Código da Etapa:</label>
                                    <input class="form-control" name="codigoEtapa" id="codigoEtapa" <?php if (isset($edicao)) echo 'value="' . $etapa->codigoEtapa . '"' ?>>
                                </div>  

                                <div class="form-group">
                                    <label>Observação:</label>
                                    <textarea class="form-control" rows="3" id="observacao" name="observacao"><?php if (isset($edicao) && $etapa->observacao != '') echo $etapa->observacao;?></textarea>
                                </div>


                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="etapaID" id="etapaID" value="<?=$etapa->etapaID;?>">
                                <?php } ?>
                                <input type="hidden" name="obraID" id="obraID" value="<?=$obraID;?>">

                                <button type="submit" style='width:90%;margin-left:5%' class="btn btn-primary btn-block">Gravar</button>

                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4 hidden" id="tipoLoading" style="margin-top:20px;background:rgba(0,0,0,0)">
            <img style="width:10%;margin-left:45%"src="<?=base_url('assets/template/img/ajax-loader.gif');?>">
        </div>
        <div class="col-lg-4 hidden" id="tipoSuccess">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>A etapa foi gravada com sucesso!</p>
                </div>
             </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-4 hidden" id="tipoError">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>A etapa não pôde ser gravado, tente novamente mais tarde!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <div class="col-lg-4 hidden" id="tipoError2">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>A etapa não pôde ser gravado, verifique os dados</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>
</section>