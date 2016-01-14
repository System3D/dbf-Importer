<?php
if (isset($edicao)) {
    $tipo = 'Editar Perfil';
} else {
    $tipo = 'Perfil de Usuario';
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?= $tipo ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Perfil de Usuario
                </div>
                <?php if (!empty($usuario)) { ?>
                <div class="panel-body">
                    <div class="row">

                         <div class="col-lg-12">
                            <?php
                            if (!isset($edicao)) { ?>
                            <form role="form" name="profile" id="profile" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input class="form-control" disabled name="nome" id="nome" value="<?=$usuario->nome;?>">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" disabled name="email" id="email" value="<?=$usuario->email;?>">
                                </div>
                                <div class="form-group">
                                    <label>Funcionario de:</label>
                                    <input class="form-control" disabled name="fantasia" id="fantasia" value="<?=$usuario->empregador;?>">
                                </div>
                                 <div class="form-group">
                                    <label>Tipo de Usuario:</label>
                                    <input class="form-control" disabled name="usertype" id="usertype"  value="<?=$usuario->tipoUsuario;?>">
                                </div>
                            </form>
                            <a style="float:left" href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
                             <div class="text-right" style="float:right">
                               <a href="<?=base_url('saas/profile/editar/');?>" type="button" class="btn btn-primary">Editar Dados</a>
                            </div>
                            <?php }else{ ?>
                             <form role="form" name="profileEdit" id="profileEdit" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input class="form-control" name="nome" id="nome" value="<?=$usuario->nome;?>">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" name="email" id="email" value="<?=$usuario->email;?>">
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Usuário:</label>
                                    <select class="form-control" name="tipoUsuario" id="tipoUsuario" <?php if (isset($disable)) echo 'disabled'; ?>>
                                        <option value="1" <?php if($usuario->tipoUsuario == 1) echo 'selected'; ?>>Administrador</option>
                                        <option value="2" <?php if($usuario->tipoUsuario == 2) echo 'selected'; ?>>Planejamento</option>
                                        <option value="3" <?php if($usuario->tipoUsuario == 3) echo 'selected'; ?>>Engenharia</option>
                                        <option value="4" <?php if($usuario->tipoUsuario == 4) echo 'selected'; ?>>PCP</option>
                                        <option value="5" <?php if($usuario->tipoUsuario == 5) echo 'selected'; ?>>Apontador</option>
                                        <option value="6" <?php if($usuario->tipoUsuario == 6) echo 'selected'; ?>>Montagem</option>
                                        <option value="7" <?php if($usuario->tipoUsuario == 7) echo 'selected'; ?>>Qualidade</option>
                                        <option value="8" <?php if($usuario->tipoUsuario == 8) echo 'selected'; ?>>Almoxarifado</option>
                                        <option value="9" <?php if($usuario->tipoUsuario == 9) echo 'selected'; ?>>Gestor</option>
                                    </select>
                                </div>
                                <input type="hidden" name="userID" id="userID" value="<?=$usuario->usuarioLocatarioID;?>">
                                <input type="hidden" name="roleID" id="roleID" value="<?=$usuario->tipoUsuarioID;?>">
                            
                             <div class="text-right" style="float:right">
                               <button style="float:right" type="submit" class="btn btn-primary btn-block">&nbsp;&nbsp;Atualizar&nbsp;&nbsp;</button>
                            </div>
                            </form>
                            <a style="float:left" href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
                            <?php } ?>
                          </div>
                          <!-- /.col-lg-6 (nested) -->
                    
         <div class="col-lg-6 hidden" id="tipoLoading" style="margin-top:20px;background:rgba(0,0,0,0)">
                <img style="width:10%;margin-left:45%"src="<?=base_url('assets/img/ajax-loader.gif');?>">
        </div>
        <div class="col-lg-6 hidden" id="tipoSuccess" style="margin-top:20px">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Atualizado com sucesso!
                </div>
                <div class="panel-body">
                    <p>Todas modificações foram salvas com sucesso!</p>
                </div>
             </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-6 hidden" id="tipoError" style="margin-top:20px">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao atualizar!
                </div>
                <div class="panel-body">
                    <p>O perfil não pode ser atualizado, tente novamente mais tarde!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <div class="col-lg-6 hidden" id="tipoError2" style="margin-top:20px">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    Erro ao atualizar!
                </div>
                <div class="panel-body">
                    <p>O perfil não pode ser atualizado, possivelmente já existe!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
            </div>
                        <!-- /.col-lg-12 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                    <?php } //endif ?>

             </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    <br /><hr /><br />
</div>
<script type="text/javascript" src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
