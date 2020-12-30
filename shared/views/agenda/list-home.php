<?php $v->layout("_theme"); ?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Agenda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <a class="btn" id="btn-logout" href="<?= $router->route("profile.logout"); ?>">Sair</a>
    <div class="row">
        <div class="col-lg-12">
            <div class="login_form_callback">

            </div>

            <h1 class="mt-5">Minha agenda</h1>
            <a class="btn" style="margin: 15px 0px" href="<?= $router->route("profile.addcontact"); ?>">Adicionar contato</a>

            <div id="message" role="alert">

            </div>


            <table class="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Telefone</th>
                </tr>
                </thead>

                <?php if (!$contacts): ?>

                    <h3>Não existem contatos cadastrados.</h3>

                <?php else: ?>
                    <?php foreach ($contacts as $contact): ?>

                        <tbody>
                        <tr class="contact">
                            <td>
                                <a href="<?= $router->route("profile.edit",
                                    ["id" => $contact->id]); ?>"><?= $contact->name; ?></a>
                            </td>
                            <td><?= $contact->lastname; ?></td>
                            <td><?= $contact->phone; ?></td>
                            <td>
                                <a class="delete" href="#" data-action="<?= $router->route("profile.delete") ;?>"
                                   data-id="<?= $contact->id; ?>"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>
                        </tbody>

                    <?php endforeach; ?>
                <?php endif; ?>
            </table>


        </div>

    </div>
    <div class="d-flex justify-content-center">
        <?= $paginator;?>
    </div>


</div>

<?php $v->start("scripts"); ?>
<script src="<?= assetAgenda("bootstrap/js/form.js");?>"></script>
<?php $v->end(); ?>
