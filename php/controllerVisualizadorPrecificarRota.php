<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	/* Carrega o model */	
	include 'model.php';

	foreach($_POST as $indice => $value){
		$_POST[$indice] = addslashes($_POST[$indice]);
		$_POST[$indice] = mysqli_real_escape_string(conectarBanco(), $_POST[$indice]);
	}

	foreach($_GET as $indice => $value){
		$_GET[$indice] = addslashes($_GET[$indice]);
		$_GET[$indice] = mysqli_real_escape_string(conectarBanco(), $_GET[$indice]);
	}

	foreach($_REQUEST as $indice => $value){
		$_REQUEST[$indice] = addslashes($_REQUEST[$indice]);
		$_REQUEST[$indice] = mysqli_real_escape_string(conectarBanco(), $_REQUEST[$indice]);
	}
	
	function inserirEstado($verificador){
		$listaEstados = listarEstados();

		while($estado = $listaEstados->fetch_row()){
			if($estado[0]==$verificador){
				return $estado[2];
			}
		}
		
		return "";
	}
	
	function inserirLocais($id,$diferenciador,$ref){
		$listarLocais = listarLocais();
		
		$selectOptions = '<select id="input_locais-'.$diferenciador.'-'.$ref.'" class="input_locais" required>';
		$selectOptions = $selectOptions.'<option value="" disable>Selec.</option>';
		
		while($local = $listarLocais->fetch_row()){
			$estado = inserirEstado($local[6]);
			if($id == $local[0]){
				$selectOptions = $selectOptions.'<option value="'.$local[0].'" selected>'.$local[1].' / '.$estado.'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$local[0].'">'.$local[1].' / '.$estado.'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirCliente($id,$diferenciador){
		$listaEmpresas = listarClientes();
		
		$selectOptions = '<select id="input_cliente-'.$diferenciador.'" class="input_cliente" required>';
		$selectOptions = $selectOptions.'<option value="" >Não especificado</option>';
		
		while($empresa = $listaEmpresas->fetch_row()){
			if($empresa[0]==$id){
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'" selected>'.$empresa[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'">'.$empresa[1].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function addPrecificacao(){
		
		$clientes = inserirCliente(0,0);
		$origem = inserirLocais(0,'o',0);
		$destino = inserirLocais(0,'d',0);
		
		$textoPush = '
		<div class="tabelaMF">
			<h2>Criar precificação</h2>
			<table class="table_format_filter monitorarFrota table table-striped">
				<thead>
					<tr>
						<th scope="col">Ações</th>
						<th>Contrato</th>
						<th scope="col">Apelido</th>
						<th scope="col">Valor</th>
						<th scope="col">km</th>
						<th scope="col">Transit-time</th>
						<th scope="col">Origem</th>
						<th scope="col">Destino</th>
						<th scope="col">Cliente</th>
					</tr>
				</thead>
				<tbody>
					<tr class="visualizarColaborador" >
						<th scope="row">
							<button type="button" id="salvar-0" class="btn btn-primary btn-salvar">Salvar</button>
						</th>
						<td><input type="checkbox" id="checked-0"></td>
						<td><input id="apelido-0" class="nome" value="" \></td>
						<td><input id="valor-0" class="nome money" value="" \></td>
						<td><input id="km-0" class="nome" value="" \></td>
						<td><input id="transitime-0" class="nome" value="" \></td>
						<td>'.$origem.'</td>
						<td>'.$destino.'</td>
						<td>'.$clientes.'</td>
					</tr>
				</tbody>
			</table>
		</div>';
		
		return $textoPush;
	}
	
	function listarPrecificacoes(){
		$lista = listarLocaisPrecificacoes();
		
		$textoPush = '
				<div class="tabelaMF">
					<h2>Gerenciar precificações existentes</h2>
					<table class="table_format_filter monitorarFrota table table-striped">
						<thead>
							<tr>
								<th scope="col">Ações</th>
								<th scope="col">Contrato</th>
								<th scope="col">Apelido</th>
								<th scope="col">Valor</th>
								<th scope="col">km</th>
								<th scope="col">Transit-time</th>
								<th scope="col">Origem</th>
								<th scope="col">Destino</th>
								<th scope="col">Cliente</th>
							</tr>
						</thead>
						<tbody>
			';
									
		while($row = $lista->fetch_row()) {
			$origem = inserirLocais($row[8],'o',$row[0]);
			$destino = inserirLocais($row[9],'d',$row[0]);
			$clientes = inserirCliente($row[10],$row[0]);
			$contrato = $row[1] == 1 ? "checked" : "";
			$textoPush = $textoPush.'
							<tr class="visualizarColaborador" id="'.$row[0].'">
								<th scope="row">
									<button type="button" id="salvar-'.$row[0].'" class="btn btn-primary btn-salvar">Salvar</button>
									<button type="button" id="excluir-'.$row[0].'" class="btn btn-primary btn-excluir">Excluir</button>
								</th>
								<td><input type="checkbox" id="checked-'.$row[0].'" '.$contrato.'></td>
								<td><input id="apelido-'.$row[0].'" class="nome" value="'.$row[2].'" \></td>
								<td><input id="valor-'.$row[0].'" class="nome money" value="'.$row[4].'" \></td>
								<td><input id="km-'.$row[0].'" class="nome" value="'.$row[3].'" \></td>
								<td><input id="transitime-'.$row[0].'" class="nome" value="'.$row[5].'" \></td>
								<td>'.$origem.'</td>
								<td>'.$destino.'</td>
								<td>'.$clientes.'</td>
							</tr>
			';
		}		
		
		$textoPush = $textoPush.'
						</tbody>
					</table>
				</div>
		';
		
		return $textoPush;
	}
