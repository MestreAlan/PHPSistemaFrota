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

	function listarMonitorarFrota(){
		$textoPush =   
			'<thead>
				<tr>
					<th>
					
					<div class="container">									
						<div class="dropdown">
							Frota 
							<button class="btn btn-secondary btn-dropdown-filtro dropdown-toggle" id="dropdown-menu-frota" idDropMenu="filtro-frota" type="button"></button><p \> 
						
		
							<ul class="dropdown-menu dropdown sharedown-content hide" id="filtro-frota">
								<div class="form-check">
									<li><input class="liDropMenu" name="locationthemes" value="Frota" type="checkbox" />&nbsp;Frota</a></li>
									<li><input class="liDropMenu" name="locationthemes" value="FrotaB" type="checkbox"/>&nbsp;FrotaB</a></li>
								</div>
								<button class="btn btn-filtro" type="button" cond=0>Atualizar</button>
							</ul>
						</div>
						
					</th>
					
					<th>
						<div class="dropdown">
							Placa
							<button class="btn btn-secondary btn-dropdown-filtro dropdown-toggle" id="dropdown-menu-placa" idDropMenu="filtro-placa" type="button"></button><p \> 
						
		
							<ul class="dropdown-menu dropdown sharedown-content hide" id="filtro-placa">
								<div class="form-check">
									<li><input class="liDropMenu" name="locationthemes" value="Placa" type="checkbox" />&nbsp;Placa</li>
									<li><input class="liDropMenu" name="locationthemes" value="PlacaB" type="checkbox"/>&nbsp;PlacaB</li>
								</div>
								<button class="btn btn-filtro" type="button" cond=1>Atualizar</button>
							</ul>
						</div>
					</th>
					
					<th>
						<div class="dropdown">
							Motorista
							<button class="btn btn-secondary btn-dropdown-filtro dropdown-toggle" id="dropdown-menu-motorista" idDropMenu="filtro-motorista" type="button"></button><p \> 
						
		
							<ul class="dropdown-menu dropdown sharedown-content hide" id="filtro-motorista">
								<div class="form-check">
									<li><input class="liDropMenu" name="locationthemes" value="Motorista" type="checkbox" />&nbsp;Motorista</a></li>
									<li><input class="liDropMenu" name="locationthemes" value="MotoristaB" type="checkbox"/>&nbsp;MotoristaB</a></li>
								</div>
								<button class="btn btn-filtro" type="button" cond=2>Atualizar</button>
							</ul>
						</div>
					</th>
					
					<th>
						Origem
					</th>
					
					<th>
						Km Inicial
					</th>
					
					<th>
						Data de saída
					</th>
					
					<th>
						Destino
					</th>
					
					<th>
						Km final
					</th>
					
					<th>
						Data de chegada
					</th>
					
					<th>
						Km total
					</th>
					
					<th>
						Diária para viagem
					</th>
					
					<th>
						Tipo de execução
					</th>
				</tr>
			</thead>
			<tbody class="tbodyDadosPessoais" >
				<tr>
					<td>
						Frota
					</td>
					
					<td>
						Placa
					</td>
					
					<td>
						Motorista
					</td>
					
					<td>
						Origem
					</td>
					
					<td>
						Km Inicial
					</td>
					
					<td>
						Data de saída
					</td>
					
					<td>
						Destino
					</td>
					
					<td>
						Km final
					</td>
					
					<td>
						Data de chegada
					</td>
					
					<td>
						Km total
					</td>
					
					<td>
						Diária para viagem
					</td>
					
					<td>
						Tipo de execução
					</td>
				</tr>
				
				<tr  class="filter-row" data-frota="FrotaB" data-placa="PlacaB">
					<td>
						FrotaB
					</td>
					
					<td>
						Placa
					</td>
					
					<td>
						MotoristaB
					</td>
					
					<td>
						Origem
					</td>
					
					<td>
						Km Inicial
					</td>
					
					<td>
						Data de saída
					</td>
					
					<td>
						Destino
					</td>
					
					<td>
						Km final
					</td>
					
					<td>
						Data de chegada
					</td>
					
					<td>
						Km total
					</td>
					
					<td>
						Diária para viagem
					</td>
					
					<td>
						Tipo de execução
					</td>
				</tr>
			</tbody>'
		;
		
		return $textoPush;
	}
	
	