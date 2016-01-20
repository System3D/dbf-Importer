 <section class="content-header">
          <h1>
            GRD Referente a  <i style='font-size:22px'><?= $nomeDBF; ?></i>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url('saas/importacoes/obras');?>"><i class="fa fa-building"></i> Obras</a></li>
            <li><a href="<?=base_url('saas/importacoes/etapas').'/'.$import->etapaID;?>"><i class="fa fa-crop"></i> Etapas</a></li>
            <li><a href="<?=base_url('saas/importacoes/painel').'/'.$import->importacaoID;?>"><i class="fa fa-upload"></i> Importações</a></li>
            <li><a href="<?=base_url('saas/importacoes/gravardwg').'/'.$import->importacaoID;?>"><i class="fa fa-picture-o"></i> Desenhos</a></li>
            <li class="active">GRD</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">
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
                <th>Desenho</th>
                <th>Conjunto(Marca)</th>
                <th>Desenho</th>
                <th>Tipologia</th>
                <th>Quantidade</th>
                <th>Peso Unidade(Kg)</th>
                <th>Peso Total(Kg)</th>
            </tr>
        </thead>
        <tbody>

            <tr style="font-size:18px">
                <td>PESO TOTAL</td>
                <td>  </td>
                <td>  TOTAL GRD  </td>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                <td>  <?= number_format($Pesos['total'], 2, ',', '.'); ?> </td>
            </tr>
             <?php 
             $xcx = 1;
            foreach ($Desenhos as $des) { 
                ?>
                <tr class="secRow">

                    <td><?= $des ?></td>
                    <td> - </td>
                    <td><?= $des ?></td>
                    <td><?= $Conjuntos[$des][0]['DES_PEZ'] ? $Conjuntos[$des][0]['DES_PEZ'] : '-' ?></td>
                    <td> - </td>
                    <td> - </td>
                    <td><?= number_format($Pesos[$des], 2, ',', '.'); ?></td>
                </tr>
                <?php  
                foreach($Conjuntos as $conj){
                   foreach($conj as $con){
                     if($con['FLG_DWG'] == $des){
                    ?>
                     <tr>
                    <td><?= $con['FLG_DWG'] ?></td>
                    <td><?= $con['MAR_PEZ'] ?></td>
                    <td><?= $con['FLG_DWG'] ?></td>
                    <td><span class="xedit" key="DES_PEZ" id="<?= $xcx ?>"><?= $con['DES_PEZ'] ?></span></td>
                    <td><?= $con['QTA_PEZ'] ?></td>
                    <td><?= number_format($con['PESO_QTA'], 2, ',', '.');  ?></td>
                    <td><?= number_format($con['peso'], 2, ',', '.'); ?></td>
                     </tr>
            <?php   $xcx++;
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
