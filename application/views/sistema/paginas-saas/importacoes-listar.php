<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Importações</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de Importações
                </div>
                <?php if (!empty($import)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th>Arquivo</th>
                                    <th>Obra</th>
                                    <th>Etapa</th>
                                    <th>Sub-Etapa</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($import as $imp) {
                                ?>
                                <tr class="stripped">
                                    <td><a href="<?=$imp->path;?>"  target="_blank"><?=$imp->arquivo;?></a></td>
                                    <td><a href="<?=base_url() . 'saas/obras/ver/'.$imp->obraID;?>"><?=$imp->nome;?></a></td>
                                    <td><a href="<?=base_url() . 'saas/obras/ver/'.$imp->obraID;?>"><?=$imp->codigoEtapa;?></a></td>
                                    <td><a href="<?=base_url() . 'saas/subetapa/listar/'.$imp->obraID.'/'.$imp->etapaID;?>"><?=$imp->codigoSubetapa;?></a></td>
                                    <td><a href="<?=base_url() . 'saas/clientes/ver/'.$imp->clienteID;?>"><?=$imp->razao;?></a></td>
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
    </div>
    <br /><hr /><br />
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true
    });
});
</script>