<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Detail Pembelian</h2>
        <table class="table">
	    <tr><td>NOTRANSAKSI</td><td><?php echo $NOTRANSAKSI; ?></td></tr>
	    <tr><td>KODEBRG</td><td><?php echo $KODEBRG; ?></td></tr>
	    <tr><td>HARGABELI</td><td><?php echo $HARGABELI; ?></td></tr>
	    <tr><td>QTY</td><td><?php echo $QTY; ?></td></tr>
	    <tr><td>DISKON</td><td><?php echo $DISKON; ?></td></tr>
	    <tr><td>DISKONRP</td><td><?php echo $DISKONRP; ?></td></tr>
	    <tr><td>TOTALRP</td><td><?php echo $TOTALRP; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_hbeli') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>