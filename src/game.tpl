<pre>
<?php //var_dump($data->stranky);?>
</pre>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game is pain</title>
</head>
<body>
    <h1>Game</h1>
    <?php if(isset($data->cisloStranky)) :?>
        <p>Stránka č.: <?= $data->cisloStranky ?></p>
    <?php endif;?>

    <?php foreach($data->stranky as $ind => $str) :?>
        <?php if($ind == 0) :?>
            <a href="<?= $str->url?>">Úvod</a><br>
        <?php elseif($ind == count($data->stranky)-1) :?>
            <br><a href="<?= $str->url?>">Poslední</a>
        <?php else :?>
            <a href="<?= $str->url?>">Strana <?= $str->cislo?></a> |
        <?php endif;?>
    <?php endforeach;?>
</body>
</html>