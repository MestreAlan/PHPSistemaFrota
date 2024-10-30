		<div id="logado">
			<div class="acessarmonitorarfrota-ADM-page">
				<div class="container">
					<div class="row">
						<?php
							//include 'views/sideMenu.php';
						?>
					
						<div id="responsividadeDireita" class="col-xs-9 col-xs-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
							<h1>Monitoramento da frota ADM</h1>
														
								<?php
									include 'php/controllerVisualizadorMonotoramentoFrotaADM.php';
									
									echo 
										'<div id="tabelaMF">
											<table id="tableMonotoramentoFrota" class="table_format_filter MonitorarFrota table table-striped">'.
												listarMonotorarFrota()
											.'</table>
										</div>';
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
