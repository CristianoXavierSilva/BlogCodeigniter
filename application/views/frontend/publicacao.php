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
                <?php
                    if ($destaque->img != null) {
                        $foto_pub = base_url("assets/uploads/posts/" . $destaque->img); ?>
                    <img class="img-responsive" src="<?= $foto_pub ?>" alt="<?= $destaque->titulo ?>">
                    <hr>
                <?php } ?>
                <p><?= $destaque->conteudo ?></p>

                <hr>
            <?php } ?>
        </div>