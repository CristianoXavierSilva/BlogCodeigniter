<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php foreach ($postagem as $destaque) { ?>
                <h1>
                    <?= $destaque->titulo ?></a>
                </h1>
                <p class="lead">
                    por <a href="<?= base_url('autor/'.$destaque->id.'/'. limpar($destaque->nome)) ?>"><?= $destaque->nome ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?= postadoem($destaque->data) ?> </p>
                <hr>
                <p><i><?= $destaque->subtitulo ?></i></p>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p><?= $destaque->conteudo ?></p>

                <hr>
            <?php } ?>
        </div>