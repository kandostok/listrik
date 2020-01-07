<?php include 'header.php'; ?>

	<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Daftar Tagihan </h3>
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
									<h3 class="panel-title">Daftar Tagihan</h3>
								</div>
							</div>
						</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Bulan</th>
												<th>Total</th>
												<th>Bukti</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($up as $u):
												$cek_tag = $this->tag->cek_pembayaran($u->id_tagihan); 
											 ?>
											 <tr>
											 	<td><?=$u->id_tagihan?></td>
											 	<td><?=$u->bulan?> <?=$u->tahun?></td>
											 	<td><?=($u->tarif*$u->jumlah_meter)?></td>
											 	<td>
													<?php
													if(@$cek_tag->bukti!=""){
														echo '<img src="'.base_url().'assets/uploads/'.$cek_tag->bukti.'" width="40">';
													}
													?>
												</td>
												<td>
													<?php 
														if(@$cek_tag->status==null){
															echo $u->status;
														} else{
															echo $cek_tag->status;
														}
													?>
												</td>
												<td>
													<?php 
														if (@$cek_tag->status=='lunas') {
															echo'LUNAS';
														} else{
															echo'
																<a onclick="up_bukti('.$u->id_tagihan.')" href="#" data-toggle="modal" data-target="#up_bukti" class="btn btn-warning btn-sm">Upload</a>
															';
														}
													 ?>
												</td>
											 </tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->

		<div class="modal fade" id="up_bukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                	<h4>Upload Bukti</h4>
	                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <form action="<?=base_url('index.php/pelanggan/aksi_upload')?>" method="post" enctype="multipart/form-data">
	                    <div class="modal-body">
	                        <div class="tab-pane" id="settings" role="tabpanel">
	                            <div class="card-block">
	                                    <div class="form-horizontal form-material form-group">
	                                        <input type="hidden" name="id_tagihan" id="id_tagihan">
	                                        <label>Upload Bukti</label>
	                                        <input type="file" class="form-control form-control-line" name="bukti">
	                                    </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="modal-footer">
	                        <input type="submit" name="submit" class="btn btn-success" value="Kirirm">
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>

<script type="text/javascript">
	function up_bukti(id_tagihan){
		$("#id_tagihan").val(id_tagihan);
		$("#id_tarif").val(id_tarif)
	}
</script>

<?php include 'footer.php' ?>