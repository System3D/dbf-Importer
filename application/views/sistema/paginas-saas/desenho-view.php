<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Desenhos</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de Desenhos
                </div>
                <?php if (!empty($Desenhos)) { ?>
                



    <div class="panel-body">
      <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover droptable" cellspacing="0" width="100%" id="dataTables">
        <thead>
            <tr>
                <th>Desenho</th>
                <th>Conjunto(Marca)</th>
                <th>Tipologia</th>
                <th>Quantidade</th>
                <th>Peso Unidade(Kg)</th>
                <th>Peso Total(Kg)</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>TOTAL GRD</td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> <?= $Pesos['total'] ?> </td>
            </tr>
             <?php 
            foreach ($Desenhos as $des) {
                ?>
                <tr>
                    <td><?= $des ?></td>
                    <td> - </td>
                    <td><?= $Conjuntos[$des][0]['DES_PEZ'] ?? '-' ?></td>
                    <td> - </td>
                    <td> - </td>
                    <td> <?= $Pesos[$des] ?> </td>
                </tr>
                <?php 
                foreach($Conjuntos as $conj){
                   foreach($conj as $con){
                     if($con['FLG_DWG'] == $des){
                    ?>
                     <tr>
                    <td><?= $con['FLG_DWG'] ?></td>
                    <td><?= $con['MAR_PEZ'] ?></td>
                    <td><?= $con['DES_PEZ'] ?></td>
                    <td><?= $con['QTA_PEZ'] ?></td>
                    <td><?= $con['PESO_QTA'] ?></td>
                    <td><?= $con['peso'] ?></td>
                     </tr>
            <?php   
                    }
                  }
                }
            } 
            ?>      
        </tbody>
         </table>
            </div>








                <!-- /.panel-heading -->
                

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
