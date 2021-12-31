<pre>
<?php //var_dump($data->msg);?>
</pre>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Score</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">
</head>
<body class="text-center">
    <div id="box" align="center"></div>

<?php if (isset($data->msg) && !empty($data->msg)) :?>
    <div class="alert"><p><strong><?= $data->msg ?></strong></p></div>
<?php endif;?>
      <h1>Score</h1>

<?php if (!isset($_SESSION['user'])) :?>
    <form id="hiddenForm"  method="post" action="index.php">Login:
        <input type="text" name="login" />
        <br/>Heslo:
        <input type="password" name="password" />
        <br>
        <button type="submit" >Přihlásit se</button>
        <button type="button" id="cancel">Zrušit</button>
    </form>
    <a id="login" href="#">Přihlásit se</a><br/>
<?php endif;?>

<?php if (isset($_SESSION['user'])) :?>
    <form class="text-center" id="hiddenForm" method="post" action="index.php">Staré heslo:
        <input type="password" name="oldpass" />
        <br/>Nové heslo:
        <input type="password" name="newpass" />
        <br>
        <button type="submit" >Změnit heslo</button>
        <button type="button" id="cancel">Zrušit</button>
    </form>
    <a id="changePass" href="#">Změna hesla</a><br/>
    <a id="logout" href="#">Odhlásit se</a><br/>
<?php endif;?>

    <dl>
    <?php foreach($data->stranky as $ind => $str) :?>
        <?php if($ind == 0) :?>
           <dt><a class="nav-link" href="<?= $str->url?>">Score</a></dt>
           <dd>Po přihlášení lze mazat score</dd>
        <?php elseif($ind == count($data->stranky)-1) :?>
           <dt><a class="nav-link" href="<?= $str->url?>">O projektu</a></dt>
           <dd>Info o projektu</dd>
        <?php else :?>
            <dt><a class="nav-link" href="<?= $str->url?>">Hrej <?= $str->cislo?></a></dt>
            <dd>Hra "chyť si svoji koronu"</dd>
        <?php endif;?>
    <?php endforeach;?>
    </dl>

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