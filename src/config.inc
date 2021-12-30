<?php
function automaticky_nacitac_trid($class) {
	if(is_file("class".DIRECTORY_SEPARATOR.$class . '.php')) {
		require_once "class".DIRECTORY_SEPARATOR.$class . '.php';
	}else {
		trigger_error("Soubor s třídou $class neexistuje!", E_USER_ERROR);
		//die();
	}
}

spl_autoload_register('automaticky_nacitac_trid');