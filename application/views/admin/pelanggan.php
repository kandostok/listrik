<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data Pelanggan </h3>
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
									<h3 class="panel-title">Data Pelanggan</h3>
								</div>
							</div>
							<div class="col-md-6">
                            	<a href="#" data-toggle="modal" data-target="#insert_admin" class="btn btn-success pull-right" style="margin: 12px;">Tambah Pelanggan</a>
                            </div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Pelanggan</th>
												<th>Username</th>
												<th>Password</th>
												<th>No. KWH</th>
                                                <th>Alamat</th>
                                                <th>Daya</th>
                                                <th>Tarif</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($pelanggan as $t) {
													echo'
														<tr>
															<td>'.$t->id_pelanggan.'</td>
															<td>'.$t->nama_pelanggan.'</td>
															<td>'.$t->username.'</td>
															<td>'.$t->password.'</td>
															<td>'.$t->nomorKWH.'</td>
                                                            <td>'.$t->alamat.'</td>
                                                            <td>'.$t->daya.' kWh</td>
                                                            <td>Rp '.$t->tarif.'</td>
															<td>
                                                                <a onclick="edit_pelanggan('.$t->id_pelanggan.')" href="#" data-toggle="modal" data-target="#update_admin" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                                <a href="'.base_url('index.php/pelanggan/delete_pelanggan/'.$t->id_pelanggan).'" class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i></a>
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

		<div class="modal fade" id="insert_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                	<h4>Tambah Pelanggan</h4>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('index.php/pelanggan/tambah_pelanggan')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_pelanggan">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" class="form-control form-control-line" name="nama_pelanggan"><br>
                                        <label>Username</label>
                                        <input type="text" class="form-control form-control-line" name="username"><br>
                                        <label>Password</label>
                                        <input type="text" class="form-control form-control-line" name="password"><br>
                                        <label>Alamat</label>
                                        <input type="text" class="form-control form-control-line" name="alamat"><br>
                                        <label>Nomor KWH</label>
                                        <input type="text" class="form-control form-control-line" name="nomorKWH"><br>
                                        <label>Daya</label>
                                        <select class="form-control" name="daya">
                                            <?php
                                                foreach ($tarif as $t) {
                                                    echo '
                                                        <option value="'.$t->id_tarif.'">'.$t->daya.'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="tambah" class="btn btn-success" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('index.php/pelanggan/update_pelanggan')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_pelanggan" id="ubah_idpelanggan">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" id="ubah_namapelanggan" class="form-control form-control-line" name="nama_pelanggan">
                                        <br>
                                        <label>Username</label>
                                        <input type="text" id="ubah_username" class="form-control form-control-line" name="username">
                                        <br>
                                        <label>Password</label>
                                        <input type="text" id="ubah_password" class="form-control form-control-line" name="password">
                                        <br>
                                        <label>Alamat</label>
                                        <input type="text" class="form-control form-control-line" name="alamat" id="ubah_alamat"><br>
                                        <label>Nomor KWH</label>
                                        <input type="text" id="ubah_nomorkwh" class="form-control form-control-line" name="nomorKWH"><br>
                                        <label>Daya</label><br>
                                        <select class="form-control" id="ubah_daya" name="daya">
                                            <?php
                                                foreach ($tarif as $t) {
                                                    echo '
                                                        <option value="'.$t->id_tarif.'">'.$t->daya.'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="edit" class="btn btn-success" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">

        function edit_pelanggan(id) {
            $('#ubah_idpelanggan').val();
            $('#ubah_username').val();
            $('#ubah_password').val();
            $('#ubah_namapelanggan').val();
            $('#ubah_alamat').val();
            $('#ubah_nomorkwh').val();
            $('#ubah_daya').val();

            $.getJSON("<?php echo base_url('index.php/pelanggan/get_id_pelanggan/') ?>"+ id, function(data){
                $('#ubah_idpelanggan').val(data.id_pelanggan);
                $('#ubah_username').val(data.username);
                $('#ubah_password').val(data.password);
                $('#ubah_namapelanggan').val(data.nama_pelanggan); 
                $('#ubah_alamat').val(data.alamat);
                $('#ubah_nomorkwh').val(data.nomorKWH);
                $('#ubah_daya').val(data.id_tarif);
                // $('#ubah_level').prop('selectedIndex', data.id_admin - 1 );
            });
        }
    </script>

<?php include 'footer.php' ?>