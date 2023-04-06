<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Barang;

class C_Barang extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new M_Barang();
    }

    public function display()
    {
        $model = new M_Barang();
        $data['title'] = 'Data Barang';
        $data['getBarang'] = $model->getBarang();

        return view('barang/V_Display', $data);
    }


    public function barang_create()
    {
        $data = [
            'title' => 'Barang'
        ];
        return view('/barang/v_tambah_barang', $data);
    }

    public function barang_store()
    {
        if (!$this->validate([
            'nama_barang' => [
                'label' => 'nama_barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'stok_barang' => [
                'label' => 'stok_barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'harga_barang' => [
                'label' => 'harga_barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'file_barang' => [
                'label' => 'file_barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ])) {
            return view('barang/v_tambah_barang', [
                'errors' => $this->validator->getErrors(),
                'title' => 'Store Barang Error !'
            ]);
        }

        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'stok_barang' => $this->request->getPost('stok_barang'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'file_barang' => $this->request->getPost('file_barang')
        ];

        $this->model->barang_store($data);
        return redirect()->to('/barang');
    }
}
