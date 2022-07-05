<?php
/**
* connect.php
*
* Abre a conexão com o banco de dados e executa as querys.
* @author Marco Roberto Capella Soares <mrcapella@gmail.com>
*/
class Conexao {	

	public static function conectDb() {
		
		$hostname = "localhost";
		$username = "capella";
		$password = "84011970";
		$db  = "workflow";

		$conn = mysqli_connect($hostname, $username, $password, $db);

		if (!$conn) {

			die ("Erro na conexão: ".mysqli_error());
 
		}else {

			return $conn;

		}
	}

	public static function getUsersPerfil() {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select wu.id_users,wu.users_full_name,wp.perfil_nome,wu.users_cpf,wu.users_email
			from wf_users wu, wf_usersxperfil wup, wf_perfil wp
			where wup.id_users = wu.id_users
			and wup.id_perfil = wp.id_perfil";

			return mysqli_query($con, $query);

		}
	}

	public static function getClientes() {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select * from wf_cliente";

			return mysqli_query($con, $query);

		}
	}

	public static function listaClientes($id) {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select * from wf_cliente where id_cliente=".$id;

			return mysqli_query($con, $query);

		}
	}
	public static function listaPesquisa($id_empresa) {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select * from wf_pesquisa 
			where pesquisa_active='S'
			and pesquisa_id_empresa =".$id_empresa;

			return mysqli_query($con, $query);

		}
	}

	public static function insertUsers($nome,$cpf,$email,$telefone,$senha) {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select * from wf_users 
			where users_cpf = '".$cpf."'
			or users_email ='".$email."'";
			$res = mysqli_query($con, $query);

			if (mysqli_num_rows($res) > 0) {

				return("Este usuário já está cadastrado!");
			
			} else {

				$query = "INSERT INTO wf_users(users_name,users_full_name,users_cpf,users_email,users_telefone,users_password,users_id_perfil) VALUES('$nome','$nome','$cpf','$email','$telefone',md5('$senha'),'1')";
				mysqli_query($con, $query);				
				
			}			
		}

		mysqli_close($con);
	}

	public static function insertCliente($nome,$cpf,$sexo,$telefone,$contato,$email,$cep,$rua,$fachada,$bairro,$cidade,$uf,$pesquisa,$nasc) {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select * from wf_cliente
			where cliente_cpf = '".$cpf."'";
			$res = mysqli_query($con, $query);

			if (mysqli_num_rows($res) > 0) {

				$query = "UPDATE wf_cliente SET cliente_nome='$nome',
				cliente_cpf='$cpf',
				cliente_sexo='$sexo',
				cliente_telefone='$telefone',
				cliente_contato='$contato',
				cliente_email='$email',
				cliente_cep='$cep',
				cliente_rua='$rua',
				cliente_fachada='$fachada',
				cliente_bairro='$bairro',
				cliente_cidade='$cidade',
				cliente_uf='$uf',
				cliente_id_pesquisa='$pesquisa',
				cliente_data_nascimento='$nasc',
				cliente_id_empresa=1
				where cliente_cpf = '$cpf'";
				mysqli_query($con, $query);

				return("Cliente atualizado com sucesso!");
			
			} else {

				$query = "INSERT INTO wf_cliente(cliente_nome,cliente_cpf,cliente_sexo,cliente_telefone,cliente_contato,cliente_email,cliente_cep,
				cliente_rua, cliente_fachada,cliente_bairro,cliente_cidade,cliente_uf,cliente_id_pesquisa,cliente_data_nascimento,cliente_id_empresa) VALUES('$nome','$cpf','$sexo','$telefone','$contato','$email','$cep','$rua','$fachada','$bairro','$cidade','$uf','$pesquisa','$nasc',1)";
				mysqli_query($con, $query);

				return("Cliente cadastrado com sucesso!");
				
			}			
		}

		mysqli_close($con);
	}

	public static function validaLogin($email,$senha) {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "select users_password from wf_users 
			where users_email ='".$email."'";
			$res = mysqli_query($con, $query);

			if (mysqli_num_rows($res) > 0) {
				
				while($row = mysqli_fetch_object($res)) {

					$passwd = $row->users_password;
				}
				if (md5($senha) != $passwd) {
					
					return "0";

				}else {
				
					return "1";
				}			
			}else {

				return "2";				
			}			
		}

		mysqli_close($con);
	}

	public static function gravaAcesso($email) {
		
		$con = Conexao::conectDb();

		if ($con) {

			$query = "UPDATE wf_users SET users_last_acess = now()
			where users_email = '".$email."'";
			mysqli_query($con, $query);			
		}
		return $query;
		mysqli_close($con);
	}
}
?>