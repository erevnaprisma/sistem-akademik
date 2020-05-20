<table class="table table-vcenter">

						<thead>
							<tr>
								<th>No</th>
								<th>Nama Siswa</th>
								<th>Kehadiran</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i=1;
								foreach($app as $k){
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>
													<input type="hidden" name="id_device[]" value="'.$k['id_device'].'">
													<input type="hidden" name="nama_siswa[]" value="'.$k['nama_siswa'].'">
													'.$k['nama_siswa'].'
													<input type="hidden" id="id_abs_siswa" 
													class="id_abs_siswa form-control" name="id_abs_siswa[]" value="'.$k['id_user'].'">
												</td>
												<td><select id="aas_hdr-'.$i.'" name="kehadiran[]" class="form-control"><option value="1">Hadir</option><option value="2">Ijin</option><option value="3">Terlambat</option><option value="4">Sakit</option><option value="5">Alfa</option></select></td>
												<td><input type="text" id="abs_ket" name="abs_ket[]" class="abs_ket form-control" placeholder="Isi Keterangan"></td>
											</tr>';
									$i++;
								}
							?>
						</tbody>
					</table>
