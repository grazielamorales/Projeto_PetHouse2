<?php
	class Categoria
	{
		public function __construct(private int $idcategoria = 0, private string $descritivo = "", private string $status = ""){}
		
		
		

		

		/**
		 * Get the value of idcategoria
		 */
		public function getIdcategoria(): int
		{
				return $this->idcategoria;
		}

		/**
		 * Set the value of idcategoria
		 */
		public function setIdcategoria(int $idcategoria): self
		{
				$this->idcategoria = $idcategoria;

				return $this;
		}

		/**
		 * Get the value of descritivo
		 */
		public function getDescritivo(): int
		{
				return $this->descritivo;
		}

		/**
		 * Set the value of descritivo
		 */
		public function setDescritivo(int $descritivo): self
		{
				$this->descritivo = $descritivo;

				return $this;
		}


	}
?>