<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PelangganModel');
        $this->load->model('TagihanModel', 'tag');
	}

	public function index()
	{
		$data['pelanggan']	= $this->PelangganModel->get_pelanggan();
		$data['tarif'] = $this->PelangganModel->get_tarif();
		$this->load->view('admin/pelanggan', $data);	
	}

	public function tambah_pelanggan()
    {
        if ($this->input->post('tambah')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
            $this->form_validation->set_rules('nomorKWH', 'Nomor KWH', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('daya', 'Daya', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                if ($this->PelangganModel->save_pelanggan() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Tambah Pelanggan Sukses');
                    
                    redirect('pelanggan');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Tambah Pelanggan Gagal');
                    
                    redirect('pelanggan');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('pelanggan');
                
            }
        } else {
            $this->session->set_flashdata('notif', validation_errors());
                
            redirect('pelanggan');
        }
    }

    public function add_pelanggan()
    {
        if ($this->input->post('tambah')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
            $this->form_validation->set_rules('nomorKWH', 'Nomor KWH', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('daya', 'Daya', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                if ($this->PelangganModel->save_pelanggan() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Registrasi Pelanggan Sukses');
                    
                    redirect('pelanggan/login');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Registrasi Pelanggan Gagal');
                    
                    redirect('pelanggan/login');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('pelanggan/login');
                
            }
        } else {
            $this->session->set_flashdata('notif', validation_errors());
                
            redirect('pelanggan/login');
        }
    }

    public function delete_pelanggan($id_pelanggan)
    {
        if ($this->PelangganModel->del_pelanggan($id_pelanggan) == true) {
            $this->session->set_flashdata('notif_sukses', 'Hapus Pelanggan Sukses');
            
            redirect('pelanggan');
            
        } else {
            $this->session->set_flashdata('notif', 'Hapus Pelanggan Gagal!');
            
            redirect('pelanggan');
            
        }
    }

    public function update_pelanggan()
    {
        if ($this->input->post('edit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
            $this->form_validation->set_rules('nomorKWH', 'Nomor KWH', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('daya', 'Daya', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->PelangganModel->up_pelanggan() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Update Pelanggan Sukses');
                    redirect('pelanggan');
                } else {
                    $this->session->set_flashdata('notif', 'Update Pelanggan Gagal!');
                    redirect('pelanggan');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('pelanggan');
                
            }
        } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('pelanggan');
                
            }
    }

    public function get_id_pelanggan($id_pelanggan)
    {
        $data_pelanggan = $this->PelangganModel->get_pelanggan_id($id_pelanggan);

        echo json_encode($data_pelanggan);
    }

    public function login()
    {
        $data['tarif'] = $this->PelangganModel->get_tarif();
        $this->load->view('pelanggan/login_pel', $data);
    }

    public function do_login()
    {
        if ($this->input->post('login')) {
            $login = $this->PelangganModel->cek_pel();
            if($login->num_rows()>0){
                $dt = $login->row();
                $data = array(
                    'id_pelanggan'      => $dt->id_pelanggan,
                    'nama_pelanggan'    => $dt->nama_pelanggan,
                    'username'          => $dt->username,
                    'password'          => $dt->password,
                    'logged_in'         => true,
                    'id_tarif'          => $dt->id_tarif
                );
                $this->session->set_userdata($data);
                redirect('pelanggan/toPelanggan');
            } else {
                $this->session->set_flashdata('notif', 'Username atau Password Salah');
                redirect('pelanggan/login');
            }
        } else{
            $this->session->set_flashdata('notif_gagal', validation_errors());
                redirect('pelanggan/login');
        }
    }

    public function toPelanggan()
    {
        $this->load->view('pelanggan/dashboard_pelanggan');
    }

    public function logout()
    {
        $data = array(
            'id_admin'    => "",
            'username'    => "",
            'logged_in'   => false
        );
        
        $this->session->unset_userdata('$data');
        $this->session->sess_destroy();
        redirect('pelanggan/login');
    }

    public function up_bukti()
    {
        $data['up'] = $this->tag->daftar_tagihan();

        $this->load->view('pelanggan/upload', $data);
    }

    public function aksi_upload()
    {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']  = '10000';
            $config['max_width']  = '102400';
            $config['max_height']  = '76800';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('bukti')){
                $this->session->set_flashdata('notif', $this->upload->display_errors());
                redirect('pelanggan/up_bukti');
            }
            else{
                $update = $this->tag->bayar();
                if($update){
                    $this->session->set_flashdata('notif_sukses', 'Upload Bukti Sukses');
                    redirect('pelanggan/up_bukti');
                } else {
                    $this->session->set_flashdata('notif', 'Update Pelanggan Gagal');
                    redirect('pelanggan/up_bukti');
                }
                redirect('pelanggan/up_bukti');
            }      
    }

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */