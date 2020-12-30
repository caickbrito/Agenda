<?php $v->layout("_theme"); ?>

<div class="page">    
    <h1>Olá <?= $user->first_name; ?>,</h1>
    <p>Aqui é sua conta no projeto, mas por enquanto a única coisa que você pode fazer é sair dela :P</p>
    <p><a class="btn btn-green" href="<?= $router->route("profile.logout"); ?>" title="Sair agora">SAIR AGORA :)</a></p>
</div>
