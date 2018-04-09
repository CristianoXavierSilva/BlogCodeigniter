<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?= $titulo . ' > ' ?>
                <small>
                    <?php
                    if ($subtitulo != '') {
                        echo $subtitulo;
                    } else {
                        foreach ($cat_titulo as $cat) {
                            echo $cat->titulo;
                        }
                    }
                    ?>
                </small>
            </h1>

            <?php
            foreach ($autores as $autor) {

                if ($autor->img != null) {
                    $foto_user = "assets/uploads/usuarios/" . $autor->img;
                } else {
                    $foto_user = "assets/frontend/img/semFoto.png";
                }
                
                ?>
                <div class="col-md-4">
                    <img class="img-responsive img-circle" src="<?= base_url($foto_user) ?>" alt="">
                </div>
                <div class="col-md-8 ">
                    <h2>
                        <?= $autor->nome ?>
                    </h2> 
                    <hr>
                    <p><?= $autor->historico ?></p>

                    <hr>
                </div>
            <?php } ?>
        </div>