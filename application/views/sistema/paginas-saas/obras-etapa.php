<?php
if($tipo == 'addetapa')
    $typ = ' Etapa';
if($tipo == 'addimport')
    $typ = ' Importação';
?>

    <section class="content-header">
          <h1>
            Obras
            <small>Escolha uma Obra</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Obras</li>
          </ol>
        </section>
    <!-- /.row -->

     <section class="content">
          <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Escolha uma obra
                </div>
                <?php if (!empty($obras)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="10%">Código</th>
                                    <th>Nome</th>
                                    <th>Cliente</th>
                                    <th width="10%">Data</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($obras as $obra) { ?>

                            <?php
                                if ($obra->statusObra == 0) {
                                    $status = 'Inativo';
                                    $tipoStatus = 'danger';
                                    $acaoStatus = 'ativar';
                                }else{
                                    $status = 'Ativo';
                                    $tipoStatus = 'success';
                                    $acaoStatus = 'inativar';
                                }
                                ?>
                                <tr class="<?=$tipoStatus;?>" >
                                    <td><?=$obra->codigo;?></td>
                                    <?php if($tipo == 'addetapa'){ ?>
                                    <td><a href="<?=base_url() . 'saas/etapas/cadastrar/' . $obra->obraID?>"><?=$obra->nome;?></a></td>
                                    <?php }elseif($tipo == 'addimport'){ ?>
                                     <td><a href="<?=base_url() . 'saas/importacoes/etapas/' . $obra->obraID?>"><?=$obra->nome;?></a></td>
                                     <?php } ?>
                                    <td><?=$obra->fantasia;?></td>
                                    <td><?=dataMySQL_to_dataBr($obra->data);?></td>
                                    <td class="text-center">
                                        <span class="text-<?=$tipoStatus;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.panel-body -->
                <?php } else { ?>
                <div class="panel-heading">
                    <h4>Nada ainda cadastrado!</h4>
                </div>
                <?php } ?>
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-6 col-md-6">
            <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
           <a href="<?=base_url('saas/obras/cadastrar/');?>" type="button" class="btn btn-primary">Cadastrar Obra</a>
        </div>
    </div>
</section>
    <br /><hr /><br />
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true
    });
});
</script>