<?php $this->load->view('layout/header');?>
<h3 style="margin-top:0px"> <i class="fa fa-home"></i> Dashboard</h3>
         
		 <hr>

		 <div class="row">
			<div class="col-md-12">
			   <h5>Transaksi</h5>
			   <a class="btn btn-success" onclick="transaksiBarangBaru() " >  Barang Baru <i class="fa fa-plus"></i> </a>
			   <a class="btn btn-primary" onclick="transaksiBaru() " > Tambah Stock <i class="fa fa-plus"></i> </a>
			   <hr>
			   <?php  ?>
			   Transaksi Terakhir
			   <input type="hidden" name="lastIDtransaksi" id="lastIDtransaksi" value="<?= @$lastIDTransaksi->NOTRANSAKSI ?>">
			  
				<table class="table table-bordered " style="margin-bottom: 10px">
					<tr>
			<th>No</th>
			<th>Kode Transaksi</th>
			<th>Kode Barang</th>
			<th>Kode Suplier</th>
			<th>Total RP</th>
			<th>Tanggal</th>
			<th>Aksi</th>
            </tr><?php $no = 1;
            foreach ($listTransaksi as $listTransaksiRow)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $no++; ?></td>
			<td ><?php echo $listTransaksiRow->NOTRANSAKSI ?></td>
			<td ><?php echo $listTransaksiRow->KODEBRG ?></td>
			<td ><?php echo $listTransaksiRow->KODESPL ?></td>
			<td >Rp.<?php echo $listTransaksiRow->TOTALRP ?></td>
			<td ><?php echo $listTransaksiRow->TGLBELI ?></td>
			
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tbl_dbeli/read/'.$listTransaksiRow->ID),'Detail'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
			</div>
		 </div>
	

		<hr>
		<div class="row">
			
		<div class="col-md-6">
			Daftar  Barang dan Stock
			<table class="table table-bordered" style="margin-bottom: 10px">
				<tr>
					<th>No</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Stock</th>
		
					</tr>
					<?php $startBarang = 1;
						foreach ($daftarBarang as $tbl_barang)
						{
							?>
							<tr>
						<td width="80px"><?php echo $startBarang++; ?></td>
						<td><?php echo $tbl_barang->KODEBRG ?></td>
						<td><?php echo $tbl_barang->NAMABRG ?></td>
						<td><?php echo $tbl_barang->QTYBELI ?></td>
					</tr>
					<?php
				}
				?>
			</table>

		</div>
		<div class="col-md-6">
			Suplier
			<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
         <th>No</th>
		<th>Kode Supplier</th>
		<th>Nama Supplier</th>
		<th>Total Hutang</th>
            </tr><?php $no = 1;
            foreach ($suplier as $tbl_suplier)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $no++ ?></td>
			<td><?php echo $tbl_suplier->KODESPL ?></td>
			<td><?php echo $tbl_suplier->NAMASPL ?></td>
			<td><?php echo $tbl_suplier->TOTALHUTANG ?></td>
			
		</tr>
                <?php
            }
            ?>
        </table>

		</div>

	</div>		 


	<!-- Modal -->

	
			<!-- Modal Transaksi-->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-xl">
				<div class="modal-content">
				<div class="modal-header">
					<h5>Transaksi : Tambah Stok</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					
				<div class="container-fluid mb-5">

				<div class="row">
					<div class="col-md-12">
					<div class="form-group">
							<label for="char">Cari Kode Barang / Nama Barang </label>
							<input oninput="searchBarang()"  type="text" class="form-control" name="cariBarang" id="cariBarang" placeholder="Cari Barang"  />
						</div>
					</div>
				</div>

				<hr>

					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">

								<div class="form-group">
									<label for="char">Kode Barang </label>
									 <h5 id="KodeBarang" > - </h5>
								</div>
								<div class="form-group">
									<label for="char">Nama Barang </label>
									 <h5 id="namaBarang"> - </h5>
								</div>
							
								<div class="form-group">
									<label for="char">Stock </label>
									 <h5 id="stock"> - </h5>
								</div>

								<div class="form-group">
									<label for="char">Barang Satuan </label>
									 <h5 id="satuan"> - </h5>
								</div>
								<div class="form-group">
									<label for="char">Harga </label>
									 <h5 id="harga"> - </h5>
									 <input type="hidden" name="HARGA" id="hargaBarang" value="0" />
								</div>

								</div>
							</div>
						

						</div>	
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">

								<div class="form-group">
									<label for="char">Quantity </label>
									<input  type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity Barang" oninput="totalHarga('stok')"  />
								</div>

								<div class="form-group">
									<label for="char">Diskon </label>
									<input type="number" class="form-control" name="diskon" id="diskon" placeholder="Diskon Barang" oninput="totalHarga('stok')" />
								</div>
							
								
								<hr>
								<div class="form-group">
									<label for="char">Harga Beli </label>
									<input type="number" class="form-control" name="pembayaran" id="pembayaran" placeholder="Rp.0"  />
								</div>
								</div>

							</div>

							<div class="mt-3 text-center">
								
								<span>Total Harga</span>
								<h2 id="finalHarga"> Rp.0</h2>
							<hr>
								<a type="button" onclick="ajaxAddStock()" class="btn btn-success">Simpan Transaksi</a>
								<a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan Transaksi</a>
							</div>

						</div>	
				
				</div>
			</div>
				<div class="modal-footer">
				</div>
				</div>
			</div>
		</div>
			</div>
			<!-- Modal Transaksi-->
		<div class="modal fade" id="newTransaksiBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-xl">
				<div class="modal-content">
				<div class="modal-header">
					<h5>Transaksi : Tambah Barang Baru</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					
				<div class="container-fluid mb-5">

		

				<hr>

					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">

								<div class="form-group">
									<label for="char">Kode Barang </label>
									<input   type="text" class="form-control" name="inputKodeBarang" id="inputKodeBarang" placeholder=" Kode Barang ... "  />
								</div>
								<div class="form-group">
									<label for="char">Nama Barang </label>
									<input   type="text" class="form-control" name="inputNamaBarang" id="inputNamaBarang" placeholder="Nama  Barang ... "  />
								</div>
						
								<div class="form-group">
									<label for="char">Satuan Barang </label>
									<input   type="number" class="form-control" name="inputSatuanBarang" id="inputSatuanBarang" placeholder="Satuan Barang ... "  />
								</div>
						
								<div class="form-group">
									<label for="char">Harga Beli</label>
									<input   type="number" class="form-control" name="inputHargaBeli" id="inputHargaBeli" input="inputHargaBeli" placeholder="Harga Beli ... "  />
								</div>

								<!-- supplier yang sudah ada -->
								<!-- select option data -->
								<div class="form-group">
									<label for="char">Supplier </label>
									<select class="form-select" name="inputSupplier" id="inputSupplierOPT">
										<option value="0">Pilih Supplier</option>
										<?php
											foreach ($suplier as $tbl_supplier)
											{
												?>
													<option value="<?php echo $tbl_supplier->KODESPL ?>">
														<?php echo $tbl_supplier->NAMASPL ?>
													</option>
												<?php
											}
										?>
									</select>
								</div>

								<!-- Checkbox supplier baru -->
								<div class="form-group">
									<div class="form-check">
										<input onclick="isNewSuplier()" class="form-check-input" type="checkbox" value="1" name="inputSupplierBaru" id="inputSupplierBaru">
										<label class="form-check-label" for="inputSupplierBaru">
											Supplier Baru ?
										</label>

											<div id="divSupplierBaru" class="hidden">
																<!-- jka ada supllier Baru -->
												<div class="form-group">
													<label for="char">Kode Supplier </label>
													<input   type="text" class="form-control" name="kodeSupplier" id="inputKodeSupplier" placeholder="Kode Supplier ... "  />
												</div>

												<div class="form-group">
													<label for="char">Nama Supplier </label>
													<input   type="text" class="form-control" name="inputSupplier" id="inputnamaSupplier" placeholder=" nama Supplier ... "  />
												</div>

											</div>

									</div>
								</div>


							

								</div>
							</div>
						

						</div>	

						<div class="col-md-6">
							<div class="card">
								<div class="card-body">

								

								<div class="form-group">
									<label for="char">Quantity </label>
									<input oninput="totalHarga('tambah')"  type="number" class="form-control" name="quantity" id="inputQuantity" placeholder="Quantity Barang"  />
								</div>

								<div class="form-group">
									<label for="char">Diskon </label>
									<input oninput="totalHarga('tambah')"  type="number" class="form-control" name="diskon" id="inputDiskon" placeholder="Diskon Barang"  />
								</div>

								<hr>
								<div class="form-group">
									<label for="char">Harga Beli </label>
									<input oninput="totalHarga('tambah')" type="number" class="form-control" name="pembayaran" id="inputPembayaran" placeholder="Rp.0"  />
								</div>
								</div>

							</div>

							<div class="mt-3 text-center">
								
								<span>Total Harga</span>
								<h2 id="finalHargaAdd"> Rp.0</h2>
							<hr>
								<a type="button" onclick="konfrimasi()" class="btn btn-success">Lanjutkan</a>
								<a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan Transaksi</a>
							</div>

						</div>	
				
				</div>
			</div>
				<div class="modal-footer">
				</div>
				</div>
			</div>
		</div>

			</div>

			<div class="modal fade" id="konfrimModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Transaksi</p>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card">
						<div class="card-body" id="konfrimasiText">
							This is some text within a card body.
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button   onclick="addNewBarang()" type="button" class="btn btn-success">Simpan Transaksi</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan Transaksi</button>
				</div>
				</div>
			</div>
			</div>




