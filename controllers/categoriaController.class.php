<?php
	require_once "models/Conexao.class.php";
	require_once "models/CategoriaDAO.class.php";
	require_once "models/Categoria.class.php";
	
	if(!isset($_SESSION)){
		session_start();

		class categoriaController
		{
			public function listar()
			{
				if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "Administrador")
				{
					header("location:index.php");
				}
				$categoriaDAO = new CategoriaDAO();
				$retorno = $categoriaDAO->buscar_todas_categorias();
				if(is_array($retorno))
				{
					require_once "views/listar_categorias.php";
				}
				else
				{
					echo $retorno;
				}
			}
			public function inserir()
			{
				if($_POST)
				{
					if($_POST["descritivo"] == "")
					{
						echo "<script>alert('Preencha o descritivo da categoria')</script>";
					}
					else
					{
						$categoria = new Categoria(descritivo:$_POST["descritivo"], status:"Ativo");
						
						$categoriaDAO = new CategoriaDAO();
						
						$categoriaDAO->inserir_categoria($categoria);
						
						header("location:index.php?");
					}
				}
		
				require_once "views/form_categoria.php";
			}

			public function alterar()
			{				
				if(isset($_GET["id"]))
				{
					//buscar a categoria no BD
					$categoria = new Categoria($_GET["id"]);
					$categoriaDAO = new CategoriaDAO();
					$ret = $categoriaDAO->buscar_uma_categoria($categoria);
					header("location: edit_categoria.php");
					

					if($_POST)
					{			
						//alterar categoria no BD				
						$categoria = new Categoria($_POST["idcategoria"], $_POST["descritivo"]);
						$categoriaDAO = new CategoriaDAO();
						$categoriaDAO->alterar_categoria($categoria);
						
					}				
					header("location:listar_categorias.php");
				}
						
				
			}

			public function excluir_categoria()
			{
				if($_GET)
				{
					//excluir				
					$categoria = new Categoria(idcategoria:$_GET["id"]);
					
					$categoriaDAO = new CategoriaDAO();
					$categoriaDAO->excluir_categoria($categoria);
					
				}				
				header("location:listar_categorias.php");				
						
			}

			public function alterar_estatus() 
			{
				if(isset($_GET["id"]))
				{
					//buscar uma categoria do BD
					$categoria = new Categoria($_GET["id"]);
					$categoriaDAO = new CategoriaDAO();
					$retorno = $categoriaDAO->buscar_todas_categorias_ativas($categoria);
					header("location: edit_categoria.php");

					if($_POST){

						//alterar o status
						$categoria = new Categoria(idcategoria:$_GET["id"], status:$_GET["status"]);
						
						$categoriaDAO = new CategoriaDAO();
						
						$categoriaDAO->alterar_status($categoria);
					}					
					header("location:listar_categorias.php");
					
				}				
								
			}
		}	
	}

?>