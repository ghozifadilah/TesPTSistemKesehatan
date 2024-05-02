<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Daftar Supplier</h2>
        <div class="row" style="margin-bottom: 10px">
          
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tbl_suplier/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_suplier'); ?>" class="btn btn-default">Reset</a>
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
		<th>Kode Supplier</th>
		<th>Nama Supplier</th>
		<th>Action</th>
            </tr><?php
            foreach ($tbl_suplier_data as $tbl_suplier)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_suplier->KODESPL ?></td>
			<td><?php echo $tbl_suplier->NAMASPL ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tbl_suplier/update/'.$tbl_suplier->ID),'Ubah'); 
				echo ' | '; 
				echo anchor(site_url('tbl_suplier/delete/'.$tbl_suplier->ID),'Hapus','onclick="javasciprt: return confirm(\'Anda yakin ?\')"'); 
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