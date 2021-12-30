<?php
class Controller
{
    /**
     *
     * @var Model
     */
	private $model;

    public function __construct($model) {
        $this->model = $model;
        $this->zkontrolujKrokVpred();
    }

    private function zkontrolujKrokVpred() {
        if(isset($_GET['vpred'])) {
            $this->model->jdiVpred((int)$_GET['vpred']);
        }
    }
}
