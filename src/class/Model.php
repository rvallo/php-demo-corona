<?php
class Model
{
    private $krok = 1;
    private $maxPocet = 5;

	public function __construct(){

	}

    public function jdiVpred($cisloStrany) {
	    $this->krok = $cisloStrany;
	    if($this->krok > $this->maxPocet) {
            $this->krok = $this->maxPocet;
        }
        if($this->krok < 1) {
            $this->krok = 1;
        }
    }

    public function vratCisloStranky() {
	    return $this->krok;
    }

    private function strankyOdkazovane() {
	    $stranky = array();
	    for($i = 1; $i <= $this->maxPocet; $i++) {
	        $stranky[] = (object) array(
	            'url' => 'index.php?vpred='.$i,
                'cislo' => $i
                //'active' => ($i == $this->krok)
            );
        }
	    return $stranky;
    }

    public function getScore() {
        $score = array();
        $scoreSql = $this->runSQL("SELECT nickname,score FROM score ORDER BY score DESC");
        $rank = 1;
	    foreach ($scoreSql as $row) {
            $score[] = (object) array(
	            'rank' => $rank,
                'nick' => $row["nickname"],
                'score' => $row["score"]
            );
		  $rank++;
	    }
        //var_dump($scoreSql);
	    return $score;
    }

    public function runSQL($sqlcmd) {
        require_once('config.php');
        $result = NULL;
        try {
        	$conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$sql = $conn->prepare($sqlcmd);
        	$sql->execute();
        	$score = $sql->setFetchMode(PDO::FETCH_ASSOC);

            $result = $sql->FetchAll();
        } catch (PDOException $e) {
        	echo 'Chyba: Nelze se připojit k dtb!' . $e->getMessage();
            $result = 0;
        }
        $conn = NULL;
        return $result;
    }

    public function getHighScore() {
        $test = $this->runSQL("SELECT score FROM score ORDER BY score DESC LIMIT 1");
	    return (isset($test[0]["score"]) ? $test[0]["score"] : 0);
    }


    public function dejDataProSablonu() {
        $template = 'uvod.tpl';
        if ($this->krok == 2) {
            $template = 'game.tpl';
            return (object) array(
                'cisloStranky' => $this->krok,
                'stranky' => $this->strankyOdkazovane(),
                'template' => $template,
                'highscore' => $this->getHighScore()
            );
        }
        if ($this->krok == 1) {
            $template = 'score.tpl';
            return (object) array(
                'cisloStranky' => $this->krok,
                'stranky' => $this->strankyOdkazovane(),
                'template' => $template,
                'score' => $this->getScore() 
            );
        }

	    return (object) array(
	        'cisloStranky' => $this->krok,
            'stranky' => $this->strankyOdkazovane(),
            'template' => $template
        );
    }

}
