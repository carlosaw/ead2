<html>
	<head>
		<title>Adicionar Aluno</title>
		<link href="<?php echo BASE; ?>assets/css/template.css" rel="stylesheet">
		<style>
			
		</style>
	</head>
	<body>
		<h1 class="add">Adicionar Aluno</h1>
	<form method="POST" class="form_loginAdd">
	
		<input class="inp_add_aluno" type="text" name="nome" placeholder="Nome do Aluno" /><br/><br/>

		<input type="email" name="email" class="inp_add_aluno" placeholder="E-mail do Aluno"/><br/><br/>

		<input type="password" name="senha" class="inp_add_aluno" placeholder="Senha do Aluno"/><br/><br/>
				
		<input type="submit" value="Adicionar Aluno" class="inp_add_aluno" id="btn_add_aluno"/>

	</form>
	</body>
</html>


