
	<h1 style="text-align:center">Cursos</h1>
	


<table border="0" width="100%">
	<tr>
		<th class="ptr">Imagem</th>
		<th class="ptr">Nome</th>
		<th class="ptr" width="100">Qt. de Alunos</th>
		<th class="ptr">Ações</th>
	</tr>

	<?php foreach($cursos as $curso): ?>
		<tr>
			<td class="ptr" width="130"><img src="<?php echo BASE; ?>../assets/images/cursos/<?php echo $curso['imagem']; ?>" border="0" width="200" /></td>
			
			<td class="ptrname"><?php echo $curso['nome']; ?></td>
			
			<td class="ptr" align="center"><?php echo $curso['qtalunos']; ?></td>
			
			<td class="ptr" width="200">
				<div class="btnAction">
					<button class="btn a"><a href="<?php echo BASE; ?>home/adicionar">Add </a><br/></button>

					<button class="btn b"><a href="<?php echo BASE; ?>home/editar/<?php echo $curso['id']; ?>">Edit</a></button>
				
					<button class="btn c"><a href="<?php echo BASE; ?>home/excluir/<?php echo $curso['id']; ?>">Del</a></button>
				</div>
			</td>
		</tr>
	<?php endforeach; ?>

</table>
</section>
</div>