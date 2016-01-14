<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Detalhes da obra
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <strong><?=$obra->nome;?></strong><br />
                    <?php if(isset($obra->codigo)) echo '<strong>Código: ' . $obra->codigo . '</strong><br /><br />';?>
                    <?php if(isset($obra->endereco)) echo $obra->endereco . '<br />';?>
                    <?php if(isset($obra->nomeCidade)) echo $obra->nomeCidade . ', ' . $obra->nomeEstado . ' - ' . $obra->uf . '<br />';?>
                    <?php if(isset($obra->cep)) echo 'CEP: ' . $obra->cep . '<br />';?>
                    <?php if(isset($obra->descricao)) { ?>
                    <em><?=$obra->descricao;?></em>
                    <?php } ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php if (isset($cliente)) { ?>
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Detalhes do cliente
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <?php
                        if(isset($cliente->fantasia)) echo '<strong>' . $cliente->fantasia . '</strong><br />';
                        if(isset($cliente->razao)) echo '<strong>' . $cliente->razao . '</strong><br />';
                        echo '<br />';
                        if(isset($cliente->email)) echo 'Email: ' . $cliente->email . '<br />';
                        if(isset($cliente->site)) echo 'Site: ' . $cliente->site . '<br />';
                        if(isset($cliente->endereco)) echo $cliente->endereco . '<br />';
                        if(isset($cliente->nomeCidade)) echo $cliente->nomeCidade . ', ' . $cliente->nomeEstado . ' - ' . $cliente->uf . '<br />';
                        if(isset($cliente->cep)) echo 'CEP: ' . $cliente->cep . '<br />';
                        if(isset($cliente->fone)) echo 'Fone: ' . telefone($cliente->fone);
                    ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php } ?>

    <?php if (isset($construtora)) { ?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalhes da construtora
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <?php
                        if(isset($construtora->fantasia)) echo '<strong>' . $construtora->fantasia . '</strong><br />';
                        if(isset($construtora->razao)) echo '<strong>' . $construtora->razao . '</strong><br />';
                        echo '<br />';
                        if(isset($construtora->email)) echo 'Email: ' . $construtora->email . '<br />';
                        if(isset($construtora->site)) echo 'Site: ' . $construtora->site . '<br />';
                        if(isset($construtora->endereco)) echo $construtora->endereco . '<br />';
                        if(isset($construtora->nomeCidade)) echo $construtora->nomeCidade . ', ' . $construtora->nomeEstado . ' - ' . $construtora->uf . '<br />';
                        if(isset($construtora->cep)) echo 'CEP: ' . $construtora->cep . '<br />';
                        if(isset($construtora->fone)) echo 'Fone: ' . telefone($construtora->fone);
                    ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php } ?>

    <?php if (isset($gerenciadora)) { ?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalhes da gerenciadora
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <?php
                        if(isset($gerenciadora->fantasia)) echo '<strong>' . $gerenciadora->fantasia . '</strong><br />';
                        if(isset($gerenciadora->razao)) echo '<strong>' . $gerenciadora->razao . '</strong><br />';
                        echo '<br />';
                        if(isset($gerenciadora->email)) echo 'Email: ' . $gerenciadora->email . '<br />';
                        if(isset($gerenciadora->site)) echo 'Site: ' . $gerenciadora->site . '<br />';
                        if(isset($gerenciadora->endereco)) echo $gerenciadora->endereco . '<br />';
                        if(isset($gerenciadora->nomeCidade)) echo $gerenciadora->nomeCidade . ', ' . $gerenciadora->nomeEstado . ' - ' . $gerenciadora->uf . '<br />';
                        if(isset($gerenciadora->cep)) echo 'CEP: ' . $gerenciadora->cep . '<br />';
                        if(isset($gerenciadora->fone)) echo 'Fone: ' . telefone($gerenciadora->fone);
                    ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php } ?>

    <?php if (isset($calculista)) { ?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalhes do calculista
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <?php
                        if(isset($calculista->fantasia)) echo '<strong>' . $calculista->fantasia . '</strong><br />';
                        if(isset($calculista->razao)) echo '<strong>' . $calculista->razao . '</strong><br />';
                        echo '<br />';
                        if(isset($calculista->email)) echo 'Email: ' . $calculista->email . '<br />';
                        if(isset($calculista->site)) echo 'Site: ' . $calculista->site . '<br />';
                        if(isset($calculista->endereco)) echo $calculista->endereco . '<br />';
                        if(isset($calculista->nomeCidade)) echo $calculista->nomeCidade . ', ' . $calculista->nomeEstado . ' - ' . $calculista->uf . '<br />';
                        if(isset($calculista->cep)) echo 'CEP: ' . $calculista->cep . '<br />';
                        if(isset($calculista->fone)) echo 'Fone: ' . telefone($calculista->fone);
                    ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php } ?>

    <?php if (isset($detalhamento)) { ?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalhes do detalhamento
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <?php
                        if(isset($detalhamento->fantasia)) echo '<strong>' . $detalhamento->fantasia . '</strong><br />';
                        if(isset($detalhamento->razao)) echo '<strong>' . $detalhamento->razao . '</strong><br />';
                        echo '<br />';
                        if(isset($detalhamento->email)) echo 'Email: ' . $detalhamento->email . '<br />';
                        if(isset($detalhamento->site)) echo 'Site: ' . $detalhamento->site . '<br />';
                        if(isset($detalhamento->endereco)) echo $detalhamento->endereco . '<br />';
                        if(isset($detalhamento->nomeCidade)) echo $detalhamento->nomeCidade . ', ' . $detalhamento->nomeEstado . ' - ' . $detalhamento->uf . '<br />';
                        if(isset($detalhamento->cep)) echo 'CEP: ' . $detalhamento->cep . '<br />';
                        if(isset($detalhamento->fone)) echo 'Fone: ' . telefone($detalhamento->fone);
                    ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php } ?>

    <?php if (isset($montagem)) { ?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detalhes da montagem
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <address>
                    <?php
                        if(isset($montagem->fantasia)) echo '<strong>' . $montagem->fantasia . '</strong><br />';
                        if(isset($montagem->razao)) echo '<strong>' . $montagem->razao . '</strong><br />';
                        echo '<br />';
                        if(isset($montagem->email)) echo 'Email: ' . $montagem->email . '<br />';
                        if(isset($montagem->site)) echo 'Site: ' . $montagem->site . '<br />';
                        if(isset($montagem->endereco)) echo $montagem->endereco . '<br />';
                        if(isset($montagem->nomeCidade)) echo $montagem->nomeCidade . ', ' . $montagem->nomeEstado . ' - ' . $montagem->uf . '<br />';
                        if(isset($montagem->cep)) echo 'CEP: ' . $montagem->cep . '<br />';
                        if(isset($montagem->fone)) echo 'Fone: ' . telefone($montagem->fone);
                    ?>
                </address>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 text-right">
        <a href="<?=base_url() . 'saas/obras/editar/' . $obra->obraID;?>" type="button" class="btn btn-warning">Editar Obra</a>
    </div>
</div>