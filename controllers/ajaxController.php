<?php
class ajaxController extends controller {

	private $info;

	public function __construct() {
		parent::__construct();

		$alunos = new Alunos();
		// *Verifica se !=não tiver aluno logado 
		if(!$alunos->isLogged()) {//Criar 'isLogged' no 'Model'
			header("Location: ".BASE."login");//*Manda para 'login'
		}
	}

	public function marcar_assistido($id) {
		$aulas = new Aulas();
		$aulas->marcarAssistido($id);//Criar marcarAssistido em models 'aulas'
	}
}