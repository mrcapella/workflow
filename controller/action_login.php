<?php
/**
* action_login.php
*
* Ações para o cadastro das tabelas.
* @author Marco Roberto Capella Soares <marco.capella@jcrsolucoes.com>
* Update em 07/11/2016
*
*/
include_once("../model/connect.php");

switch ($_POST["postLogin"]) {    
    case 'login': 
        $email = $_POST["postEmail"];
		$senha = $_POST["postSenha"];
		$res = Query::validaLogin($email,$senha);
		echo $res;      
    break;
}
?>