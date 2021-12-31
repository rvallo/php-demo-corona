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

define('SQL_HOST', getenv('DB_HOST'));
define('SQL_DBNAME', getenv('DB_NAME'));
define('SQL_USERNAME', getenv('DB_USER'));
define('SQL_PASSWORD', getenv('DB_PASSWORD'));
$GLOBALS['DB_CON'] = 'mysql:dbname=' . SQL_DBNAME . ';host=' . SQL_HOST . '';