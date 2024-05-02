<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_barang Read</h2>
        <table class="table">
	    <tr><td>KODEBRG</td><td><?php echo $KODEBRG; ?></td></tr>
	    <tr><td>NAMABRG</td><td><?php echo $NAMABRG; ?></td></tr>
	    <tr><td>SATUAN</td><td><?php echo $SATUAN; ?></td></tr>
	    <tr><td>HARGABELI</td><td><?php echo $HARGABELI; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_barang') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>