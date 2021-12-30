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
        if (isset($_POST['score']) && isset($_POST['nickname']) && !empty($_POST['nickname']) ) {
            $this->model->insertScore((int)$_POST['score'], $_POST['nickname']);
        }
        if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
            $this->model->logOut();
        }
        if(isset($_POST['password']) && !empty($_POST['password']) && !empty($_POST['login']) && isset($_POST['login'])) {
            $this->model->loginAdmin($_POST['login'], $_POST['password']);
        }
        if(isset($_POST['oldpass']) && !empty($_POST['oldpass']) && !empty($_POST['newpass']) && isset($_POST['newpass']) && !empty($_SESSION['user']) ) {
            $this->model->changePass($_POST['oldpass'],$_POST['newpass'],$_SESSION['user']);
        }
        if(isset($_GET['vpred'])) {
            $this->model->jdiVpred((int)$_GET['vpred']);
        }
        if(isset($_GET['delete']) && isset($_SESSION['user'])) {
            $this->model->deleteScore((int)$_GET['delete']);
        }
    }
}
