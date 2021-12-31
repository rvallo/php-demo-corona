<?php
class Model
{
    private $krok = 1;
    private $msg = "";
    private $maxPocet = 5;

	public function __construct(){

	}

    public function selectScoreSQL($limit) {
        $result = NULL;
        try {
        	$conn = new PDO($GLOBALS['DB_CON'], SQL_USERNAME, SQL_PASSWORD);
        	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$sql = $conn->prepare("SELECT id,nickname,score FROM score ORDER BY score DESC LIMIT :limit;");
            $sql->bindParam(':limit', $limit, PDO::PARAM_INT );
        	$sql->execute();
        	$score = $sql->setFetchMode(PDO::FETCH_ASSOC);

            $result = $sql->FetchAll();
        } catch (PDOException $e) {
        	echo 'Chyba3: Nelze se připojit k dtb!' . $e->getMessage();
            $result = 0;
        }
        $conn = NULL;
        return $result;
    }

    public function selectPass($login) {
        $result = NULL;
        try {
        	$conn = new PDO($GLOBALS['DB_CON'], SQL_USERNAME, SQL_PASSWORD);
        	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$sql = $conn->prepare("SELECT password FROM admin WHERE username=:username;");
            $sql->bindParam(':username', $login, PDO::PARAM_STR, 45 );
        	$sql->execute();
        	$score = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->FetchAll();
        } catch (PDOException $e) {
        	echo 'Chybasp: Nelze se připojit k dtb!' . $e->getMessage();
            $conn = NULL;
            return $result = 0;
        }
        $conn = NULL;
        return (isset($result[0]["password"]) ? $result[0]["password"] : 0);
    }

    public function updatePass($login,$newhash) {
        $result = false;
        try {
            $conn = new PDO($GLOBALS['DB_CON'], SQL_USERNAME, SQL_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("UPDATE admin SET password=:newhash WHERE username=:user;");
            $sql->bindParam(':newhash', $newhash, PDO::PARAM_STR, 255 );
            $sql->bindParam(':user', $login, PDO::PARAM_STR, 45 );
            $sql->execute();
            $result = true;
        } catch (PDOException $e) {
        	echo 'Chybasp: Nelze se připojit k dtb!' . $e->getMessage();
            $conn = NULL;
            return $result;
        }
        $conn = NULL;
        return $result;
    }

    public function insertScoreSQL($nickname,$score) {
        $result = false;
        try {
            $conn = new PDO($GLOBALS['DB_CON'], SQL_USERNAME, SQL_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("INSERT INTO `game`.`score` (nickname, score) VALUES (:nick,:score);");
            $sql->bindParam(':nick', $nickname, PDO::PARAM_STR, 255 );
            $sql->bindParam(':score', $score, PDO::PARAM_INT );
            $sql->execute();
            $result = true;
        } catch (PDOException $e) {
        	echo 'Chybasp: Nelze se připojit k dtb!' . $e->getMessage();
            $conn = NULL;
            return $result;
        }
        $conn = NULL;
        return $result;
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

    public function checkPass($login, $password) {
        $sqlPass = $this->selectPass($login);
        if (password_verify($password, $sqlPass)) {
            return true;
          } 
        else {
            return false;
        }
    }

    public function loginAdmin($login, $password) {    
       if ($this->checkPass($login, $password)) {
          $this->msg = "Přihlášení proběhlo úspěšně!";
          $_SESSION['user'] = $login;
        } 
        else {
          $this->msg = "Neplatné heslo!";
        }

    }

    public function insertScore($score, $nickname) {
        $this->msg = ($this->insertScoreSQL($nickname, $score) ? "Vlozeno do dtb." : "Chyba ukladani.");
     }

    public function logOut() {
        session_unset();
        session_destroy();
	    $this->msg = "Odhlášení bylo úspěšné.";
    }

    public function changePass($oldpass, $newpass, $login) {
      if ($this->checkPass($login, $oldpass)) {
        $hash = password_hash($newpass, PASSWORD_DEFAULT);
        if ($this->updatePass($login, $hash)) {
            $this->msg = "Změna hesla proběhla úspěšně.";
        }
        else
        {
            $this->msg = "Nastala chyba při změne hesla, zkus to znovu.";
        }
        
      } 
      else {
        $this->msg = "Neplatné heslo!";
      }
    }

    public function getMsg() {
	    return $this->msg;
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
            );
        }
	    return $stranky;
    }

    public function deleteScore($id) {
        $conn = new PDO($GLOBALS['DB_CON'], SQL_USERNAME, SQL_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("DELETE FROM `game`.`score` WHERE id = :id;");
		$sql->bindParam(':id', $id, PDO::PARAM_INT );
		$sql->execute();
    }

    public function getScore() {
        $score = array();
        $scoreSql = $this->selectScoreSQL(100);
        $rank = 1;
	    foreach ($scoreSql as $row) {
            $score[] = (object) array(
	            'rank' => $rank,
                'nick' => $row["nickname"],
                'score' => $row["score"],
                'id' => $row["id"]
            );
		  $rank++;
	    }
        //var_dump($scoreSql);
	    return $score;
    }

    public function getHighScore() {
        $highscore = $this->selectScoreSQL(1);
	    return (isset($highscore[0]["score"]) ? $highscore[0]["score"] : 0);
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
                'score' => $this->getScore(),
                'msg' => $this->getMsg()
            );
        }

	    return (object) array(
	        'cisloStranky' => $this->krok,
            'stranky' => $this->strankyOdkazovane(),
            'template' => $template
        );
    }

}
