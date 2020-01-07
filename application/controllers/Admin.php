<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
	}

	public function index()
	{
		$this->load->view('admin/login');		
	}

	public function logout()
    {
        $data = array(
            'id_admin'    => "",
            'username'    => "",
            'logged_in'   => false
        );
        
        $this->session->unset_userdata('$data');
        $this->session->sess_destroy();
        redirect('admin');
    }

	public function do_login()
	{
		if ($this->input->post('login')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == true) {
				if ($this->AdminModel->cek_login() == true && $this->session->userdata('id_level') == 1) {
					redirect('admin/toAdmin');
				} elseif ($this->AdminModel->cek_login() == true && $this->session->userdata('id_level') == 2) {
					redirect('manajer');
				} else{
					$this->session->set_flashdata('notif_gagal', 'Username atau Password salah!');
	                redirect('admin');
				}
			} else {
				$this->session->set_flashdata('notif_gagal', validation_errors());
	            redirect('admin');
			}
		} else{
			$this->session->set_flashdata('notif_gagal', validation_errors());
	            redirect('admin');
		}
	}

	public function toAdmin()
	{
		$this->load->view('admin/dashboard_admin');
	}

	public function toManajer()
	{
		$this->load->view('admin/manajer');
	}

	public function dataAdmin()
	{
		$data['admin'] = $this->AdminModel->get_admin();
		$data['level'] = $this->AdminModel->get_level();
		$this->load->view('admin/admin', $data);
	}

	public function tambah_admin()
    {
        if ($this->input->post('tambah')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'trim|required');
            $this->form_validation->set_rules('level', 'Level', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                if ($this->AdminModel->save_admin() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Tambah Admin Sukses');
                    
                    redirect('admin/dataAdmin');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Tambah Admin Gagal');
                    
                    redirect('admin/dataAdmin');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('admin/dataAdmin');
                
            }
        } else {
            $this->session->set_flashdata('notif', validation_errors());
                
            redirect('admin/dataAdmin');
        }
    }

    public function delete_admin($id_admin)
    {
        if ($this->AdminModel->del_admin($id_admin) == true) {
            $this->session->set_flashdata('notif_sukses', 'Hapus Admin Sukses');
            
            redirect('admin/dataAdmin');
            
        } else {
            $this->session->set_flashdata('notif', 'Hapus Admin Gagal!');
            
            redirect('admin/dataAdmin');
            
        }
    }

    public function update_admin()
    {
        if ($this->input->post('edit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'trim|required');
            $this->form_validation->set_rules('level', 'Level', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->AdminModel->up_admin() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Update Admin Sukses');
                    
                    redirect('admin/dataAdmin');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Update Admin Gagal!');
                    
                    redirect('admin/dataAdmin');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('admin/dataAdmin');
                
            }
        } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('admin/dataAdmin');
                
            }
    }

    public function get_id_admin($id_admin)
    {
        $data_admin = $this->AdminModel->get_admin_id($id_admin);

        echo json_encode($data_admin);
    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */