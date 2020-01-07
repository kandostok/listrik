<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data Level</h3>
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
									<h3 class="panel-title">Data Level</h3>
								</div>
							</div>
							<div class="col-md-6">
                            	<a href="#" data-toggle="modal" data-target="#insert_admin" class="btn btn-success pull-right" style="margin: 12px;">Tambah Level</a>
                            </div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Level</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($level as $l) {
													echo'
														<tr>
															<td>'.$l->id_level.'</td>
															<td>'.$l->level.'</td>
															<td>
                                                                <a onclick="edit_level('.$l->id_level.')" href="#" data-toggle="modal" data-target="#update_admin" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                                <a href="'.base_url('index.php/level/delete_level/'.$l->id_level).'" class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i></a>
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
                	<h4>Tambah Level</h4>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('index.php/level/tambah_level')?>" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_level">
                                        <label>Level</label>
                                        <input type="text" class="form-control form-control-line" name="level"><br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php base_url()?>level/update_level" method="post">
                    <div class="modal-body">
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-block">
                                    <div class="form-horizontal form-material form-group">
                                        <input type="hidden" name="id_level" id="ubah_idlevel">
                                        <label>Level</label>
                                        <input type="text" id="ubah_level" class="form-control form-control-line" name="level">
                                        <br>
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

        function edit_level(id) {
            $('#ubah_idlevel').val();
            $('#ubah_level').val();

            $.getJSON("<?php echo base_url('index.php/level/get_id_level/') ?>"+ id, function(data){
                $('#ubah_idlevel').val(data.id_level);
                $('#ubah_level').val(data.level);
                // $('#ubah_level').prop('selectedIndex', data.id_admin - 1 );
            });
        }
    </script>

<?php include 'footer.php' ?>