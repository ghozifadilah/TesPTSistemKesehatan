<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_hbeli Read</h2>
        <table class="table">
	    <tr><td>NOTRANSAKSI</td><td><?php echo $NOTRANSAKSI; ?></td></tr>
	    <tr><td>KODESPL</td><td><?php echo $KODESPL; ?></td></tr>
	    <tr><td>TGLBELI</td><td><?php echo $TGLBELI; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_hbeli') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>