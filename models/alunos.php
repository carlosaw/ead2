<?php 
class Alunos extends model {

	private $info;//Criado para o setAluno

	//Verifica se tem aluno logado no sistema!
	public function isLogged() {
		//Se existe a sessão e não está vazia...
		if(isset($_SESSION['lgaluno']) && !empty($_SESSION['lgaluno'])) {
			return true;
		} else {
			return false;
		}//Criar login Controller para fazer login
	}

	public function fazerLogin($email, $senha) {

		$sql = "SELECT * FROM alunos WHERE email = '$email' AND senha = '$senha'";
		$sql = $this->db->query($sql);//Executa a query

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();//Pega o resultado desta consulta. 

			$_SESSION['lgaluno'] = $row['id'];//Salva o id do aluno logado.

			return true;
		}

		return false;
	}

	public function isInscrito($id_curso) {
		$sql = "SELECT * FROM aluno_curso WHERE id_aluno = '".($this->info['id'])."' 
			AND id_curso = '$id_curso'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function setAluno($id) {//Recebe o id do aluno

		$sql = "SELECT * FROM alunos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {//Se houve resultado manda para variavel info.
			$this->info = $sql->fetch();
		}
	
	}

	public function getNome() {//Pega nome do aluno do setAluno.
		return $this->info['nome'];//Retorna o nome do aluno logado.
	}//Volta pro homeController

	public function getId() {
		return $this->info['id'];//Retorna o id do aluno e vai pro homeController
	}

	public function getNumAulasAssistidas($id_curso) {

		$sql = "
		SELECT id
		FROM historico
		WHERE 
			id_aluno = '".($this->getId())."'
			AND id_aula IN (select aulas.id from aulas where aulas.id_curso = '$id_curso')
		";
		$sql = $this->db->query($sql);

		return $sql->rowCount();
	}
}	
?>