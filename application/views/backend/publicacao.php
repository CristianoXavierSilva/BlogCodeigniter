<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= 'Administrar ' . $subtitulo . 's' ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Adicionar nova ' . $subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            echo form_open('admin/publicacao/inserir');
                            ?>
                            <div class="form-group">
                                <label id="select-categoria"> Categoria: </label>
                                <select id="select-categoria" name="select-categoria" class="form-control">
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?= $categoria->id ?>"> <?= $categoria->titulo ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="txt-titulo"> Título </label>
                                <input id="txt-titulo" name="txt-titulo" type="text" class="form-control" 
                                       placeholder="Digite o titulo da publicação..." value="<?= set_value('txt-titulo') ?>">
                            </div>
                            <div class="form-group">
                                <label id="txt-subtitulo"> Subtítulo </label>
                                <input id="txt-subtitulo" name="txt-subtitulo" type="subtitulo" class="form-control" 
                                       placeholder="Digite o subtitulo da publicação..." value="<?= set_value('txt-subtitulo') ?>">
                            </div>
                            <div class="form-group">
                                <label id="txt-conteudo"> Conteúdo </label>
                                <textarea id="txt-conteudo" name="txt-conteudo" class="form-control" 
                                          placeholder="Digite o conteúdo da publicação...">
                                              <?= set_value('txt-conteudo') ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label id="txt-data"> Data </label>
                                <input id="txt-data" name="txt-data" type="datetime-local" class="form-control" 
                                       value="<?= set_value('txt-data') ?>">
                            </div>
                            <input id="txt-usuario" name="txt-usuario" type="hidden" value="<?= $this->session->userdata('userLogado')->id ?>">

                            <button type="submit" class="btn btn-default"> Cadastrar </button>
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
        <!-- /.col-lg-12 -->

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Alterar ' . $subtitulo . ' existente' ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <style>
                                img { width: 240px }
                            </style>
                            <?php
                            $this->table->set_heading("Foto", "Título", "Data", "Alterar", "Excluir");

                            foreach ($publicacoes as $publicacao) {
                                
                                if ($publicacao->img != null) {
                                    $foto_pub = img("assets/uploads/posts/" . $publicacao->img);
                                } else {
                                    $foto_pub = img("assets/frontend/img/semFoto2.png");
                                }

                                $titulo = $publicacao->titulo;
                                $data = postadoem($publicacao->data);

                                $alterar = anchor(base_url('admin/publicacao/atualizar/' . md5($publicacao->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                $excluir = anchor(base_url('admin/publicacao/excluir/' . md5($publicacao->id)), '<i class="fa fa-remove fa-fw"></i> Excluir');

                                $this->table->add_row($foto_pub, $titulo, $data, $alterar, $excluir);
                            }
                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                            echo $this->table->generate();
                            echo "<div class='paginacao'>".$links_pagination."</div>";
                            
                            ?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
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