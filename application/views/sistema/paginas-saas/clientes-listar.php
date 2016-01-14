<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Clientes</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de clientes
                </div>
                <?php if (!empty($clientes)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th>Razão Social</th>
                                    <th>Fantasia</th>
                                    <th width="15%">Telefone</th>
                                    <th width="10%">Tipo</th>
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($clientes as $cliente) {
                                if ($cliente->tipo == 0) {
                                    $tipo = 'Física';
                                } else {
                                    $tipo = 'Jurídico';
                                }
                                ?>
                                <tr class="stripped">
                                    <td><a href="<?=base_url() . 'saas/clientes/ver/' . $cliente->clienteID;?>"><?=$cliente->razao;?></a></td>
                                    <td><?=$cliente->fantasia;?></td>
                                    <td class="telefone"><?=$cliente->fone;?></td>
                                    <td class="text-center"><?=$tipo;?></td>
                                     <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'saas/clientes/editar/' . $cliente->clienteID;?>" alt="Editar cliente" title="Editar cliente">
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
           <a href="<?=base_url('saas/clientes/cadastrar/');?>" type="button" class="btn btn-primary">Cadastrar cliente</a>
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