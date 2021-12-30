<pre>
<?php //var_dump($data->score);?>
</pre>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Score</title>
</head>
<body>
    <h1>Score</h1>
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

<h2>High score</h2>
<h4>TOP 20</h4>
<table class="table table-bordered table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Score</th>
    </tr>
  </thead>
  <tbody>
  
  <?php foreach($data->score as $key=> $row_score) :?>
       <tr><th scope="row"><?= $row_score->rank ?></th><td><?= $row_score->nick ?></td><td><?= $row_score->score ?></td></tr>
    <?php endforeach;?>
    </tbody></table>
</body>
</html>