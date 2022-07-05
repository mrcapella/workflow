<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>..:: Sistema ::..</title>
<link rel="shortcut icon" href="../images/icons/cadastro.fw.png"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="../scripts/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
	//var iframe_height = parseInt($('html').height()); 
	//window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
	$('#table_cliente').DataTable();

	$("#cadastrar").click(function() { 

		var nome = $("#nome").val();
		var cpf = $("#cpf").val();
		var datanasc = $("#datanasc").val();
		var sexo = $("input[type='radio'][name='sexo']:checked").val();
		var cpf = $("#cpf").val();
		var email = $("#email").val();
		var telefone = $("#telefone").val();
		var contato = $("#contato").val();
		var cep = $("#cep").val();
		var rua = $("#rua").val();
		var fachada = $("#fachada").val();
		var bairro = $("#bairro").val();
		var cidade = $("#cidade").val();
		var uf = $("#uf").val();
		var pesquisa = $("#pesquisa").val();

		// Validação dos campos
		if (nome == "") {
			$("#nome").css("background-color","#FF6666");
			alert("O campo Nome não foi preenchido!");
			$("#nome").focus();
			return false;
		}
		if (cpf == "") {
			$("#cpf").css("background-color","#FF6666");
			alert("O campo CPF não foi preenchido!");
			$("#cpf").focus();
			return false;
		}		
		if (datanasc == "") {
			$("#datanasc").css("background-color","#FF6666");
			alert("O campo Nascimento não foi preenchido");
			$("#datanasc").focus();
			return false;
		}
		if ((sexo != "F") && (sexo != "M") && (sexo != "O")) {
			$("#sexo").css("background-color","#FF6666");
			alert("Informe o sexo do cliente!");
			$("#sexo").focus();
			return false;
		}
		if (telefone == "") {
			$("#telefone").css("background-color","#FF6666");		
			alert('O campo Telefone não foi preenchido!');
			$("#telefone").focus();
			return false;
		}
		if (email == "") {
			$("#senha").css("background-color","#FF6666");		
			alert('O campo E-mail não foi preenchido!');
			$("#email").focus();
			return false;
		}
		if (cep == "") {
			$("#cep").css("background-color","#FF6666");		
			alert('Os dados do endereço não foram preenchidos!');
			$("#cep").focus();
			return false;
		}
		if (fachada == "") {
			$("#fachada").css("background-color","#FF6666");		
			alert('O número da casa não foi informado!');
			$("#fachada").focus();
			return false;
		}
		$.ajax({
			url: "../controller/action_cadastro.php",
			type: "POST",
			data: { postCadastro:'novo_cliente', postNome:nome, postCpf:cpf, postEmail:email, postTelefone:telefone, postContato:contato, postSexo:sexo, postDatanasc:datanasc, postPesquisa:pesquisa, postCep:cep, postRua:rua, postFachada:fachada, postBairro:bairro, postCidade:cidade, postUf:uf },
			dataType: "html",
			success: function(res) {
				if (res) {
					alert(res);
				}
				$("#nome").val("");
				$("#cpf").val("");
				$("#email").val("");
				$("#telefone").val("");
				$("#contato").val("");
				$("#cep").val("");
				$("#datanasc").val("");
				$("#pesquisa").val("0");
				$("#fachada").val("");
				$('input[name="sexo"]').prop('checked', false);
				document.location.reload(true);
			}
		});     
	});
});

function carrega_formulario(id) {

	//carrega os valores do grid para o formulário de cadastro.	
	$.ajax({
		url: "../controller/action_consulta.php",
		type: "POST",
		data: { postConsulta:'lista_cliente', postId:id },
		dataType: "html",
		success: function(res) {
			if (res) {
				const arr = res.split("#");
				document.getElementById('nome').value=(arr[1]);
				document.getElementById('cpf').value=(arr[2]);
				document.getElementById('email').value=(arr[3]);
				document.getElementById('cep').value=(arr[5]);
				document.getElementById('rua').value=(arr[6]);
				document.getElementById('fachada').value=(arr[7]);
				document.getElementById('bairro').value=(arr[8]);
				document.getElementById('cidade').value=(arr[9]);
				document.getElementById('uf').value=(arr[10]);
				document.getElementById('pesquisa').value=(arr[11]);
				document.getElementById('telefone').value=(arr[13]);
				document.getElementById('contato').value=(arr[14]);
				document.getElementById('datanasc').value=(arr[15]);
				switch(arr[4]) {
					case "F":
						$('input[id="sexoF"]').prop('checked', true);
					break;
					case "M":
						$('input[id="sexoM"]').prop('checked', true);
					break;						
					default: 
						$('input[id="sexoO"]').prop('checked', true);
				}
			}
		}
	}); 
		
}

