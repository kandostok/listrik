<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('TagihanModel','tag');
		$this->load->model('AdminModel','admin');
	}

	public function index()
	{
		$data['get_bayar'] = $this->tag->get_pembayaran();
		$this->load->view('admin/tagihan', $data);
	}

	public function verificated($id_pembayaran, $id_tagihan, $status)
	{
		$ver = $this->tag->get_verification($id_pembayaran, $id_tagihan, $status);
		if($ver){
			$this->session->set_flashdata('notif_sukses', 'Verifikasi Sukses');
		} else {
			$this->session->set_flashdata('notif', 'Verifikasi Gagal');
		}
		redirect('tagihan');
	}

}

/* End of file Tagihan.php */
/* Location: ./application/controllers/Tagihan.php */