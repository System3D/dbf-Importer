<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Obras</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de obras
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
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($obras as $obra) { ?>
                            <?php
                                if ($obra->status == 0) {
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
                                    <td><?=$obra->codigoObra;?></td>
                                    <td><a href="<?=base_url() . 'saas/obras/ver/' . $obra->obraID?>"><?=$obra->nomeObra;?></a></td>
                                    <td><?=$obra->fantasia;?></td>
                                    <td><?=dataMySQL_to_dataBr($obra->data);?></td>
                                    <td class="text-center">
                                        <span class="text-<?=$tipoStatus;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                             <a href="<?=base_url() . 'saas/obras/editarStatus/' . $obra->obraID . '/' . $acaoStatus;?>" alt="Mudar Status" title="Mudar Status" style="text-decoration:none">
                                                <i class="fa fa-refresh fa-fw"></i>
                                            </a>
                                            <a href="<?=base_url() . 'saas/obras/editar/' . $obra->obraID;?>" alt="Editar obra" title="Editar obra">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                        </div>
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
    <br /><hr /><br />
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true
    });
});
</script>