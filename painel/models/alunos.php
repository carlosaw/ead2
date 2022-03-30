<?php 
class Alunos extends model {

	public function getAlunos() {
		$array = array();
		//Pega qtde de cursos de um aluno especifico.
		$sql = "
		SELECT 
			*,
			(select count(*) from aluno_curso where aluno_curso.id_aluno 
				= alunos.id) as qtcursos 
		FROM alunos";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getAluno($id) {//Pega o aluno para editar.
		$array = array();
	
		$sql = "SELECT * FROM alunos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
//print_r($array);exit;
		}
		
		return $array;
	
	}

	public function excluirAluno($id) {//Deleta Aluno.
		
		//Delete tudo da tabela aluno_curso onde id-aluno = id (do curso).
		$sql = "DELETE FROM aluno_curso WHERE id_aluno = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM alunos WHERE id = '$id'";
		$this->db->query($sql);
	}

	public function adicionarAluno($nome, $email, $senha) {//Adiciona Aluno!
		$this->db->query("INSERT INTO alunos SET nome = '$nome', email = '$email', senha = '$senha'");						
	}

	public function editarAluno($id, $nome, $email, $senha, $cursos) {// Edição do aluno!
		
			$this->db->query("UPDATE alunos SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = '$id'");

			$this->db->query("DELETE FROM aluno_curso WHERE id_aluno = '$id'");

			foreach($cursos as $curso) {
				$this->db->query("INSERT INTO aluno_curso SET id_aluno = '$id', id_curso = '$curso'");
			}
		
		header("Location: ".BASE.'alunos');
	}
}
	
?>