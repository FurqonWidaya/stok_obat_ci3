<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_stokobat extends CI_Model {

    public function get_all_stok_obat() {
         $this->db->order_by('created_at', 'desc'); //mengurutkan data dari terbaru berdasarkan pembuatannya
        return $this->db->get('obat')->result_array(); //Mengembalikan data dari tabel 'obat' sebagai array
    }

    public function insert_stok_obat() {
        //mengambil data dari inputan user
        $data = array(
            'nama_obat' => $this->input->post('nama_obat'),
            'kategori_obat' => $this->input->post('kategori_obat'),
            'harga_obat' => $this->input->post('harga_obat'),
            'stok_obat' => $this->input->post('stok_obat')
        );

        $this->db->insert('obat', $data); //menambah data baru ke db obat
    }
    public function get_stok_obat_by_id() {
        $id = $this->input->get('id'); //untuk mengenali id yang dipilih untuk mendapatkan data per id
        $data = $this->db->get_where('obat', array('id' => $id))->row(); // Mendapatkan data berdasarkan ID dari tabel 'obat'
        return $data;
    }

    public function update_stok_obat() {
        $id=$this->input->post('id'); //memuat inputan berdasarkan id yang dipilih untuk diupdate
        $data = array(
            'nama_obat' => $this->input->post('nama_obat'),
            'kategori_obat' => $this->input->post('kategori_obat'),
            'harga_obat' => $this->input->post('harga_obat'),
            'stok_obat' => $this->input->post('stok_obat')
        );

        $this->db->where('id', $id); 
        return $this->db->update('obat', $data);// Memperbarui data di dalam tabel 'obat' berdasarkan ID
    }

    public function delete_stok_obat() {
        $this->db->delete('obat', array('id' => $this->input->post('id')));  // Menghapus data dari tabel 'obat' berdasarkan ID
        return $this->db->get('obat')->result_array(); // Mengembalikan data dari tabel 'obat' sebagai array
    }

}