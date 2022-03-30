<div class="cursoinfo">
	<img src="<?php echo BASE; ?>assets/images/cursos/<?php echo $curso->getImagem(); ?>" border="0" height="60" />
	<h3><?php echo $curso->getNome(); ?></h3>
	<?php echo $curso->getDescricao(); ?><br/>
	<?php echo $aulas_assistidas.' / '.$total_aulas.' ('.(($aulas_assistidas/$total_aulas)*100).'%)'; ?>
</div>

<div class="curso_left">
	<?php foreach($modulos as $modulo): ?>
		<div class="modulo"><?php echo $modulo['nome']; ?></div>
		<!--em server side tirar utf8_encode-->
		<!--Cria as aulas dentro do modulo	-->
		<?php foreach($modulo['aulas'] as $aula): ?>
			<a href="<?php echo BASE; ?>cursos/aula/<?php echo $aula['id']; ?>">
				<div class="aula">
					<?php echo $aula['nome']; ?>
					<?php if($aula['assistido'] === true): ?>
					<img style="float:right; margin-right:10; margin-top:5;" src="<?php echo BASE; ?>assets/images/v.png" border="0" height="20"/>
					<?php endif; ?>
				</div>
			</a>
		<?php endforeach; ?>	
	
	<?php endforeach; ?>
</div>
<div class="curso_right">
	<h1>Vídeo - <?php echo $aula_info['nome']; ?></h1>

	<iframe id="video" style="width:100%" frameborder="0" src="//player.vimeo.com/video/<?php echo $aula_info['url']; ?>"></iframe><br/>
	
	<?php echo $aula_info['descricao']; ?><br/>
	<!--<?php //print_r($aula_info); ?>-->
	<?php if($aula_info['assistido'] === '1'): ?>
		Esta aula ja foi assistida!
	<?php else: ?>
		<button onclick="marcarAssistido(this)" data-id="<?php echo $aula_info['id_aula']; ?>">Marcar como assistida</button>
	<?php endif; ?>
	<hr/>
	
	<h3 class="duv">Dúvidas? Envie sua pergunta!</h3>
	<div class="form_duvida">
		<form method="POST">
			<textarea name="duvida"></textarea><br/><br/>
			<input type="submit" value="Enviar Dúvida" />
		</form>
	</div>
</div>