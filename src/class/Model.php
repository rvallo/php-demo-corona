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
    

    public function dejDataProSablonu() {
	    return (object) array(
	        'cisloStranky' => $this->krok,
            'stranky' => $this->strankyOdkazovane()
        );
    }

}
