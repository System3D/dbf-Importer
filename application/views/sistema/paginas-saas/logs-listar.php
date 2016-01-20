 <section class="content-header">
          <h1>
            Logs do Sistema
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Logs</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de logs
                </div>
                <?php if (!empty($logs)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="tableData">
                            <thead>
                                <tr>
                                    <th width="10%">LogID</th>
                                    <th width="15%">Usuário</th>
                                    <th>Email</th>
                                    <th>Ação</th>
                                    <th width="20%">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($logs as $log) { ?>
                                <tr class="stripped">
                                    <td align="center"><?=$log->logID;?></td>
                                    <td><?=$log->nome;?></td>
                                    <td><?=$log->email;?></td>
                                    <td><?=$log->acao;?></td>
                                    <td><?=dataCompletaMySQL_to_dataBr($log->data);?></td>
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
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables').DataTable({
        "order": [[ 0, "desc" ]],
        responsive: true
    });
});
</script>