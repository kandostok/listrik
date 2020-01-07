<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LevelModel');
	}

	public function index()
	{
		$data['level'] = $this->LevelModel->get_level();
		$this->load->view('admin/level', $data);
	}

	public function tambah_level()
    {
        if ($this->input->post('tambah')) {
            $this->form_validation->set_rules('level', 'Level', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                if ($this->LevelModel->save_level() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Tambah level Sukses');
                    
                    redirect('level');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Tambah level Gagal');
                    
                    redirect('level');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('level');
                
            }
        } else {
            $this->session->set_flashdata('notif', validation_errors());
                
            redirect('level');
        }
    }

    public function delete_level($id_level)
    {
        if ($this->LevelModel->del_level($id_level) == true) {
            $this->session->set_flashdata('notif_sukses', 'Hapus level Sukses');
            
            redirect('level');
            
        } else {
            $this->session->set_flashdata('notif', 'Hapus level Gagal!');
            
            redirect('level');
            
        }
    }

    public function update_level()
    {
        if ($this->input->post('edit')) {
            $this->form_validation->set_rules('level', 'Level', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->LevelModel->up_level() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Update level Sukses');
                    
                    redirect('level');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Update level Gagal!');
                    
                    redirect('level');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('level');
                
            }
        } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('level');
                
            }
    }

    public function get_id_level($id_level)
    {
        $data_level = $this->LevelModel->get_level_id($id_level);

        echo json_encode($data_level);
    }

}

/* End of file Level.php */
/* Location: ./application/controllers/Level.php */