<?php $this->load->view('layout/footer');?>


<script>

var isHutang = false;
var hutang = 0;

function transaksiBaru() {

	$("#exampleModal").modal('show');
	
}
function transaksiBarangBaru() {

	$("#newTransaksiBarang").modal('show');
	
}
var dumpSearch = '';
function searchBarang() {


	var cariBarang = $('#cariBarang').val();

	$.ajax({
        url: '<?=site_url('Tbl_Barang/ajax_searchBarang')?>',
        type: 'GET',
        dataType: 'json',
        data: {
          search: cariBarang,
		},

    }).done(function(data) {

		console.log(data.getBarang[0]);
		dumpSearch = data;

		$('#KodeBarang').text(data.getBarang[0].barang_kode);
		$('#namaBarang').text(data.getBarang[0].barang_nama);
		$('#harga').text(data.getBarang[0].barang_harga);
		$('#satuan').text(data.getBarang[0].barang_satuan);
		$('#stock').text(data.getBarang[0].barang_qty);
		$('#hargaBarang').val(data.getBarang[0].barang_harga);
	

	});
	
}

let newSuplier = false;
function isNewSuplier() {

	if (newSuplier == false) {
		
		$('#divSupplierBaru').removeClass('hidden');
		newSuplier = true;
	}else{
		$('#divSupplierBaru').addClass('hidden');
		newSuplier = false;
	}

}

