<?php
class homeController extends controller {

	public function __construct() {
		parent::__construct();
		$usuarios = new Usuarios();

		if(!$usuarios->isLogged()) {
			header("Location: ".BASE."login");
		}
	}
	public function index() {
		$dados = array(
			'cursos' => array()
		);
		//Aqui pega os cursos da plataforma
		$cursos = new Cursos();
		$dados['cursos'] = $cursos->getCursos();
			
		$this->loadTemplate('home', $dados);
	}

	public function excluir($id) {
		$cursos = new Cursos();
		$cursos->excluir($id);
		header("Location: ".BASE);
	}

	public function adicionar() {	
		
		$dados = array();
		$cursos = new Cursos();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {

			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$imagem = $_FILES['imagem'];

			if(!empty($imagem['tmp_name'])) {

				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');

				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);

				$cursos->addCurso($nome, $descricao, $md5name);
				header("Location: ".BASE); 
				}
			}
		}
		$this->loadTemplate("curso_add", $dados);
	}


	public function editar($id) {//Editar Curso.
		$dados = array(
			'curso' => array(),
			'modulos' => array()
		);
		$modulos = new Modulos();		
		

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$imagem = $_FILES['imagem'];

			$cursos = new Cursos();
			$cursos = $cursos->editar($id, $nome, $descricao);

			if(!empty($imagem['tmp_name'])) {//Verifica se imagem foi enviada.			
				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');

				if(in_array($imagem['type'], $types)) {
					$cursos = new Cursos();
					move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);
					$cursos = $cursos->editar($md5name);
				}
			}
		}
				
		//Usuário adicionou um Módulo Novo.
		if(isset($_POST['modulo']) && !empty($_POST['modulo'])) {
			$modulo = addslashes($_POST['modulo']);
			$modulos->addModulo($modulo, $id);
		}

		$aulas = new Aulas();
		//Usuário adicionou uma Aula Nova.
		if(isset($_POST['aula']) && !empty($_POST['aula'])) {
			$aula = addslashes($_POST['aula']);
			$moduloaula = addslashes($_POST['moduloaula']);
			$tipo = addslashes($_POST['tipo']);

			$aulas->addAula($id, $moduloaula, $aula, $tipo);
		}
		
		$cursos = new Cursos();
		$dados['curso'] = $cursos->getCurso($id);
		
		$dados['modulos'] = $modulos->getModulos($id);		
		$this->loadTemplate('curso_edit', $dados);		
	}

	public function del_modulo($id) {
		if(!empty($id)) {
			$id = addslashes($id);
			$modulos = new Modulos();
			
			$modulos->delModulo($id);
		}
	}

	public function edit_modulo($id) {
		$array = array();

		$id_curso = $modulos = new Modulos();

		if(isset($_POST['modulo']) && !empty($_POST['modulo'])) {
			$nome = addslashes($_POST['modulo']);
			$id_curso = $modulos->updateModulo($nome, $id);
		
		header("Location: ".BASE."home/editar/".$id_curso);
		exit;
		}

		$array['modulo'] = $modulos->getModulo($id);

		$this->loadTemplate('curso_edit_modulo', $array);
	}

	public function del_aula($id) {
		if(!empty($id)) {
			$id = addslashes($id);
			
			$aulas = new Aulas();
			
			$id_curso = $aulas->delAula($id);
		}
	}

	public function edit_aula($id) {
		$dados = array();
		$view = 'curso_edit_aula_video';

		$aulas = new Aulas();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$url = addslashes($_POST['url']);

			$id_curso = $aulas->updateVideoAula($id, $nome, $descricao, $url);

			header("Location: ".BASE."home/editar/".$id_curso);
		}
		$dados = array();
		$view = 'curso_edit_aula_poll';

		$aulas = new Aulas();

		if(isset($_POST['pergunta']) && !empty($_POST['pergunta'])) {
			$pergunta = addslashes($_POST['pergunta']);
			$opcao1 = addslashes($_POST['opcao1']);
			$opcao2 = addslashes($_POST['opcao2']);
			$opcao3 = addslashes($_POST['opcao3']);
			$opcao4 = addslashes($_POST['opcao4']);
			$resposta = addslashes($_POST['resposta']);

			$id_curso = $aulas->updateQuestionarioAula($id, $pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta);
	//print_r($_POST);exit;
			header("Location: ".BASE."home/editar/".$id_curso);
		}

		$dados['aula'] = $aulas->getAula($id);

		if($dados['aula']['tipo'] == 'video') {
			$view = 'curso_edit_aula_video';
		} else {
			$view = 'curso_edit_aula_poll';
		}

		$this->loadTemplate($view, $dados);
	}
}