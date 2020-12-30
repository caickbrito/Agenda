<?php $v->layout("_theme"); ?>

<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Editar contato</h2>
        </div>

        <div class="row g-3">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Adicionados recentemente:</span>
                </h4>
                <?php if ($contacts): ?>
                    <?php foreach ($contacts as $contact): ?>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?=$contact->name ;?> <?=$contact->lastname ;?></h6>
                                    <small class="text-muted"><?=$contact->phone ;?></small>
                                </div>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Informações:</h4>
                <form class="form-group" action="<?= $router->route("profile.editcontact"); ?>" method="post">
                    <div class="login_form_callback">
                        <?php if (isset($_SESSION['message'])): ?>
                            <p class="message <?= $_SESSION['type']; ?>"><?= $_SESSION['message']; ?></p>
                        <?php endif ?>
                    </div>
                    <div class="row g-3">

                        <input type="hidden" name="id" value="<?= $contact->id;?>">
                        <div class="col-sm-6">

                            <label for="firstName" class="form-label">Primeiro nome</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" value="<?= $contact->name ;?>" required>

                        </div>

                        <div class="col-sm-6">
                            <label for="last_name" class="form-label">Sobrenome <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" value="<?= $contact->lastname ;?>">
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="text" class="form-control w-100" name="phone" id="phone" value="<?= $contact->phone ;?>" required>
                        </div>

                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Atualizar contato</button>
                    <a class="w-100 btn" style="margin-top: 15px;" href="<?= $router->route("profile.home"); ?>">Voltar</a>
                </form>
            </div>
        </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; <?= date("Y");?> CB Developer</p>
    </footer>
</div>

<?php $v->start("scripts"); ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>

