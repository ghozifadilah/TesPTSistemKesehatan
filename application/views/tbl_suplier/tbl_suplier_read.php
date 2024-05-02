<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_suplier Read</h2>
        <table class="table">
	    <tr><td>KODESPL</td><td><?php echo $KODESPL; ?></td></tr>
	    <tr><td>NAMASPL</td><td><?php echo $NAMASPL; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_suplier') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>