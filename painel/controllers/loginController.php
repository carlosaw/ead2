<?php
class loginController extends controller {

	public function __construct() {
		parent::__construct();
	}// Não precisa ver se está logado.
	
	public function index() {
		$array = array();//Carrega pagina de login

		//Recebe os dados do login	
		if(isset($_POST['email']) && !empty($_POST['email'])) {
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			$usuarios = new Usuarios();//Instancia a classe 'alunos'.
			
			// *Se existir o email e senha...
			if($usuarios->fazerLogin($email, $senha)) {// Criar fazerLogin no Model usuarios				
				// *Vai para Home.
				header("Location: ".BASE);
			}
		}
		
		$this->loadView("login", $array);
		
	}

	public function logout() {
		unset($_SESSION['lgadmin']);
		header("Location: ".BASE);
	}

}