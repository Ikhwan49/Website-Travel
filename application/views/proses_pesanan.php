<div class="container-fluid">
	
	<div class="alert alert-success">
		<p class="text-center align-middle">Selamat, Pesanan Anda telah Berhasil diproses!!!</p>
	</div>

	<form method="post">
		<input type="hidden" name="cetakpsn" value="<?php echo $pesanan ?>">
		<button type="submit">Cetak Pesanan</button>
	</form>

</div>