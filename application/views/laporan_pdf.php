<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>
    <body>
        <div style="text-align:center">
            <h3> Laporan Pembelian</h3>
        </div>
        <table id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                <?php foreach ($ctk as $valu) : ?>
                <tr>
                    <td scope="row"><?php echo $no++ ?></td>
                    <td><?php echo $valu->nama_brg ?></td>
                    <td><?php echo $valu->jumlah ?></td>
                    <td><?php echo "Rp " . number_format($valu->harga,0,',','.'); ?></td>
                    <td><?php echo $valu->tgl_bayar ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>