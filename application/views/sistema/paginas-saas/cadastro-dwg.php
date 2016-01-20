 <section class="content-header">
          <h1>
            Arquivos de <i><?= $import->name ?></i>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url('saas/importacoes/obras');?>"><i class="fa fa-building"></i> Obras</a></li>
            <li><a href="<?=base_url('saas/importacoes/etapas').'/'.$import->etapaID;?>"><i class="fa fa-crop"></i> Etapas</a></li>
            <li><a href="<?=base_url('saas/importacoes/painel').'/'.$import->importacaoID;?>"><i class="fa fa-upload"></i> Importações</a></li>
            <li class="active">Desenhos</li>
          </ol>
        </section>
    <!-- /.row -->

  <section class="content">

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Importações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                        $filename = (string )$dados[0]->fileName;
                        $filname = explode('/',$filename);
                        $filname = end($filname);
                    ?>
                    <h4>Conjuntos de <?= $filname ?></h4>
                    <br />
                            <?php
                                foreach($dados as $file){
                            ?>
                            <div class="row">
                             <div class="col-lg-12">
                                <h5>Marcação/Desenho: <?= $file->MAR_PEZ ?> / <?= $file->FLG_DWG ?></h5>
                              </div>
                            </div>
                            <?php
                                }
                            ?>
                        
                            
                </div>
                <!-- /.panel-body -->
            </div>
            <a href="<?=base_url() . 'saas/conjuntos/grd/'.$IDfil;?>" style="width:90%;margin-left:5%" class="btn btn-logout btn-block">Visualizar GRD</a>
            <br />
            <hr>
            <br />
        </div>
        <div class="col-lg-4">
             <?php
                if($import->status == 0 || ($this->session->userdata('tipoUsuarioID') == 1)){
             ?>
             <div class="panel panel-default">
                <div class="panel-heading">
                    Importar Desenhos
                </div>
            <form role="form" method="post" action="<?=base_url() . 'saas/importacoes/cadastrardwg';?>" enctype="multipart/form-data" style="width:94%;margin-left:3%;margin-top:5px;margin-bottom:10px">
                <div class="form-group">
                    <label>Arquivos DWG</label>
                    <input type="file" multiple name="dwg[]" />
                </div>
                <div class="form-group">
                    <label>Observações</label>
                    <textarea name="observacoes" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" name='fileName' value="<?= $dbfFile ?>">
                <input type="hidden" name='fileID' value="<?= $IDfil ?>">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-cloud-upload"></i> Importar</button>
            </form>
        </div>

         <?php
     }
            if(!empty($this->session->flashdata('message'))){
                foreach($this->session->flashdata('message') as $msg){
                    list($stat, $header, $messag) = explode('&',$msg);
                    if($stat == 'NO'){
                    ?>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <?= $header ?>
                    </div>
                    <div class="panel-body">
                        <p><?= $messag; ?></p>
                    </div>
                </div>
                <?php
                    }elseif($stat == 'YES'){
                ?>
                    <div class="panel panel-success">
                    <div class="panel-heading">
                        <?= $header ?>
                    </div>
                    <div class="panel-body">
                         <p><?= $messag; ?></p>
                    </div>
                </div>
            <?php
                }
            }
        }
                if(!empty($this->session->flashdata('danger'))){
                ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('danger'); ?></p>
                </div>
            </div>
            <?php
                }elseif(!empty($this->session->flashdata('success'))){
            ?>
                <div class="panel panel-success">
                <div class="panel-heading">
                    Sucesso!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('success'); ?></p>
                </div>
                </div>
            <?php
                }
            ?> 

          <?php
                if($status == 1){
                ?>
            <div class="panel panel-success2">
                <div class="panel-heading">
                    Ok!
                </div>
                <div class="panel-body">
                    <p>Todos desenhos Necessarios estão cadastrados!</p>
                </div>
            </div>
            <?php
                if($import->status == 0){
            ?>
            <a href="<?= base_url()."saas/importacoes/revok/".$IDfil ?>" class="btn btn-primary btn-block"> <i class="fa fa-paper-plane"></i> &nbsp; Enviar Para Revisão</a>
            <?php
                }elseif($import->status == 1){
            ?>
            <div class="panel panel-success2">
                <div class="panel-heading">
                 <i class="fa fa-check"></i> &nbsp;  Importação Aprovada!
                </div>
                <div class="panel-body">
                   <p> Mensagem do Revisor <br> <br>
                   <i style='float:right'>   Revisor - João Pinto </i></p>
                </div>
            </div>
            <?php
                }elseif($import->status == 2){
            ?>
            <div class="panel panel-danger2">
                <div class="panel-heading">
                  <i class="fa fa-times"></i> &nbsp;  Importação Reprovada!
                </div>
                <div class="panel-body">
                    <p>Mensagem do Revisor <br> <br>
                      <i style='float:right'> Revisor - Adelaide Barbosa(Zeloso@capiroto.br)</i></p>
                </div>
            </div>
            <?php
                }elseif($import->status == 3){
            ?>
            <div class="panel panel-info2">
                <div class="panel-heading">
                   <i class="fa fa-clock-o"></i> &nbsp;  Importação Aguardando Revisão
                </div>
            </div>
            <?php
                }
            ?>
            <?php
                }elseif($status == 2){
            ?>
                <div class="panel panel-danger2">
                <div class="panel-heading">
                    Desenhos não constam no banco DBF!
                </div>
                <div class="panel-body">
                    <p>Os seguintes Desenhos:<br />
                         <strong>
                    <?php
                        foreach($check as $che){
                            echo $che." <br />" ;
                        }
                    ?>
                    </strong>
                    Não constam no banco DBF. Favor Removelos ou Substituilos.
                    </p>
                </div>
            </div>
             <?php
                }elseif($status == 3){
            ?>
                <div class="panel panel-info2">
                <div class="panel-heading">
                    Desenhos Não Cadastrados!
                </div>
                <div class="panel-body">
                    <p>Os seguintes Desenhos:<br />
                         <strong>
                    <?php
                        foreach($check as $che){
                            echo $che." <br />" ;
                        }
                    ?>
                    </strong>
                    Ainda não foram cadastrados.
                    </p>
                </div>
            </div>
             <?php
                }else{
                list($missing, $sobra) = explode('&b&', $check);
                $missing = explode('&d&', $missing);
                $sobra = explode('&d&', $sobra);
            ?>
                <div class="panel panel-danger2">
                <div class="panel-heading">
                    Desenhos não constam no banco DBF!
                </div>
                <div class="panel-body">
                    <p>Os seguintes Desenhos:<br />
                         <strong>
                    <?php
                        foreach($sobra as $sob){
                            echo $sob." <br />" ;
                        }
                    ?>
                    </strong>
                    Não constam no banco DBF. Favor Removelos ou Substituilos.
                    </p>
                </div>
            </div>
             <div class="panel panel-info2">
                <div class="panel-heading">
                    Desenhos Não Cadastrados!
                </div>
                <div class="panel-body">
                    <p>Os seguintes Desenhos:<br />
                        <strong>
                    <?php
                        foreach($missing as $miss){
                            echo $miss." <br />" ;
                        }
                    ?>
                     </strong>
                    Ainda não foram cadastrados.
                    </p>
                </div>
            </div>
            <?php
                }
            ?>
        
        
      </div>
    <div class="col-lg-4">
             <div class="panel panel-default">
                <div class="panel-heading">
                    Desenhos Importados
                </div>
                 <div class="panel-body">
                    <h4>Desenhos de <?= $filname ?></h4>
                    <br />  
                            <?php
                            if(empty($files)){
                                echo "<h5>Sem Desenhos Cadastrados.</h5>";
                            }
                                foreach($files as $fil){
                                    $path = $fil->path;
                                    $path=explode('/',$path);
                                    array_shift($path);
                                    array_shift($path);
                                    array_shift($path);
                                    array_shift($path);
                                    $path = base_url(implode('/',$path));
                            ?>
                            <div class="row">
                             <div class="col-lg-12" id="editorino">
                                <h5 style='font-size:16px'>Nome: <strong><?= $fil->fileName ?></strong>
                                <div style="float:right;margin-right:15px">
                                <?php
                                    if($import->status == 0  || ($this->session->userdata('tipoUsuarioID') == 1)){
                                ?>
                                <a href="#" title="Editar" class="editedi"><i class="fa fa-pencil fa"></i></a>
                                &nbsp;
                                <a href="<?= base_url()."saas/importacoes/excluirdwg/".$fil->dwgID."and".$IDfil ?>" title="Excluir" style="color:red"><i class="fa fa-trash-o fa"></i></a>
                                &nbsp;
                                <?php
                                    }
                                ?>
                                <a href="<?= $path ?>" target="_blank" title="Download" style="color:#323232"><i class="fa fa-download fa"></i></a>
                                </div>
                                </h5>
                                 <?php if(isset($fil->observacoes)){ ?>
                                <p style='font-size:12px;padding:5px'> <?= $fil->observacoes; ?> </p>
                                <?php } ?>
                                <form action="<?= base_url()."saas/importacoes/editardwg" ?>"  role="form" class="hidden dis" method="post" enctype="multipart/form-data">
                                <input type="file" name="dwg" />
                                <input type="hidden" name='dwgID' value="<?= $fil->dwgID ?>">
                                <input type="hidden" name='dbfID' value="<?= $IDfil ?>">
                                <button type="submit" style="float:right;margin-right:15px;width:10%" class="btn btn-info btn-block">Enviar</button>
                                </form>
                              </div>
                            </div>
                            <?php
                                }
                            ?>   
                </div>
                <!-- /.panel-body -->
        </div>

    </div>


</div>
 <a style="float:left" href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
</section>
