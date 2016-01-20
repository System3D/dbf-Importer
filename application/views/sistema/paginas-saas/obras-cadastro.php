<?php
if (isset($edicao)) {
    $name  = 'form-obra-edita';
    $title = 'Edição';
} else {
    $name = 'form-obra';
    $title = 'Cadastro';
}
?>
 <section class="content-header">
          <h1>
            <?= $title ?> 
            <small>de Obra</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cadastrar Obra</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title;?> de obra
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div style="width:90%;margin-left:5%">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                                <div class="form-group" style='width:90%;margin-left:5%'>
                                    <label>Código da Obra:</label>
                                    <input class="form-control" name="codigo" id="codigo" <?php if (isset($edicao)) echo 'value="' . $obra->codigo . '"' ?>>
                                </div>
                                <div class="form-group" style='width:90%;margin-left:5%'>
                                    <label>Nome da Obra:</label>
                                    <input class="form-control" name="nome" id="nome" <?php if (isset($edicao)) echo 'value="' . $obra->nome . '"' ?>>
                                </div>
                                <div class="form-group" style='width:90%;margin-left:5%'>
                                    <label>Descrição:</label>
                                    <textarea rows="4" class="form-control" name="descricao" id="descricao"> <?php if (isset($edicao)) echo 'value="' . $obra->descricao . '"' ?></textarea>
                                </div>
                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="obraID" id="obraID" value="<?=$obraID;?>">
                                <?php } ?>

                                <button type="submit" class="btn btn-primary btn-block" style='width:80%;margin-left:10%'>Gravar</button>

                            </form>
                            </div>
                        </div>
                        <!-- /.col-lg-12 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        <div class="col-lg-4 hidden" id="tipoLoading" style="margin-top:20px;background:rgba(0,0,0,0)">
            <img style="width:10%;margin-left:45%"src="<?=base_url('assets/template/img/ajax-loader.gif');?>">
        </div>
        <div class="col-lg-4 hidden" id='tipoSuccess'>
            <div class="panel panel-success">
                <div class="panel-heading">
                    Obra Gravada com Sucesso!
                </div>
                <div class="panel-body">
                    <p>Os dados para seu cliente logar-se estão disponiveis na sessão Usuarios-Gerenciar. Procure pelo nome ou Codigo da Obra. </p>
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
                    <p>A obra não pôde ser gravado, tente novamente mais tarde!</p>
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
                    <p>A obra não pôde ser gravado, verifique os dados</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</section>
<script type="text/javascript" src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
   function search_cities(estadoID){
        $.post("<?=base_url();?>service/enderecos/cidades", {
            estadoID : estadoID
        }, function(data){
            $('#cidade').html(data);
        });
    };
</script>