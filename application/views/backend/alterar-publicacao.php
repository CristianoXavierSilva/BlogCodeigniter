<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= 'Administrar ' . $subtitulo . 's' ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Atualizar ' . $subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            foreach ($publicacoes as $publicacao) {
                            echo form_open('admin/publicacao/salvar/'.md5($publicacao->id));
                                ?>
                                <div class="form-group">
                                    <label id="select-categoria"> Categoria: </label>
                                    <select id="select-categoria" name="select-categoria" class="form-control">
                                        <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?= $categoria->id ?>" <?php if ($categoria->id == $publicacao->categoria) { echo "selected"; } ?>> <?= $categoria->titulo ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="txt-titulo"> Título </label>
                                    <input id="txt-titulo" name="txt-titulo" type="text" class="form-control" 
                                           placeholder="Digite o titulo da publicação..." value="<?= $publicacao->titulo ?>">
                                </div>
                                <div class="form-group">
                                    <label id="txt-subtitulo"> Subtítulo </label>
                                    <input id="txt-subtitulo" name="txt-subtitulo" type="subtitulo" class="form-control" 
                                           placeholder="Digite o subtitulo da publicação..." value="<?= $publicacao->subtitulo ?>">
                                </div>
                                <div class="form-group">
                                    <label id="txt-conteudo"> Conteúdo </label>
                                    <textarea id="txt-conteudo" name="txt-conteudo" class="form-control" 
                                              placeholder="Digite o conteúdo da publicação...">
                                        <?= $publicacao->conteudo ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label id="txt-data"> Data </label>
                                    <input id="txt-data" name="txt-data" type="datetime-local" class="form-control" 
                                           value="<?= strftime('%Y-%m-%dT%H:%M:%S', strtotime($publicacao->data)) ?>">
                                </div>
                                <input id="txt-id" name="txt-id" type="hidden" value="<?= $publicacao->id ?>">

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

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= 'Imagem de destaque do ' . $subtitulo ?>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 10px">
                            <style>
                                img { width: 130% }
                            </style>
                            <div class="col-lg-8 col-lg-offset-1">
                                <?php
                                if ($publicacao->img != null) {
                                    echo img("assets/uploads/posts/" . $publicacao->img);
                                } else {
                                    echo img("assets/frontend/img/semFoto2.png");
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
                                echo form_open_multipart('admin/publicacao/addFoto');
                                echo form_hidden('id', md5($publicacao->id));
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