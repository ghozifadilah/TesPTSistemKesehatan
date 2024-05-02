<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_stock Read</h2>
        <table class="table">
	    <tr><td>QTYBELI</td><td><?php echo $QTYBELI; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_stock') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>