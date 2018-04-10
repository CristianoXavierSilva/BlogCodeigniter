<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= 'Administrar ' . $subtitulo . 's' ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Atualizar ' . $subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            foreach ($usuarios as $usuario) {
                            echo form_open('admin/usuarios/salvar'.md5($usuario->id));
                            
                                ?>
                                <div class="form-group">
                                    <label id="txt-nome"> Nome da categoria </label>
                                    <input id="txt-nome" name="txt-nome" type="text" class="form-control" 
                                           placeholder="Digite o nome de usuário..." value="<?= $usuario->nome ?>">
                                </div>
                                <div class="form-group">
                                    <label id="txt-email"> E-mail </label>
                                    <input id="txt-email" name="txt-email" type="email" class="form-control" 
                                           placeholder="Digite o email de usuário..." value="<?= $usuario->email ?>">
                                </div>
                                <div class="form-group">
                                    <label id="txt-historico"> Histórico </label>
                                    <textarea id="txt-historico" name="txt-historico" class="form-control" 
                                              placeholder="Digite o historico de usuário...">
                                                  <?= $usuario->historico ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label id="txt-user"> Usuário </label>
                                    <input id="txt-user" name="txt-user" type="text" class="form-control" 
                                           placeholder="Digite o user de usuário..." value="<?= $usuario->user ?>">
                                </div>
                                <div class="form-group">
                                    <label id="txt-senha"> Senha </label>
                                    <input id="txt-senha" name="txt-senha" type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label id="txt-confirm-senha"> Confirmar senha </label>
                                    <input id="txt-confirm-senha" name="txt-confirm-senha" type="password" class="form-control">
                                </div>                            

                                <input id="txt-id" name="txt-id" type="hidden" value="<?= $usuario->id ?>" class="form-control">
                                <button type="submit" class="btn btn-default">Atualizar</button>
                                <?php
                                echo form_close();
                                ?>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->

            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= 'Imagem de destaque do ' . $subtitulo ?>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 10px">
                            <div class="col-lg-3 col-lg-offset-3">
                                <?php
                                    if($usuario->img != null) {
                                        echo img("assets/uploads/usuarios/".$usuario->img);
                                    } else {
                                        echo img("assets/frontend/img/semFoto.png");
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                $div_open = '<div class="form-group">';
                                $div_close = '</div>';
                                $imagem = array(
                                    'name' => 'userfile',
                                    'id' => 'userfile',
                                    'class' => 'form-control'
                                );
                                $btn_adicionar = array(
                                    'name' => 'btn_adicionar',
                                    'id' => 'btn_adicionar',
                                    'class' => 'btn btn-default',
                                    'value' => 'Adicionar nova imagem'
                                );

                                echo validation_errors('<div class="alert alert-danger">', '</div>');
                                echo form_open_multipart('admin/usuarios/addFoto');
                                echo form_hidden('id', md5($usuario->id));
                                echo $div_open;
                                echo form_upload($imagem);
                                echo $div_close;
                                echo $div_open;
                                echo form_submit($btn_adicionar);
                                echo $div_close;
                                echo form_close();
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!--
                            <form role="form">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input class="form-control" placeholder="Entre com o texto">
                                </div>
                                <div class="form-group">
                                    <label>Foto Destaque</label>
                                    <input type="file">
                                </div>
                                <div class="form-group">
                                    <label>Conteúdo</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Selects</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Cadastrar</button>
                                <button type="reset" class="btn btn-default">Limpar</button>
                            </form>
-->