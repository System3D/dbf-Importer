<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Usuários</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de usuários
                </div>
                <?php if (!empty($locatariosUsuarios)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($locatariosUsuarios as $loc) {
                                switch ($loc->tipoUsuarioID) {
                                    case 1:
                                        # Administrador
                                        $tipo = 'Administrador';
                                        break;
                                    case 2:
                                        # Planejamento
                                        $tipo = 'Planejamento';
                                        break;
                                    case 3:
                                        # Engenharia
                                        $tipo = 'Engenharia';
                                        break;
                                    case 4:
                                        # PCP
                                        $tipo = 'PCP';
                                        break;
                                    case 5:
                                        # Apontador
                                        $tipo = 'Apontador';
                                        break;
                                    case 6:
                                        # Montagem
                                        $tipo = 'Montagem';
                                        break;
                                    case 7:
                                        # Qualidade
                                        $tipo = 'Qualidade';
                                        break;
                                    case 8:
                                        # Almoxarifado
                                        $tipo = 'Almoxarifado';
                                        break;
                                    case 9:
                                        # Gestor
                                        $tipo = 'Gestor';
                                        break;
                                    }
                                if ($loc->status == 0) {
                                    $status = 'Inativo';
                                    $tipoStatus = 'danger';
                                    $acaoStatus = 'ativar';
                                } else {
                                    $status = 'Ativo';
                                    $tipoStatus = 'success';
                                    $acaoStatus = 'inativar';
                                }
                                ?>
                                <tr class="<?=$tipoStatus;?>">
                                <td><a href="<?=base_url() . 'saas/usuarios/ver/' . $loc->usuarioLocatarioID;?>"><?=$loc->nome;?></a></td>
                                    <td><?=$loc->email;?></td>
                                    <td class="text-center"><?=$tipo;?></td>
                                    <td class="text-center">
                                        <span class="text-<?=$tipoStatus;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'saas/usuarios/editar/' . $loc->usuarioLocatarioID;?>" alt="Editar usuário" title="Editar usuário">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?=base_url() . 'saas/usuarios/editarStatus/' . $loc->usuarioLocatarioID . '/' . $acaoStatus;?>" alt="Mudar Status" title="Mudar Status">
                                                <i class="fa fa-refresh fa-fw"></i>
                                            </a>
                                             &nbsp;
                                            <a href="<?=base_url() . 'saas/usuarios/excluir/' . $loc->usuarioLocatarioID;?>" alt="Excluir usuário" title="Excluir usuário" onclick="return confirma_exclusao('<?=$loc->nome;?>')">
                                                <i class="fa fa-times fa-fw"></i>
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
                    <h4>Nenhum usuário cadastrado ainda!</h4>
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
           <a href="<?=base_url() . 'saas/usuarios/cadastrar/';?>" type="button" class="btn btn-primary">Cadastrar usuário</a>
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
<script>
    function confirma_exclusao(nomeUsuario) {
        if (!confirm("Deseja realmente excluir o usuário: '" + nomeUsuario + "' ?")) {
            return false;
        }
        return true;
    }
</script>