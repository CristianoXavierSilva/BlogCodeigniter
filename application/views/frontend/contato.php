<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?= $titulo ?>
            </h1>
            <div class="col-md-12">
                <?php
                
                if ($enviado == 1) {
                    echo "<div class='alert alert-success'> Email enviado com sucesso! </div>";
                } elseif ($enviado == 2) {
                    echo "<div class='alert alert-warning'> Email não enviado! </div>";
                }

                $atributosForm = array(
                    'name' => 'formulario_contato',
                    'id' => 'formulario_contato'
                );

                echo validation_errors('<div class="alert alert-danger">', '</div>');
                echo form_open(base_url('contato/enviar_mensagem'), $atributosForm);

                $atribNome = array(
                    'name' => 'txtNome',
                    'id' => 'txtNome',
                    'class' => 'form-control',
                    'placeholder' => 'Digite seu Nome',
                    'value' => set_value('txtNome')
                );

                echo("<div class='form-group'>") .
                form_label("Nome", 'txtNome') .
                form_input($atribNome) .
                ("</div>");

                $atribEmail = array(
                    'name' => 'txtEmail',
                    'id' => 'txtEmail',
                    'class' => 'form-control',
                    'placeholder' => 'Digite seu Email',
                    'value' => set_value('txtEmail')
                );

                echo("<div class='form-group'>") .
                form_label("Email", 'txtEmail') .
                form_input($atribEmail) .
                (" </div>");

                $atribMsg = array(
                    'name' => 'txtMsg',
                    'id' => 'txtMsg',
                    'class' => 'form-control',
                    'placeholder' => 'Digite sua mensagem...',
                    'value' => set_value('txtMensagem')
                );

                $atribAssunto = array(
                    'name' => 'txtAssunto',
                    'id' => 'txtAssunto',
                    'class' => 'form-control',
                    'placeholder' => 'Digite seu Assunto',
                    'value' => set_value('txtAssunto')
                );

                echo("<div class='form-group'>") .
                form_label("Assunto", 'txtAssunto') .
                form_input($atribAssunto) .
                (" </div>");

                echo("<div class='form-group'>") .
                form_label("Mensagem", 'txtMsg') .
                form_textarea($atribMsg) .
                (" </div>");

                $btn_enviar = array(
                    'id' => 'btn_enviar',
                    'name' => 'btn_enviar',
                    'class' => 'btn btn-default',
                    'value' => 'Enviar Mensagem'
                );

                echo form_submit($btn_enviar);
                echo form_close();
                ?>
            </div>
        </div>