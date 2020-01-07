<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data Tarif</h3>
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
									<h3 class="panel-title">Data Tarif</h3>
								</div>
							</div>
							<div class="col-md-6">
                            	<a href="#" data-toggle="modal" data-target="#insert_admin" class="btn btn-success pull-right" style="margin: 12px;">Tambah Tarif</a>
                            </div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Daya</th>
												<th>Tarif</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($tarif as $t) {
													echo'
														<tr>
															<td>'.$t->id_tarif.'</td>
															<td>'.$t->daya.'</td>
															<td>'.$t->tarif.'</td>
															<td>
                                                                <a onclick="edit_tarif('.$t->id_tarif.')" href="#" data-toggle="modal" data-target="#update_admin" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                                <a href="'.base_url('index.php/Tarif/delete_tarif/'.$t->id_tarif).'" class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i></a>
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
                	<h4>Tambah Tarif</h4>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('index.php/Tarif/tambah_tarif')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_tarif">
                                        <label>Daya</label>
                                        <input type="number" class="form-control form-control-line" name="daya"><br>
                                        <label>Tarif</label>
                                        <input type="number" class="form-control form-control-line" name="tarif">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Tarif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('index.php/Tarif/update_tarif')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_tarif" id="ubah_idtarif">
                                        <label>Daya</label>
                                        <input type="number" id="ubah_daya" class="form-control form-control-line" name="daya">
                                        <br>
                                        <label>Tarif</label>
                                        <input type="number" id="ubah_tarif" class="form-control form-control-line" name="tarif">
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

        function edit_tarif(id) {
            $('#ubah_idtarif').val();
            $('#ubah_daya').val();
            $('#ubah_tarif').val();

            $.getJSON("<?php echo base_url('index.php/Tarif/get_id_tarif/') ?>"+ id, function(data){
                $('#ubah_idtarif').val(data.id_tarif);
                $('#ubah_daya').val(data.daya);
                $('#ubah_tarif').val(data.tarif);
                // $('#ubah_level').prop('selectedIndex', data.id_tarif - 1 );
            });
        }
    </script>

<?php include 'footer.php' ?>