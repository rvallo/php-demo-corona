<?php
class View
{
	/**
	 * @var Model
	 */
	private $model;
	/**
	 * @var Controller
	 */
    private $controller;

    public function __construct($controller,$model) {
        $this->controller = $controller;
        //var_dump($controller);
        $this->model = $model;
        $this->vypisStranku();
    }

    private function vypisStranku() {
        $data = $this->model->dejDataProSablonu();
        //var_dump($data);
        //echo "Stránka č.: " . $this->model->vratCisloStranky();
        include 'uvod.tpl';
    }
}