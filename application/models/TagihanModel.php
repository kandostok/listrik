<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TagihanModel extends CI_Model {

	public function daftar_tagihan()
        {
            return $this->db->join('penggunaan', 'penggunaan.id_penggunaan=tagihan.id_penggunaan')
                            ->join('pelanggan', 'pelanggan.id_pelanggan=penggunaan.id_pelanggan')
                            ->join('tarif', 'tarif.id_tarif=pelanggan.id_tarif')
                            ->where('pelanggan.id_pelanggan', $this->session->userdata('id_pelanggan'))
                            ->order_by('id_tagihan', 'desc')
                            ->get('tagihan')->result();
        }

    public function get_pembayaran()
    {
        return $this->db->select('*, pembayaran.status as status_bayar')
                        ->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan')
                        ->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan')
                        ->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan')
                        ->where('pembayaran.status', 'pending')
                        ->get('pembayaran')->result();
    }

    public function get_admin()
    {
        return $this->db->select('*, admin.nama_admin as nama_admin')
                        ->where('admin.id_level', '1')
                        ->get('admin')->result();
    }

    public function cek_pembayaran($id_tagihan)
    {
        return $this->db->where('id_tagihan',$id_tagihan)
                        ->get('pembayaran')->row();
    }

    public function bayar()
        {
            $cb = $this->db
                ->where('id_tagihan',$this->input->post('id_tagihan'))
                ->get('pembayaran');
            $dt = $this->db
                ->where('id_tagihan',$this->input->post('id_tagihan'))
                ->get('tagihan')->row();
            $tar = $this->db->where('id_tarif', $this->session->userdata('id_tarif'))->get('tarif')->row();
            $ba = 2500;

            if($cb->num_rows()>0){
                $dt = $cb->row();
                $data = array(
                    'bukti'     =>$this->upload->data('file_name'),
                    'status'    =>'pending'
                );
                return $this->db->where('id_pembayaran',$dt->id_pembayaran)->update('pembayaran',$data);
            } else {
                
                $data = array(
                    'id_pembayaran'         => $this->input->post('id_pembayaran'),
                    'id_tagihan'            => $this->input->post('id_tagihan'),
                    'tanggal_bayar'         => date('Y-m-d'),
                    'bulan_bayar'           => $dt->bulan,
                    'biaya_admin'           => $ba,
                    'total_bayar'           => $ba + ($dt->jumlah_meter * $tar->tarif),
                    'status'                => 'pending',
                    'bukti'                 => $this->upload->data('file_name'),
                );
                return $this->db->insert('pembayaran',$data);
                
            }
        }

    public function get_verification($id_pembayaran, $id_tagihan, $status)
    {
        $data = array(
            'status'        => $status,
            'id_admin'      => $this->session->userdata('id_admin')
        );
        $ver = $this->db->where('id_pembayaran',$id_pembayaran)
                        ->update('pembayaran',$data);
        if($ver){
            $data = array(
            'status'    => $status
        );
            return $this->db->where('id_tagihan',$id_tagihan)
                ->update('tagihan',$data);
        }
    }  

}

/* End of file TagihanModel.php */
/* Location: ./application/models/TagihanModel.php */