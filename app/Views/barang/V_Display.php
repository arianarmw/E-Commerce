<?= $this->extend('layouts/V_Template'); ?>
<?= $this->section('content'); ?>

<h1 class="text-center">CHRISTIAN ROID</h1>
<br>

<div class="container-fluid mx-5">
    <div class="row">
        <?php
        $nomor = 1;
        foreach ($getBarang as $row) :
        ?>
            <div class="card mx-2" style="width: 22rem;">
                <img class="card-img-top" src="<?= $row->file_barang; ?>">
                <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <h3><?= $row->nama_barang; ?></h3>
                    <p4><?= "Rp " . number_format($row->harga_barang, 2, ',', '.'); ?></p4>
                    <p5>Stok : <?= $row->stok_barang; ?> pcs</p5>
                    <a href="/keranjang/add/<?= $row->id_barang; ?>/1" style="align-self: flex-end;"><button type="button" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Add to Cart</button></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endsection(); ?>