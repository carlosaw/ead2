<?php
class alunosController extends controller {

	public function __construct() {
		parent::__construct();
		$usuarios = new Usuarios();

		if(!$usuarios->isLogged()) {//Verifica se aluno esta logado
			header("Location: ".BASE."login");
		}
	}

	public function index() {
		$dados = array(
			'alunos' => array()
		);

		$alunos = new Alunos();//Pega classe alunos
		$dados['alunos'] = $alunos->getAlunos();

		$this->loadTemplate('alunos', $dados);
	}

	public function excluir($id) {//Exclui aluno

		$alunos = new Alunos();
		$alunos->excluirAluno($id);

		header("Location: ".BASE.'alunos');
	}

	public function adicionar() {//Adiciona aluno
		$dados = array();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {

			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);
			
			$alunos = new Alunos();
			$alunos->adicionarAluno($nome, $email, $senha);
		
			header("Location: ".BASE.'alunos');
		}
		$this->loadTemplate("alunos_add");
	}

	public function editar($id) {//Editar Aluno.
		$alunos = array(
			'aluno' => array(),
			'modulos' => array()
		);

		$alunos = new Alunos();
		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);
			$cursos = $_POST['cursos'];
		
			$alunos->editarAluno($id, $nome, $email, $senha, $cursos);
		}

		$cursos = new Cursos();
		$dados['aluno'] = $alunos->getAluno($id);
		$dados['cursos'] = $cursos->getCursos();
		$dados['inscrito'] = $cursos->getCursosInscritos($id);

		$this->loadTemplate('alunos_edit', $dados);
	}
}