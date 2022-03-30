<html>
	<head>
		<meta charset="UTF-8" />
		<title>EAD</title>
		<link href="<?php echo BASE; ?>assets/css/template.css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE; ?>assets/js/script.js"></script>
	</head>
	<body>
		<div class="container">
			<section>
			<div class="topo">
				<a href="<?php echo BASE; ?>">
					<div>Cursos</div>
				</a>
				<a href="<?php echo BASE; ?>alunos">
					<div>Alunos</div>
				</a>
				<a href="<?php echo BASE; ?>login/logout">
					<div style="float:right">Sair</div>
				</a>			
			</div>
		
	<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</body>
</html>