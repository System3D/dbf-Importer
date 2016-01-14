<div class="row">
    <div class="col-lg-12">

            <?php if (!empty($etapas)) { ?>
            <div class="row">
            <?php  $cont = 1;
            foreach ($etapas as $etapa) { ?>
            <div class="col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <span class="text-left">
                            <a href="<?=base_url() . 'saas/etapas/editar/' . $etapa->obraID . '/' . $etapa->etapaID;?>" title="Editar">Código: <?=$etapa->codigoEtapa;?></a>
                        </span>
                        <span class="pull-right">
                             <a href="<?=base_url() . 'saas/etapas/excluir/' . $etapa->obraID . '/' . $etapa->etapaID;?>" onclick="return confirma_exclusao('<?='Código ' . $etapa->codigoEtapa;?>')" ><i class="fa fa-times"></i> Excluir</a>
                        </span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <strong>Peso: </strong><?=peso($etapa->peso);?><br /><br />
                        <strong>Detalhes da etapa:</strong><br /><br />
                        <?php if($etapa->estruturaPrincipal == 1) echo '<p class="fa fa-check"> Estrutura Principal</p><br />';?>
                        <?php if($etapa->estruturaSecundaria == 1) echo '<p class="fa fa-check"> Estrutura Secundária</p><br />';?>
                        <?php if($etapa->telhasCobertura == 1) echo '<p class="fa fa-check"> Telhas de cobertura</p><br />';?>
                        <?php if($etapa->telhasFechamento == 1) echo '<p class="fa fa-check"> Telhas de fechamento</p><br />';?>
                        <?php if($etapa->calhas == 1) echo '<p class="fa fa-check"> Calhas</p><br />';?>
                        <?php if($etapa->rufosArremates == 1) echo '<p class="fa fa-check"> Rufos e arremates</p><br />';?>
                        <?php if($etapa->steelDeck == 1) echo '<p class="fa fa-check"> SteelDeck</p><br />';?>
                        <?php if($etapa->gradesPiso == 1) echo '<p class="fa fa-check"> Grades e pisos</p><br />';?>
                        <?php if($etapa->escadas == 1) echo '<p class="fa fa-check"> Escadas</p><br />';?>
                        <?php if($etapa->corrimao == 1) echo '<p class="fa fa-check"> Corrimão</p><br />';?>

                        <?php if(isset($etapa->outro) && $etapa->outro != '') echo '<p class="fa fa-check"> <strong>Outro:</strong> ' . $etapa->outro . '<p><br />';?>
                        <?php if(isset($etapa->observacao) && $etapa->observacao != '') { ?>
                        <br /><em><strong>Observações:</strong></em><br />
                        <em><?=$etapa->observacao;?></em>
                        <?php } ?>

                        <hr />
                        <?php if(!empty($etapa->subetapas) && $etapa->subetapas != ''){ ?>
                        <h4>Subetapas Cadastradas:</h4>
                        <?php foreach ($etapa->subetapas as $subetapa) { ?>
                        <p><a href="<?=base_url() . 'saas/subetapa/listar/' . $etapa->obraID . '/' . $etapa->etapaID;?>">Código: <?=$subetapa->codigoSubetapa;?></a></p>
                        <?php } ?>
                        <?php } ?>
                        <p align="right"><a class="btn btn-primary" href="<?=base_url() . 'saas/subetapa/listar/' . $etapa->obraID . '/' . $etapa->etapaID;?>">Cadastrar Sub-etapa</a></p>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <?php
                if($cont%3==0) {
                    echo '<div class="col-lg-12">&nbsp;</div>';
                }
                $cont++;
            ?>
            <?php } //Final do FOREACH ?>
        </div>
            <?php } else { ?>
            <div class="panel-heading">
                <h4>Nenhuma etapa cadastrada!</h4>
            </div>
            <?php } ?>

        <div class="col-lg-12 col-md-12 text-right">
           <a href="<?=base_url() . 'saas/etapas/cadastrar/' . $obra->obraID;?>" type="button" class="btn btn-primary">Cadastrar etapa</a>
        </div>
        <!-- /.panel -->
    </div>
</div>
<script>
    function confirma_exclusao(codigoEtapa) {
        if (!confirm("Deseja realmente excluir a etapa: '" + codigoEtapa + "' ?")) {
            return false;
        }
        return true;
    }
</script>