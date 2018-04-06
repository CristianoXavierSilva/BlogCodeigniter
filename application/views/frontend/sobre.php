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
                <?php foreach ($autores as $autor) { ?>
                    <div class="col-md-4 col-xs-6">
                        <img class="img-responsive img-circle" src="http://placehold.it/200x200" alt="">
                        <h4>
                            <a href="<?= base_url('autor/' . $autor->id . '/' . limpar($autor->nome)) ?>"> <?= $autor->nome ?> </a>
                        </h4>
                    </div>
                <?php } ?>
            </div>
        </div>