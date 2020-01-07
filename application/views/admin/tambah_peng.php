<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Tambah Penggunaan</h3>
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
									<h3 class="panel-title">Tambah Penggunaan</h3>
								</div>
							</div>
						</div>
							<div class="panel-body">
								<form action="<?=base_url('index.php/penggunaan/tambah_peng')?>" method="post">
				                    <div class="modal-body">
				                            <div class="card-block">
				                                    <div class="form-horizontal form-material form-group">
				                                    	<input type="hidden" name="id_penggunaan">
				                                        <label>Id Pelanggan</label>
				                                        <input type="text" class="form-control form-control-line" name="id_pelanggan" value="<?=$peng->id_pelanggan?>" readonly><br>
				                                        <label>Pelanggan</label>
				                                        <input type="text" class="form-control form-control-line" name="pelanggan" value="<?=$peng->nama_pelanggan?>" readonly><br>
				                                        <label>Bulan</label>
				                                        <input type="text" class="form-control form-control-line" name="bulan"><br>
				                                        <label>Tahun</label>
				                                        <input type="number" class="form-control form-control-line" name="tahun"><br>
				                                        <label>Meter Awal</label>
				                                        <input type="number" class="form-control form-control-line" name="meter_awal"><br>
				                                        <label>Meter Akhir</label>
				                                        <input type="number" class="form-control form-control-line" name="meter_akhir">
				                                    </div>
				                            </div>
				                    </div>
				                    <div class="modal-footer">
				                        <input type="submit" name="tambah" class="btn btn-success" value="SIMPAN">
				                    </div>
				                </form>
								</div>
							</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->

		
<?php include 'footer.php' ?>