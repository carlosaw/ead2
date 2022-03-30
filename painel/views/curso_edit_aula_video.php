<h1 style="text-align:center;">Editar Aula - Vídeo</h1>
<fieldset>
	<form method="POST">
		Título da Aula:<br/>
		<input type="text" name="nome" value="<?php echo $aula['nome']; ?>" style="width:230;" /><br/><br/>

		Descrição da Aula:<br/>
		<textarea class="txtaula" name="descricao"><?php echo $aula['descricao']; ?></textarea><br/><br/>

		URL do vídeo:<br/>
		<input type="text" name="url" value="<?php echo $aula['url']; ?>" style="width:230;" /><br/><br/>
		
		<input type="submit" value="Salvar" />
	</form>
</fieldset>