<?php
	require_once "cabecalho.php";
	
?>


<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Categoria</title>
	</head>
	<body>
		<h1>Categoria</h1>
		<form action="#" method="POST">
		
			<input type="hidden" name="idcategoria" value="<?php echo $ret[0]->idcategoria;?>">
			
			<label>Descritivo:</label>
			<input type="text" name="descritivo" value="<?php echo $ret[0]->descritivo;?>">
			<br><br>
			<input type="submit" value="Alterar">
		</form>
	</body>
</html>