<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">DBFs</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de DBFs
                </div>
                <?php if (!empty($dados)) { ?>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover droptable" cellspacing="0" width="100%" id="tableData">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Marca</th>
                                    <th>Peso</th>
                                    <th>Desenho</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dados as $dado) {
                                ?>
                                <tr class="stripped">
                                    <td class="details-control"><?=$dado['dbfID'];?></td>
                                    <td><?=$dado['MAR_PEZ'];?></td>
                                    <td><?=$dado['peso'];?> Kg</td>
                                    <td><?=$dado['FLG_DWG'];?></td>
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
