<?php
	date_default_timezone_set("America/Sao_Paulo");
	require_once "vendor/autoload.php";
	$html = "<h1>Extrato da Compra - " . date('d/m/Y') . "</h1>";
	$html.= "<table>
	           <tr>
			      <th>Produto</th>
				  <th>Quantidade</th>
				  <th>Preço</th>
			   </tr>";
	 foreach($_SESSION["carrinho"] as $dado)
	 {
		$subtotal = $dado["preco"] * $dado["quantidade"];
		$total +=$subtotal;

		$html .= "<tr>
				  <td>{$dado['nome']}</td>
		          <td>{$dado['quantidade']}</td>
				  <td>" . number_format($dado["preco"],2, ",", ".") . "</td>
				  </tr>";
	 }
	 $html.= "
	 			<tr>
				<th colspan='4'>Total do pedido---------------->" 
				. number_format($total, 2, ',', '.') ."
				</th></tr>";
	 $html .= "</table>";
			   
	 $mpdf = new \Mpdf\Mpdf();
	 $mpdf->AddPage("P");
	 $estilo = file_get_contents("style/style.css");
	 $mpdf->writeHTML($estilo, 1);
	 $mpdf->writeHTML($html);
	 $mpdf->output();
?>
