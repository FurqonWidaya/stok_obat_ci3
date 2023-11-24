<?php

class Auth extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('session');
}
public function index() {
    if ($this->session->userdata('username')) {  // Jika sudah login, redirect ke halaman utama obat
        redirect('stokobat'); 
    }
   
    $content = $this->load->view('auth/login', '', TRUE); // memuat view login dan disimpan sebagai var content
    $title = 'LOGIN - SI Medicines';                //set judul halaman dan disimpan dalam var
    $this->load->view('layouts/master', ['content'=>$content,'title'=>$title]); //menampilkan login dengan menggabungkan atribut
}

public function login() {
    // Set aturan validasi untuk form login
    $this->form_validation->set_rules('username', 'Username', 'trim|required', 
    [ 'required'=> 'Kolom username silahkan diisi']);
    $this->form_validation->set_rules('password', 'Password', 'trim|required',
     [ 'required'=> 'Kolom password silahkan diisi']);

    if ($this->form_validation->run() == FALSE) {
        // Tampilkan halaman login jika validasi gagal
        $content = $this->load->view('auth/login', '', TRUE);
        $title = 'LOGIN - SI Medicines';
        $this->load->view('layouts/master', ['content'=>$content,'title'=>$title]);
    } else {
        // Proses login
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Ganti dengan metode validasi login yang sesuai, misalnya dari database
        $is_valid_login = $this->db->get_where('pengguna',['username'=>$username])->row_array();

        if ($is_valid_login) {
            // Set data user ke dalam session
            if($is_valid_login['is_active']==1 ){
                $user_data = [
                    'username' => $username,
                    'email' => $is_valid_login['email'],
                    'role_id' => $is_valid_login['role_id'],
                ];
                $this->session->set_userdata($user_data);
                // Redirect ke halaman setelah login berhasil (misalnya home)
                redirect('stokobat');
            }else{
                $this->session->set_flashdata('error', 'email belum diaktifkan');
                redirect('auth/login');
            }
        } else {
            // Tampilkan pesan error jika login gagal
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('auth/login');
        }
    }
}


public function register() {
    // Set aturan validasi untuk form registrasi
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required',
    [ 'required'=> 'Kolom Nama silahkan diisi']);
    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[pengguna.username]',
    [ 'required'=> 'Kolom username silahkan diisi','is_unique'=>'username sudah digunakan']);
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pengguna.email]',
    [ 'required'=> 'Kolom email silahkan diisi','is_unique'=>'email sudah digunakan','valid_email'=>'gunakan email yang valid']);
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]',
    [ 'required'=> 'Kolom password silahkan diisi', 'min_length'=>'minimal gunakan 6 digit karakter']);
    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, tampilkan halaman registrasi kembali dengan pesan error
        $content = $this->load->view('auth/register', '', TRUE);
        $title = 'Register - SI Medicines';
        $this->load->view('layouts/master', ['content'=>$content,'title'=>$title]);
    } else {
        // Jika validasi berhasil, tambahkan data pengguna ke database
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 2,  // Sesuaikan dengan role_id yang sesuai
            'is_active' => TRUE, // Sesuaikan dengan status aktivasi yang sesuai
        );

        $this->db->insert('pengguna', $data);

        // Set pesan registrasi berhasil
        $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');

        // Redirect ke halaman login
        redirect('auth/login');
    }
}

public function logout() { //untuk keluar halaman 
    //menghapus session userdata
    $this->session->unset_userdata('username'); 
    redirect('auth');
}
}