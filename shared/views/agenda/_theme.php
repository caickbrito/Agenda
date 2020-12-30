<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link href="<?= assetAgenda("bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?= assetAgenda("bootstrap/css/style.css"); ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= asset("css/message.css"); ?>"/>
    <link rel="stylesheet" href="<?= asset("css/button.css"); ?>"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title><?= $title; ?></title>
</head>

<body>

<?= $v->section("content"); ?>



<!-- Bootstrap core JavaScript -->
<script src="<?= assetAgenda("jquery/jquery.slim.min.js"); ?>"></script>
<script src="<?= assetAgenda("bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
<script src="<?= asset("js/jquery.js"); ?>"></script>
<script src="<?= asset("js/jquery-ui.js"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>

</html>