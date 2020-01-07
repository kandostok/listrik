<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranModel extends CI_Model {

	public function get_history()
		{
			return $this->db->join('admin', 'admin.id_admin = pembayaran.id_admin')
							->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan')
							->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan')
							->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan')
							->get('pembayaran')->result();
		}	

}

/* End of file PembayaranModel.php */
/* Location: ./application/models/PembayaranModel.php */