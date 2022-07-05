<?php
/**
* action_consulta.php
*
* Ações para o consulta dos dados.
* @author Marco Roberto Capella Soares <mrcapella@gmail.com>
* Update em 02/07/2022
*
*/
include_once("../model/connect.php");
include_once("trata_geral.php");

switch ($_POST["postConsulta"]) {    
    case 'lista_cliente': 
		$cliente = "";
	
		$id = ($_POST["postId"]);
		$res = conexao::listaClientes($id);;
		while($row = mysqli_fetch_array($res)) {
			for($i=1; $i<=($res->field_count-1);$i++) {
				$cliente = $cliente."#".$row[$i];
			}
		}
		echo utf8_encode($cliente);
    break;
}
?>