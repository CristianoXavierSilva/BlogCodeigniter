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
                    <?= 'Alterar ' . $subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            foreach ($categorias as $categoria) {
                            echo form_open('admin/categoria/salvar/'.md5($categoria->id));
                            ?>
                            <div class="form-group">
                                <label id="txt-categoria"> Nome da categoria </label>
                                <input id="txt-id" type="hidden" name="txt-id" value="<?= md5($categoria->id) ?>">
                                <input id="txt-categoria" name="txt-categoria" type="text" class="form-control" 
                                       placeholder="Digite o nome da categoria..." value="<?= $categoria->titulo ?>">
                            </div>
                            
                            <button type="submit" class="btn btn-default">Atualizar</button>
                            <?php
                            }
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
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->