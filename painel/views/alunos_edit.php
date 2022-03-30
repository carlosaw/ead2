<html>
	<head>
		<title>Editar Aluno</title>
		<link href="<?php echo BASE; ?>assets/css/template.css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE; ?>assets/js/script.js"></script>
	</head>
	<body>
		<h1 class="add">Editar Aluno</h1>
		
		<form method="POST" class="form_EditAluno">
		
			<input class="inp_edit" type="text" name="nome" value="<?php echo $aluno['nome']; ?>" placeholder="Nome do aluno" /><br/><br/>

			<input class="inp_edit" type="email" name="email" value="<?php echo $aluno['email']; ?>" placeholder="E-mail do aluno" /><br/><br/>

			<input class="inp_edit" type="password" name="senha" value="<?php echo $aluno['senha']; ?>" placeholder="Senha do aluno" /><br/><br/>
			
			<strong>Cursos inscritos:</strong> (Segure CTRL para selecionar outros cursos)<br/>
			<select name="cursos[]" class="slct" multiple>
				<?php foreach($cursos as $curso): ?>
					<option value="<?php echo $curso['id']; ?>" <?php 
					if(in_array($curso['id'], $inscrito)) {
						echo 'selected="selected"';
					}
					?>><?php echo $curso['nome']; ?></option>
				<?php endforeach; ?>
			</select><br/><br/>

			<input type="submit" value="Salvar" class="inp_edit" />

		</form><br/>

	</body>
</html>


