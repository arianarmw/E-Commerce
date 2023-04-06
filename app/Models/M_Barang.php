<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama_barang', 'harga_barang', 'stok_barang', 'file_barang'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getBarang($id_barang = false)
    {
        if ($id_barang === false) {
            // return $this->findAll();

            //query untuk menampilkan data
            $query = $this->db->query("SELECT * FROM barang");
            return $query->getResult(); // return berupa aray objek

        } else {
            $query = $this->db->query("SELECT * FROM barang where id_barang = '$id_barang'");
            return $query->getResult(); //return berupa aray objek
        }
    }

    //store data barang
    public function barang_store($data)
    {
        return $this->insert($data);
    }
}
