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
        $this->checkParams();
    }

    private function checkParams() {
        if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
            session_unset();
            session_destroy();
        }
        if(isset($_POST['password']) && !empty($_POST['password']) && !empty($_POST['login']) && isset($_POST['login'])) {
            $this->model->loginAdmin($_POST['login'], $_POST['password']);
        }
        if(isset($_GET['vpred'])) {
            $this->model->jdiVpred((int)$_GET['vpred']);
        }
    }
}
