					<!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Painel principal</li>

                        <?php if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#rhSideBar" aria-expanded="false" aria-controls="rhSideBar" class="side-nav-link">
									<i class="fa fa-users"></i>
									<span class="badge bg-success float-end">4</span>
									<span> RH </span>
								</a>
								<div class="collapse" id="rhSideBar"> <!--add show em class para colapsar-->
									<ul class="side-nav-second-level">
										<li>
											<a style="text-decoration:none;" href="#" id="acessoListaColaboradores" class="menuitem-active active">- Todos colaboradores</a>
										</li>
										<li><a style="text-decoration:none;" href="#" id="acessoListaColaboradoresAtivos">- Colaboradores ativos</a></li>
										<li><a style="text-decoration:none;" href="#" id="acessoListaColaboradoresDesativos">- Colaboradores inativos</a></li>
										<li><a style="text-decoration:none;" href="#" id="acessoCriarColaborador">- Novo colaboradores</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#almoxarifadoSideBar" aria-expanded="false" aria-controls="almoxarifadoSideBar" class="side-nav-link">
									<i class="fa fa-archive"></i>
									<span class="badge bg-success float-end">5</span>
									<span> Almoxarifado </span>
								</a>
								<div class="collapse " id="almoxarifadoSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" href="#">- *Estoque geral</a></li>
										<li><a style="text-decoration:none;" href="#">- *EPI</a></li>
										<li><a style="text-decoration:none;" href="#">- *EPC</a></li>
										<li><a style="text-decoration:none;" href="#">- *Peças em estoque</a></li>
										<li><a style="text-decoration:none;" href="#">- *Itens de saúde</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#frotaSideBar" aria-expanded="false" aria-controls="frotaSideBar" class="side-nav-link">
									<i class="fa fa-car"></i>
									<span class="badge bg-success float-end">2</span>
									<span> Frota </span>
								</a>
								<div class="collapse " id="frotaSideBar">
									<ul class="side-nav-second-level">
										<!--<li><a style="text-decoration:none;" href="#" id="acessoMonitoramentoFrota">- Monitoramento de frota</a></li>-->
										<li><a style="text-decoration:none;" href="#" id="acessoManipularFrota">- Listar Frotas</a></li>
										<li><a style="text-decoration:none;" href="#" id="acessoAdicionarFrota">- Adicionar Frota</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#saudeSideBar" aria-expanded="false" aria-controls="saudeSideBar" class="side-nav-link">
									<i class="fa fa-ambulance"></i>
									<span class="badge bg-success float-end">2</span>
									<span> Saúde </span>
								</a>
								<div class="collapse " id="saudeSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" href="#">- *Liberar veiculo</a></li>
										<li><a style="text-decoration:none;" href="#">- *Validar equipamentos</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#clientesSideBar" aria-expanded="false" aria-controls="clientesSideBar" class="side-nav-link">
									<i class="fa fa-handshake-o"></i>
									<span class="badge bg-success float-end">3</span>
									<span> Clientes </span>
								</a>
								<div class="collapse " id="clientesSideBar">
									<ul class="side-nav-second-level">'.
										($_SESSION['perfil_logado'] != '4' ? '<li><a style="text-decoration:none;" id="acessoListarClientesGeral" href="#">- Listar clientes</a></li>' : '').
										($_SESSION['perfil_logado'] != '4' ? '<li><a style="text-decoration:none;" id="acessoCriarCliente" href="#">- Novo cliente</a></li>' : '').
										($_SESSION['perfil_logado'] == '4' ? '<li><a style="text-decoration:none;" id="acessoClienteRestrito" href="#">- Acompanhar Ordens de Serviço</a></li>' : '').
									'</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#operacoesSideBar" aria-expanded="false" aria-controls="operacoesSideBar" class="side-nav-link">
									<i class="fa fa-map-o"></i>
									<span class="badge bg-success float-end">1</span>
									<span> Operações </span>
								</a>
								<div class="collapse " id="operacoesSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" href="#" id="acessoCriarPlanejamentoOS">- Planejar OS</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#sistemaSideBar" aria-expanded="false" aria-controls="sistemaSideBar" class="side-nav-link">
									<i class="fa fa-cog"></i>
									<span class="badge bg-success float-end">1</span>
									<span> Sistema </span>
								</a>
								<div class="collapse " id="sistemaSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" href="#" id="acessoGerenciarLocalizacoes">- Gerenciar localizações</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] == '1'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#financeiroSideBar" aria-expanded="false" aria-controls="financeiroSideBar" class="side-nav-link">
									<i class="fa fa-money"></i>
									<span class="badge bg-success float-end">4</span>
									<span> Financeiro </span>
								</a>
								<div class="collapse " id="financeiroSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" id="acessoPrecificarRota" href="#">- Precificar rota</a></li>
										<li><a style="text-decoration:none;" id="acessoCriarNota" href="#">- Criar nota fiscal</a></li>
										<li><a style="text-decoration:none;" href="#">- *Balanço patrimonial</a></li>
										<li><a style="text-decoration:none;" href="#">- *Manipular documentos</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] == '1'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#administrativoSideBar" aria-expanded="false" aria-controls="administrativoSideBar" class="side-nav-link">
									<i class="fa fa-bar-chart"></i>
									<span class="badge bg-success float-end">2</span>
									<span> Administrativo </span>
								</a>
								<div class="collapse " id="administrativoSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" href="#" id="acessoListarOrdensServicos">- Monitorar OS</a></li>
										<li><a style="text-decoration:none;" href="#" id="acessoDashboard">- Dashboard</a></li>
									</ul>
								</div>
							</li>';
						}
						if($_SESSION['perfil_logado'] != '4'){
							echo 
							'<li class="side-nav-item menuitem-active">
								<a style="text-decoration:none;" data-bs-toggle="collapse" href="#monitorarSideBar" aria-expanded="false" aria-controls="monitorarSideBar" class="side-nav-link">
									<i class="fa fa-map-marker"></i>
									<span class="badge bg-success float-end">1</span>
									<span> Monitorar frota </span>
								</a>
								<div class="collapse " id="monitorarSideBar">
									<ul class="side-nav-second-level">
										<li><a style="text-decoration:none;" href="#" id="acessoVisualizarLocalizacaoVeiculos">- Ver</a></li>
									</ul>
								</div>
							</li>';
						} ?>
						
                        <li class="side-nav-title side-nav-item">Apps</li>

                        <li class="side-nav-item">
                            <a style="text-decoration:none;" href="#" class="side-nav-link">
                                <i class="uil-calender"></i>
                                <span> Calendario </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a style="text-decoration:none;" href="#" class="side-nav-link">
                                <i class="uil-comments-alt"></i>
                                <span> Chat </span>
                            </a>
                        </li>

                        
                    </ul>

                    <!-- End Sidebar -->

                    <div class="clearfix"></div>