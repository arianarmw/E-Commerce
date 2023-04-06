<?php

namespace App\Controllers;

use App\Models\M_Barang;
use App\Controllers\BaseController;

class C_Keranjang extends BaseController
{

    public function display()
    {
        $cart = session()->get('cart');
        $model = new M_Barang();
        $data['cart'] = session()->get('cart');

        // JIKA DATA ARRAY CART MASIH NULL / KOSONG ATAU TIDAK TERDETEKSI, MAKA DATA CART DI SET ARAY KOSONG
        if ($data['cart'] == NULL) {
            $data['cart'] = [];
        }
        return view('barang/V_Keranjang', $data);
    }

    public function add($id_barang, $jumlah_jual)
    {
        // MENAMBAHKAN ITEM KE CART
        $model = new M_Barang();
        $product = $model->find($id_barang);

        if (!$product) {
            throw new \Exception('Barang tidak ditemukan.');
        }

        // BAGIAN SESSION
        $cart = session()->get('cart');

        // JIKA SEBELUMNYA PRODUK SUDAH DIPESAN, MAKA HANYA DITAMBAH $jumlah_jual DAN UPDATE JUMLAH SUBTOTALNYA
        if (isset($cart[$id_barang])) {
            $new_qty = $cart[$id_barang]['jumlah_jual'] + $jumlah_jual;
            if ($product['stok_barang'] < $new_qty) {
                return redirect()->back()->with('error', 'Error! Stok Kurang');
            }

            $cart[$id_barang]['jumlah_jual'] = $new_qty;
            $cart[$id_barang]['subtotal'] = $new_qty * $product['harga_barang'];
        } else {
            // JIKA SEBELUMNYA PRODUK BELUM DIPESAN, MAKA AKAN DITAMBAH KE CART SEBAGAI PRODUK BARU
            if ($product['stok_barang'] < $jumlah_jual) {
                return redirect()->back()->with('error', 'Error! Stok Kurang');
            }

            $cart[$id_barang] = [
                'id_barang' => $product['id_barang'],
                'nama_barang' => $product['nama_barang'],
                'file_barang' => $product['file_barang'],
                'harga_barang' => $product['harga_barang'],
                'jumlah_jual' => $jumlah_jual,
                'subtotal' => $jumlah_jual * $product['harga_barang']
            ];
        }
        session()->set('cart', $cart);

        return redirect()->to('/keranjang');
    }


    public function update()
    {
        $id_barang = $this->request->getPost('id_barang');
        $jumlah_jual = $this->request->getPost('jumlah_jual');

        $model = new M_Barang();
        $product = $model->find($id_barang);

        if ($product['stok_barang'] < $jumlah_jual) {
            echo '<script>
                    alert("Error! Stok Kurang");
                    window.location="' . base_url('/barang') . '"
                </script>';
        } else {
            // MENGUPDATE JUMLAH ITEM DI CART

            // BAGIAN SESSION
            $cart = session()->get('cart');

            // UPDATE BAGIAN QTY CART SESUAI INPUTAN
            $cart[$id_barang]['jumlah_jual'] = $jumlah_jual;


            // UPDATE BAGIAN SUBTOTAL CART BERDASARKAN PERHITUNGAN ANTARA QTY TERBARU DENGAN HARGA BARANG DI DATABASE (KARENA SIFATNYA MASIH CART MAKA HARGA BARANG MASIH MENGAMBIL DI DATABASE.)
            $cart[$id_barang]['subtotal'] = $jumlah_jual * $product['harga_barang'];


            // SET SESSION SEMACAM SAVE DATA
            session()->set('cart', $cart);

            // REDIRECT LAGI KE Keranjang
            return redirect()->to('/keranjang');
        }
    }


    public function remove($id_barang)
    {
        // MENGHAPUS ITEM DARI CART
        $cart = session()->get('cart');

        if (isset($cart[$id_barang])) {
            unset($cart[$id_barang]);
            session()->set('cart', $cart);
        }

        return redirect()->to('/keranjang');
    }

    public function clear()
    {
        // MENGHAPUS SEMUA ITEM DARI CART
        session()->remove('cart');

        return redirect()->to('/keranjang');
    }
}
