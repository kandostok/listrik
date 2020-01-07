<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Detail Tagihan</h3>
							<p class="panel-subtitle">
								<?php 
									echo"Tanggal: ".date("d-m-Y");
								 ?>
							</p>
						</div>
					</div>
						<?php
	                        $notifikasi = $this->session->flashdata('notif');
	                        if ($notifikasi != null) {
	                            echo '
	                                <div class="alert alert-danger">
	                                    '.$notifikasi.'
	                                </div>
	                            ';
	                        }
	                    ?>
	                <?php
	                        $notifikasi_sukses = $this->session->flashdata('notif_sukses');
	                        if ($notifikasi_sukses != null) {
	                            echo '
	                                <div class="alert alert-success">
	                                    '.$notifikasi_sukses.'
	                                </div>
	                            ';
	                        }
	                    ?>
					<!-- END OVERVIEW -->
					<div class="panel">
						<div class="row">
							<div class="col-md-6">
								<div class="panel-heading">
									<h3 class="panel-title">Detail Tagihan</h3>
								</div>
							</div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Bulan</th>
												<th>Tahun</th>
                                                <th>Total Penggunaan</th>
                                                <th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($tag as $t) {
													echo'
														<tr>
															<td>'.$t->id_tagihan.'</td>
															<td>'.$t->bulan.'</td>
															<td>'.$t->tahun.'</td>
															<td>'.$t->jumlah_meter.'</td>
															<td>'.$t->status.'</td>
														</tr>
													';
												}
											 ?>
										</tbody>
									</table>
								</div>
							</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->

<?php include 'footer.php' ?>