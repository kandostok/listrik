<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Detail Penggunaan</h3>
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
									<h3 class="panel-title">Detail Penggunaan</h3>
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
												<th>Meter Awal</th>
												<th>Meter Akhir</th>
                                                <th>Total Penggunaan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($pengap as $p) {
                                                    $ma = (int)$p->meter_akhir;
                                                    $am = (int)$p->meter_awal;
                                                    $jumlah = $ma - $am;
													echo'
														<tr>
															<td>'.$p->id_penggunaan.'</td>
															<td>'.$p->bulan.'</td>
															<td>'.$p->tahun.'</td>
															<td>'.$p->meter_awal.'</td>
															<td>'.$p->meter_akhir.'</td>
                                                            <td>'.$jumlah.'</td>
															<td>
                                                                <a href="'.base_url('index.php/Penggunaan/delete_penggunaan/'.$p->id_penggunaan).'" class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i></a>
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