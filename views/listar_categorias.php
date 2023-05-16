<?php
	
	require_once "cabecalho.php";	
	if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "Administrador")
	{
		header("location:index.php");
	}
?>
	<div class="content">
	<div class="container">
		<h1>Categorias</h1>
		<table class="table table-striped">
			<tr>
				<th>Descritivo</th>
				<th>Situação</th>
				<th>Ações</th>
			</tr>
			
				<?php	
					if(is_array($retorno))
					{

						foreach($retorno as $dados)
						{
							echo "<tr>";
							echo "<td>{$dados->descritivo}</td>";
							echo "<td>{$dados->status}</td>";
							echo "<td>
							
							<a class='btn btn-primary' href='index.php?controle=categoriaController&metodo=alterar&id={$dados->idcategoria}'>Alterar</a>
							
							&nbsp;&nbsp;
							
							<a class='btn btn-danger' href='index.php?controle=categoriaController&metodo=excluir&id={$dados->idcategoria}'>Excluir</a>
							
							&nbsp;&nbsp;";
							
							if($dados->status == "Ativo")
							{
								echo "<a href='index.php?controle=categoriaController&metodo=inativar_status&id={$dados->idcategoria}&status=Inativo'class='btn btn-secondary'>Inativar</a>";
							}
							else
							{
								echo "<a class='btn btn-warning' href='index.php?controle=categoriaController&metodo=ativar_status&id={$dados->idcategoria}&status=Ativo'>Ativar</a>";
							}
							echo "</td></tr>";
						}
					}
					
				?>
		</table>
		<br><br><a class="btn btn-success" href="form_categoria.html">Nova Categoria</a>
<?php
	require_once "rodape.html";
?>