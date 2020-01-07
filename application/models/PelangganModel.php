<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelangganModel extends CI_Model {

	public function get_pelanggan()
	{
		return $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif')->get('pelanggan')->result();
	}

	public function get_tarif()
	{
		return $this->db->get('tarif')->result();
	}

    public function cek_pel()
    {
        return $this->db->where('username',$this->input->post('username'))->where('password',$this->input->post('password'))->get('pelanggan');
    }

	public function save_pelanggan()
    {
        $data = array(
            'id_pelanggan'	 	=> $this->input->post('id_pelanggan'),
            'username'       	=> $this->input->post('username'),
            'password'       	=> $this->input->post('password'),
            'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
            'nomorKWH'			=> $this->input->post('nomorKWH'),
            'alamat'			=> $this->input->post('alamat'),
            'id_tarif'	 	    => $this->input->post('daya') 
        );

        $this->db->insert('pelanggan', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function del_pelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan)
                 ->delete('pelanggan');
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function up_pelanggan()
    {
        $data = array(
            'id_pelanggan'	 	=> $this->input->post('id_pelanggan'),
            'username'       	=> $this->input->post('username'),
            'password'       	=> $this->input->post('password'),
            'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
            'nomorKWH'			=> $this->input->post('nomorKWH'),
            'alamat'			=> $this->input->post('alamat'),
            'id_tarif'	 	    => $this->input->post('daya') 
        );

        $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'))
                 ->update('pelanggan', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_pelanggan_id($id_pelanggan)
    {
        return $this->db->where('id_pelanggan', $id_pelanggan)
                        ->get('pelanggan')
                        ->row();
        
    }

    public function login_pel()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $query = $this->db->where('username', $username)
                              ->where('password', $password)
                              ->get('pelanggan');

            if ($query->num_rows() > 0) {
                $dl = $query->row();

                $data = array(
                    'id_pelanggan'  => $dl->id_pelanggan,
                    'username'      => $dl->username,
                    'password'      => $dl->password,
                    'id_tarif'      => $dl->id_tarif,
                    'logged_id'     => true
                );
                
                $this->session->set_userdata($data);
                return true;
            } else{
                return false;
            }
        }
}

/* End of file PelangganModel.php */
/* Location: ./application/models/PelangganModel.php */