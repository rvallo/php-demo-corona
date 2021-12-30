<pre>
<?php //var_dump($data->msg);?>
</pre>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Score</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/uvod.css" rel="stylesheet">
</head>
<body>
    <div id="box" align="center"></div>

<?php if (isset($data->msg) && !empty($data->msg)) :?>
    <div class="alert"><p><strong><?= $data->msg ?></strong></p></div>
<?php endif;?>
      <h1>Score</h1>

<?php if (!isset($_SESSION['user'])) :?>
    <form method="post" action="index.php">Login:
        <input type="text" name="login" />
        <br/>Heslo:
        <input type="password" name="password" />
        <input type="submit" />
        <button type="button" id="cancel">Zrušit</button>
    </form>
    <a id="login" href="#">Přihlásit se</a><br/>
<?php endif;?>

<?php if (isset($_SESSION['user'])) :?>
    <form method="post" action="index.php">Staré heslo:
        <input type="password" name="oldpass" />
        <br/>Nové heslo:
        <input type="password" name="newpass" />
        <input type="submit" />
        <button type="button" id="cancel">Zrušit</button>
    </form>
    <a id="changePass" href="#">Změna hesla</a><br/>
    <a id="logout" href="#">Odhlásit se</a><br/>
<?php endif;?>

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
<?php if (!isset($_SESSION['user'])) :?>
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
    <?php endif;?>

<?php if (isset($_SESSION['user'])) :?>
<table class="table table-bordered table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Score</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>  
  <?php foreach($data->score as $key=> $row_score) :?>
       <tr><th scope="row"><?= $row_score->rank ?></th><td><?= $row_score->nick ?></td><td><?= $row_score->score ?></td><td><a href=index.php?delete=<?= $row_score->id ?>>Delete!</a></td></tr>
    <?php endforeach;?>
    </tbody></table>
    <?php endif;?>
</body>
<script src="js/login.js"></script>
</html>