<pre>
<?php //var_dump($data->stranky);?>
</pre>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>O projektu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">
</head>
<body class="text-center">
    <h1>Hra o chytání korony</h1>
    <p>Cílem hry je chytit co nejvíce koronáče.</p>

    <dl>
    <?php foreach($data->stranky as $ind => $str) :?>
        <?php if($ind == 0) :?>
           <dt><a class="nav-link" href="<?= $str->url?>">Score</a></dt>
           <dd>Po přihlášení lze mazat score</dd>
        <?php elseif($ind == count($data->stranky)-1) :?>
           <dt><a class="nav-link" href="<?= $str->url?>">O projektu</a></dt>
           <dd>Info o projektu</dd>
        <?php else :?>
            <dt><a class="nav-link" href="<?= $str->url?>">Hrej</a></dt>
            <dd>Hra "chyť si svoji koronu"</dd>
        <?php endif;?>
    <?php endforeach;?>
    </dl>
</body>
</html>