<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LevelModel extends CI_Model {

	public function get_level()
	{
		return $this->db->get('level')->result();
	}

	public function save_level()
    {
        $data = array(
            'id_level'	     => $this->input->post('id_level'),
            'level'			 => $this->input->post('level')
        );

        $this->db->insert('level', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function del_level($id_level)
    {
        $this->db->where('id_level', $id_level)
                 ->delete('level');
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function up_level()
    {
        $data = array(
            'id_level'	     => $this->input->post('id_level'),
            'level'		     => $this->input->post('level') 
        );

        $this->db->where('id_level', $this->input->post('id_level'))
                 ->update('level', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_level_id($id_level)
    {
        return $this->db->where('id_level', $id_level)
                        ->get('level')
                        ->row();
    }

}

/* End of file LevelModel.php */
/* Location: ./application/models/LevelModel.php */