function limpa_formulario_cep() {
	//Limpa valores do formulário de cep.
	document.getElementById('rua').value=("");
	document.getElementById('bairro').value=("");
	document.getElementById('cidade').value=("");
	document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
	if (!("erro" in conteudo)) {
		//Atualiza os campos com os valores.
		document.getElementById('rua').value=(conteudo.logradouro);
		document.getElementById('bairro').value=(conteudo.bairro);
		document.getElementById('cidade').value=(conteudo.localidade);
		document.getElementById('uf').value=(conteudo.uf);
	}else {
		//CEP não Encontrado.
		limpa_formulario_cep();
		alert("CEP não encontrado.");
		document.getElementById('cep').value=("");
	}
}
	
function pesquisacep(valor) {
	//Nova variável "cep" somente com dígitos.
	var cep = valor.replace(/\D/g, '');

	//Verifica se campo cep possui valor informado.
	if (cep !== "") {

		//Expressão regular para validar o CEP.
		var validacep = /^[0-9]{8}$/;

		//Valida o formato do CEP.
		if(validacep.test(cep)) {
			//Preenche os campos com "..." enquanto consulta webservice.
			document.getElementById('rua').value="...";
			document.getElementById('bairro').value="...";
			document.getElementById('cidade').value="...";
			document.getElementById('uf').value="...";

			//Cria um elemento javascript.
			var script = document.createElement('script');

			//Sincroniza com o callback.
			script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

			//Insere script no documento e carrega o conteúdo.
			document.body.appendChild(script);

		}else {
			//cep é inválido.
			limpa_formulario_cep();
			alert("Formato de CEP inválido.");
		}
	}else {
		//cep sem valor, limpa formulário.
		limpa_formulario_cep();
	}
}

function formatar(mascara, documento){
	var i = documento.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(i);

	if (texto.substring(0,1) != saida){
		documento.value += texto.substring(0,1);
	}
}
</script>
<style>
h11 {
    color:red;
}

