 <section class="content-header">
          <h1>
            Suas Importações
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Suas Importações</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">
    <div class="row">
    	<?php
    		foreach($imports as $import){
    		$stat = ($import->status == 0) ? 'panel-main' : (($import->status == 1) ? 'panel-success2' : (($import->status == 2) ? 'panel-danger2' : 'panel-info2'));
    		$fa = ($import->status == 0) ? 'fa-paper-plane-o' : (($import->status == 1) ? 'fa-check' : (($import->status == 2) ? 'fa-exclamation-circle' : 'fa-clock-o'));
    		$msg = ($import->status == 0) ? 'Aguardando Envio' : (($import->status == 1) ? 'Enviado e Aprovado' : (($import->status == 2) ? 'Enviado e Reprovado' : 'Aguardando Revisão'));
    	?>
     <div class="col-lg-4">
         <div class="panel <?= $stat ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa <?= $fa ?> fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h2 style='color:#fff'><?= $import->name ?></h2>
                            <div><?php echo $import->nome.' / '.$import->codigoEtapa ?></div>
                        </div>
                    </div>
                </div>
                <div class="panel-list">
                	<h4 style="margin-left:15px">  Banco :: <?= $import->arquivo ?></h4>
                	
                    <?php if(!empty($import->observacoes )){ ?>
                    <hr>
                    <p style='margin-left:10px'><?= $import->observacoes ?></p>
                    <?php } ?>
                    <?php if(!empty($import->revisao )){ ?>
                    <hr>
                    <p style='margin-left:10px'><?= $import->revisao ?></p>
                    <?php } ?>
                </div>
                    <div class="panel-footer">
                        <span class="text-center"> <i class="fa <?= $fa ?> fa"></i>&nbsp;&nbsp;<?= $msg ?></span>
                        <a class="footerlink" style='float:right;margin-right:5px;color:#424242' href="<?=base_url() . 'saas/importacoes/gravardwg/'.$import->importacaoID;?>">Ver Mais &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
            </div>
          </div>
        <?php } ?>
    </div>
</section>