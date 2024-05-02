<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_dbeli List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('tbl_dbeli/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tbl_dbeli/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_dbeli'); ?>" class="btn btn-default">Reset</a>
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
		<th>KODEBRG</th>
		<th>HARGABELI</th>
		<th>QTY</th>
		<th>DISKON</th>
		<th>DISKONRP</th>
		<th>TOTALRP</th>
		<th>Action</th>
            </tr><?php
            foreach ($tbl_dbeli_data as $tbl_dbeli)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_dbeli->NOTRANSAKSI ?></td>
			<td><?php echo $tbl_dbeli->KODEBRG ?></td>
			<td><?php echo $tbl_dbeli->HARGABELI ?></td>
			<td><?php echo $tbl_dbeli->QTY ?></td>
			<td><?php echo $tbl_dbeli->DISKON ?></td>
			<td><?php echo $tbl_dbeli->DISKONRP ?></td>
			<td><?php echo $tbl_dbeli->TOTALRP ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tbl_dbeli/read/'.$tbl_dbeli->ID),'Detail'); 
				echo ' | '; 
				echo anchor(site_url('tbl_dbeli/update/'.$tbl_dbeli->ID),'Ubah'); 
				echo ' | '; 
				echo anchor(site_url('tbl_dbeli/delete/'.$tbl_dbeli->ID),'Hapus','onclick="javasciprt: return confirm(\'Anda yakin ?\')"'); 
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