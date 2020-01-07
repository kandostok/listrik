<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">History Transaksi</h3>
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
									<h3 class="panel-title">History Transaksi</h3>
								</div>
							</div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>Nomor KWH</th>
												<th>Pelanggan</th>
												<th>Bulan Bayar</th>
												<th>Biaya Admin</th>
												<th>Total Bayar</th>
                                                <th>Status</th>
                                                <th>Bukti</th>
                                                <th>Verifikasi Admin</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($history as $h) {
													echo'
														<tr>
															<td>'.$h->nomorKWH.'</td>
															<td>'.$h->nama_pelanggan.'</td>
															<td>'.$h->bulan_bayar.'</td>
															<td>'.$h->biaya_admin.'</td>
															<td>'.$h->total_bayar.'</td>
															<td>'.$h->status.'</td>
                                                            <td><img src="'.base_url().'assets/uploads/'.$h->bukti.'" width="40"></td>
                                                            <td>'.$h->nama_admin.'</td>
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
                	<h4>Tambah Admin</h4>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('index.php/admin/tambah_admin')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_admin">
                                        <label>Username</label>
                                        <input type="text" class="form-control form-control-line" name="username"><br>
                                        <label>Password</label>
                                        <input type="text" class="form-control form-control-line" name="password"><br>
                                        <label>Nama Admin</label>
                                        <input type="text" class="form-control form-control-line" name="nama_admin"><br>
                                        <label>Level</label>
                                        <select class="form-control" name="level">
                                            <?php
                                                foreach ($level as $l) {
                                                    echo '
                                                        <option value="'.$l->id_level.'">'.$l->level.'</option>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php base_url()?>update_admin" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_admin" id="ubah_idadmin">
                                        <label>Username</label>
                                        <input type="text" id="ubah_username" class="form-control form-control-line" name="username">
                                        <br>
                                        <label>Password</label>
                                        <input type="text" id="ubah_password" class="form-control form-control-line" name="password">
                                        <br>
                                        <label>Nama Admin</label>
                                        <input type="text" id="ubah_namaadmin" class="form-control form-control-line" name="nama_admin">
                                        <br>
                                        <label>Level</label><br>
                                        <select class="form-control" id="ubah_level" name="level">
                                            <?php
                                                foreach ($level as $l) {
                                                    echo '
                                                        <option value="'.$l->id_level.'">'.$l->level.'</option>
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

        function edit_admin(id) {
            $('#ubah_idadmin').val();
            $('#ubah_username').val();
            $('#ubah_password').val();
            $('#ubah_namaadmin').val();
            $('#ubah_level').val();

            $.getJSON("<?php echo base_url('index.php/admin/get_id_admin/') ?>"+ id, function(data){
                $('#ubah_idadmin').val(data.id_admin);
                $('#ubah_username').val(data.username);
                $('#ubah_password').val(data.password);
                $('#ubah_namaadmin').val(data.nama_admin); 
                $('#ubah_level').val(data.id_level);
                // $('#ubah_level').prop('selectedIndex', data.id_admin - 1 );
            });
        }
    </script>

<?php include 'footer.php' ?>