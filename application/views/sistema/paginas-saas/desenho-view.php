<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if(isset($nomeDBF)){
            ?>
            <h3 class="page-header">GRD Referente ao Banco <i style='font-size:22px'><?= $nomeDBF; ?></i></h3>
            <?php
                }else{
            ?>
            <h3 class="page-header">GRD Referente a todos Bancos Cadastrados</h3>
            <?php } ?>
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
                <?php if ($Desenhos && $Pesos && $Conjuntos) { ?>
    <div class="panel-body">
      <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover droptable" cellspacing="0" width="100%" id="dataTables">
        <thead>
            <tr>
                
                <th>Conjunto(Marca)</th>
                <th>Tipologia</th>
                <th>Desenho</th>
                <th>Quantidade</th>
                <th>Peso Unidade(Kg)</th>
                <th>Peso Total(Kg)</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>PESO TOTAL</td>
                <td>  </td>
                <td>  TOTAL GRD  </td>
                <td>  </td>
                <td>  </td>
                <td> <?= $Pesos['total'] ?> </td>
            </tr>
             <?php 
            foreach ($Desenhos as $des) { 
                ?>
                <tr>
                    
                    <td>PESO TOTAL </td>
                    <td><?php // $Conjuntos[$des][0]['DES_PEZ'] ?? '-' ?> - </td>
                    <td>Desenho - <?= $des ?></td>
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
                    
                    <td><?= $con['MAR_PEZ'] ?></td>
                    <td><?= $con['DES_PEZ'] ?></td>
                    <td>Desenho - <?= $con['FLG_DWG'] ?></td>
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
        <div class="row" style="margin-top:15px">
        <div class="col-lg-6 col-md-6">
            <a href="javascript:history.back()" type="button" class="btn btn-default" style="margin-left:10px"><< Voltar</a>
        </div>
        <?php
            if(isset($this_id) && isset($Conjuntos)){
        ?>
        <div class="col-lg-6 col-md-6">
            <a href="<?=base_url('')."saas/conjuntos/makeGrd/".$this_id;?>" class="btn btn-logout btn-block" style="width:30%;float:right;margin-right:10px">Gerar PDF</a>
        </div>
        <?php } ?>
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
