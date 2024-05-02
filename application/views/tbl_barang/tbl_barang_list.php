<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Daftar Barang</h2>
        <div class="row" style="margin-bottom: 10px">
          
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tbl_barang/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_barang'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Satuan</th>
		<th>Harga Beli</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($tbl_barang_data as $tbl_barang)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_barang->KODEBRG ?></td>
			<td><?php echo $tbl_barang->NAMABRG ?></td>
			<td><?php echo $tbl_barang->SATUAN ?></td>
			<td><?php echo $tbl_barang->HARGABELI ?></td>
			<td style="text-align:center" width="200px">
				<?php 
			
				echo anchor(site_url('tbl_barang/update/'.$tbl_barang->ID),'Ubah'); 
			
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <?php $this->load->view('layout/footer');?>