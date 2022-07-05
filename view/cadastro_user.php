<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" name="robots" content="noindex, nofollow">
<title>..:: Sistema ::..</title>
<link rel="shortcut icon" href="../images/icons/cadastro.fw.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="../styles/cadastro_user.css">
<script src="../scripts/jquery-1.12.4.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
var defaultCSS = document.getElementById('bootstrap-css');
function changeCSS(css){
	if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
	else $('head > link').filter(':first').replaceWith(defaultCSS); 
}
function keyPress(){
	$("#nome").css("background-color","#FFFFFF")
}

$(document).ready(function() {
	//var iframe_height = parseInt($('html').height()); 
	//window.parent.postMessage( iframe_height, 'https://bootsnipp.com');

	$("#cadastrar").click(function() { 

		var nome = $("#nome").val();
		var cpf = $("#cpf").val();
		var email = $("#emailc").val();
		var telefone = $("#telefone").val();
		var senha = $("#senhac").val();
		var senha_confirma = $("#senha_confirma").val();
			
		// Validação dos campos
		if (nome == "") {
			$("#nome").css("background-color","#FF6666");
			alert("O campo Nome não foi preenchido!");
			$("#nome").focus();
			return false;
		}
		if (senha != senha_confirma) {
			$("#senha_confirma").css("background-color","#FF6666");
			alert("As senhas não são iguais!");
			$("senha_confirma").focus();
			return false;
		}
		if (senha.length != 8) {
			$("#senha").css("background-color","#FF6666");		
			alert('A senha deve ter pelo menos 8 caracteres!');
			$("senha").focus();
			return false;
		}
		$.ajax({
			url: "../controller/action_cadastro.php",
			type: "POST",
			data: { postCadastro:'novo_usuario', postNome:nome, postCpf:cpf, postEmail:email, postTelefone:telefone, postSenha:senha },
			dataType: "html",
			success: function(res) {
				if (res) {
					alert(res);
				}
				$("#nome").val("");
				$("#cpf").val("");
				$("#emailc").val("");
				$("#telefone").val("");
				$("#senhac").val("");
				$("#senha_confirma").val("");
			}
		});

		$(cadastro_user).attr("action","teste.php");
		$(cadastro_user).attr("method","post");
		//$(cadastro_user).submit();        
	});
	
	$("#cancelar").click(function() { 		
		$(cadastro_user).attr("action","login.php");
		$(cadastro_user).attr("method","post");
		$(cadastro_user).submit();        
	});

});

function formatar(mascara, documento) {
	var i = documento.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(i);

	if (texto.substring(0,1) != saida) {
		documento.value += texto.substring(0,1);
	}
}
</script>
</head>
<body>
<form name="cadastro_user" id="cadastro_user" class="form-horizontal">
<fieldset>
	<div class="panel panel-primary">
		<div class="panel-heading">Cadastro de Usuário</div>    
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-9 control-label">
					<p class="help-block"><h11>*</h11> Campo Obrigatório </p>
				</div>
			</div>
			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-3 control-label" for="Nome">Nome <h11>*</h11></label>  
				<div class="col-md-6">
					<input id="nome" name="nome" placeholder="" class="form-control input-md" required="" type="text" value="" onKeyPress="keyPress();">
				</div>
			</div>
			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-3 control-label" for="Nome">CPF <h11>*</h11></label>  
				<div class="col-md-2">
					<input id="cpf" name="cpf" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
				</div>	  
				<label class="col-md-1 control-label" for="prependedtext">Telefone <h11>*</h11></label>
				<div class="col-md-2">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input id="telefone" name="telefone" class="form-control" placeholder="XX XXXXX-XXXX" type="text" maxlength="13"  required="" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$" OnKeyPress="formatar('## #####-####', this)">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="Nome">E-mail <h11>*</h11></label>  
				<div class="col-md-4">
					<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<input id="emailc" name="emailc" class="form-control" placeholder="seuemail@email.com" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="Nome">Senha <h11>*</h11></label>  
				<div class="col-md-4">
					<div class="input-group">
					<input id="senhac" name="senhac" type="password" placeholder="" class="form-control input-md" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="Nome">Confirme a senha <h11>*</h11></label>  
				<div class="col-md-4">
					<div class="input-group">
					<input id="senha_confirma" name="senha_confirma" type="password" placeholder="" class="form-control input-md" value="">
					</div>
				</div>
			</div>
		</div>			
		<!-- Button (Double) -->
		<div class="form-group">
			<label class="col-md-3 control-label" for="Cadastrar"></label>
			<div class="col-md-8">
				<a href="#" class="btn btn-primary btn-success" name="cadastrar" id="cadastrar"><span class="glyphicon glyphicon-ok"></span> Cadastrar</a>					
				<button id="te" name="te" class="btn btn-danger" type="Reset"><span class="glyphicon glyphicon-trash"></span> Limpar dados</button>
				<a href="#" class="btn btn-primary btn-default" name="cancelar" id="cancelar">&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-backward"></span> Retornar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</a>
			</div>
		</div>
	</div>
</fieldset>
</form>
</body>
</html>