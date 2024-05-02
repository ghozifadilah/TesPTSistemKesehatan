<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_hutang <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="char">NOTRANSAKSI <?php echo form_error('NOTRANSAKSI') ?></label>
            <input type="text" class="form-control" name="NOTRANSAKSI" id="NOTRANSAKSI" placeholder="NOTRANSAKSI" value="<?php echo $NOTRANSAKSI; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">KODESPL <?php echo form_error('KODESPL') ?></label>
            <input type="text" class="form-control" name="KODESPL" id="KODESPL" placeholder="KODESPL" value="<?php echo $KODESPL; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">TGLBELI <?php echo form_error('TGLBELI') ?></label>
            <input type="text" class="form-control" name="TGLBELI" id="TGLBELI" placeholder="TGLBELI" value="<?php echo $TGLBELI; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">TOTALHUTANG <?php echo form_error('TOTALHUTANG') ?></label>
            <input type="text" class="form-control" name="TOTALHUTANG" id="TOTALHUTANG" placeholder="TOTALHUTANG" value="<?php echo $TOTALHUTANG; ?>" />
        </div>
	    <input type="hidden" name="ID" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_hutang') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>