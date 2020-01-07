<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TarifModel extends CI_Model {

	public function get_tarif()
	{
		return $this->db->get('tarif')->result();
	}

	public function save_tarif()
    {
        $data = array(
            'id_tarif'	     => $this->input->post('id_tarif'),
            'daya'       	 => $this->input->post('daya'),
            'tarif'    	     => $this->input->post('tarif')
        );

        $this->db->insert('tarif', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function del_tarif($id_tarif)
    {
        $this->db->where('id_tarif', $id_tarif)
                 ->delete('tarif');
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function up_tarif()
    {
        $data = array(
            'id_tarif'	     => $this->input->post('id_tarif'),
            'daya'       	 => $this->input->post('daya'),
            'tarif'    	     => $this->input->post('tarif')
        );

        $this->db->where('id_tarif', $this->input->post('id_tarif'))
                 ->update('tarif', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_tarif_id($id_tarif)
    {
        return $this->db->where('id_tarif', $id_tarif)
                        ->get('tarif')
                        ->row();
        
    }

}

/* End of file TarifModel.php */
/* Location: ./application/models/TarifModel.php */