function addNewBarang() {


var inputKodeBarang = $('#inputKodeBarang').val();
var inputNamaBarang = $('#inputNamaBarang').val();
var inputSatuanBarang = $('#inputSatuanBarang').val();
var inputHargaBeli = parseFloat($('#inputHargaBeli').val());
var inputKodeSupplier = $('#inputKodeSupplier').val();
var inputnamaSupplier = $('#inputnamaSupplier').val();
var inputQuantity = parseFloat($('#inputQuantity').val());
var inputDiskon = parseFloat($('#inputDiskon').val());
var inputPembayaran = $('#inputPembayaran').val();

if (!newSuplier) {
	inputKodeSupplier = $('#inputSupplierOPT').find(":selected").val();;
}


// perhitungan transaksi
var lastIDTransaksi = $('#lastIDtransaksi').val();


		var totalRp = inputQuantity * inputHargaBeli;
		var totalDiskon;

		if (inputDiskon === 0 || isNaN(inputDiskon)) {
			totalDiskon = totalRp;
		} else {
			totalDiskon = (totalRp * inputDiskon) / 100;
			totalDiskon = totalRp - totalDiskon;
		}


	// jika berhutang
	if (inputPembayaran < totalRp) {
		hutang = Number(totalRp) - Number(inputPembayaran);
		isHutang = true;
	}else{
		hutang = 0;
	}

	$.ajax({
        url: '<?=site_url('Tbl_hbeli/ajax_addNewBarang')?>',
        type: 'POST',
        dataType: 'json',
        data: {
          inputKodeBarang: inputKodeBarang,
		  inputNamaBarang: inputNamaBarang,
		  inputSatuanBarang: inputSatuanBarang,
		  inputHargaBeli: inputHargaBeli,

		  inputKodeSupplier: inputKodeSupplier,
		  inputnamaSupplier: inputnamaSupplier,
		  isNewSuplier: newSuplier,
		 
		  lastIDTransaksi: lastIDTransaksi,
		  totalDiskon: totalDiskon,
		  totalRp: totalRp,
		  inputQuantity: inputQuantity,
		  inputDiskon: inputDiskon,
		  inputPembayaran: inputPembayaran,
		  hutang: hutang,

		},

    }).done(function(data) {

		// reload window
		window.location.reload();

	});
	
}
function ajaxAddStock() {

// ubah stock
// ubah hutang

var addStockQuantity = $('#quantity').val();
var addStockDiskon = $('#diskon').val();
var inputHargaBeli = $('#pembayaran').val();


var totalRp = Number(addStockQuantity) * Number(inputHargaBeli);
var totalDiskon = Number(totalRp) * Number(addStockDiskon) / 100;

if (addStockDiskon == 0 || addStockDiskon == '') {
	totalRp = Number(addStockQuantity) * Number(inputHargaBeli);
}


$.ajax({

	url: '<?=site_url('Tbl_dbeli/ajax_addStockBarang')?>',
	type: 'POST',
	dataType: 'json',
	data: {
		stock : addStockQuantity,
		diskon : addStockDiskon,
		pembayaran : inputHargaBeli,
		totalRp : totalRp,
		totalDiskon : totalDiskon,
		LastTransaksi : dumpSearch
	},
	success: function(data) { // corrected .done to success
		// reload window
		window.location.reload();
	},
	error: function(xhr, status, error) { // handle errors if any
		console.error(xhr.responseText);
	}
});

}


