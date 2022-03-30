<?php
class cursosController extends controller {

	private $info;

	public function __construct() {
		parent::__construct();

		$alunos = new Alunos();
		// *Verifica se !=não tiver aluno logado 
		if(!$alunos->isLogged()) {//Criar 'isLogged' no 'Model'
			header("Location: ".BASE."login");//*Manda para 'login'
		}

	}
	public function index() {
		header("Location: ".BASE);		
	}
	public function entrar($id) {
		$dados = array(
			'info' => array(),
			'curso' => array(),
			'modulos' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['lgaluno']);
		$dados['info'] = $alunos;

		//Verifica se aluno esta inscrito neste curso
		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);//Criar setCursos
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);//Criar model 'modulos'...

			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);
			$dados['total_aulas'] = $curso->getTotalAulas();

			$this->loadTemplate('curso_entrar', $dados);//Criar view 'curso_entrar'
		} else {
			header("Location: ".BASE);
		}

	}

	public function aula($id_aula) {
		$dados = array(
			'info' => array(),
			'curso' => array(),
			'modulos' => array(),
			'aula_info' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['lgaluno']);
		$dados['info'] = $alunos;

		$aula = new Aulas();
		$id = $aula->getCursoDeAula($id_aula);

		//Verifica se aluno esta inscrito neste curso
		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);//Criar setCursos
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);//Criar model 'modulos'...

			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);
			$dados['total_aulas'] = $curso->getTotalAulas();
			
			$dados['aula_info'] = $aula->getAula($id_aula);

			//Aqui cria um view para aula e um para questionarios
			if($dados['aula_info']['tipo'] == 'video') {
				$view = 'curso_aula_video';
			} else {
				$view = 'curso_aula_poll';

				if(!isset($_SESSION['poll'.$id_aula])) {
					$_SESSION['poll'.$id_aula] = 0;
				}
			}

			//Uma vez recebida a duvida vamos recebe-la
			if(isset($_POST['duvida']) && !empty($_POST['duvida'])) {
				$duvida = addslashes($_POST['duvida']);
				//Passou a duvida e o aluno que fez a duvida nesta aula.
				$aula->setDuvida($duvida, $alunos->getId());//Criar setDuvida no model aulas.php
			}
			//Aqui pega as respostas das opções do questionario. 
			if(isset($_POST['opcao']) && !empty($_POST['opcao'])) {
				$opcao = addslashes($_POST['opcao']);//Recebe opção selecionada.

				if($opcao == $dados['aula_info']['resposta']) {
					$dados['resposta'] = true;
					$aula->marcarAssistido($id_aula);
				} else {
					$dados['resposta'] = false;
				}

				$_SESSION['poll'.$id_aula]++;//Aumenta o numero de tentativa.
			} 

							//muda curso_aula para $view	
			$this->loadTemplate($view, $dados);//Criar view 'curso_aula'
		} else {
			header("Location: ".BASE);
		}
	}

}