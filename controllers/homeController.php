<?php
class homeController extends controller {

	public function __construct() {
		parent::__construct();

		$alunos = new Alunos();
		// *Verifica se !=não tiver aluno logado 
		if(!$alunos->isLogged()) {//Criar 'isLogged' no 'Model'
			header("Location: ".BASE."login");//*Manda para 'login'
		}

	}
	public function index() {
		$dados = array(
			'info' => array(),//info vai ser um array dentro de outro
			'cursos' => array()//cursos vai ser um array dentro do outro
		);//Manda $dados['info'] abaixo

		//Põe o nome do aluno logado no topo
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['lgaluno']);
		//Criar setAluno no Model 'alunos'->
		
		$dados['info'] = $alunos;
		//Faz com que as infor do aluno vão para variavel info.
		//Vai pro template.php
		
		//Cria relação aluno-cursos
		$cursos = new Cursos();//Criar 'cursos' no array acima.
		$dados['cursos'] = $cursos->getCursosDoAluno($alunos->getId());//Criar getId no model 'alunos'.

		$this->loadTemplate('home', $dados);
	}

}