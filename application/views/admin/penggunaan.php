<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data Penggunaan</h3>
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
									<h3 class="panel-title">Data Penggunaan</h3>
								</div>
							</div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Pelanggan</th>
												<th>Nomor KWH</th>
												<th>Daya</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($pel as $p) {
													echo'
														<tr>
															<td>'.$p->id_pelanggan.'</td>
															<td>'.$p->nama_pelanggan.'</td>
															<td>'.$p->nomorKWH.'</td>
															<td>'.$p->daya.'</td>
															<td>
                                                                <a href="'.base_url('index.php/penggunaan/add_peng/'.$p->id_pelanggan).'" class="btn btn-success btn-sm">Tambah Penggunaan</a>
                                                                <a href="'.base_url('index.php/penggunaan/detail_peng/'.$p->id_pelanggan).'" class="btn btn-primary btn-sm">Detail Penggunaan</a>
                                                                <a href="'.base_url('index.php/penggunaan/detail_tag/'.$p->id_pelanggan).'" class="btn btn-warning btn-sm">Detail Tagihan</a>
                                                            </td>
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