<?= $this->extend('layouts/V_Template'); ?>
<?= $this->section('content'); ?>

<h1 class="text-center">KERANJANG</h1>
<br>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($cart as $item) : ?>
        <div class="card" style="width: 50rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                <form class="card-text mb-3" action="/keranjang/update" method="post">
                    <div class="input-group">
                        <input type="hidden" name="id_barang" value="<?= $item['id_barang'] ?>">
                        <input type="number" class="form-control" name="jumlah_jual" value="<?= $item['jumlah_jual'] ?>">
                        <button type="submit" class="btn btn-secondary">Update</button>
                    </div>
                </form>
                <h6 class="card-subtitle mb-2 text-muted"><?= "Rp " . number_format($item['subtotal'], 2, ',', '.'); ?></h6>
                <a class="hapus btn btn-danger mt-2" href="/keranjang/remove/<?= $item['id_barang'] ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
            </div>
        </div>
    <?php endforeach ?>

    <div class="card mt-4" style="width: 50rem;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <small class="text-muted">Subtotal: Rp <?= "Rp " . number_format(array_sum(array_column($cart, 'subtotal')), 2, ',', '.'); ?></small>
            <div>
                <?php if (session()->get('cart') != NULL) : ?>
                    <a href="/checkout"><button type="submit" class="btn btn-primary">Checkout</button></a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>