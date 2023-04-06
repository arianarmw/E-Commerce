<?php

namespace App\Controllers;

use App\Models\M_Barang;
use App\Models\M_Jual;
use App\Controllers\BaseController;
use App\Models\M_TransaksiPenjualan;

class c_transaksi extends BaseController
{
    public function display()
    {
        $model = new M_Barang();
        $data['title'] = 'Checkout';

        //  GET SESSION CART
        $data['cart'] = session()->get('cart');

        // JIKA DATA ARRAY CART MASIH NULL / KOSONG ATAU TIDAK TERDETEKSI, MAKA DATA CART DI SET ARAY KOSONG
        if ($data['cart'] == NULL) {
            $data['cart'] = [];
        }
        echo view('transaksi/V_Checkout', $data);
    }

    public function save()
    {
        // DEKLARASI MODEL
        $BarangModel = new M_Barang();
        $TransaksiModel = new M_TransaksiPenjualan();
        $JualModel = new M_Jual();

        //  GET SESSION CART
        $cart_session = session()->get('cart');

        // DEKLARASI TOTAL PEMBAYARAN
        $total_pembayaran = 0;

        // PROSES MENGHITUNG TOTAL PEMBAYARAN
        foreach ($cart_session as $cs) {
            $total_pembayaran += $cs['subtotal'];
        }

        // PROSES INSERT DATA KE TABEL TRANSAKSI PENJUALAN
        $data_transaksi = array(
            'status_pembayaran' => 1,
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'total_pembayaran' => $total_pembayaran,
            'nama_pembeli' => $this->request->getPost('nama_pembeli'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kode_pos' => $this->request->getPost('kode_pos')
        );

        $TransaksiModel->insert($data_transaksi);

        // UNTUK MENDAPATKAN ID TRANSAKSI TERAKHIR
        $lastInsertId = $TransaksiModel->insertID();

        // PROSES INSERT DATA DETAIL TRANSAKSI KE TBL DETAIL TRANSAKSI
        foreach ($cart_session as $css) {
            $data_jual = array(
                'no_transaksi' => $lastInsertId,
                'id_barang' => $css['id_barang'],
                'harga_jual' => $css['harga_barang'],
                'jumlah_jual' => $css['jumlah_jual'],
                'subtotal' => $css['subtotal']
            );

            $JualModel->insert($data_jual);

            // PROSES MENGURANGI STOK
            $product = $BarangModel->find($css['id_barang']);
            $data_barang = [
                'stok_barang' => $product['stok_barang'] - $css['jumlah_jual']
            ];

            $BarangModel->update($css['id_barang'], $data_barang);
        }

        // MELAKUKAN HAPUS DATA CART
        session()->destroy();

        echo '<script>
                    alert("Selamat! Berhasil Melakukan Transaksi");
                    window.location="' . base_url('/barang') . '"
                </script>';
    }
}
