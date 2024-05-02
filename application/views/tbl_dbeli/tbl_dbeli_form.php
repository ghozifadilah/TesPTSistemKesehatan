<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Tbl_dbeli <?php echo $button ?></h2>
    
    <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="char">NOTRANSAKSI <?php echo form_error('NOTRANSAKSI') ?></label>
            <input type="text" class="form-control" name="NOTRANSAKSI" id="NOTRANSAKSI" placeholder="NOTRANSAKSI" value="<?php echo $NOTRANSAKSI; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">KODEBRG <?php echo form_error('KODEBRG') ?></label>
            <input type="text" class="form-control" name="KODEBRG" id="KODEBRG" placeholder="KODEBRG" value="<?php echo $KODEBRG; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">HARGABELI <?php echo form_error('HARGABELI') ?></label>
            <input type="text" class="form-control" name="HARGABELI" id="HARGABELI" placeholder="HARGABELI" value="<?php echo $HARGABELI; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">QTY <?php echo form_error('QTY') ?></label>
            <input type="text" class="form-control" name="QTY" id="QTY" placeholder="QTY" value="<?php echo $QTY; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">DISKON <?php echo form_error('DISKON') ?></label>
            <input type="text" class="form-control" name="DISKON" id="DISKON" placeholder="DISKON" value="<?php echo $DISKON; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">DISKONRP <?php echo form_error('DISKONRP') ?></label>
            <input type="text" class="form-control" name="DISKONRP" id="DISKONRP" placeholder="DISKONRP" value="<?php echo $DISKONRP; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">TOTALRP <?php echo form_error('TOTALRP') ?></label>
            <input type="text" class="form-control" name="TOTALRP" id="TOTALRP" placeholder="TOTALRP" value="<?php echo $TOTALRP; ?>" />
        </div>
	    <input type="hidden" name="ID" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_dbeli') ?>" class="btn btn-default">Cancel</a>
	</form>
    
<?php $this->load->view('layout/footer');?>