function totalHarga(mode) {

	if (mode == 'tambah') {
		
			var inputQuantity = parseFloat($('#inputQuantity').val());
			var inputDiskon = parseFloat($('#inputDiskon').val());
			var inputHargaBeli = parseFloat($('#inputHargaBeli').val());
			
			
		}else{
			
			var inputQuantity = parseFloat($('#quantity').val());
			var inputDiskon = parseFloat($('#diskon').val());
			var inputHargaBeli = parseFloat($('#hargaBarang').val());

			
		}
		
			var totalRp = inputQuantity * inputHargaBeli;
			var totalDiskon;
			
			if (inputDiskon === 0 || isNaN(inputDiskon)) {
				totalDiskon = totalRp;
			} else {
				totalDiskon = (totalRp * inputDiskon) / 100;
				totalDiskon = totalRp - totalDiskon;
			}


			if (mode == 'tambah') {
				$('#finalHargaAdd').text(totalDiskon);
			}else{
				$('#finalHarga').text(totalDiskon);
			}
			


}


function konfrimasi(mode) {

	var inputKodeBarang = $('#inputKodeBarang').val();
	var inputNamaBarang = $('#inputNamaBarang').val();
	var inputSatuanBarang = $('#inputSatuanBarang').val();
	var inputKodeSupplier = $('#inputKodeSupplier').val();
	var inputnamaSupplier = $('#inputnamaSupplier').val();
	var inputHargaBeli = parseFloat($('#inputHargaBeli').val());
	var inputQuantity = parseFloat($('#inputQuantity').val());
	var inputDiskon = parseFloat($('#inputDiskon').val());
	var inputPembayaran = $('#inputPembayaran').val();

	if (!newSuplier) {
		inputKodeSupplier = $('#inputSupplierOPT').find(":selected").val();;
	}

	
	    var totalRp = inputQuantity * inputHargaBeli;
		var totalDiskon;

		if (inputDiskon === 0 || isNaN(inputDiskon)) {
			totalDiskon = totalRp;
		} else {
			totalDiskon = (totalRp * inputDiskon) / 100;
			totalDiskon = totalRp - totalDiskon;
		}

	var html =` 
		<p>
			<strong>Kode Barang</strong> : ${inputKodeBarang} <br>
			<strong>Kode Supplier</strong> : ${inputKodeSupplier}  <br>
			<strong>Quantity</strong> : ${inputQuantity}  <br>
			<strong>Harga Beli</strong> : ${inputHargaBeli}  <br>
			<strong>Diskon</strong> : ${inputDiskon}  <br>
			<strong>Pembayaran</strong> : ${inputPembayaran}  <br>
			<strong>Total Diskon</strong> : ${totalDiskon}  <br>
			<hr>
		    <strong>Total Harga</strong> : ${totalRp} <br>
			<strong>Total Bayar</strong> : ${inputPembayaran}
		</P>`
	 ;

	 $('#konfrimasiText').html(html);
	  

	$('#konfrimModal').modal('show')
}

</script>

