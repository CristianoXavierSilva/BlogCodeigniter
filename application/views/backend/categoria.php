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
                    <?= 'Adicionar nova ' . $subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if($publicado == 1) {
                                echo "<div class='alert alert-success'> Item adicionado! </div>";
                            }
                            
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            echo form_open('admin/categoria/inserir');
                            ?>
                            <div class="form-group">
                                <label id="txt-categoria"> Nome da categoria </label>
                                <input id="txt-categoria" name="txt-categoria" type="text" class="form-control" placeholder="Digite o nome da categoria...">
                            </div>

                            <button type="submit" class="btn btn-default">Cadastrar</button>
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
                    <?= 'Alterar ' . $subtitulo . ' existente' ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            $this->table->set_heading("Nome da Categoria", "Alterar", "Excluir");
                            foreach ($categorias as $categoria) {

                                $nome_cat = $categoria->titulo;
                                $alterar = anchor(base_url('admin/categoria/atualizar/' . md5($categoria->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                $excluir = '<button type="button" class="btn btn-link" data-toggle="modal" data-target=".excluir-modal-' . $categoria->id . '"><i class="fa fa-remove fa-fw"></i> Excluir</button>';

                                echo $modal = ' <div class="modal fade excluir-modal-' . $categoria->id . '" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel2">Exclusão de Categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Deseja Excluir a Categoria ' . $categoria->titulo . '?</h4>
                                                <p>Após Excluida a categoria <b>' . $categoria->titulo . '</b> não ficara mais disponível no Sistema.</p>
                                                <p>Todos os itens relacionados a categoria <b>' . $categoria->titulo . '</b> serão afetados e não aparecerão no site até que sejam editados.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a type="button" class="btn btn-primary" href="' . base_url("admin/categoria/excluir/" . md5($categoria->id)) . '">Excluir</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>';

                                $this->table->add_row($nome_cat, $alterar, $excluir);
                            }
                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                            echo $this->table->generate();
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