<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Daftar Pembelian</h2>
        <div class="row" style="margin-bottom: 10px">
           
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tbl_hbeli/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_hbeli'); ?>" class="btn btn-default">Reset</a>
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
		<th>NOTRANSAKSI</th>
		<th>KODESPL</th>
		<th>TGLBELI</th>
		<th>Action</th>
            </tr><?php
            foreach ($tbl_hbeli_data as $tbl_hbeli)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_hbeli->NOTRANSAKSI ?></td>
			<td><?php echo $tbl_hbeli->KODESPL ?></td>
			<td><?php echo $tbl_hbeli->TGLBELI ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tbl_hbeli/detailBeli/'.$tbl_hbeli->ID),'Detail'); 
                echo ' | ';
                echo anchor(site_url('tbl_hbeli/delete/'.$tbl_hbeli->ID),'Hapus','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"');
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