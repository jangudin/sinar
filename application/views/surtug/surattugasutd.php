<div class="right_col" role="main">
	<div class>
		<div class="page-title">
			<div class="title_left">
				<h3>Surat Tugas</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Fasyankes </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php $this->load->view('surtug/menu')?>
						<div class="clearfix"></div>
						<hr>

						<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Faskes</th>
									<th>Nama Faskes</th>
									<th>LPA</th>

									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								foreach ($data as $a) { ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?=$a->kode_faskes ?></td>
										<td><?=$a->nama_fasyankes ?></td>
										<td><?=$a->inisial ?></td>
										<td><?php if($a->cek == null):?>
										<a class="btn btn-sm btn-success" href="<?php echo base_url('Surat_tugas/detaiutd/'.$a->pengajuan_id.'/'.$a->kode_faskes)  ?>"><span data-feather="edit"></span> TTE SURAT TUGAS</a>
									<?php else:?>
										<a class="btn btn-sm btn-success" href="<?php echo base_url('Surat_tugas/detaiutd/'.$a->pengajuan_id.'/'.$a->kode_faskes)  ?>"><span data-feather="edit"></span>LIHAT BERKAS</a>
									<?php endif;?>


								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</div>