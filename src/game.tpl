<pre>
<?php //var_dump($data->stranky);?>
</pre>
<!DOCTYPE html>
<html lang="cs">
	<head>
		<meta charset="utf-8">
		<title>Game is pain</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link href="css/main.css" rel="stylesheet">
		<script src="js/game.js"></script>
	</head>
	<body class="text-center" >
		<h1>Chytni svojí koronu</h1>
		<p><button id="back" onclick="location.href='index.php';" >Zpět na highscore.</button><br>
		<button id="start_btn" class="rounded-50" onclick="timerGameObj.click()">Start game</button> SCORE:<input type="text" class="myInput" id="score" name="score" readonly> Zbývající sekundy:<input type="text" class="myInput" id="time" name="time" value="60" readonly> Přezdívka:<input type="text" required="true" class="myInput" id="nickname" name="nickname" value="player">
		<br>
		Cíl hry je chytit pouze koronu.</p>
		<h2 id="result">Klikni na start game</h2>
		<div id="game" class="div-game"></div>
		<footer>
		<h3>Zdroje:</h3>
		<p>Obrázek korony <a href="https://www.unicef.org/lac/sites/unicef.org.lac/files/styles/two_column/public/Copia%20de%20unicef%20coronavirus.jpg?itok=FChfTTD6">www.unicef.org</a><br>
		Zdroj ostatních virusů <a href='https://www.freepik.com/free-vector/six-types-viruses-white-background_1250781.htm'>zde</a></p>
	</footer>
	</body>
</html>