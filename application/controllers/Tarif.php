<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('TarifModel');
	}

	public function index()
	{
		$data['tarif'] = $this->TarifModel->get_tarif();
		$this->load->view('admin/tarif', $data);
	}

	public function tambah_tarif()
    {
        if ($this->input->post('tambah')) {
            $this->form_validation->set_rules('daya', 'Daya', 'trim|required');
            $this->form_validation->set_rules('tarif', 'Tarif', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                if ($this->TarifModel->save_tarif() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Tambah tarif Sukses');
                    
                    redirect('tarif');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Tambah tarif Gagal');
                    
                    redirect('tarif');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('tarif');
                
            }
        } else {
            $this->session->set_flashdata('notif', validation_errors());
                
            redirect('tarif');
        }
    }

    public function delete_tarif($id_tarif)
    {
        if ($this->TarifModel->del_tarif($id_tarif) == true) {
            $this->session->set_flashdata('notif_sukses', 'Hapus tarif Sukses');
            
            redirect('tarif');
            
        } else {
            $this->session->set_flashdata('notif', 'Hapus tarif Gagal!');
            
            redirect('tarif');
            
        }
    }

    public function update_tarif()
    {
        if ($this->input->post('edit')) {
            $this->form_validation->set_rules('daya', 'Daya', 'trim|required');
            $this->form_validation->set_rules('tarif', 'Tarif', 'trim|required');

            if ($this->form_validation->run() == true) {
                if ($this->TarifModel->up_tarif() == true) {
                    $this->session->set_flashdata('notif_sukses', 'Update tarif Sukses');
                    
                    redirect('tarif');
                    
                } else {
                    $this->session->set_flashdata('notif', 'Update tarif Gagal!');
                    
                    redirect('tarif');
                    
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('tarif');
                
            }
        } else {
                $this->session->set_flashdata('notif', validation_errors());
                
                redirect('tarif');
                
            }
    }

    public function get_id_tarif($id_tarif)
    {
        $data_tarif = $this->TarifModel->get_tarif_id($id_tarif);

        echo json_encode($data_tarif);
    }

}

/* End of file Tarif.php */
/* Location: ./application/controllers/Tarif.php */