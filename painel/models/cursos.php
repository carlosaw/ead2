<?php
class Cursos extends model {

	public function getCursos() {//Pega a qtde de alunos inscritos num curso especifico	
		$array = array();

		$sql = "
		SELECT 
			*,
			(select count(*) from aluno_curso where aluno_curso.id_curso 
				= cursos.id) as qtalunos 
		FROM cursos";

		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function excluir($id) {//Deleta Curso.
		$sql = "SELECT id FROM aulas WHERE id_curso = '$id'";
		$sql = $this->db->query($sql);
		
		if($sql->rowCount() > 0) {
			$aulas = $sql->fetchAll();
			
			foreach($aulas as $aula) {
				
				$sqlaula = "DELETE FROM historico WHERE id_aula = '".($aula['id_aula'])."'";
				$this->db->query($sqlaula);
				
				$sqlaula = "DELETE FROM questionarios WHERE id_aula = '".($aula['id_aula'])."'";
				$this->db->query($sqlaula);
				
				$sqlaula = "DELETE FROM videos WHERE id_aula = '".($aula['id_aula'])."'";
				$this->db->query($sqlaula);
			}
		}

		//Delete tudo da tabela aluno_curso onde id-curso = id (do curso).
		$sql = "DELETE FROM aluno_curso WHERE id_curso = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM aulas WHERE id_curso = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM modulos WHERE id_curso = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM cursos WHERE id = '$id'";
		$this->db->query($sql);
	}

	public function addCurso($nome, $descricao, $md5name) {//Adiciona Curso!
		$this->db->query("INSERT INTO cursos SET nome = '$nome', descricao = '$descricao', imagem = $md5name'");	
	}

	public function getCurso($id) {//Pega o curso para editar.
		$array = array();
	
		$sql = "SELECT * FROM cursos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}
		return $array;

	}

	public function editar($id) {// Edição do Curso!
		
		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$imagem = $_FILES['imagem'];
	
			$this->db->query("UPDATE cursos SET nome = '$nome', descricao = '$descricao' WHERE id = '$id'");

			if(!empty($imagem['tmp_name'])) {//Verifica se imagem foi enviada.				
				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');

				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);

				$this->db->query("UPDATE cursos SET nome = '$nome', descricao = '$descricao' WHERE id = '$id'");

				$this->db->query("UPDATE cursos SET imagem = '$md5name' WHERE id = '$id'");
			 	
				}
			}
		}
	}

	public function getCursosInscritos($id_aluno) {
		$array = array();
		
		$sql = "SELECT id_curso FROM aluno_curso WHERE id_aluno = '$id_aluno'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $row) {
				$array[] = $row['id_curso'];
			}

		}

		return $array;

	}

}