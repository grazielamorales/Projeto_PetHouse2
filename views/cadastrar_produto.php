<?php
	if($_POST)
	{
		require_once "../models/Conexao.class.php";
		require_once "../models/Produto.class.php";
		require_once "../models/Categoria.class.php";
		require_once "../models/ProdutoDAO.class.php";
		$erro = false;
		if($_POST["nome"] == "")
		{
			$erro = true;
			echo "<script>alert('Preencha o nome do produto')</script>";
		}
		if($_FILES["imagem"]["name"] == "")
		{
			$erro = true;
			echo "<script>alert('Escolha uma imagem para o produto')</script>";
		}
		if($_POST["categoria"] == "0")
		{
			$erro = true;
			echo "<script>alert('Escolha uma categoria')</script>";
		}
		if(!$erro)
		{
			//inserir no BD
			$categoria = new categoria($_POST["categoria"]);
			
			$produto = new Produto(nome:$_POST["nome"], descricao:$_POST["descricao"], preco:$_POST["preco"], estoque:$_POST["estoque"], imagem:$_FILES["imagem"]["name"], status:"Ativo", categoria:$categoria);
			
			$produtoDAO = new ProdutoDAO();
			$produtoDAO->inserir_produto($produto);
			
			header("location:listar_produtos.php");
		}
		else
		{
			//voltar para o formulário
			echo "<script>location.href='form_produto.php'</script>";
		}
	}//if $_POST
	else
	{
		header("location:listar_produtos.php");
	}
?>