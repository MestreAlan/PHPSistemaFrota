		<div id="logado">
			<div class="criar-planejamentoOS-page">
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
				
					<div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
						<div class="modal-dialog modal-sm">
							<div class="modal-content" style="width: 48px">
								<span class="fa fa-spinner fa-spin fa-3x"></span>
							</div>
						</div>
					</div>
				
					<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
						<h1>Planejamento de Ordens de Serviço</h1>
						<button type="button" class="btn btn-primary voltar">Ir para lista de OSs</button>
						<h2>Criar OS</h2>
						<?php
							include 'php/controllerVisualizadorPlanejamentoOS.php';
							
							echo listarPlanejarOS();
						?>
						
						<p \><p \>
						<p \><p \>
						<h2>Acompanhar OS</h2>
						<p \><p \><button type="button" id="editarOS" class="btn btn-primary editarOS">Salvar alterações</button>
						<div id="visualTable"></div>
					</div>
				</div>
			</div>
		</div>
		