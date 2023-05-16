<?php

require_once "models/Conexao.class.php";
require_once "models/CategoriaDAO.class.php";
require_once "models/Categoria.class.php";
require_once "models/ProdutoDAO.class.php";
require_once "models/Produto.class.php";

class produtoController
{
    public function listar()
    {
        $produtoDAO = new produtoDAO();
        $retorno = $produtoDAO->buscar_todos_produtos();
        require_once "views/listar_produtos.php";
    }

    public function inserir()
    {
        if($_POST)
        {
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
			
			$produto = new Produto(nome:$_POST["nome"], descricao:$_POST["descricao"], preco:$_POST["preco"], estoque:$_POST["estoque"], imagem:$_FILES["imagem"]["name"],
                       status:"Ativo", categoria:$categoria);
			
			$produtoDAO = new ProdutoDAO();
			$produtoDAO->inserir_produto($produto);
			
			header("location:index.php?controle=produtoController&metodo=listar");
		}
		
	}//if $_POST
	
        $categoria = new Categoria(status:"Ativo");
				
        $categoriaDAO = new CategoriaDAO();
				
        $retorno = $categoriaDAO->buscar_todas_categorias_ativas($categoria);
        
        require_once "views/form_produto.php";


    }

    public function alterar()
    {

    }

    public function buscar_Ativos()
    {
        $produto = new Produto(status:"Ativo");
		$produtoDAO = new ProdutoDAO();
		$retorno = $produtoDAO->buscar_todos_produtos_ativos($produto);
    }
}