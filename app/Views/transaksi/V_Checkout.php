    <?= $this->extend('layouts/V_Template'); ?>
    <?= $this->section('content'); ?>

    <h2 class="text-center mb-4">CHECKOUT</h2>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <form action="/checkout/save" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_pembeli">Nama</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" placeholder="Karina Yoo" value="<?= old('nama_pembeli') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="youremail@example.com" value="<?= old('email') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="0821xxxxxxxx" value="<?= old('telepon') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Jl.XXXX XXXX" value="<?= old('alamat') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" placeholder="Seoul" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Gyeonggi" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="405XX" required>
                    </div>

                </div>
                <hr class="my-4">

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="kesadaran" required>
                    <label class="form-check-label" for="kesadaran">Dengan ini saya menyatakan mengisi data dengan benar.</label>
                </div>


                <hr class="my-4">

                <h4 class="mb-3">Metode Pembayaran</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="Mobile Banking" required checked>
                        <label class="form-check-label" for="Mobile Banking">Mobile Banking</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="Link Aja" required>
                        <label class="form-check-label" for="Link Aja">Link Aja</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="Dana" required>
                        <label class="form-check-label" for="Dana">Dana</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="Ovo" required>
                        <label class="form-check-label" for="Ovo">Ovo</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="metode_pembayaran" value="Gopay" required>
                        <label class="form-check-label" for="Gopay">Gopay</label>
                    </div>
                </div>
                <hr class="my-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Checkout</button>
            </form>
        </div>

        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Keranjang Belanja</span>
                <span class="badge bg-secondary rounded-pill"><?= count($cart) ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php foreach ($cart as $item) : ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?= $item['nama_barang'] ?></h6>
                            <small class="text-muted"><?= "Rp " . number_format($item['harga_barang'], 2, ',', '.'); ?> x <?= $item['jumlah_jual'] ?> Pcs
                            </small>
                        </div>
                        <span class="text-muted"><?= "Rp " . number_format($item['subtotal'], 2, ',', '.'); ?></span>
                    </li>
                <?php endforeach ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong><?= "Rp " . number_format(array_sum(array_column($cart, 'subtotal')), 2, ',', '.'); ?></strong>
                </li>
            </ul>
            <a href="/barang"><button type="submit" class="btn btn-warning">Ubah Keranjang</button></a>
        </div>
    </div>

    <?= $this->endsection(); ?>