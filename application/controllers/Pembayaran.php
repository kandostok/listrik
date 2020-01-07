<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PembayaranModel');
	}

	public function index()
	{
		$data['history'] = $this->PembayaranModel->get_history();
		$this->load->view('admin/history', $data);
	}

}

/* End of file Tagihan.php */
/* Location: ./application/controllers/Tagihan.php */