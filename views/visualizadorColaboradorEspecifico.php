		<div id="logado">
			<div class="person-page">
				<div class="container">
					<div class="row">
						<?php
							//include 'views/sideMenu.php';
						?>
						
						<div class="modal modalSpinner fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
							<div class="modal-dialog modal-sm">
								<div class="modal-content" style="width: 48px">
									<span class="fa fa-spinner fa-spin fa-3x"></span>
								</div>
							</div>
						</div>
						
						<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">

							<div class="tab" role="tabpanel">
				                
								<button type="button" class="btn btn-primary voltar">Voltar</button>
								<h1>Editar dados do colaborador</h1>

				                <!-- Nav tabs -->
				                <ul class="nav nav-tablist" id="ex1" role="tablist">
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link active" id="ex1-tab-1" data-bs-toggle="tab"	href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">D. Pessoais</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-2" data-bs-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls=" ex1-tabs-2" aria-selected="false">D. Contratuais</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-3" data-bs-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls=" ex1-tabs-3" aria-selected="false">Endereço</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-4" data-bs-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls=" ex1-tabs-4" aria-selected="false">Contatos</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-5" data-bs-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls=" ex1-tabs-5" aria-selected="false">Dependentes</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-6" data-bs-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls=" ex1-tabs-6" aria-selected="false">D. Bancários</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-7" data-bs-toggle="tab" href="#ex1-tabs-7" role="tab" aria-controls=" ex1-tabs-7" aria-selected="false">Eventos</a>
				                    </li>
				                    <li role="presentation" class="nav-item">
				                    	<a class="nav-link" id="ex1-tab-8" data-bs-toggle="tab" href="#ex1-tabs-8" role="tab" aria-controls=" ex1-tabs-8" aria-selected="false">Documentos</a>
				                    </li>

				                </ul>

				                <div class="tab-content" id="ex1-content">
				                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
				                        <?php
											include 'php/controllerVisualizadorColaboradorEspecifico.php';
											
											echo '<table id="tableDadosPessoais" class="colaboradorEspecifico table table-striped">'.
											
											chamarListarDadosPessoais()
											
											.'</table>';
										?>
				                    </div>

				                    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">

				                    	<div class="tab" role="tabpane2">
					                    	<ul class="nav nav-tablist" id="ex2" role="tablist">
							                    <li role="presentation" class="nav-item">
							                    	<a class="nav-link active" id="ex2-tab-1" data-bs-toggle="tab"	href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Vínculo</a>
							                    </li>
							                    <li role="presentation" class="nav-item">
							                    	<a class="nav-link" id="ex2-tab-2" data-bs-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls=" ex2-tabs-2" aria-selected="false">Jornada</a>
							                    </li>
							                    <li role="presentation" class="nav-item">
							                    	<a class="nav-link" id="ex2-tab-3" data-bs-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls=" ex2-tabs-3" aria-selected="false">Remuneração</a>
							                    </li>
							                    <li role="presentation" class="nav-item">
							                    	<a class="nav-link" id="ex2-tab-4" data-bs-toggle="tab" href="#ex2-tabs-4" role="tab" aria-controls=" ex2-tabs-3" aria-selected="false">Benefícios</a>
							                    </li>
							                    <li role="presentation" class="nav-item">
							                    	<a class="nav-link" id="ex2-tab-5" data-bs-toggle="tab" href="#ex2-tabs-5" role="tab" aria-controls=" ex2-tabs-3" aria-selected="false">Descontos</a>
							                    </li>
							                </ul>

					                        <?php
					                        	echo '
					                        	<div class="tab-content" id="ex2-content">
													<div class="complementoCorpo tab-pane fade show active" id="ex2-tabs-1" role="tabpane2" aria-labelledby="ex2-tab-1">
					                        			<table id="tableDadosProfissionais" class="colaboradorEspecifico table table-striped">'.
										
															chamarListarDadosProfissionais()
										
														.'</table> 
													</div>
													<div class="tab-pane fade" id="ex2-tabs-2" role="tabpane2" aria-labelledby="ex2-tab-2">
														<table id="tableJornada" class="colaboradorEspecifico table table-striped">	
															'.chamarListarJornada().'
														</table>
													</div>
													<div class="tab-pane fade" id="ex2-tabs-3" role="tabpane2" aria-labelledby="ex2-tab-3">
														<table id="tableRemuneracao" class="colaboradorEspecifico table table-striped">	
															'.chamarListarRemudenracao().'
														</table>
													</div>
													<div class="complementoCorpo tab-pane fade" id="ex2-tabs-4" role="tabpane2" aria-labelledby="ex2-tab-4">
														<table id="tableBeneficios" class="colaboradorEspecifico table table-striped">'.
										
															chamarListarBeneficios()
											
														.'</table> 
													</div>
													<div class="tab-pane fade" id="ex2-tabs-5" role="tabpane2" aria-labelledby="ex2-tab-5">
														Em desenvolvimento
													</div>
												</div>';
											?>
				                 	    </div>
				                	</div>
				                    <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
				                        <?php
				                       		echo '<div class="complementoCorpo"> <table id="tableEnderecos" class="colaboradorEspecifico table table-striped">'.
									
											chamarListarEndereco()
											
											.'</table> </div>';
										?>
									</div>
									<div class="tab-pane fade" id="ex1-tabs-4" role="tabpanel" aria-labelledby="ex1-tab-4">
				                        <?php
											echo '<div class="complementoCorpo"> <table id="tableContatos" class="colaboradorEspecifico table table-striped">'.
											
											chamarListarContatos()
											
											.'</table> </div>';
										?>
									</div>
									<div class="tab-pane fade" id="ex1-tabs-5" role="tabpanel" aria-labelledby="ex1-tab-5">
				                        <?php		
											echo '<div class="complementoCorpo"> <table id="tableDependentes" class="colaboradorEspecifico table table-striped">'.
											
											chamarListarDependentes()
											
											.'</table> </div>';
										?>
									</div>	
									<div class="tab-pane fade" id="ex1-tabs-6" role="tabpanel" aria-labelledby="ex1-tab-6">
				                        <?php		
											echo '<div class="complementoCorpo"> <table id="tableDadosBancarios" class="colaboradorEspecifico table table-striped">'.
										
											chamarListarDadosBancarios()
											
											.'</table> </div>';
										?>
									</div>
									<div class="tab-pane fade" id="ex1-tabs-7" role="tabpanel" aria-labelledby="ex1-tab-7">
				                        <?php	
											echo '<div class="complementoCorpo"> 
												<table id="tableEventos" class="colaboradorEspecifico table table-striped">'.
										
													chamarEventos()
											
												.'</table>
											</div>
											
											<div id="myModal" class="modal">
												<!-- Modal content -->
												<div class="modal-content">
													<table id="tableEventosDesligamento" class="colaboradorEspecifico table table-striped">
										
														<thead>
					
															</thead>
															<tbody class="tbodyDadosBancarios" >
																<tr>
																	<td>
																		<div class="container">
																			<div class="row">
																				<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
																					<input required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,24}" class="nomeBanco" dadosBancoNomeAtual="" id="dadosBancoNome"  type="text" value="">
																					<span>Data de início:  </span>
																				</div>
																				<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
																					<input required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,24}" class="nomeBanco" dadosBancoNomeAtual="" id="dadosBancoNome"  type="text" value="">
																					<span>Data final:  </span>
																				</div>
																			</div>
																			<div class="row">
																				<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
																					<input dadosBancoAgenciaAtual="" id="dadosBancoAgencia" required pattern="[0-9]{1}[0-9\-]{2,5}[0-9]{1}"  class="agencia" type="text" value="">
																					<span>Informações:  </span>
																				</div>
																			</div>
																			<div class="row">
																				<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
																					<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
																					<span>Indenizado ou não:  </span>
																				</div>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td>
																		<button id="dadosBancarios-" type="button" class="btn btn-primary btnSalvarDadosBancarios">Cadastrar</button>
																	</td>
																</tr>
															</tbody>
											
													</table>
												</div>
											</div>
											
											';
										?>
									</div>
									<div class="tab-pane fade" id="ex1-tabs-8" role="tabpanel" aria-labelledby="ex1-tab-8">
				                        <?php
											//ADD DOCUMENTOS
											echo '<div class="complementoCorpo"> 										
												<form enctype="multipart/form-data" class="documentosForm">
													<div class="file-loading">
														<input id="kv-explorer" type="file" multiple=true name="arquivo[]" >
													</div>
												</form>
											</div>'
											;
										?>
				                    </div>
				                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
