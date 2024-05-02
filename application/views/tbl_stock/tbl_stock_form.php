<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_stock <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">QTYBELI <?php echo form_error('QTYBELI') ?></label>
            <input type="text" class="form-control" name="QTYBELI" id="QTYBELI" placeholder="QTYBELI" value="<?php echo $QTYBELI; ?>" />
        </div>
	    <input type="hidden" name="KODEBRG" value="<?php echo $KODEBRG; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_stock') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>