<?php 
class Usuarios extends model {

	private $info;//Criado para o setAluno

	//Verifica se tem aluno logado no sistema!
	public function isLogged() {
		//Se existe a sessão e não está vazia...
		if(isset($_SESSION['lgadmin']) && !empty($_SESSION['lgadmin'])) {
			return true;
		} else {
			return false;
		}//Criar login Controller para fazer login
	}

	public function fazerLogin($email, $senha) {

		$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
		$sql = $this->db->query($sql);//Executa a query

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();//Pega o resultado desta consulta. 

			$_SESSION['lgadmin'] = $row['id'];//Salva o id do aluno logado.

			return true;
		}

		return false;
	}

}	
?>