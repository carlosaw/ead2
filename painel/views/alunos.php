<h1 style="text-align:center">Alunos</h1>

<button class="btnAdd"><a href="<?php echo BASE; ?>alunos/adicionar">Adicionar Aluno</a></button><br/><br/>
<table border="1" width="100%">
	<tr>
		<th>Nome</th>
		<th width="80">Qt. de Cursos</th>
		<th>Ações</th>
	</tr>
	<?php foreach($alunos as $aluno): ?>
		<tr>
			<td style="padding-left:20"><?php echo $aluno['nome']; ?></td>
			<td align="center"><?php echo $aluno['qtcursos']; ?></td>
			
			<td width="200">
			<div class="btnEdit">
				<button class="btnEditaluno"><a href="<?php echo BASE; ?>alunos/editar/<?php echo $aluno['id']; ?>">Editar Aluno</a></button>
			
				<button class="btnDelaluno"><a href="<?php echo BASE; ?>alunos/excluir/<?php echo $aluno['id']; ?>">Excluir Aluno</a></button>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>

</table>