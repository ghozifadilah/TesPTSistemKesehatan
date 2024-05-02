<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px"><?php echo $button ?> Barang </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="char">Kode Barang <?php echo form_error('KODEBRG') ?></label>
            <input type="text" class="form-control" name="KODEBRG" id="KODEBRG" placeholder="Kode barang" value="<?php echo $KODEBRG; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Nama Barang <?php echo form_error('NAMABRG') ?></label>
            <input type="text" class="form-control" name="NAMABRG" id="NAMABRG" placeholder="Nama Barang" value="<?php echo $NAMABRG; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">SATUAN <?php echo form_error('SATUAN') ?></label>
            <input type="text" class="form-control" name="SATUAN" id="SATUAN" placeholder="Satuan " value="<?php echo $SATUAN; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">HARGABELI <?php echo form_error('HARGABELI') ?></label>
            <input type="text" class="form-control" name="HARGABELI" id="HARGABELI" placeholder="harga Beli" value="<?php echo $HARGABELI; ?>" />
        </div>
	    <input type="hidden" name="ID" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_barang') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>