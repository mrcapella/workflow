<?php
/**
* action_cadastro.php
*
* Ações para o cadastro das tabelas.
* @author Marco Roberto Capella Soares <marco.capella@jcrsolucoes.com>
* Update em 07/11/2016
*
*/
include_once("../model/connect.php");
include_once("trata_geral.php");

// Função para gerar uma sequência aleatória de caracteres
function geraSenha($tamanho = 8, $numeros = true, $simbolos = false) {
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$num = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';
	$caracteres .= $lmin;
	if ($numeros) 
		$caracteres .= $num;
	if ($simbolos) 
		$caracteres .= $simb;
	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}

switch ($_POST["postCadastro"]) {    
    case 'novo_usuario':  
        $nome = TrataStrings::exibeSpecialChars($_POST["postNome"]);
		$cpf = $_POST["postCpf"];
        $telefone = $_POST["postTelefone"];
        $email = $_POST["postEmail"];
		$senha = $_POST["postSenha"];
		$res = Conexao::insertUsers(strtoupper($nome),$cpf,$email,$telefone,$senha);
		echo $res;      
    break;
	case 'novo_cliente':  
        $nome = utf8_decode($_POST["postNome"]);
		$cpf = $_POST["postCpf"];
		$sexo = $_POST["postSexo"];
        $telefone = TrataStrings::exibeSpecialChars($_POST["postTelefone"]);
		$contato = TrataStrings::exibeSpecialChars($_POST["postContato"]);
        $email = $_POST["postEmail"];
		$cep = $_POST["postCep"];
		$rua = utf8_decode($_POST["postRua"]);
		$bairro = utf8_decode($_POST["postBairro"]);
		$fachada = $_POST["postFachada"];
		$cidade = utf8_decode($_POST["postCidade"]);
		$uf = $_POST["postUf"];
		$pesquisa = $_POST["postPesquisa"];
		$nasc = $_POST["postDatanasc"];
		$res = Conexao::insertCliente(strtoupper($nome),$cpf,$sexo,$telefone,$contato,$email,$cep,$rua,$fachada,$bairro,$cidade,$uf,$pesquisa,$nasc);
		echo $res;      
    break;
}
?>