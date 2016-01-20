 <section class="content-header">
          <h1>
            Etapas
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Escolha uma Etapa
                </div>
                <?php if (!empty($etapas)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="normalTable">
                            <thead>
                                <tr>
                                    <th width="10%">Código</th>
                                    <th>Observacao</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($etapas as $etapa) { ?>
                                    <td><a href="<?=base_url('saas/importacoes/painel').'/'.$etapa->etapaID;?>"><?=$etapa->codigoEtapa;?></a></td>
                                    <td><?=$etapa->observacao;?></td>
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
           <a href="<?=base_url('saas/etapas/cadastrar').'/'.$obra->obraID;?>" type="button" class="btn btn-primary">Cadastrar Etapa</a>
        </div>

    </div>
    <br /><hr /><br />
</div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true
    });
});
</script>