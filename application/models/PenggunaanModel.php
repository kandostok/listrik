<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggunaanModel extends CI_Model {

	public function get_pelanggan()
	{
		return $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif')->get('pelanggan')->result();
	}

	public function detail_pelanggan($id_pelanggan)
	{
		return $this->db->where('id_pelanggan', $id_pelanggan)->get('pelanggan')->row();
	}

	public function get_penggunaan()
	{
		return $this->db->get('penggunaan')->result();
	}

    public function detail_Penggunaan($id_pelanggan)
    {
        return $this->db->where('id_pelanggan',$id_pelanggan)->get('penggunaan')->result();
    }

    public function detail_tagihan($id_pelanggan)
    {
        return $this->db->join('penggunaan','penggunaan.id_penggunaan=tagihan.id_penggunaan')
                        ->where('id_pelanggan', $id_pelanggan)->get('tagihan')->result();
    }

	public function save()
    {
        $data = array(
            'id_penggunaan'	     => $this->input->post('id_penggunaan'),
            'id_pelanggan'       => $this->input->post('id_pelanggan'),
            'bulan'		         => $this->input->post('bulan'),
            'tahun'			     => $this->input->post('tahun'),
            'meter_awal'	     => $this->input->post('meter_awal'),
            'meter_akhir'	     => $this->input->post('meter_akhir') 
        );

        $this->db->insert('penggunaan', $data);
            if($this->db->affected_rows() > 0){
                $tm_penggunaan = $this->db
                                ->where('id_pelanggan',$this->input->post('id_pelanggan'))
                                ->order_by('id_penggunaan','desc')
                                ->limit(1)
                                ->get('penggunaan')->row();

                $data = array(
                    'id_penggunaan'     => $tm_penggunaan->id_penggunaan,
                    'bulan'             => $this->input->post('bulan'),
                    'tahun'             => $this->input->post('tahun'),
                    'jumlah_meter'      => ($this->input->post('meter_akhir')-$this->input->post('meter_awal')),
                    'status'            => 'belum lunas'
                );

            $this->db->insert('tagihan', $data);    
            }
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function del_peng($id_penggunaan)
    {
        $this->db->where('id_penggunaan', $id_penggunaan)
                 ->delete('penggunaan');
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file PenggunaanModel.php */
/* Location: ./application/models/PenggunaanModel.php */