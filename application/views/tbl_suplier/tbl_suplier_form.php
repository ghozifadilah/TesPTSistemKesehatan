<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px"> <?php echo $button ?> Supplier</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="char">Kode Supplier <?php echo form_error('KODESPL') ?></label>
            <input type="text" class="form-control" name="KODESPL" id="KODESPL" placeholder="Kode Supplier" value="<?php echo $KODESPL; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Nama Supplier <?php echo form_error('NAMASPL') ?></label>
            <input type="text" class="form-control" name="NAMASPL" id="NAMASPL" placeholder="Nama Supplier" value="<?php echo $NAMASPL; ?>" />
        </div>
	    <input type="hidden" name="ID" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_suplier') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>