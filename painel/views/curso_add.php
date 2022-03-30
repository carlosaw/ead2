<html>
	<head>
		<title>Adicionar Curso</title>
		<link href="<?php echo BASE; ?>assets/css/template.css" rel="stylesheet">
		<style>
			
		</style>
	</head>
	<body>
		<h1 class="add">Adicionar Curso</h1>
	<form method="POST" class="form_loginAdd"enctype="multipart/form-data">
	
		<input class="inp_add" type="text" name="nome" placeholder="Nome do curso" /><br/><br/>

		<textarea name="descricao" class="txtadd" placeholder="Descrição do Curso" ></textarea><br/><br/>

		Imagem<br/>
		<input type="file" name="imagem" /><br/>
				
		<input type="submit" value="Adicionar Curso" class="inp_add" />

	</form>
	</body>
</html>


