<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

	public function get_admin()
		{
			return $this->db->join('level', 'level.id_level=admin.id_level')->get('admin')->result();
		}

    public function detail_admin($id_admin)
    {
        return $this->db->where('id_admin', $id_admin)->get('admin')->row();
    }

	public function get_level()
		{
			return $this->db->get('level')->result();
		}

	public function cek_login()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$query = $this->db->where('username', $username)
							  ->where('password', $password)
							  ->get('admin');

			if ($query->num_rows() > 0) {
				$dl = $query->row();

				$data = array(
					'id_admin'  => $dl->id_admin,
					'username'  => $dl->username,
					'password'  => $dl->password,
					'adminName' => $dl->nama_admin,
                    'id_level'  => $dl->id_level,
					'logged_in'	=> true
				);
				
				$this->session->set_userdata($data);
                // die($this->session->set_userdata($data));
				return true;
			} else{
				return false;
			}
		}

	public function save_admin()
    {
        $data = array(
            'id_admin'	     => $this->input->post('id_admin'),
            'username'       => $this->input->post('username'),
            'password'       => $this->input->post('password'),
            'nama_admin'     => $this->input->post('nama_admin'),
            'id_level'	     => $this->input->post('level') 
        );

        $this->db->insert('admin', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function del_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin)
                 ->delete('admin');
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function up_admin()
    {
        $data = array(
            'id_admin'	     => $this->input->post('id_admin'),
            'username'       => $this->input->post('username'),
            'password'       => $this->input->post('password'),
            'nama_admin'     => $this->input->post('nama_admin'),
            'id_level'	         => $this->input->post('level') 
        );

        $this->db->where('id_admin', $this->input->post('id_admin'))
                 ->update('admin', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_admin_id($id_admin)
    {
        return $this->db->where('id_admin', $id_admin)
                        ->get('admin')
                        ->row();
        
    }	

}

/* End of file AdminModel.php */
/* Location: ./application/models/AdminModel.php */