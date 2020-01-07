<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggunaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PenggunaanModel');
	}

	public function index()
	{
		$data['pel'] = $this->PenggunaanModel->get_pelanggan();
		$data['peng'] = $this->PenggunaanModel->get_penggunaan();
		$this->load->view('admin/penggunaan', $data);
	}

	public function add_peng($id_pelanggan)
	{
		$data['peng'] = $this->PenggunaanModel->detail_pelanggan($id_pelanggan);
		$this->load->view('admin/tambah_peng', $data);
	}

	public function detail_peng($id_pelanggan='')
	{
		$data['pel'] = $this->PenggunaanModel->detail_pelanggan($id_pelanggan);
		$data['pengap'] = $this->PenggunaanModel->detail_penggunaan($id_pelanggan);
		$this->load->view('admin/detail_peng', $data);
	}

	public function detail_tag($id_pelanggan='')
	{
		$data['tag'] = $this->PenggunaanModel->detail_tagihan($id_pelanggan);
		$data['pel'] = $this->PenggunaanModel->detail_pelanggan($id_pelanggan);
		$this->load->view('admin/detail_tag', $data);
	}

	public function tambah_peng()
	{
		if ($this->input->post('tambah')) {
            $this->form_validation->set_rules('id_pelanggan', 'Id Pelanggan');
            $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
            $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
            $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'trim|required');
            $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                if ($this->PenggunaanModel->save() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Tambah Penggunaan Sukses');
                    
                    redirect('penggunaan');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Tambah Penggunaan Gagal');
                    
                    redirect('penggunaan');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('penggunaan');
                
            }
        } else {
            $this->session->set_flashdata('notif', validation_errors());
                
            redirect('penggunaan');
        }
	}

	public function delete_penggunaan($id_penggunaan)
    {
        if ($this->PenggunaanModel->del_peng($id_penggunaan) == true) {
            $this->session->set_flashdata('notif_sukses', 'Hapus Penggunaan Sukses');
            
            redirect('Penggunaan');
            
        } else {
            $this->session->set_flashdata('notif', 'Hapus Penggunaan Gagal!');
            
            redirect('Penggunaan');
            
        }
    }

}

/* End of file Penggunaan.php */
/* Location: ./application/controllers/Penggunaan.php */