<?php
require 'environment.php';

define("BASE", "http://localhost/ead/painel/");//url raiz do projeto/

$config = array();

if(ENVIRONMENT == 'development') {
	//define("BASE_URL", "http://localhost/ead/painel/");
	$config['dbname'] = 'ead';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	//define("BASE_URL", "http://awregulagens.com.br/ead/");
	$config['dbname'] = 'awregula_ead';
	$config['host'] = '162.241.2.197';
	$config['dbuser'] = 'awregula';
	$config['dbpass'] = 'H121tRa6lx';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

?>