#logo {
	width:50%;
	height:50%;
}
#teste:hover {
	background-color: #c0c0c0;
	text-align: center;
}
.panel-heading{
    font-size:150%;
}
</style>
</head>
<body>
<form class="form-horizontal">
<fieldset>
	<div class="panel panel-primary">
		<div class="panel-heading">Cadastro de Cliente</div>		
		<div class="panel-body">
			<!--<div class="form-group">
				<div class="col-md-11 control-label">
					<p class="help-block"><h11>*</h11> Campo Obrigatório </p>
				</div>
			</div>-->

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
				<div class="col-md-8">
					<input id="nome" name="nome" placeholder="" class="form-control input-md" required="" type="text">
				</div>
			</div>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-2 control-label" for="Nome">CPF <h11>*</h11></label>  
				<div class="col-md-2">
					<input id="cpf" name="cpf" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="14" pattern="[0-9]+$" OnKeyPress="formatar('###.###.###-##', this)">
				</div>
			  
				<label class="col-md-1 control-label" for="Nome">Nascimento<h11>*</h11></label>  
				<div class="col-md-2">
					<input id="datanasc" name="datanasc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
				</div>

				<!-- Multiple Radios (inline) -->
				<label class="col-md-1 control-label" for="radios">Sexo <h11>*</h11></label>
				<div class="col-md-4"> 
					<label required="" class="radio-inline" for="radios-0" >
						<input name="sexo" id="sexoF" value="F" type="radio" required>
						Feminino
					</label> 
					<label class="radio-inline" for="radios-1">
						<input name="sexo" id="sexoM" value="M" type="radio">
						Masculino
					</label>
					<label class="radio-inline" for="radios-2">
						<input name="sexo" id="sexoO" value="O" type="radio">
						Outro
					</label>
				</div>
			</div>

			<!-- Prepended text-->
			<div class="form-group">
				<label class="col-md-2 control-label" for="prependedtext">Telefone <h11>*</h11></label>
				<div class="col-md-2">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input id="telefone" name="telefone" class="form-control" placeholder="XX XXXXX-XXXX" required="" type="text" maxlength="15" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$" OnKeyPress="formatar('## #####-####', this)">
					</div>
				</div>			  
				<label class="col-md-1 control-label" for="prependedtext">Contato</label>
				<div class="col-md-2">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input id="contato" name="contato" class="form-control" placeholder="XX XXXXX-XXXX" type="text" maxlength="15"  pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$" OnKeyPress="formatar('## #####-####', this)">
					</div>
				</div>
			</div> 

			<!-- Prepended text-->
			<div class="form-group">
				  <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
				  <div class="col-md-5">
						<div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							  <input id="email" name="email" class="form-control" placeholder="email@email.com" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
						</div>
				  </div>
			</div>

			<!-- Search input-->
			<div class="form-group">
				<label class="col-md-2 control-label" for="CEP">CEP <h11>*</h11></label>
				<div class="col-md-2">
					<input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="9" pattern="[0-9]+$">
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-primary" onclick="pesquisacep(cep.value)">Pesquisar</button>
				</div>
			</div>

			<!-- Prepended text-->
			<div class="form-group">
				<label class="col-md-2 control-label" for="prependedtext">Endereço</label>
				<div class="col-md-4">
					<div class="input-group">
					<span class="input-group-addon">Rua</span>
					<input id="rua" name="rua" class="form-control" placeholder="" required="" readonly="readonly" type="text">
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<span class="input-group-addon">Nº <h11>*</h11></span>
					<input id="fachada" name="fachada" class="form-control" placeholder="" required=""  type="text">
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-addon">Bairro</span>
					<input id="bairro" name="bairro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="prependedtext"></label>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Cidade</span>
					<input id="cidade" name="cidade" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<span class="input-group-addon">Estado</span>
					<input id="uf" name="uf" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
				</div>
			</div>
		</div>
		<?php 
		include_once("../model/connect.php");
		$res = Conexao::listaPesquisa('1');
		?>
		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-2 control-label" for="selectbasic">Como soube da loja?</label>
			<div class="col-md-3">
				<select required id="pesquisa" name="pesquisa" class="form-control">					
					<option value="0">Selecione uma opção</option>
					<?php
					while($row = mysqli_fetch_object($res)) {
						echo 
						"<option value=".$row->id_pesquisa.">".utf8_encode($row->pesquisa_descricao)."</option>";
					}
					?>
				</select>
			</div>
		</div>

		<!-- Button (Double) -->
		<div class="form-group">
			<label class="col-md-5 control-label" for="Cadastrar"></label>
			<div class="col-md-4">
				<a href="#" class="btn btn-primary btn-success" name="cadastrar" id="cadastrar"><span class="glyphicon glyphicon-ok"></span> Salvar</a>	
				<button id="te" name="te" class="btn btn-danger" type="Reset"><span class="glyphicon glyphicon-trash"></span> Limpar </button>
				<a href="#" class="btn btn-primary btn-default" name="cancelar" id="cancelar"><span class="glyphicon glyphicon-backward"></span> Retornar</a>
			</div>
		</div>
	</div>
</fieldset>
<?php
include_once("../controller/trata_geral.php");
$res = Conexao::getClientes();
echo "
<div class='container' style='width:90%'>
<table id='table_cliente' class='table table-striped table-bordered' style='width:100%'>
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>Telefone</th>
				<th>Contato</th>
				<th>Endereço</th>
			</tr>
		</thead>
		<tbody>";
		while($row = mysqli_fetch_object($res)) {
			echo 
			"<tr>
				<td style='text-align:center' id='teste' onclick='carrega_formulario(".$row->id_cliente.");'>".$row->id_cliente."</th>
				<td>".TrataStrings::exibeSpecialChars($row->cliente_nome)."</td>
				<td>".$row->cliente_cpf."</td>
				<td>".$row->cliente_telefone."</td>
				<td>".$row->cliente_contato."</td>
				<td>".utf8_encode($row->cliente_rua).", ".$row->cliente_fachada.", ".utf8_encode($row->cliente_bairro)."</td>
			</tr>";
		}
		echo 
		"</tbody>
	</table></br>
</div>";
?>
</form>
</body>
</html>