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
                                                <th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($get_bayar as $h) {
                                                    
													echo'
														<tr>
															<td>'.$h->nomorKWH.'</td>
															<td>'.$h->nama_pelanggan.'</td>
															<td>'.$h->bulan_bayar.'</td>
															<td>'.$h->biaya_admin.'</td>
															<td>'.$h->total_bayar.'</td>
															<td>'.$h->status.'</td>
                                                            <td><img src="'.base_url().'assets/uploads/'.$h->bukti.'" width="40"></td>
                                                            <td>
                                                            <div class="btn-group">
                                                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                  Aksi
                                                                <span class="caret"></span>
                                                              </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                  <li><a href="'.base_url().'index.php/tagihan/verificated/'.$h->id_pembayaran.'/'.$h->id_tagihan.'/lunas">Lunas</a></li>
                                                                  <li><a href="'.base_url().'index.php/tagihan/verificated/'.$h->id_pembayaran.'/'.$h->id_tagihan.'/ditolak">Ditolak</a></li>
                                                                </ul></div>
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

    <div class="modal fade" id="update_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php base_url('index.php/tagihan/verificated')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_admin" id="ubah_idadmin">
                                        <label>Status</label>
                                        <select class="form-control" id="ubah_level" name="status">
                                            <option value="lunas">Lunas</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                        <label>Admin</label>
                                        <select class="form-control" id="ubah_level" name="admin">
                                            <?php 
                                                foreach ($admin as $a) {
                                                    var_dump($admin);
                                                    echo'
                                                        <option value="'.$a->id_admin.'">'.$a->nama_admin.'</option>
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