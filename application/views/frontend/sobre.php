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

            <div class="col-md-12 row">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>

                <hr>
            </div>
            <br>
            <h1 class="page-header">
                Nossos Autores
            </h1>
            <div class="col-md-12 row">
                <?php
                foreach ($autores as $autor) {

                    if ($autor->img != null) {
                        $foto_user = "assets/uploads/usuarios/" . $autor->img;
                    } else {
                        $foto_user = "assets/frontend/img/semFoto.png";
                    }
                    ?>
                    <div class="col-md-5 col-xs-6">
                        <style>
                            img { width: 200px; height: auto }
                        </style>
                        <img class="img-responsive img-circle" src="<?= base_url($foto_user) ?>" alt="">
                        <h4>
                            <a href="<?= base_url('autor/' . $autor->id . '/' . limpar($autor->nome)) ?>"> <?= $autor->nome ?> </a>
                        </h4>
                    </div>
                <?php } ?>
            </div>
        </div>