<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokObat extends CI_Controller {

    public function __construct() { //fungsi yang dijalan pertama dan untuk digunakan pada fungsi lain
        parent::__construct();
        $this->load->model('m_stokobat'); //memanggil model stok obat
        $this->load->library('form_validation');//memanggil library dari ci untuk validasi
        $this->load->library('session');//memanggil library dari ci untuk session data
        //memanggil modal.php yang terpisah 
		$this->inc['modal'] = $this->load->view('modal', '', true);
    }
    
    public function index() {
         // memeriksa apakah pengguna tidak masuk sebagai pengguna, jika tidak diarhkan ke route auth
        if(!$this->session->userdata('username')){
            redirect('auth');
        }
        $content = $this->load->view('stokobat', $this->inc, true); //set untuk memanggil view stokobat, dan menginclude page modal yang terpisah
        $title = 'Dashboard - SI Medicines'; //set judul web
        $this->load->view('layouts/master', ['content'=>$content,'title'=>$title]);// untuk view menampilkan ke web
    }

    public function get_stok_obat() { 
        // mengambil seluruh data obat dengan model
        $data = $this->m_stokobat->get_all_stok_obat();
        echo json_encode($data); // Mengembalikan data sebagai respons JSON
    }

    public function create_stok_obat() {  
         // cek validasi inputan dari permintaan AJAX apakah sudah benar?
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'trim|required');
            $this->form_validation->set_rules('kategori_obat', 'Kategori Obat', 'trim|required');
            $this->form_validation->set_rules('harga_obat', 'Harga Obat', 'trim|required|numeric');
            $this->form_validation->set_rules('stok_obat', 'Stok Obat', 'trim|required|numeric');

            // cek jika Validasi formulir sudah benar?
            if ($this->form_validation->run() === TRUE) {
                $this->m_stokobat->insert_stok_obat(); // Masukkan data record baru dengan menggunakan model
                echo json_encode(array('status' => 'success', 'message' => 'Data baru obat berhasil dibuat.')); //untuk digunakan pada fungsi ajax di view
            } else {
                echo json_encode(array('status' => 'error', 'message' => validation_errors())); //untuk digunakan pada fungsi ajax di view
            }
        } else {
            $this->load->view('stokobat'); //output jika validasi salah
        }
    }
    
    public function get_stok_obat_by_id() {
        $data = $this->m_stokobat->get_stok_obat_by_id(); // Mendapatkan stok obat berdasarkan ID dari model
        error_log('Data retrieved: ' . json_encode($data)); //untuk mengecek error log ketika data diambil
        echo json_encode($data); // Mengembalikan data sebagai respons JSON
    }
    
    public function update_stok_obat()
    {
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'trim|required');
        $this->form_validation->set_rules('kategori_obat', 'Kategori Obat', 'trim|required');
        $this->form_validation->set_rules('harga_obat', 'Harga Obat', 'trim|required|numeric');
        $this->form_validation->set_rules('stok_obat', 'Stok Obat', 'trim|required|numeric');
       
        if ($this->form_validation->run() === TRUE) {
            $this->m_stokobat->update_stok_obat(); // Memperbarui rekaman stok obat dengan menggunakan fungsi dari model
            echo json_encode(array('status' => 'success', 'message' => 'Record updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }

    public function delete_stok_obat() {         
        $this->m_stokobat->delete_stok_obat(); // Menghapus rekaman stok obat dengan menggunakan fungsi dari model
        echo json_encode(array('status' => 'success', 'message' => 'Record deleted successfully.'));
    }

}