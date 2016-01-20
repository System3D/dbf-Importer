<?php
    if (isset($edicao)) {
        $name = 'form-usuario-edita';
        $title = 'Edição';
    } else {
        $name = 'form-usuario';
        $title = 'Cadastro';
    }

    if(isset($disable)){
        $title = 'Perfil';
        $name = '';
    }
?>
 <section class="content-header">
          <h1>
            <?= $title ?>
            <small> De Usuario</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> <?= $title ?> de Usuario</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title;?> de usuário
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Nome/Obra:</label>
                                    <input class="form-control" name="nome" id="nome" <?php if (isset($edicao)) echo 'value="' . $usuarioLocatario->nome . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <div class="form-group">
                                    <label>Email/Codigo:</label>
                                    <input class="form-control" name="email" id="email" <?php if (isset($edicao)) echo 'value="' . $usuarioLocatario->email . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <?php if(!isset($disable) || $usuarioLocatario->tipoUsuarioID == 7){ ?>
                                 <div class="form-group">
                                    <label>Senha:</label>
                                    <input class="form-control" name="senha" id="senha" <?php if (isset($edicao)) echo 'value="' . $usuarioLocatario->password . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label>Tipo de Usuário:</label>
                                    <select class="form-control" name="tipoUsuarioID" id="tipoUsuarioID" <?php if (isset($disable) || $this->session->userdata('tipoUsuarioID') != 1) echo 'disabled'; ?>>
                                        <option value="1" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 1) echo 'selected'; ?>>Administrador</option>
                                        <option value="2" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 2) echo 'selected'; ?>>Master</option>
                                        <option value="3" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 3) echo 'selected'; ?>>Projetista</option>
                                        <option value="4" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 4) echo 'selected'; ?>>Revisão</option>
                                        <option value="5" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 5) echo 'selected'; ?>>Fabricação</option>
                                        <option value="6" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 6) echo 'selected'; ?>>Montagem</option>
                                        <option value="7" <?php if(isset($edicao) && $usuarioLocatario->tipoUsuarioID == 7) echo 'selected'; ?>>Cliente</option>
                                    </select>
                                </div>

                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="usuarioLocatarioID" id="usuarioLocatarioID" value="<?=$usuarioLocatario->usuarioLocatarioID;?>">
                                <?php } ?>
                                <?php if (isset($disable)) { ?>
                                <a href="<?=base_url() . 'saas/usuarios/editar/' . $usuarioLocatario->usuarioLocatarioID;?>" type="button" class="btn btn-primary btn-block">Editar</a>
                                <?php } else { ?>
                                <button type="submit" class="btn btn-primary btn-block">Gravar</button>
                                <?php } ?>
                            </form>
                        </div>
                        <!-- /.col-lg-12 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
         <div class="col-lg-4 hidden" id="tipoLoading" style="margin-top:20px;background:rgba(0,0,0,0)">
            <img style="width:10%;margin-left:45%"src="<?=base_url('assets/template/img/ajax-loader.gif');?>">
        </div>
        <div class="col-lg-6 hidden" id="tipoSuccess">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>O usuário foi gravado com sucesso e já pode ser utilizado!</p>
                </div>
             </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-6 hidden" id="tipoError">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>O usuário não pôde ser gravado, tente novamente mais tarde!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <div class="col-lg-6 hidden" id="tipoError2">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>O usuário não pôde ser gravado, veja se o email já não existe!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</section>